<?php
# ************************************************************************************************************************************************************
# SKRYPT DODAWANIA TAGÓW
# CREATED BY MACIEJ KOLANKIEWICZ (C) 2014
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
# *********************************************************************************************
# ZALADOWANIE PLIKU KONFIGURACYJNEGO
# *********************************************************************************************
	include_once($path_file."webconfig/config.php");
# *********************************************************************************************
# ZALADOWANIE PLIKOW Z FUNKCJAMI
# *********************************************************************************************
	include_once($path_file."function/functionCode.php");
	include_once($path_file."function/functionTemplat.php");
	include_once($path_file."function/functionError.php");
	include_once($path_file."function/functionDB.php");
# *********************************************************************************************
# POLACZENIE Z BAZA DANYCH
# *********************************************************************************************
	include_once($path_file."function/dbconnect.php");
# ************************************************************************************************************************************************************
# POBRANIE DANYCH Z BAZY DANYCH NA PODSTAWIE IDENTYFIKATORA 
# ************************************************************************************************************************************************************
	$queryArt = "SELECT * FROM aktualnosci WHERE id =  '".$_POST['idArt']."'";
	$askArt = mysql_query($queryArt) or die (mysql_error());
	$askAsocArt = mysql_fetch_array($askArt);
# KONWERSJA NA CZAS UNIXOWY
	$datepickerW = strtotime($_POST['datepickerW'])+43200;
# WYGENEROWANIE IDENTYFIKATORA FOLDERU DLA GALERII I PLIKOW
	$new_idincrement = $askAsocArt['galPicId'];
	
	$dataAktualizacji = time();
# USUWANIE Z TEKSTU NIEBEZPIECZNYCH FUNKCJI ATAKOW SQL PHP ORAZ JAVASCRIPT ORAZA PODMIANA CUDZYSLOWOW
	$_POST['textAktW'] = str_replace("'",'`',str_replace("\"",'`',strip_tags($_POST['textAktW'])));
	$_POST['textArtW'] = str_replace("'",'`',str_replace("\"",'`',strip_tags($_POST['textArtW'])));
# ************************************************************************************************************************************************************
# FUNKCJA SPRAWDZAJACA CZY ZAPYTANIE JEST ZAPYTANIE AJAXOWYM
# DODANIE ARTYKULU DO BAZY DANYCH
# ************************************************************************************************************************************************************
	 if(isset($_POST['dane']))
	 	{
		$query = "UPDATE aktualnosci SET 
					tytulakt = '".$_POST['tytulAktW']."',
					tytulart = '".$_POST['tytulArtW']."',
					data = '".$datepickerW."',
					autor = '".$_POST['autorW']."',
					tekstAkt = '".$_POST['textAktW']."',
					tekstArt = '".$_POST['textArtW']."',
					dataEdy = '".$dataAktualizacji."',
					typView = '".$_POST['typArt']."',
					folderPic = '".$_POST['check2']."',
					redaktor = '1',
					kategorie = '".$_POST['katAktW']."',
					aktywnosc = '".$_POST['check1']."'
					WHERE id = '".$_POST['idArt']."'";			
		# DODANIE DO BAZY DANYCH 
		if(mysql_query($query))
			{
		# TWORZENIE FOLDERU DLA ARTYKULU
		}else{
			$response = "NIE ZAKTUALIZOWANO ARTYKULU W BAZIE DANYCH";
			}
# ************************************************************************************************************************************************************
# USUNIECIE STARYCH TAGOW I KATEGORII Z BAZY W RELACJI Z ARTYKULEM 
# ************************************************************************************************************************************************************
		$queryDel = "DELETE FROM taglist WHERE artID = '".$_POST['idArt']."'";
		 mysql_query($queryDel) or die (mysql_error());
		$queryDel = "DELETE FROM kategorielist WHERE artID = '".$_POST['idArt']."'";
		 mysql_query($queryDel) or die (mysql_error());
# ************************************************************************************************************************************************************
# DDANIE TAGOW I KATEGORII DO BAZY W RELACJI Z ARTYKULEM 
# ************************************************************************************************************************************************************
		$_POST['tagAktW'] = substr($_POST['tagAktW'],0,-1);
		$_POST['katAktW'] = substr($_POST['katAktW'],0,-1);
		
		$tagAktWArray = explode(',',$_POST['tagAktW']);
		$katAktWArray = explode(',',$_POST['katAktW']);
		
	
		# ZAPIS DO BAZY DANYCH TABLICY ROZBITYCH TAGOW W RELACJI Z ARTYKULEM
		while($tagAktWAsoc = each($tagAktWArray))
			{
			$tagAktWquery = "SELECT id FROM tagi WHERE nazwa = '".$tagAktWAsoc['value']."'";
			$tagAktWAsk = mysql_query($tagAktWquery) or die ("TAGI:".mysql_error());
			$tagAktWAsoc1 = mysql_fetch_array($tagAktWAsk);
			$tagAktWquery = "INSERT INTO taglist SET
								tagID = '".$tagAktWAsoc1['id']."',
								artID = '".$_POST['idArt']."',
								nazwa = '".$tagAktWAsoc['value']."'";
			mysql_query($tagAktWquery) or die (mysql_error());
			}
		# ZAPIS DO BAZY DANYCH TABLICY ROZBITYCH KATEGORII	 W RELACJI Z ARTYKULEM
		while($katAktWAsoc = each($katAktWArray))
			{
			$katAktWquery = "SELECT id FROM kategorie WHERE nazwa = '".$katAktWAsoc['value']."'";
			$katAktWAsk = mysql_query($katAktWquery) or die ("KATEGORIE: ".mysql_error());
			$katAktWAsoc1 = mysql_fetch_array($katAktWAsk);
			$katAktWquery = "INSERT INTO kategorielist SET
								katID = '".$katAktWAsoc1['id']."',
								artID = '".$_POST['idArt']."',
								nazwa = '".$katAktWAsoc['value']."'";
			mysql_query($katAktWquery) or die (mysql_error());
			}
		if($_POST['typArt'] == 2)
			{
			$queryLinkMenu = "UPDATE menugorne SET
								art = '".$asocarray['id']."'
								WHERE id = '".$_POST['selectMenu']."'";
			mysql_query($queryLinkMenu) or die (mysql_error());
			}	
	    echo json_encode($response);
		}
# ************************************************************************************************************************************************************
?>
