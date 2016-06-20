<?php
# *********************************************************************************************************************************************
# SKRYPT STRONY GLOWENEJ 
# CREATED BY MACIEJ KOLANKIEWICZ (C) 2014
# *********************************************************************************************************************************************
# *********************************************************************************************************************************************
# OBSLUGA BLEDOW
# *********************************************************************************************************************************************
	ini_set( 'display_errors' ,  1 ); 
# *********************************************************************************************************************************************
# ZNAJDOWANIE UNIWERSALEJ SCIEZKI DOSTEPU DO PLIKU ORAZ OKRESLANIE JEGO LOKALIZACJI
# *********************************************************************************************************************************************
	$lokalizator = 0;$path_file = "";clearstatcache();
	$name_file = substr($_SERVER['PHP_SELF'],strpos(strrev($_SERVER['PHP_SELF']),'/',0)*(-1));
	while(!file_exists($path_file."path.php")){$path_file = "";
	for($q=0; $q <=(substr_count($_SERVER['PHP_SELF'], "/"))-$lokalizator; $q++)
	$path_file = $path_file."../";$lokalizator++;}
# *********************************************************************************************************************************************
# ZALADOWANIE MECHANIZMU INICJACYJNEGO
# *********************************************************************************************************************************************
	include_once($path_file."initiation/initiation.php");
    
# *********************************************************************************************************************************************
# FUNKCJA ANALIZUJACA ZMIENNE GET I DODJACA LUB ZMIENIAJACA ZMIENNE GET
# *********************************************************************************************************************************************
	function queryString($query)
		{
		$queryOld = $_SERVER['QUERY_STRING'];
		$queryOldArray = explode('&',$queryOld);
		$queryNew = '';
		while($queryOldAsoc = each($queryOldArray))
			{
			$queryOldName = substr($queryOldAsoc['value'],0,strpos($queryOldAsoc['value'],"="));
			$queryName = substr($query,0,strpos($query,"="));	
			if($queryOldName != $queryName)
				$queryNew = $queryNew.$queryOldAsoc['value']."&";
			}
		$queryNew = $queryNew.$query;
		return($queryNew);
		}

# *********************************************************************************************************************************************
# ZALADOWANIE FUNKCJI JQUERY DLA STRONY 1
# *********************************************************************************************************************************************
	include_once($path_file."function/functionJquery.php");
echo "dupa";
# *********************************************************************************************************************************************
# ZMIENNE WEJSCIOWE I ICH STAN 
# *********************************************************************************************************************************************
	if(!isset($_GET['kat'])) $_GET['kat'] = '';
	if(!isset($_GET['tag'])) $_GET['tag'] = '';
	if(!isset($_GET['art'])) $_GET['art'] = 0;
	if(!isset($_GET['nri'])) $_GET['nri'] = 0;

# *********************************************************************************************************************************************
?>
</head>
<body>	  
<?php
# *********************************************************************************************************************************************
# WYGENEROWANIE SELECT MENU GORNEGO MENU Z WARTOSCIAMI DLA NOWEGO ARTYKULU
# *********************************************************************************************************************************************
	$menuGorneHtml = '<select name="menugWriteOknoW" id="menugWriteOknoW" size="7">'."\n";
	$queryMenu = "SELECT * FROM menugorne";
	$askMenu = mysql_query($queryMenu) or die("BLAD ODCZYTU ZAWARTOSCI MENU GORNEGO DLA NOWEO ART: ".mysql_error());
	while($askArrayMenu = mysql_fetch_array($askMenu))
		{
		$menuGorneHtml = $menuGorneHtml."\t\t".'<option value="'.$askArrayMenu['id'].'">'.$askArrayMenu['nazwa'].'</option>'."\n";
		}
	$menuGorneHtml = $menuGorneHtml."\t\t".'</select>'."\n";
# *********************************************************************************************************************************************
# SPRAWDZENIE CZY UZYTKOWNIK ZALOGOWANY
# *********************************************************************************************************************************************
	if($statusSession == 2)
	{
# *********************************************************************************************************************************************
# WYGENEROWANIE OKNA DLA NOWEGO ARTYKULU
# *********************************************************************************************************************************************
	$webhead = new Template($path_file."admin/tpl/nowyArt.tpl");
	$webhead->add('pathfile', $path_file);
	$webhead->add('gornemenu', $menuGorneHtml);
	echo $webhead->execute();
# *********************************************************************************************************************************************
# WYGENEROWANIE OKNA DLA NOWEGO TAGA
# *********************************************************************************************************************************************
	$webhead = new Template($path_file."admin/tpl/nowyTag.tpl");
	$webhead->add('pathfile', $path_file);
	echo $webhead->execute();
# *********************************************************************************************************************************************
# WYGENEROWANIE OKNA DLA NOWEJ KATEGORII
# *********************************************************************************************************************************************
	$webhead = new Template($path_file."admin/tpl/nowyKat.tpl");
	$webhead->add('pathfile', $path_file);
	echo $webhead->execute();
# *********************************************************************************************************************************************
# WYGENEROWANIE OKNA DLA USUNIĘCIA ARTYKUŁU
# *********************************************************************************************************************************************
	$webhead = new Template($path_file."admin/tpl/nowyKat.tpl");
	$webhead->add('pathfile', $path_file);
	echo $webhead->execute();
# *********************************************************************************************************************************************
# WYGENEROWANIE ZAPYTANIA GLOWNEGO Z UWZGLEDNIENIEM FILTROW
# *********************************************************************************************************************************************
	}
