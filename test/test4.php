<?php
# ************************************************************************************************************************************************************
# SKRYPT REJESTRACJI UZYTKOWNIKOW STRONY
# CREATED BY MACIEJ KOLANKIEWICZ (C) 2012
# ************************************************************************************************************************************************************
# ************************************************************************************************************************************************************
# OBSLUGA BLEDOW
# ************************************************************************************************************************************************************
	ini_set( 'display_errors' ,  1 ); 
# ************************************************************************************************************************************************************
# ZNAJDOWANIE UNIWERSALEJ SCIEZKI DOSTEPU DO PLIKU ORAZ OKRESLANIE JEGO LOKALIZACJI
# ************************************************************************************************************************************************************
	$lokalizator = 0;$path_file = "";clearstatcache();
	$name_file = substr($_SERVER['PHP_SELF'],strpos(strrev($_SERVER['PHP_SELF']),'/',0)*(-1));
	while(!file_exists($path_file."path.php")){$path_file = "";
	for($q=0; $q <=(substr_count($_SERVER['PHP_SELF'], "/"))-$lokalizator; $q++)
	$path_file = $path_file."../";$lokalizator++;}
# ************************************************************************************************************************************************************
# ZALADOWANIE MECHANIZMU INICJACYJNEGO
# ************************************************************************************************************************************************************
	include_once($path_file."initiation/initiation.php");
# ************************************************************************************************************************************************************
# ZALADOWANIE TAGOW z MySQL
# ************************************************************************************************************************************************************
	$query = "SELECT * FROM kategorie";
	$ask = mysql_query($query) or die('BLAD POBRANIA TAGOW: '.mysql_error());
	$katString = '';
	while($asocarray = mysql_fetch_array($ask))
		$katString = $katString."'".$asocarray['nazwa']."',";
	$katString = substr($katString,0,strlen($katString)-1);
# ************************************************************************************************************************************************************

