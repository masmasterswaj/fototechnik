<?php
# ************************************************************************************************************************************************************
# SKRYPT STEROWANIA STRONA JQUERY
# CREATED BY MACIEJ KOLANKIEWICZ (C) 2014
# ************************************************************************************************************************************************************
# ************************************************************************************************************************************************************
# SKRYPT INICJACJI STRONY
# CREATED BY MACIEJ KOLANKIEWICZ (C) 2012
# ************************************************************************************************************************************************************
# ************************************************************************************************************************************************************
# funkcja wyswietlajaca informacje.
# ************************************************************************************************************************************************************
	ini_set( 'display_errors', 'On' ); 
	error_reporting( E_ALL );
# ************************************************************************************************************************************************************
# WARTOSC ILOSCI ARTYKULOW NA STRON ZWIAZANA ZE SKRYPTAMI JQUERY I ICH GENEROWANIEM PRZEZ PHP
# ************************************************************************************************************************************************************
	$ilelement = 10;
# ************************************************************************************************************************************************************
# ZNAJDOWANIE UNIWERSALEJ SCIEZKI DOSTEPU DO PLIKU ORAZ OKRESLANIE JEGO LOKALIZCJI
# ************************************************************************************************************************************************************
	$lokalizator = 0;$path_file = "";clearstatcache();
	$name_file = substr($_SERVER['PHP_SELF'],strpos(strrev($_SERVER['PHP_SELF']),'/',0)*(-1));
	while(!file_exists($path_file."path.php")){$path_file = "";
	for($q=0; $q <=(substr_count($_SERVER['PHP_SELF'], "/"))-$lokalizator; $q++)
	$path_file = $path_file."../";$lokalizator++;}
# ************************************************************************************************************************************************************
?>
<script type="text/javascript">
//FUNKCJA WYWOLUJACA OBIEKT EDYTORA TEKSTU W ZNACZNIKU TEXTAREA **********************************************************************************************
tinymce.init({
	selector: "textarea",
	theme: "modern",
	
	plugins: [
		"advlist autolink lists link image charmap print preview hr anchor pagebreak",
		"searchreplace wordcount visualblocks visualchars code fullscreen",
		"insertdatetime media nonbreaking save table contextmenu directionality",
		"emoticons template paste textcolor responsivefilemanager"
	],
	
	toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
	toolbar2: "print preview media | forecolor backcolor emoticons",
	image_advtab: true,
	templates: [
		{title: 'Test template 1', content: 'Test 1'},
		{title: 'Test template 2', content: 'Test 2'}
	],
   external_filemanager_path:"/fototechnik/filemenager/",
   filemanager_title:"Menadżer plików",
   external_plugins: { "filemanager" : "/fototechnik/filemenager/plugin.min.js"},
});
//WYWOLANIE FUNKCJI FACEBOOKA ****************************************************************************************************************************
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