# WCZYTANIE DANYCH
# ZAPYTANIE UZALEZNIONE OD DANYCH WEJSCIOWYCH - KLIKNIECIE NA KATEGORII ORAZ INNYCH FILTROW
	if($_GET['kat'] != '')
		{
		# ZAPYTANIE DO LISTY KATEGORII W ZALEZNOSCI OD KLIKNIETEJ KATEGORII 
		$queryKatGet = "SELECT artID FROM kategorielist WHERE nazwa = '".$_GET['kat']."'";
		$askKatGet = mysql_query($queryKatGet) or die("BLAD UTWORZENIA LISTY KATEGORII: ".mysql_error());
		if(mysql_num_rows($askKatGet) > 0)
			{
			$queryKatGetLista = ' and (';
			while($asocKatGet =  mysql_fetch_array($askKatGet))
				{
				$queryKatGetLista = $queryKatGetLista."
							id = '".$asocKatGet['artID']."' or ";
				}
			$queryKatGetLista = substr($queryKatGetLista,0,-3).') ';
			}else{
			$queryKatGetLista = " and id='0' ";
			}
		$query = "SELECT * FROM aktualnosci WHERE 
						typView = '1' and 
						aktywnosc = '1' ".$queryKatGetLista." 
						ORDER BY aktualnosci.data DESC";
		}
	if($_GET['tag'] != '')
		{
		# ZAPYTANIE DO LISTY KATEGORII W ZALEZNOSCI OD KLIKNIETEJ KATEGORII 
		$queryTagGet = "SELECT artID FROM taglist WHERE nazwa = '".$_GET['tag']."'";
		$askTagGet = mysql_query($queryTagGet) or die("BLAD UTWORZENIA LISTY KATEGORII: ".mysql_error());
		if(mysql_num_rows($askTagGet) > 0)
			{
			$queryTagGetLista = ' and (';
			while($asocTagGet =  mysql_fetch_array($askTagGet))
				{
				$queryTagGetLista = $queryTagGetLista."
							id = '".$asocTagGet['artID']."' or ";
				}
			$queryTagGetLista = substr($queryTagGetLista,0,-3).') ';
			}else{
			$queryTagGetLista = " and id='0' ";
			}
		$query = "SELECT * FROM aktualnosci WHERE 
						typView = '1' and 
						aktywnosc = '1' ".$queryTagGetLista." 
						ORDER BY aktualnosci.data DESC";
		}
	if($_GET['tag'] == '' and $_GET['kat'] == '')
		$query = "SELECT * FROM aktualnosci WHERE 
						typView = '1' and 
						aktywnosc = '1' 
						ORDER BY aktualnosci.data DESC";

	if($_GET['art'] != 0)
		{
		$query = "SELECT * FROM aktualnosci WHERE 
						id = '".$_GET['art']."'
						ORDER BY aktualnosci.data DESC";
		}
# *********************************************************************************************************************************************
# OKRESLENIE ZAKRESU WYSWIETLANYCH ARTYKULOW
# *********************************************************************************************************************************************
					
	$ask = mysql_query($query) or die("BLAD ODCZYTU ZAWARTOSCI ARTYKULOW: ".mysql_error());
		# OBLICZENIE ILE JEST WSZYSTKICH ODPOWIEDZI
		$ilArtAsk = mysql_num_rows($ask);
		$ilArtJednostkowy = ceil($ilArtAsk / $ilelement);
		$queryZak1 = ($_GET['nri']*$ilelement);
		
	# TWORZENIE GLOWNEGO ZAPYTANIA Z FILTREM
	$queryGeneral = $query." LIMIT ".$queryZak1.",".$ilelement;	
	if($viewTest) msgViewTest('Zasięg artykulow: ','od: '.$queryZak1.' ile: '.$ilelement,3,$path_file);