?>
	<script type="text/javascript">
	
		jQuery(document).ready(function() {
			
	//ZDEFINIOWANIE TABLICY TAGOW 
		var katArray = new Array (<?php echo $katString;?>);
	//WYSWIETLENIE TAGOW NA STRONIE 	
		function katView(id,idclass){
			$("#" + id).html('');
			$.each(katArray,function(index,value){
            	$("#" + id ).append('<a href="#"><div class="'+idclass+'">'+value+'</div></a>');        
           });
		}
	//WYSWIETLNIE WSZYSTKICH TAGOW
		katView('divKatAdd1','katAdd1');
	
	//SKRYPT DODANIA TAGU DO LISTY W POLU FORMULARZA
		$(".katAdd1").live("click",function(){
			//odczytanie wszystkich tagów z pola tekstowego
            var kat=$("#katAdd1").val();
			//nazwa kliknietego taga
            var newKat=$(this).html();
            console.log('tagi:' + katArray + '  NowyTag: ' + newKat);
			//zmiana koloru kliknietego taga
            $(this).css("color","#999");
			//sprawdzenie czy dodawany tag nie jest pierwszym tagiem 
            if(kat==''){
				//dodanie wybranego taga
			    $('#katAdd1').attr('value',newKat+',');
            }else{
				//ustawienie zmiennej sprawdzajacej czy tag juz nie zostal dodany
                var valueKatDuplicate=false;
				//zdefiniowanie pustego ciagu tagow
                var valueKatList='';
				//rozbicie tagow do tablicy 
                var numbersArray=kat.split(',');
				//sprawdzenie czy nowy tag istnieje w tablicy jesli nie zwraca -1 jesli tak zwaraca ilosc wystapien
				//okreslenie indeksu taga w tablicy
			    var indexTag=$.inArray(newKat,numbersArray);
                    if(indexTag>=0){
						//usunięcie taga z tablicy 
                        numbersArray.splice(indexTag,1);
                        $(this).css("color","#F30");
			            var valueKatDuplicate=true;
                    }
                $.each(numbersArray,function(index,value){
                    if(value!=''&&$.inArray(value,katArray )>=0) 
			            valueKatList = valueKatList + value  + ',';
                });
                if(!valueKatDuplicate)
                       valueKatList=valueKatList+newKat+',';
            }
            $('#katAdd1').attr('value',valueKatList);
        });
     //SKRYPT DODANIA NOWEGO TAGU DO BAZY DANYCH I TABLICY STRONY   
		$("#butKatAdd1").live("click", function(event){
			var newKat=$('#textKatAdd1').val();
			var katLocArray=newKat.split(',');
			//wykonanie petli dodajacej tagi 
			$.each(katLocArray,function(index,value) {
				if(value!='' && $.inArray(value,katArray ) == -1) 
					{
					//zdefiniowanie danych dla wysyłki do PHP - jonson
					var data = { "kat": value };
					//konwersja do postaci zapytania
					data = $(this).serialize() + "&" + $.param(data);
					console.log('dane jonson:' + data);
					//wywolanie AJAXA do komunikacji z PHP
					$.ajax({
					  type: "POST",
					  dataType: "json",
					  async: false,
					  url: "../admin/addkat.php", //sciezka do skryptu PHP dodajacego do bazy danych
					  data: data,
					// co jesli operacja wyslania danych i odpowiedzi zakonczyla sie sukcesem
					success: function(data) {
							console.log('odpowiedz jonson:' + data);
							//dodanie taga do wewnetrznej tablicy danych pod warunkiem statusu OK dla operacji na bazie danych
							if(data == 'OK') katArray.push(value);
							$('#textKatAdd1').val('');
						},
					//co jesli nie dodano do bazy danych
					error: function(xhr, status) {
							console.log('odpowiedz jonson: ERORR!!!');
							alert('Serwer nie odpowiada poprawnie: ' + data);
						}
					});
					}
				//wywolanie funkcji wyswietlania tagów
				katView('divKatAdd1','katAdd1');
			});
           
			console.log('doawanie:' + katArray);	
		});
		
		$("#butKatDel1").live("click", function(event){
			//pobranie zawartosci pola formularza
			var delKat=$('#katAdd1').val();
			//usunicie przecinak na koncu ciagu
			if(delKat.substring(delKat.length-1,delKat.length) == ',') delKat = delKat.substring(0,delKat.length-1);
			console.log('ciag do stworzenia tablicy: '+delKat);
			//utworzenie tablicy z ciagu
			var delArray=delKat.split(',');
			console.log('tagi do usuniecia tablica:' + delArray);
			//petla usuwania
			$.each(delArray,function(index,value) {
				//zdefiniowanie danych dla wysyłki do PHP - jonson
				var data = { "kat": value };
				//konwersja do postaci zapytania
				data = $(this).serialize() + "&" + $.param(data);
				console.log('dane jonson do usuniecia:' + data);
				
				//wywolanie AJAXA do komunikacji z PHP
				$.ajax({
					  type: "POST",
					  dataType: "json",
					  async: false,
					  url: "../admin/delkat.php", //sciezka do skryptu PHP dodajacego do bazy danych
					  data: data,
			// co jesli operacja wyslania danych i odpowiedzi zakonczyla sie sukcesem
				success: function(data) {
						console.log('odpowiedz jonson z kasowania:' + data);
						//dodanie taga do wewnetrznej tablicy danych pod warunkiem statusu OK dla operacji na bazie danych
						//sprawdzenie czy nowy tag istnieje w tablicy jesli nie zwraca -1 jesli tak zwaraca ilosc wystapien
						//okreslenie indeksu taga w tablicy
						var indexKat=$.inArray(value,katArray);
							if(indexKat>=0 && data == 'OK'){
								//usunięcie taga z tablicy 
								katArray.splice(indexKat,1);
								console.log('Kasowanie z tablicy zakonczylo sie powodzeniem: ' +  katArray );
								katView('divKatAdd1','katAdd1');
								$(this).css("color","#F30");
								$('#katAdd1').val('');
								
							}
					},
				//co jesli nie dodano do bazy danych
				error: function(xhr, status) {
						console.log('odpowiedz jonson: ERORR!!!');
						alert('Serwer nie odpowiada poprawnie: ' + data);
					}
				});
			});
		});

	});
	</script>
	<style type="text/css">
	body {
		font-family:Verdana, Geneva, sans-serif;
		font-size:14px;
		color:#484646;
		margin:0px;
		background-color:#f1efe8;
	}
	#okno	 {
		display: block;
		float: left;
		background-color:#F60;
		border: 1px solid black;
		width: 100px;
		height: 100px;
		margin:10px;
	}
	.katAdd1 {
		font-size:10px;
		color:#F30;
		float:left;
		padding:3px 7px 3px 7px;
		border-right:1px dotted #999;
	}
	.katAdd1:hover {
		color:#fff;
		background:#666;
	}
	label {
		font-size:10px;
	}
	#progressbarTagAdd {
		width:80%;
		#display:none;
		margin:0px 20px 0px 20px;
	}
	</style>
</head>
 
<body>
    <div id="divKatAdd1">
    BŁĄD - Dane nie przeszły z bazy danych
    </div>
    <br />
    <br />
    <div id="formKatAdd1">
        <label for="textKatAdd1">Podaj nową KATEGORIĘ lub grupę KATEGORII podając je po przecinkach</label><br />
        <input type="text" size="30" name="textKatAdd1" id="textKatAdd1" value="" class="formPoleText" />
        <input type="submit" value="Dodaj kategorię" name="butKatAdd1" id="butKatAdd1" class="buttonSub" />
    </div>
    <br />
    <label for="katAdd1">Kliknij na KATEGORII aby dodać ją do usunięcia. Drugie kliknięcie na KATEGORII usunie ją z listy</label><br />
    <input type="text" id="katAdd1" value="" name="katAdd1" size="90" class="formPoleText" />
    <input type="submit" value="Usuń kategorię" name="butKatDel1" id="butKatDel1" class="buttonSub" />
    
   
    
</body>
</html>