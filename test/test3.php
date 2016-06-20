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
	$query = "SELECT * FROM tagi";
	$ask = mysql_query($query) or die('BLAD POBRANIA TAGOW: '.mysql_error());
	$tagString = '';
	while($asocarray = mysql_fetch_array($ask))
		$tagString = $tagString."'".$asocarray['nazwa']."',";
	$tagString = substr($tagString,0,strlen($tagString)-1);
# ************************************************************************************************************************************************************

?>
	<script type="text/javascript">
	
		jQuery(document).ready(function() {
			
	//ZDEFINIOWANIE TABLICY TAGOW 
		var tagiArray = new Array (<?php echo $tagString;?>);
	//WYSWIETLENIE TAGOW NA STRONIE 	
		function tagView(id){
			$("#" + id).html('');
			$.each(tagiArray,function(index,value){
            	$("#divTagAdd1").append('<a href="#"><div class="tagAdd1">'+value+'</div></a>');        
           });
		}
	//WYSWIETLNIE WSZYSTKICH TAGOW
		tagView('divTagAdd1');
	
	//SKRYPT DODANIA TAGU DO LISTY W POLU FORMULARZA
		$(".tagAdd1").on("click",function(){
			//odczytanie wszystkich tagów z pola tekstowego
            var tagi=$("#tagAdd1").val();
			//nazwa kliknietego taga
            var newTag=$(this).html();
            console.log('tagi:' + tagiArray + '  NowyTag: ' + newTag);
			//zmiana koloru kliknietego taga
            $(this).css("color","#999");
			//sprawdzenie czy dodawany tag nie jest pierwszym tagiem 
            if(tagi==''){
				//dodanie wybranego taga
			    $('#tagAdd1').attr('value',newTag+',');
            }else{
				//ustawienie zmiennej sprawdzajacej czy tag juz nie zostal dodany
                var valueTagDuplicate=false;
				//zdefiniowanie pustego ciagu tagow
                var valueTagList='';
				//rozbicie tagow do tablicy 
                var numbersArray=tagi.split(',');
				//sprawdzenie czy nowy tag istnieje w tablicy jesli nie zwraca -1 jesli tak zwaraca ilosc wystapien
				//okreslenie indeksu taga w tablicy
			    var indexTag=$.inArray(newTag,numbersArray);
                    if(indexTag>=0){
						//usunięcie taga z tablicy 
                        numbersArray.splice(indexTag,1);
                        $(this).css("color","#F30");
			            var valueTagDuplicate=true;
                    }
                $.each(numbersArray,function(index,value){
                    if(value!=''&&$.inArray(value,tagiArray )>=0) 
			            valueTagList = valueTagList + value  + ',';
                });
                if(!valueTagDuplicate)
                       valueTagList=valueTagList+newTag+',';
            }
            $('#tagAdd1').attr('value',valueTagList);
        });
     //SKRYPT DODANIA NOWEGO TAGU DO BAZY DANYCH I TABLICY STRONY   
		$("#butTagAdd1").on("click", function(event){
			var newTag=$('#textTagAdd1').val();
			var tagArray=newTag.split(',');
			//wykonanie petli dodajacej tagi 
			$.each(tagArray,function(index,value) {
				if(value!='' && $.inArray(value,tagiArray ) == -1) 
					{
					//zdefiniowanie danych dla wysyłki do PHP - jonson
					var data = { "tag": value };
					//konwersja do postaci zapytania
					data = $(this).serialize() + "&" + $.param(data);
					console.log('dane jonson:' + data);
					//wywolanie AJAXA do komunikacji z PHP
					$.ajax({
					  type: "POST",
					  dataType: "json",
					  async: false,
					  url: "../admin/addtag.php", //sciezka do skryptu PHP dodajacego do bazy danych
					  data: data,
					// co jesli operacja wyslania danych i odpowiedzi zakonczyla sie sukcesem
					success: function(data) {
							console.log('odpowiedz jonson:' + data);
							//dodanie taga do wewnetrznej tablicy danych pod warunkiem statusu OK dla operacji na bazie danych
							if(data == 'OK') tagiArray.push(value);
							$('#textTagAdd1').val('');
						},
					//co jesli nie dodano do bazy danych
					error: function(xhr, status) {
							console.log('odpowiedz jonson: ERORR!!!');
							alert('Serwer nie odpowiada poprawnie: ' + data);
						}
					});
					}
				//wywolanie funkcji wyswietlania tagów
				tagView('divTagAdd1');
			});
           
			console.log('doawanie:' + tagiArray);	
		});
		
		$("#butTagDel1").on("click", function(event){
			//pobranie zawartosci pola formularza
			var delTag=$('#tagAdd1').val();
			//usunicie przecinak na koncu ciagu
			if(delTag.substring(delTag.length-1,delTag.length) == ',') delTag = delTag.substring(0,delTag.length-1);
			console.log('ciag do stworzenia tablicy: '+delTag);
			//utworzenie tablicy z ciagu
			var delArray=delTag.split(',');
			console.log('tagi do usuniecia tablica:' + delArray);
			//petla usuwania
			$.each(delArray,function(index,value) {
				//zdefiniowanie danych dla wysyłki do PHP - jonson
				var data = { "tag": value };
				//konwersja do postaci zapytania
				data = $(this).serialize() + "&" + $.param(data);
				console.log('dane jonson do usuniecia:' + data);
				
				//wywolanie AJAXA do komunikacji z PHP
				$.ajax({
					  type: "POST",
					  dataType: "json",
					  async: false,
					  url: "../admin/deltag.php", //sciezka do skryptu PHP dodajacego do bazy danych
					  data: data,
			// co jesli operacja wyslania danych i odpowiedzi zakonczyla sie sukcesem
				success: function(data) {
						console.log('odpowiedz jonson z kasowania:' + data);
						//dodanie taga do wewnetrznej tablicy danych pod warunkiem statusu OK dla operacji na bazie danych
						//sprawdzenie czy nowy tag istnieje w tablicy jesli nie zwraca -1 jesli tak zwaraca ilosc wystapien
						//okreslenie indeksu taga w tablicy
						var indexTag=$.inArray(value,tagiArray);
							if(indexTag>=0 && data == 'OK'){
								//usunięcie taga z tablicy 
								tagiArray.splice(indexTag,1);
								console.log('Kasowanie z tablicy zakonczylo sie powodzeniem: ' +  tagiArray );
								tagView('divTagAdd1');
								$(this).css("color","#F30");
								$('#tagAdd1').val('');
								
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
	.tagAdd1, .tagAdd2 {
		font-size:10px;
		color:#F30;
		float:left;
		padding:3px 7px 3px 7px;
		border-right:1px dotted #999;
	}
	.tagAdd1:hover,.tagAdd2:hover {
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
    <div id="divTagAdd1">
    BŁĄD - Dane nie przeszły z bazy danych
    </div>
    <br />
    <br />
    <div id="formTagAdd1">
        <label for="textTagAdd1">Podaj nowy TAG lub grupę TAGÓW podając je po przecinkach</label><br />
        <input type="text" size="30" name="textTagAdd1" id="textTagAdd1" value="" class="formPoleText" />
        <input type="submit" value="Dodaj" name="butTagAdd1" id="butTagAdd1" class="buttonSub" />
    </div>
    <br />
    <label for="tagAdd1">Kliknij na tagu aby dodać go do usunięcia. Drugie kliknięcie na tagu usunie go z listy</label><br />
    <input type="text" id="tagAdd1" value="" name="tagAdd1" size="90" class="formPoleText" />
    <input type="submit" value="Usuń tagi" name="butTagDel1" id="butTagDel1" class="buttonSub" />
    
   
    
</body>
</html>