# *********************************************************************************************************************************************
# ZAPYTANIE DO BAZY O ARTYKULY Z ZAKRESEM FILTROWANYM
# *********************************************************************************************************************************************
	
	$ask = mysql_query($queryGeneral) or die("BLAD ODCZYTU ZAWARTOSCI ARTYKULOW: ".mysql_error());
	if(mysql_num_rows($ask) > 0)
	{
	# OBLICZENIE ILE JEST WSZYSTKICH ODPOWIEDZI
	$indexArt=1;
	while($askArray = mysql_fetch_array($ask))
		{
		if($indexArt <= 9) $indexArtView = '0'.$indexArt; else  $indexArtView = $indexArt;
# *********************************************************************************************************************************************
# WYGENEROWANIE SELECT MENU GORNEGO MENU Z WARTOSCIAMI DLA EDYTOWANEGO ARTYKULU
# *********************************************************************************************************************************************
		$menuGorneHtml = '<select name="menugWriteOkno'.$indexArtView.'" id="menugWriteOkno'.$indexArtView.'" size="7">'."\n";
		$queryMenu = "SELECT * FROM menugorne";
		$askMenu = mysql_query($queryMenu) or die("BLAD ODCZYTU ZAWARTOSCI MENU GORNEGO DLA NOWEO ART: ".mysql_error());
		while($askArrayMenu = mysql_fetch_array($askMenu))
			{
			$selected = '';
			if($askArray['id'] == $askArrayMenu['art']) $selected = 'selected';
			$menuGorneHtml = $menuGorneHtml."\t\t".'<option value="'.$askArrayMenu['id'].'" '.$selected.'>'.$askArrayMenu['nazwa'].'</option>'."\n";
			}
		$menuGorneHtml = $menuGorneHtml."\t\t".'</select>'."\n";	
# *********************************************************************************************************************************************
# WYGENEROWANIE ZAZNACZENIE OPCJI RADIOBUTTONOW
# *********************************************************************************************************************************************
		if($askArray['typView'] == 1 )
			$radioArt1 = '<input type="radio" value="1" name="typArt'.$indexArtView.'" checked="checked" />';
		else
			$radioArt1 = '<input type="radio" value="1" name="typArt'.$indexArtView.'" />';
		if($askArray['typView'] == 2 )
			$radioArt3 = '<input type="radio" value="2" name="typArt'.$indexArtView.'" checked="checked" />';
		else
			$radioArt3 = '<input type="radio" value="2" name="typArt'.$indexArtView.'" />';
		if($askArray['typView'] == 0 )
			$radioArt2 = '<input type="radio" value="0" name="typArt'.$indexArtView.'" checked="checked" />';
		else
			$radioArt2 = '<input type="radio" value="0" name="typArt'.$indexArtView.'" />';
# *********************************************************************************************************************************************
# WYGENEROWANIE ZAZNACZENIE OPCJI CHECKBOXOW
# *********************************************************************************************************************************************
		if($askArray['aktywnosc'] == 1 )
			$checkBoxArt1 = '<input type="checkbox" value="enableArt" name="enableArt'.$indexArtView.'" checked="checked" id="enableArt'.$indexArtView.'" />';
		else
			$checkBoxArt1 = '<input type="checkbox" value="enableArt" name="enableArt'.$indexArtView.'" id="enableArt'.$indexArtView.'" />';
		if($askArray['folderPic'] == 1 )
			$checkBoxArt2 = '<input type="checkbox" value="enableGal" name="enableGal'.$indexArtView.'" checked="checked" id="enableGal'.$indexArtView.'" />';
		else
			$checkBoxArt2 = '<input type="checkbox" value="enableGal" name="enableGal'.$indexArtView.'" id="enableGal'.$indexArtView.'" />';
			
	# TWORZENIE LISTY TAGOW *******************************************************************************************************************
		$query1 = "SELECT * FROM taglist WHERE artID = '".$askArray['id']."'";
		$ask1 = mysql_query($query1) or die("BLAD ODCZYTU LISTY TAGOW: ".mysql_error());
		$askArray['tagi'] = '';
		while($askArray1 = mysql_fetch_array($ask1))
			{
			$askArray['tagi'] = $askArray['tagi'].$askArray1['nazwa'].',';
			}
	# TWORZENIE LISTY KATEGORII **************************************************************************************************************
		$query1 = "SELECT * FROM kategorielist WHERE artID = '".$askArray['id']."'";
		$ask1 = mysql_query($query1) or die("BLAD ODCZYTU LISTY TAGOW: ".mysql_error());
		$askArray['kategorie'] = '';
		while($askArray1 = mysql_fetch_array($ask1))
			{
			$askArray['kategorie'] = $askArray['kategorie'].$askArray1['nazwa'].',';
			}
		if($askArray['aktywnosc'] == 1)
			{
			
			$webhead = new Template($path_file."admin/tpl/editArt.tpl");
			$webhead->add('index', $indexArtView);
			$webhead->add('id', $askArray['id']);
			$webhead->add('tytulakt', $askArray['tytulakt']);
			$webhead->add('tytulart', $askArray['tytulart']);
			$webhead->add('dataV', dateV('l j f Y',$askArray['data']));
			$webhead->add('data', date('Y-m-d',$askArray['data']));
			$webhead->add('autor', $askArray['autor']);
			$webhead->add('tekstAkt', $askArray['tekstAkt']);
			$webhead->add('tekstArt', $askArray['tekstArt']);
			$webhead->add('typView', $askArray['typView']);
			$webhead->add('galPicId', $askArray['galPicId']);
			$webhead->add('folderPic', $askArray['folderPic']);
			$webhead->add('tagi', $askArray['tagi']);
			$webhead->add('kategorie', $askArray['kategorie']);
			$webhead->add('gornemenu', $menuGorneHtml);
			$webhead->add('radioArt1', $radioArt1);
			$webhead->add('radioArt2', $radioArt1);
			$webhead->add('radioArt3', $radioArt1);
			$webhead->add('checkBoxArt1', $checkBoxArt1);
			$webhead->add('checkBoxArt2', $checkBoxArt2);
			$webhead->add('pathfile', $path_file);
			echo $webhead->execute();
# *********************************************************************************************************************************************
# WYGNEROWANIE OKNA DLA USUWANIA ARTYKUKOW
# *********************************************************************************************************************************************
# *********************************************************************************************************************************************
# WYGNEROWANIE LISTY PLIKOW DO USUNIECIA
# *********************************************************************************************************************************************
			$path_dir = $path_file."artykuly/".$askArray['galPicId']."/";
			$path_dirth = $path_file."miniatury/".$askArray['galPicId']."/";
			$delFileList = "\n".'PLIKI DO USUNIECIA'."\n".'FOLDER PLIKÓW GLOWNYCH: '.$path_dir."\n\n";
			# NAZWA PLIKU 00 NA PIERWSZA STRONE ART
			if( $handle = @opendir($path_dir) )
				{
				while ( false !== ($file = readdir( $handle )) )
					{
					if($file != '.' and $file != '..')
						$delFileList = $delFileList.$file." rozmiar pliku: ".filesize($path_dir.$file)."byte\n";
					}
				}
			#Otwarcie folderu z plikami - otwarcie lokalizacji
			$delFileList = $delFileList."\n".'PLIKI DO USUNIECIA'."\n".'FOLDER PLIKÓW GLOWNYCH: '.$path_dirth."\n\n";
			if( $handle = @opendir($path_dirth) )
				{
				# Odczytanie zawartosci folderu
				while ( false !== ($file = readdir( $handle )) )
					{
					if($file != '.' and $file != '..')
						$delFileList = $delFileList.$file." rozmiar pliku: ".filesize($path_dirth.$file)."byte\n";
					}
				}	
			# WYGENEROWANIE KODU USUNIECIA
			$delKod = substr(md5($askArray['id']),-5);
			
			$webhead = new Template($path_file."admin/tpl/delArt.tpl");
			$webhead->add('index', $indexArtView);
			$webhead->add('id', $askArray['id']);
			$webhead->add('pathfile', $path_file);
			$webhead->add('delKod', $delKod);
			$webhead->add('fileList', $delFileList);
			$webhead->add('galPicId', $askArray['galPicId']);
			echo $webhead->execute();
			
			$indexArt++;
			}
		}
	}