//WYWOLANIE FUNKCJI JQUERY *******************************************************************************************************************************
jQuery(document).ready(function() {
//WERYFIKACJA POL FORMULARZY *****************************************************************************************************************************
<?php
# ************************************************************************************************************************************************************
# GENEROWANIE FUNKCJI DLA WYSWIETLANIA TAGOW I ICH EDYCJI DLA EDYCJI AKTUALNOSCI
# ************************************************************************************************************************************************************
	for($i = 1; $i <= $ilelement; $i++)
		{
		if($i<=9) $index = '0'.$i; else $index = $i;
# ************************************************************************************************************************************************************
?>	
	$("#formularz<?php echo $index;?>").validate({ 
		messages: {
			tytulAkt<?php echo $index;?>: {
				required: 'Pole tytułu aktualności musi być uzupełnione',
				minlength: 'Wpisz conajmniej {0} znaki',
			},
			tytulArt<?php echo $index;?>: {
				required: 'Pole tytułu artykułu musi być uzupełnione',
				minlength: 'Wpisz conajmniej {0} znaki',
			},
			textAkt<?php echo $index;?>: {
				errorLabelContainer: "#textAktError",
				required: 'Treść musi zostać uzupełniona',
				minlength: 'Wpisz conajmniej {0} znaki',
			},
			textArt<?php echo $index;?>: {
				errorLabelContainer: "#textAktError",
				required: 'Treść musi zostać uzupełniona',
				minlength: 'Wpisz conajmniej {0} znaki',
			},
			tagAktE<?php echo $index;?>: {
				required: 'Musisz dodać chociaż jeden TAG',
			},
			katAktE<?php echo $index;?>: {
				required: 'Musisz dodać chociaż jedeną kategorię',
			},
			dataAkt<?php echo $index;?>: {
				required: 'Data publikacji artykułu musi zostać zdefiniowana',
				minlength: 'Wpisz conajmniej {0} znaki',
				date: 'Nie poprawna forma daty',
			},
			autor<?php echo $index;?>: {
				required: 'Autor tego artykułu musi być podany',
				minlength: 'Wpisz conajmniej {0} znaki',
			},
		},
		ignore: '',
		rules: {"hidden_field": {required:true}}
	});	
<?php
# ************************************************************************************************************************************************************
		}
# ************************************************************************************************************************************************************
?>	

	$("#formularzW").validate({ 
		messages: {
			tytulAktW: {
				required: 'Pole tytułu aktualności musi być uzupełnione',
				minlength: 'Wpisz conajmniej {0} znaki',
			},
			tytulArtW: {
				required: 'Pole tytułu artykułu musi być uzupełnione',
				minlength: 'Wpisz conajmniej {0} znaki',
			},
			textAktW: {
				errorLabelContainer: "#textAktError",
				required: 'Treść musi zostać uzupełniona',
				minlength: 'Wpisz conajmniej {0} znaki',
			},
			textArtW: {
				errorLabelContainer: "#textAktError",
				required: 'Treść musi zostać uzupełniona',
				minlength: 'Wpisz conajmniej {0} znaki',
			},
			tagAktW: {
				required: 'Musisz dodać chociaż jeden TAG',
			},
			katAktW: {
				required: 'Musisz dodać chociaż jedeną kategorię',
			},
			dataAktW: {
				required: 'Data publikacji artykułu musi zostać zdefiniowana',
				minlength: 'Wpisz conajmniej {0} znaki',
				date: 'Nie poprawna forma daty',
			},
			autorW: {
				required: 'Autor tego artykułu musi być podany',
				minlength: 'Wpisz conajmniej {0} znaki',
			},
			email: {
				required: 'Pole wymagane',
				email: 'Wpisz poprawny adres email',
			},
			url: {
				url: 'Wpisz poprawny adres URL',
			},
			comment: {
				required: 'Pole wymagane',
			},
		},
		ignore: '',
		rules: {"hidden_field": {required:true}}
	});	
<?php
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
	// TAGI TAGI TAGI ****************************************************************************************************************************************
	//ZDEFINIOWANIE FUNKCJI GENERATORA LICZB *****************************************************************************************************************
		function generate() {
			return (Math.floor(Math.random()*6)+1);
		  }
	//WYSWIETLENIE TAGOW NA STRONIE  - FUNKCJA	
		function tagView(id,idclass){
			$("#" + id).html('');
			$.each(tagiArray,function(index,value){
            	$("#" + id).append('<a href="#"><div class="'+idclass+'">'+value+'</div></a>');      
           });
		}
	//WYWOLANIE FUNKCJI DODAWANIA TAGOW DO POLA FORMULARZ ****************************************************************************************************
	var tagiArray = new Array (<?php echo $tagString;?>);
	
	//DODAWANIE TAGOW W OKNACH KONFIGURACYJNYCH.
	function tagViewGroup() {
		//Dodanie tagow lub aktualizacja w oknie zapisu
		tagView('adminWriteTag','tagAktW');
		//Dodanie tagow lub aktualizacja w oknie dodawania tagow
		tagView('divTagAdd1','tagAdd1');
		//Dodanie tagow lub aktualizacja w oknie edycji artykulu 01
		tagView('tagEdit01','tagAktE01');
		//aktualizacja tagów na stronie. 
		var el = $.map(tagiArray, function(val, i) {
				var liczba = generate();	
				  return '<a href="#" class="tag' +liczba+ '">#' + val + "</a>, ";
				});
			$("#tagiStrona").html(el.join(""));  
	}
	//WYWOLANIE FUNKCJI AKTUALIZACJI TAGOW NA STRONIE
	tagViewGroup();
	// STEROWANIE TAGAI ****************************************************************************************************************************************
	//WYSWIETLNIE WSZYSTKICH TAGOW
		
	
	//SKRYPT DODANIA TAGU DO LISTY W POLU FORMULARZA
		$(".tagAdd1").live("click",function(){
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
		$("#butTagAdd1").live("click", function(event){
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
				tagViewGroup();
			});
           
			console.log('doawanie:' + tagiArray);	
		});
		
		$("#butTagDel1").live("click", function(event){
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
								//zdefiniowana funkcja dodawania taga. (nazwa div w ktorym beda linki tagow, nazwa klasy hiperłącza
								tagViewGroup();
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
<?php
# ************************************************************************************************************************************************************
# ZALADOWANIE KATEGORII z MySQL
# ************************************************************************************************************************************************************
	$query = "SELECT * FROM kategorie";
	$ask = mysql_query($query) or die('BLAD POBRANIA TAGOW: '.mysql_error());
	$katString = '';
	while($asocarray = mysql_fetch_array($ask))
		$katString = $katString."'".$asocarray['nazwa']."',";
	$katString = substr($katString,0,strlen($katString)-1);
# ************************************************************************************************************************************************************
?>

	//KATEGORIE ***********************************************************************************************************************************************	
	//ZDEFINIOWANIE TABLICY KATEGORII 
		var katArray = new Array (<?php echo $katString;?>);
	//WYSWIETLENIE KATEGORII NA STRONIE  - FUNKCJA	
		function katView(id,idclass){
			$("#" + id).html('');
			$.each(katArray,function(index,value){
            	$("#" + id ).append('<a href="#"><div class="'+idclass+'">'+value+'</div></a>');        
           });
		}
	//DODAWANIE TAGOW W OKNACH KONFIGURACYJNYCH.
	function katViewGroup() {
		//Dodanie tagow lub aktualizacja w oknie zapisu
		katView('adminWriteKat','katAktW');
		//Dodanie tagow lub aktualizacja w oknie dodawania tagow
		katView('divKatAdd1','katAdd1');
		//Dodanie tagow lub aktualizacja w oknie edycji artykulu 01
		katView('katEdit01','katAktE01');
		//aktualizacja kategorii 
		$("#kategorieLista").html('');
		$.each(katArray,function(index,value){
			$("#kategorieLista").append('<a href="#" class="kategoria-link"><div class="kategoria-el"><img src="../images/dot.png" width="5" height="5">'+value+'</div></a>');
		});
	}
	//WYWOLANIE FUNKCJI AKTUALIZACJI TAGOW NA STRONIE
	katViewGroup();
	// STEROWANIE KATEGORIAMI *************************************************************************************************************************************

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
				katViewGroup();
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
								katViewGroup();
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
	//*****************************************************************************************************************************************************
							   
	$(".tagAktW").live("click", function(){var tagi=$("#tagAktW").val();var newTag=$(this).html();$(this).css("color","#999");if(tagi==''){ 
		$('#tagAktW').attr('value',newTag+',');}else{var valueTagDuplicate=false;var valueTagList='';var numbersArray=tagi.split(',');
		var indexTag=$.inArray(newTag,numbersArray);if(indexTag>=0){numbersArray.splice(indexTag,1);$(this).css("color","#F30");
		var valueTagDuplicate=true;}$.each(numbersArray,function(index,value){if(value!=''&&$.inArray(value,tagiArray )>=0) 
		valueTagList = valueTagList + value  + ',';});if(!valueTagDuplicate)valueTagList=valueTagList+newTag+',';}
		$('#tagAktW').attr('value',valueTagList);});
<?php
# ************************************************************************************************************************************************************
# GENEROWANIE FUNKCJI DLA WYSWIETLANIA TAGOW I ICH EDYCJI DLA EDYCJI AKTUALNOSCI
# ************************************************************************************************************************************************************
	for($i = 1; $i <= $ilelement; $i++)
		{
		if($i<=9) $index = '0'.$i; else $index = $i;
# ************************************************************************************************************************************************************
?>			
	$(".tagAktE<?php echo $index;?>").live("click", function(){var tagi=$("#tagAktE<?php echo $index;?>").val();var newTag=$(this).html();$(this).css("color","#999");if(tagi==''){ 
		$('#tagAktE<?php echo $index;?>').attr('value',newTag+',');}else{var valueTagDuplicate=false;var valueTagList='';var numbersArray=tagi.split(',');

		var indexTag=$.inArray(newTag,numbersArray);if(indexTag>=0){numbersArray.splice(indexTag,1);$(this).css("color","#F30");
		var valueTagDuplicate=true;}$.each(numbersArray,function(index,value){if(value!=''&&$.inArray(value,tagiArray )>=0) 
		valueTagList = valueTagList + value  + ',';});if(!valueTagDuplicate)valueTagList=valueTagList+newTag+',';}
		$('#tagAktE<?php echo $index;?>').attr('value',valueTagList);});
<?php
# ************************************************************************************************************************************************************
		}
# ************************************************************************************************************************************************************
?>
	//WYWOLANIE FUNKCJI DODAWANIA TAGOW DO POLA FORMULARZ ***************************************************************************************************
	
	$(".katAktW").live("click",function(){var tagi=$("#katAktW").val();var newTag=$(this).html();$(this).css("color","#999");if(tagi==''){ 
		$('#katAktW').attr('value',newTag+',');}else{var valueTagDuplicate=false;var valueTagList='';var numbersArray=tagi.split(',');
		var indexTag=$.inArray(newTag,numbersArray);if(indexTag>=0){numbersArray.splice(indexTag,1);$(this).css("color","#F30");
		var valueTagDuplicate=true;}$.each(numbersArray,function(index,value){if(value!=''&&$.inArray(value,katArray )>=0) 
		valueTagList = valueTagList + value  + ',';});if(!valueTagDuplicate)valueTagList=valueTagList+newTag+',';}
		$('#katAktW').attr('value',valueTagList);});
<?php
# ************************************************************************************************************************************************************
# GENEROWANIE FUNKCJI DLA WYSWIETLANIA TAGOW I ICH EDYCJI DLA EDYCJI AKTUALNOSCI
# ************************************************************************************************************************************************************
	for($i = 1; $i <= $ilelement; $i++)
		{
		if($i<=9) $index = '0'.$i; else $index = $i;
# ************************************************************************************************************************************************************
?>			
	
	$(".katAktE<?php echo $index;?>").live("click",function(){var tagi=$("#katAktE<?php echo $index;?>").val();var newTag=$(this).html();$(this).css("color","#999");if(tagi==''){ 
		$('#katAktE<?php echo $index;?>').attr('value',newTag+',');}else{var valueTagDuplicate=false;var valueTagList='';var numbersArray=tagi.split(',');
		var indexTag=$.inArray(newTag,numbersArray);if(indexTag>=0){numbersArray.splice(indexTag,1);$(this).css("color","#F30");
		var valueTagDuplicate=true;}$.each(numbersArray,function(index,value){if(value!=''&&$.inArray(value,katArray )>=0) 
		valueTagList = valueTagList + value  + ',';});if(!valueTagDuplicate)valueTagList=valueTagList+newTag+',';}
		$('#katAktE<?php echo $index;?>').attr('value',valueTagList);});
	
<?php
# ************************************************************************************************************************************************************
		}
# ************************************************************************************************************************************************************
?>
	
	
	//WYWOLANIE FUNKCJI KALENDARZA DLA ELEMENTU MENU ******************************************************************************************************
	$(function() {
		$("#datepickerW, #datepicker01, #datepicker02" ).datepicker({ dateFormat: "yy-mm-dd" } );
	  });
	//WYWOLANIE FUNKCJI WIELU OKIEN
	$(function() {
		$("#tabsW, #tabsTag, #tabsKat, #tabs01, #tabs02").tabs();
	});
	
	//FUNKCJA USTAWIAJACA OKNO NA SRODKU EKRANU  **********************************************************************************************************
	function windowPos(dlxmin,dlymin,dlx,dly,obiekt,nr) {
		var dlwx = window.innerWidth;
		var dlwy = window.innerHeight;
		
		var dlxm = ((dlwx/2)-(dlx/2));
		var dlym = ((dlwy/2)-(dly/2));
		if(nr == '') nr = ''; else nr = '.'+nr;
		
		$('#'+obiekt+nr)
			.css("margin-top",((dlwy/2)-(dlymin/2)) + "px")
			.css("margin-left",((dlwx/2)-(dlxmin/2)) + "px")
			.css("width",dlxmin + "px")
			.css("height",dlymin + "px")
		return okno;
		}
	
	/*	
	//FUNKCJA WYSWIETLANIA OKNA ***************************************************************************************************************************
	function windowOver(dlxmin,dlymin,dlx,dly,idOkno,idZaw,idTlo,nr) {
		windowPos(dlxmin,dlymin,dlx,dly,idOkno,nr);
		var dlwx = window.innerWidth;
		var dlwy = window.innerHeight;
		
		var dlxm = ((dlwx/2)-(dlx/2));
		var dlym = ((dlwy/2)-(dly/2));
		if(nr == '') nr = ''; else nr = '.'+nr;
		if(okno) {
		$("#"+idTlo).fadeIn('slow');	
		
		$('#'+idOkno+nr)
			.css("display","block")
			.animate({opacity:"1"},"slow")
			.animate({height:dly, marginTop: dlym},"slow")
			.animate({width:dlx, marginLeft: dlxm},"slow", function() {
		
		$('#'+idZaw+nr)
			.animate({opacity:"1"},"slow");
			window.okno = false;
			});
		
		}
	}
	//FUNKCJA ZWIJAJACA OKNO ******************************************************************************************************************************
	function windowOut (dlxmin,dlymin,dlx,dly,idOkno,idZaw,idTlo,nr)
		{
		var dlwx = window.innerWidth;
		var dlwy = window.innerHeight;
		
		var dlxm = ((dlwx/2)-(dlx/2));
		var dlym = ((dlwy/2)-(dly/2));
		
		if(nr == '') nr = ''; else nr = '.'+nr;
		$('#'+idZaw+nr)
			.animate({opacity:"0"},"slow")
		$('#'+idOkno+nr)
			.animate({height:dlymin, marginTop: ((dlwy/2)-(dlymin/2))},"slow")
			.animate({width:dlxmin, marginLeft: ((dlwx/2)-(dlxmin/2))},"slow")
			.animate({opacity:"0"},"slow")
		//.css("display","none")
		$("#"+idTlo)
			.animate({opacity:"0"},"slow")
		$("#"+idTlo)
			.fadeOut('slow');	
		$("#"+idTlo)
			.animate({opacity:"0.8"},"slow")
		window.okno = true;
	
		}
		
	//FUNKCJA WYSWIETLANIA OKNA ***************************************************************************************************************************
	function windowOver(dlxmin,dlymin,dlx,dly,idOkno,idZaw,idTlo,nr) {
		windowPos(dlxmin,dlymin,dlx,dly,idOkno,nr);
		var dlwx = window.innerWidth;
		var dlwy = window.innerHeight;
		
		var dlxm = ((dlwx/2)-(dlx/2));
		var dlym = ((dlwy/2)-(dly/2));
		if(nr == '') nr = ''; else nr = '.'+nr;
		if(okno) {
		$("#tlo1").fadeIn('slow');	
		
		$('#'+idOkno+nr)
			.css("display","block")
			.animate({opacity:"1"},"slow")
			.animate({height:dly, marginTop: dlym},"slow")
			.animate({width:dlx, marginLeft: dlxm},"slow", function() {
		
		$('#'+idZaw+nr)
			.animate({opacity:"1"},"slow");
			window.okno = false;
			});
		
		}
	}
	//FUNKCJA ZWIJAJACA OKNO ******************************************************************************************************************************
	function windowOut (dlxmin,dlymin,dlx,dly,idOkno,idZaw,idTlo,nr)
		{
		var dlwx = window.innerWidth;
		var dlwy = window.innerHeight;
		
		var dlxm = ((dlwx/2)-(dlx/2));
		var dlym = ((dlwy/2)-(dly/2));
		
		if(nr == '') nr = ''; else nr = '.'+nr;
		$('#'+idZaw+nr)
			.animate({opacity:"0"},"slow")
		$('#'+idOkno+nr)
			.animate({height:dlymin, marginTop: ((dlwy/2)-(dlymin/2))},"slow")
			.animate({width:dlxmin, marginLeft: ((dlwx/2)-(dlxmin/2))},"slow")
			.animate({opacity:"0"},"slow")
		//.css("display","none")
		//$("#tlo1")
		//	.animate({opacity:"0"},"slow")
		$("#tlo1")
			.fadeOut('slow')
			.hide('slow')
		//$("#tlo1")
		//	.animate({opacity:"0.8"},"slow")
		
		window.okno = true;
	
		}
	//USTAWIENIE NA SRODKU ONA ADMINEDIT ******************************************************************************************************************
		var dlxmin = 50;
		var dlymin = 50;
		var dlx = 900;
		var dly = 600;
		var okno = true;
	*/
	
	//WYWOLANIE FUNKCJI DLA POSZCZEGOLNYCH PRZYCISKÓW *****************************************************************************************************
	//WYWOLANIE FUNKCJI DLA EDYCJI ARTYKULOW **************************************************************************************************************
<?php
# ************************************************************************************************************************************************************
# GENEROWANIE FUNKCJI DLA WYSWIETLANIA TAGOW I ICH EDYCJI DLA EDYCJI AKTUALNOSCI
# ************************************************************************************************************************************************************
	for($i = 1; $i <= $ilelement; $i++)
		{
		if($i<=9) $index = '0'.$i; else $index = $i;
# ************************************************************************************************************************************************************
?>	
	$(".fancyboxEffects").fancybox({
				wrapCSS    : 'fancybox-custom',
				padding: 20,
				type:'inline',
				autoSize: false,
				width:960,
				height:500,
				arrows : true,
				openMethod: 'zoomIn',
				closeMethod: 'zoomOut',
				openEffect  : 'fade',
				closeEffect : 'fade',
				

				//openEffect : 'elastic',
				openSpeed  : 1000,

				//closeEffect : 'elastic',
				closeSpeed  : 500,

				closeClick : false,
				closeBtn  : true,

				helpers : {
					overlay : {
						speedIn : 1000,
						speedOut : 1000,
						
					},
					title : {
						openSpeed  : 500,
					},
				}
			});
	$(".adminEdit#a<?php echo $index;?>").click(function() {
			$.ajax({
				type: "GET",
				url: "<?php echo $path_file;?>filemenager/config/config.php?nrArt=000<?php echo $index;?>"
			});
			windowOver(dlxmin,dlymin,dlx,dly,'adminEditOkno','adminEditZaw','tlo1','e<?php echo $index;?>');
			});
	//WYWOLANIE FUNKCJI DLA DODAWANIA PLIKÓW **************************************************************************************************************
	$(".adminPic#a<?php echo $index;?>").click(function() {
			windowOver(dlxmin,dlymin,dlx,dly,'adminFileOkno','adminFileZaw','tlo3','f<?php echo $index;?>');
			});
	//WYWOLANIE FUNKCJI DLA KASOWANIA ARTYKULU ************************************************************************************************************
	$(".adminDel#a<?php echo $index;?>").click(function() {
			windowOver(dlxmin,dlymin,dlx,dly,'adminDelOkno','adminDelZaw','tlo4','d<?php echo $index;?>');
			});
<?php
# ************************************************************************************************************************************************************
		}
# ************************************************************************************************************************************************************
?>
	//WYWOLANIE FUNKCJI DLA NOWEGO ARTYKULU ***************************************************************************************************************
	$(".adminWrite").live("click", function() {
			$.ajax({
				type: "GET",
				url: "<?php echo $path_file;?>filemenager/config/config.php?nrArt=00002"
			});
			
			windowOver(dlxmin,dlymin,dlx,dly,'adminWriteOkno','adminWriteZaw','tlo2','');
			});
	//WYWOLANIE FUNKCJI DLA DODAWANIA TAGÓW ***************************************************************************************************************
	$(".adminTag").live("click", function() {
			windowOver(dlxmin,dlymin,dlx,dly,'adminTagOkno','adminTagZaw','tlo5','');
			});
	//WYWOLANIE FUNKCJI DLA DODAWANI AKATEGORII ***********************************************************************************************************
	$(".adminKat").live("click", function() {
			windowOver(dlxmin,dlymin,dlx,dly,'adminKatOkno','adminKatZaw','tlo6','');
			});
	//TLA I FUNCKJE ZAMYKAJACE OKNA ***********************************************************************************************************************
	$("#tlo1,.buttonSub#ana01,.buttonSub#ana02").live("click", function() {
			windowOut(dlxmin,dlymin,dlx,dly,'adminEditOkno','adminEditZaw','tlo1','e01');
			windowOut(dlxmin,dlymin,dlx,dly,'adminEditOkno','adminEditZaw','tlo1','e02');
			windowOut(dlxmin,dlymin,dlx,dly,'adminEditOkno','adminEditZaw','tlo1','e03');
			windowOut(dlxmin,dlymin,dlx,dly,'adminEditOkno','adminEditZaw','tlo1','e04');
			windowOut(dlxmin,dlymin,dlx,dly,'adminEditOkno','adminEditZaw','tlo1','e05');
			windowOut(dlxmin,dlymin,dlx,dly,'adminEditOkno','adminEditZaw','tlo1','e06');
			windowOut(dlxmin,dlymin,dlx,dly,'adminEditOkno','adminEditZaw','tlo1','e07');
			windowOut(dlxmin,dlymin,dlx,dly,'adminEditOkno','adminEditZaw','tlo1','e08');
			windowOut(dlxmin,dlymin,dlx,dly,'adminEditOkno','adminEditZaw','tlo1','e09');
			windowOut(dlxmin,dlymin,dlx,dly,'adminEditOkno','adminEditZaw','tlo1','e10');
		});
	$("#tlo2,.buttonSub#anaW").live("click", function() {
			windowOut (dlxmin,dlymin,dlx,dly,'adminWriteOkno','adminWriteZaw','tlo2','');
		});
	$("#tlo3").live("click", function() {
			windowOut (dlxmin,dlymin,dlx,dly,'adminFileOkno','adminFileZaw','tlo3','f01');
			windowOut (dlxmin,dlymin,dlx,dly,'adminFileOkno','adminFileZaw','tlo3','f02');
			windowOut (dlxmin,dlymin,dlx,dly,'adminFileOkno','adminFileZaw','tlo3','f03');
			windowOut (dlxmin,dlymin,dlx,dly,'adminFileOkno','adminFileZaw','tlo3','f04');
			windowOut (dlxmin,dlymin,dlx,dly,'adminFileOkno','adminFileZaw','tlo3','f05');
			windowOut (dlxmin,dlymin,dlx,dly,'adminFileOkno','adminFileZaw','tlo3','f06');
			windowOut (dlxmin,dlymin,dlx,dly,'adminFileOkno','adminFileZaw','tlo3','f07');
			windowOut (dlxmin,dlymin,dlx,dly,'adminFileOkno','adminFileZaw','tlo3','f08');
			windowOut (dlxmin,dlymin,dlx,dly,'adminFileOkno','adminFileZaw','tlo3','f09');
			windowOut (dlxmin,dlymin,dlx,dly,'adminFileOkno','adminFileZaw','tlo3','f10');
		});
	$("#tlo4").live("click", function() {
			windowOut (dlxmin,dlymin,dlx,dly,'adminDelOkno','adminDelZaw','tlo4','d01');
			windowOut (dlxmin,dlymin,dlx,dly,'adminDelOkno','adminDelZaw','tlo4','d02');
			windowOut (dlxmin,dlymin,dlx,dly,'adminDelOkno','adminDelZaw','tlo4','d03');
			windowOut (dlxmin,dlymin,dlx,dly,'adminDelOkno','adminDelZaw','tlo4','d04');
			windowOut (dlxmin,dlymin,dlx,dly,'adminDelOkno','adminDelZaw','tlo4','d05');
			windowOut (dlxmin,dlymin,dlx,dly,'adminDelOkno','adminDelZaw','tlo4','d06');
			windowOut (dlxmin,dlymin,dlx,dly,'adminDelOkno','adminDelZaw','tlo4','d07');
			windowOut (dlxmin,dlymin,dlx,dly,'adminDelOkno','adminDelZaw','tlo4','d08');
			windowOut (dlxmin,dlymin,dlx,dly,'adminDelOkno','adminDelZaw','tlo4','d09');
			windowOut (dlxmin,dlymin,dlx,dly,'adminDelOkno','adminDelZaw','tlo4','d10');
		});
	$("#tlo5,.buttonSub#anaTag").live("click", function() {
			windowOut (dlxmin,dlymin,dlx,dly,'adminTagOkno','adminTagZaw','tlo5','');
		});
	$("#tlo6,.buttonSub#anaKat").live("click", function() {
			windowOut (dlxmin,dlymin,dlx,dly,'adminKatOkno','adminKatZaw','tlo6','');
		});
	
	//ANIMACJA DYMKOW PRZY PRZYCISKACH ADMINISTRACYJNYCH **************************************************************************************************
	$(".adminEdit").mouseover(function() {
		$(".adminEdit > div").animate({opacity: 0.9},1000);
	});
	$(".adminWrite").mouseover(function() {
		$(".adminWrite > div").animate({opacity: 0.9},1000);
	});	
	$(".adminPic").mouseover(function() {
		$(".adminPic > div").animate({opacity: 0.9},1000);
	});	
	$(".adminDel").mouseover(function() {
		$(".adminDel > div").animate({opacity: 0.9},1000);
	});	
	$(".adminTag").mouseover(function() {
		$(".adminTag > div").animate({opacity: 0.9},1000);
	});	
	$(".adminKat").mouseover(function() {
		$(".adminKat > div").animate({opacity: 0.9},1000);
	});	
	  
	//WYSWIETLANIE TAGOW ***********************************************************************************************************************************
	var el = $.map(tagiArray, function(val, i) {
	var liczba = generate();	
	  return '<a href="#" class="tag' +liczba+ '">#' + val + "</a>, ";
	});
	$("#tagiStrona").html(el.join(""));	
	
	//FUNKCJA ROZWIJANIA ARTYKULOW ************************************************************************************************************************
<?php
# ************************************************************************************************************************************************************
# GENEROWANIE FUNKCJI DLA WYSWIETLANIA TAGOW I ICH EDYCJI DLA EDYCJI AKTUALNOSCI
# ************************************************************************************************************************************************************
	for($i = 1; $i <= $ilelement; $i++)
		{
		if($i<=9) $index = '0'.$i; else $index = $i;
# ************************************************************************************************************************************************************
?>	
		var klik<?php echo $index;?> = true;
		$("#s<?php echo $index;?>").click(function() {
			if(klik<?php echo $index;?>){
				var el = $('#art<?php echo $index;?>'),
					curHeight = el.height(),
					autoHeight = el.css('height', 'auto').height();
				el.height(curHeight).animate({height: autoHeight}, 1000);
				$("#s<?php echo $index;?>").html('<div class="tresc-wiecej">zwiń<img src="../images/strzalka2.png" width="13" height="11" id="strzalka"/></div>');
				klik<?php echo $index;?> = false;
			}else{
				$("#art<?php echo $index;?>").animate({"height": "412px"}, "slow");
				$("#s<?php echo $index;?>").html('<div class="tresc-wiecej">więcej<img src="../images/strzalka.png" width="13" height="11" id="strzalka"/></div>');
				klik<?php echo $index;?> = true;
			}
		});
<?php
# ************************************************************************************************************************************************************
		}
# ************************************************************************************************************************************************************
?>
	// TABY DLA ARTYKULOW ***********************************************************************************************************************************
		$('.tabs').each(function() {
			var $ul = $(this);
			var $li = $ul.children('li');
			//przy wejsciu na strone ukrywamy tresc tabow i pokazujemy tylko aktywny...
			$li.each(function() { //pętla po wszystkich tabach
				var $trescTaba = $($(this).children('a').attr('href')); //pobieramy blok o id pobranym z linka-taba
				if ($(this).hasClass('active')) { //jeżeli ten tab ma klasę aktywną
					$trescTaba.show(); //to pobrany przed chwilą blok pokazujemy
				} else {
					$trescTaba.hide(); //jeżeli takiej klasy nie ma to blok ukrywamy
				}
			});
					 
			//mały trik - gdy klikamy na tab, wtedy wykonujemy zdarzenie dla linka, który się w nim znajduje (dzieki temu możemy kliknąć na cały tab, a nie tylko na linka)
			$li.live("click", function() {$(this).children('a').click()});
			//po kliknięciu na link...
			$li.children('a').live("click", function() {
				//usuwamy z tabów klasę active
				$li.removeClass('active');
				//ukrywamy wszystkie taby               
				$li.each(function() {
					$($(this).children('a').attr('href')).hide();
				});
				//ustawiamy klikniętemu tabowi klasę aktywną
				$(this).parent().addClass('active');
				$($(this).attr('href')).show();
				//nie chcemy wykonać domyślnej akcji dla linka
				return false;
			});
		});
});
</script>