# *********************************************************************************************************************************************
?>
<!-- BANNER STRONY Z GORNYM MENU  ********************************************************************************************************* -->

<div id="banner-pasek">
    <div id="banner-menu">
        <div id="banner-logo">
            <img src="../images/banner/logo.png" width="137" height="36" alt="Logo ZSŁ Poznań" />
            <br />
            Zespół Szkół Łączności im. Mikołaja Kopernika w Poznaniu
        </div>
<?php
# *********************************************************************************************************************************************
# WYGENEROWANIE MENU GORNEGO DLA STRONY
# *********************************************************************************************************************************************

    echo '
	<div id="banner-lista">
	<ul id="menu-lista">'."\n";
	$queryMenu = "SELECT * FROM menugorne WHERE sub = '0'";
	$askMenu = mysql_query($queryMenu) or die("PROBLEM Z ODCZYTEM MENU GORNEGO Z MYSLQ");
	while($askAsocMenu = mysql_fetch_array($askMenu))
		{
		if($askAsocMenu['art'] == 0)
			$adresMenu = '#';
		else
			$adresMenu = $path_file."layout/index3.php?art=".$askAsocMenu['art'];
		if($askAsocMenu['link'] != '#')
			$adresMenu = $askAsocMenu['link'];
		echo "\t\t".'<li><a href="'.$adresMenu.'">'.$askAsocMenu['nazwa'].'</a>'."\n";
		$querySub = "SELECT * FROM menugorne WHERE sub = '".$askAsocMenu['id']."'";
		$askMenuSub = mysql_query($querySub) or die("PROBLEM Z ODCZYTEM SUB MENU GORNEGO Z MYSLQ");
		if(mysql_num_rows($askMenuSub) > 0)
			echo "\t\t\t".'<ul>'."\n";
		while($askAsocMenuSub = mysql_fetch_array($askMenuSub))
			{
			if($askAsocMenuSub['art'] == 0)
				$adresMenuSub = '#';
			else
				$adresMenuSub = $path_file."layout/index3.php?art=".$askAsocMenuSub['art'];
			if($askAsocMenuSub['link'] != '#')
				$adresMenuSub = $askAsocMenuSub['link'];
			echo "\t\t\t".'<li><a href="'.$adresMenuSub.'">'.$askAsocMenuSub['nazwa'].'</a></li>'."\n";
			}
		if(mysql_num_rows($askMenuSub) > 0)
			echo "\t\t\t".'</ul>'."\n";
		echo "\t\t".'</li>'."\n";
		}
	echo '</ul>
	</div>'."\n";
# *********************************************************************************************************************************************
?>  
            <div id="banner-obrazek">
            	<div id="coin-slider">
                    <a href="#">
                        <img src="<?php echo $path_file;?>images/banner/banner1.png" />
                        <span>
                            Fototechnik w Zespole Szkół Łączności
                        </span>
                    </a>
                    <a href="#">
                        <img src="<?php echo $path_file;?>images/banner/banner2.png" />
                        <span>
                            Fototechnik w Zespole Szkół Łączności
                        </span>
                    </a>
                </div>
                <script type="text/javascript">
					$(document).ready(function() {
						$('#coin-slider').coinslider({
						width: 1000, // width of slider panel
						height: 414, // height of slider panel
						spw: 20, // squares per width
						sph: 5, // squares per height
						delay: 1000, // delay between images in ms
						sDelay: 30, // delay beetwen squares in ms
						opacity: 0, // opacity of title and navigation
						titleSpeed: 500, // speed of title appereance in ms
						effect: 'random', // random, swirl, rain, straight
						navigation: true, // prev next and buttons
						links : true, // show images as links 
						hoverPause: false // pause on hover
						});
					});
				</script>
            	<div id="tresc-start">
<?php
# *********************************************************************************************************************************************
# SPRWDZENIE KTORY AERTYKUL -  WYWOLANIE TPL
# *********************************************************************************************************************************************
	if($ilArtJednostkowy < 10)
		{
		for($artIndex = 0; $artIndex < $ilArtJednostkowy; $artIndex++)
			{
			$newQuery = queryString("nri=".($artIndex));
			if($_GET['nri'] == $artIndex)
				{
				echo '<a href="'.$path_file.'layout/index3.php?'.$newQuery.'">
					<div class="wyborZakresuZaznBanner">'.($artIndex+1).'</div></a>';
				}else{
				echo '<a href="'.$path_file.'layout/index3.php?'.$newQuery.'">
					<div class="wyborZakresuBanner">'.($artIndex+1).'</div></a>';	
				}
			}
		}else{
			for($artIndex = $_GET['nri']; $artIndex < $_GET['nri']+10; $artIndex++)
			{
			$newQuery = queryString("nri=".($artIndex));
			if($_GET['nri'] == $artIndex)
				{
				echo '<a href="'.$path_file.'layout/index3.php?'.$newQuery.'">
					<div class="wyborZakresuZaznBanner">'.($artIndex+1).'</div></a>';
				}else{
				echo '<a href="'.$path_file.'layout/index3.php?'.$newQuery.'">
					<div class="wyborZakresuBanner">'.($artIndex+1).'</div></a>';	
				}
			}
		}
# *********************************************************************************************************************************************

?>          	
            	</div>
            </div>
    	</div>
    </div>
    <div class="tresc-tlo">
        <div id="tresc-lewy">
        
<?php
# *********************************************************************************************************************************************
# GENEROWANE ARTYKULOW NA STRONIE Z WYKORZYSTANIEM ZAPYTANIA QUERYGENERAL
# *********************************************************************************************************************************************
	
	$ask = mysql_query($queryGeneral) or die("BLAD ODCZYTU ZAWARTOSCI ARTYKULOW: ".mysql_error());
	$indexArt=1;
	if($viewTest) msgViewTest('Ilosc artykulow:','<b>'.mysql_num_rows($ask).'</b>',3,$path_file);
	if(mysql_num_rows($ask) > 0){
	while($askArray = mysql_fetch_array($ask))
		{
		
		if($askArray['aktywnosc'] == 1)
			{
			if($indexArt <= 9) $indexArtView = '0'.$indexArt; else  $indexArtView = $indexArt;
# *********************************************************************************************************************************************
# ZALADOWANIE GALERII DO TABLICY
# *********************************************************************************************************************************************
				
			$path_dir = $path_file."artykuly/".$askArray['galPicId']."/";
			$path_dirth = $path_file."miniatury/".$askArray['galPicId']."/";
			$indexArtPictures = 0;
			# NAZWA PLIKU 00 NA PIERWSZA STRONE ART
			if( $handle = @opendir($path_dirth) )
				{
				while ( false !== ($file = readdir( $handle )) )
					{
					$roz = substr($file,strrpos($file,".")+1,strlen($file)-strrpos($file,"."));
					$prefix = substr($file,strrpos($file,".")-2,2);
					$nameImg = substr($file,0,strrpos($file,".")-2);
					if($prefix == '_z')
						{	
						$name00ImageFile = $nameImg;
						$roz00ImageFile = $roz;
						}
					}
				}
			#Otwarcie folderu z plikami - otwarcie lokalizacji	 
			if( $handle = @opendir($path_dir) )
				{
				# Odczytanie zawartosci folderu
				while ( false !== ($file = readdir( $handle )) )
					{
					$roz = substr($file,strrpos($file,".")+1,strlen($file)-strrpos($file,"."));
					$prefix = substr($file,strrpos($file,".")-2,2);
					$nameImg = substr($file,0,strrpos($file,"."));
					if($file != '.' && $file != '..')
						{
						$arrayArtPictures[$indexArtPictures][0] = $file;
						$arrayArtPictures[$indexArtPictures][1] = $prefix;
						$arrayArtPictures[$indexArtPictures][2] = $nameImg;
						$arrayArtPictures[$indexArtPictures][3] = $roz;
						if($viewTest) 
							msgViewTest('Zdjecie ['.$indexArtPictures.']: ','nazwa:<b>'.$file.'</b> prefix:<b>'.$prefix.
										'</b> nazwa:<b>'.$nameImg.'</b> roz:<b>'.$roz.'</b>',3,$path_file);
						$indexArtPictures++;
						}
					}
				}	
# *********************************************************************************************************************************************
# HTML DLA PIERWSZEGO ZDJECIA
# *********************************************************************************************************************************************
			if(isset($arrayArtPictures))
				{
				if(count($arrayArtPictures) > 0 && $indexArtPictures > 0 )
					{
					$htmlArtPicturesOne = '
						<a href="'.$path_dir.$name00ImageFile.'.'.$roz00ImageFile.'" 
							data-lightbox="'.$indexArt.'" title="'.$name00ImageFile.'">
						<img src="'.$path_dirth.$name00ImageFile.'_z.'.$roz00ImageFile.'" 
							alt="'.$name00ImageFile.'" class="duze" />
						</a>
						';
					}else{
					$htmlArtPicturesOne = '';
					}
				}else{
			$htmlArtPicturesOne = '';
			}
# *********************************************************************************************************************************************
# TWORZENIE GALERII ZDJEC
# *********************************************************************************************************************************************
			if(isset($arrayArtPictures)) reset($arrayArtPictures);
			if($mysqlConnect and $viewTest) msgViewTest('Ilosc zdjec:','<b>'.count($arrayArtPictures).'</b>',3,$path_file);
			$htmlArtPicturesGalery = '';
			if(isset($arrayArtPictures) and $askArray['folderPic'] == 1) 
				{
				for($i = 0; $i < count($arrayArtPictures); $i++)
					{
						$htmlArtPicturesGalery = $htmlArtPicturesGalery.'
							<a href="'.$path_dir.$arrayArtPictures[$i][0].'" 
							data-lightbox="'.$indexArt.'" 
							title="'.$arrayArtPictures[$i][2].'">
							<img src="'.$path_dirth.$arrayArtPictures[$i][2].'_m.'.$arrayArtPictures[$i][3].'" />
							</a>
						';
					}
				}
			if($mysqlConnect and $viewTest) msgViewTest('HTML galerii:','<i>'.$htmlArtPicturesGalery.'</i>',3,$path_file);
# *********************************************************************************************************************************************
# AUTOR ZDJEĆ
# *********************************************************************************************************************************************
			if($askArray['tytulart'] != 'BRAK' and $askArray['tytulart'] != 'brak')
				{
				$autorZdj = '<h5><span class="tytul-pom">fot:</span> 
							 <span class="tytul-szary"><strong>'.$askArray['tytulart'].
							 '</strong></span></h5>';
				}else{
				$autorZdj = '';
				}
# *********************************************************************************************************************************************
# WLACZENIE LUB WYLACZENIE PRZYCISKOW EDYTOWANIA ARTYKULU W ZALEZNOSCI O STATUSU ZALOGOWANIA
# *********************************************************************************************************************************************			
# *********************************************************************************************************************************************
# SPRAWDZENIE CZY UZYTKOWNIK ZALOGOWANY
# *********************************************************************************************************************************************
	if($statusSession == 2)
		{
		$editButtonOne = '
			<div class="adminButton">
                <a class="fancyboxEffects" href="#adminEditOkno .e'.$indexArtView.'" title="Edycja artykułu"><div class="adminEdit" id="a'.$indexArtView.'">
                <div><b>Edycja tego artykułu</b><br /><br />W tym miejscu można edytować poniższy tekst artykułu lub aktualności</div>
                </div></a>
                <a class="fancyboxEffects" href="#adminWriteOkno" title="Dodanie artykułu">
                <div class="adminWrite">
                <div><b>Dodanie nowego artykułu</b><br /><br />Dadanie nowego artykułu lub aktualności ustawi ją w zależności od ustawionej daty</div>
                </div></a>
                <a class="fancyboxEffects" href="#adminFileOkno .f'.$indexArtView.'" title="Dodawanie i usuwanie zdjęć">
                <div class="adminPic" id="a'.$indexArtView.'">
                <div><b>Dodawanie i usuwanie zdjeć</b><br /><br />Dodaj lub usuń zdjęcia do tego artukułu lub aktualności</div>
                </div></a>
                
                <a class="fancyboxEffects" href="#adminDelOkno .d'.$indexArtView.'" title="Usuń artykul">
                <div class="adminDel" id="a'.$indexArtView.'">
                <div><b>Usuń artykuł</b><br /><br />Dodaj lub usuń zdjęcia do tego artukułu lub aktualności</div>
                </div></a>
                <a class="fancyboxEffects" href="#adminTagOkno" title="Dodaj lub usuń TAGI">
                <div class="adminTag">
                <div><b>Dodaj / usuń Tag</b><br /><br />Daje możliwości dodawania i usuwania tagów dla całego fotobloga</div>
                </div></a>
                <a class="fancyboxEffects" href="#adminKatOkno" title="Dodaj lub usuń kategorie">
                <div class="adminKat">
                <div><b>Dodanie kategorii</b><br /><br />Dodawanie lub usuwanie kategorii dla całego fotobloga</div>
                </div></a>
            </div>';
		$editButton = '
			<div class="adminButton">
                <a class="fancyboxEffects" href="#adminEditOkno .e'.$indexArtView.'" title="Edycja artykułu"><div class="adminEdit" id="a'.$indexArtView.'">
                <div><b>Edycja tego artykułu</b><br /><br />W tym miejscu można edytować poniższy tekst artykułu lub aktualności</div>
                </div></a>
                <a class="fancyboxEffects" href="#adminFileOkno .f'.$indexArtView.'" title="Dodawanie i usuwanie zdjęć">
                <div class="adminPic" id="a'.$indexArtView.'">
                <div><b>Dodawanie i usuwanie zdjeć</b><br /><br />Dodaj lub usuń zdjęcia do tego artukułu lub aktualności</div>
                </div></a>
                
                <a class="fancyboxEffects" href="#adminDelOkno .d'.$indexArtView.'" title="Usuń artykul">
                <div class="adminDel" id="a'.$indexArtView.'">
                <div><b>Usuń artykuł</b><br /><br />Dodaj lub usuń zdjęcia do tego artukułu lub aktualności</div>
                </div></a>
            </div>';
		}else{
		$editButtonOne = '';
		$editButton = '';
		}
# *********************************************************************************************************************************************
# SPRWDZENIE KTORY AERTYKUL -  WYWOLANIE TPL
# *********************************************************************************************************************************************
			if($indexArt == 1)
				$webhead = new Template($path_file."admin/tpl/ViewArtOne.tpl");
			else
				$webhead = new Template($path_file."admin/tpl/ViewArt.tpl");
			$webhead->add('index', $indexArtView);
			$webhead->add('id', $askArray['id']);
			$webhead->add('tytulakt', $askArray['tytulakt']);
			$webhead->add('autorzdj', $autorZdj);
			$webhead->add('dataV', dateV('l j f Y',$askArray['data']));
			$webhead->add('data', date('Y-m-d',$askArray['data']));
			$webhead->add('autor', $askArray['autor']);
			$webhead->add('editButtonOne', $editButtonOne);
			$webhead->add('editButton', $editButton);
			$webhead->add('tekstAkt', $askArray['tekstAkt']);
			$webhead->add('tekstArt', $askArray['tekstArt']);
			$webhead->add('typView', $askArray['typView']);
			$webhead->add('galPicId', $askArray['galPicId']);
			$webhead->add('folderPic', $askArray['folderPic']);
			$webhead->add('pathfile', $path_file);
			$webhead->add('facedns', $face_dns);
			$webhead->add('htmlArtPicturesOne', $htmlArtPicturesOne);
			$webhead->add('htmlArtPicturesGalery', $htmlArtPicturesGalery);
			echo $webhead->execute();
			$indexArt++;
			if(isset($arrayArtPictures)) unset($arrayArtPictures);
			}
		}
		}else{
			if($statusSession == 2)
			{
			$editButtonOne = '
			<div class="adminButton">
                <a class="fancyboxEffects" href="#adminWriteOkno" title="Dodanie artykułu">
                <div class="adminWrite">
                <div><b>Dodanie nowego artykułu</b><br /><br />Dadanie nowego artykułu lub aktualności ustawi ją w zależności od ustawionej daty</div>
                </div></a>
                <a class="fancyboxEffects" href="#adminTagOkno" title="Dodaj lub usuń TAGI">
                <div class="adminTag">
                <div><b>Dodaj / usuń Tag</b><br /><br />Daje możliwości dodawania i usuwania tagów dla całego fotobloga</div>
                </div></a>
                <a class="fancyboxEffects" href="#adminKatOkno" title="Dodaj lub usuń kategorie">
                <div class="adminKat">
                <div><b>Dodanie kategorii</b><br /><br />Dodawanie lub usuwanie kategorii dla całego fotobloga</div>
                </div></a>
            </div>';
			}else{
			$editButtonOne = '';	
			}
			$webhead = new Template($path_file."admin/tpl/ViewArtNone.tpl");
			$webhead->add('tytulakt', 'Nie znaleziono');
			$webhead->add('autorzdj', 'Żaden artykuł czy aktualność nie pasują do wybranych tagów czy kategorii');
			$webhead->add('editButtonOne', $editButtonOne);
			$webhead->add('pathfile', $path_file);
			echo $webhead->execute();	
		}
# *********************************************************************************************************************************************
?> 
         </div>
            
             <!-- KATEGORIE ------------------------------------------------------------------------------------>
            <div id="tresc-prawy">
            <h2><span class="tytul-pom">Kategorie</span></h2>
                <div id="kategorieLista">
                    BLAD MYSQL
                </div>
            <br><br>
            <h2><span class="tytul-pom">Tagi</span></h2>
                <div id="tagiStrona">
                    BLAD MYSQL                
                </div>
            </div>
            <div id="tresc-end">
<?php
# *********************************************************************************************************************************************
# SPRWDZENIE KTORY AERTYKUL -  WYWOLANIE TPL
# *********************************************************************************************************************************************
	if($ilArtJednostkowy < 10)
		{
		for($artIndex = 0; $artIndex < $ilArtJednostkowy; $artIndex++)
			{
			$newQuery = queryString("nri=".($artIndex));
			if($_GET['nri'] == $artIndex)
				{
				echo '<a href="'.$path_file.'layout/index3.php?'.$newQuery.'">
					<div class="wyborZakresuZazn">'.($artIndex+1).'</div></a>';
				}else{
				echo '<a href="'.$path_file.'layout/index3.php?'.$newQuery.'">
					<div class="wyborZakresu">'.($artIndex+1).'</div></a>';	
				}
			}
		}else{
			for($artIndex = $_GET['nri']; $artIndex < $_GET['nri']+10; $artIndex++)
			{
			$newQuery = queryString("nri=".($artIndex));
			if($_GET['nri'] == $artIndex)
				{
				echo '<a href="'.$path_file.'layout/index3.php?'.$newQuery.'">
					<div class="wyborZakresuZazn">'.($artIndex+1).'</div></a>';
				}else{
				echo '<a href="'.$path_file.'layout/index3.php?'.$newQuery.'">
					<div class="wyborZakresu">'.($artIndex+1).'</div></a>';	
				}
			}
		}
# *********************************************************************************************************************************************

?>          	
            </div>
        </div>
  
    	<div id="stopka">
        <div id="stopka-wew">
             <img src="../images/pepol.png" width="30" height="30" style="float:left; padding-right:10px"/>
            <div id="stopka-logowanie">
<?php
# *********************************************************************************************************************************************
# SPRWDZENIE KTORY AERTYKUL -  WYWOLANIE TPL
# *********************************************************************************************************************************************
         if($statusSession != 2)
			{
# *********************************************************************************************************************************************
?>	
            Zaloguj się do strony:<br>
            <form method="post" action="<?php echo $path_file;?>layout/index3.php">
            <label>login: <input type="text" name="weblogin" id="login" /></label>
            <label>hasło: <input type="password" name="webhaslo" id="login" /></label>
            <input type="submit" value="Zaloguj" />
            </form>
<?php
# *********************************************************************************************************************************************
			}else{
# *********************************************************************************************************************************************
?>
			Użytkownik zalogowany:<br>
            <form method="post" action="<?php echo $path_file;?>layout/index3.php">
            <label><?php echo $userArraySession['imie'];?> <?php echo $userArraySession['nazwisko'];?></label>
            <input type="submit" name="Wyloguj" value="Wyloguj" />
            </form>
<?php
# *********************************************************************************************************************************************
			}
# *********************************************************************************************************************************************
?>           
             </div>
            <div id="stopka-info">
            <br><br>
            © 2014 Maciej Kolankiewicz <strong>MacCOM Multimedia</strong> dla ZSŁ Poznań
            </div>
        </div>
        </div>
    </div>
	
</body>
</html>