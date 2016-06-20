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
# FUNKCJA POBIERAJACA NOWY INDEKS INCREMENTACJI MySQL
# ************************************************************************************************************************************************************
	function get_new_id($table){
		$select = 'SELECT MAX(`id`) +1 AS `id` FROM `'.$table.'` WHERE `id` != 10000000000';
		$query = mysql_query($select);
		$obj = mysql_fetch_object($query);
		return $obj->id;
		}
	$new_idincrement = get_new_id("aktualnosci");
# KONWERSJA NA CZAS UNIXOWY
	$datepickerW = strtotime($_POST['datepickerW']) +43200;
# WYGENEROWANIE IDENTYFIKATORA FOLDERU DLA GALERII I PLIKOW
	if($new_idincrement < 10) $new_idincrement = '0000'.$new_idincrement;
	if($new_idincrement >= 10 and $new_idincrement < 100) $new_idincrement = '000'.$new_idincrement;
	if($new_idincrement >= 100 and $new_idincrement < 1000) $new_idincrement = '00'.$new_idincrement;
	if($new_idincrement >= 1000 and $new_idincrement < 10000) $new_idincrement = '0'.$new_idincrement;
	if($new_idincrement >= 10000 and $new_idincrement < 100000) $new_idincrement = $new_idincrement;

	$dataUtworzenia = time();
# USUWANIE Z TEKSTU NIEBEZPIECZNYCH FUNKCJI ATAKOW SQL PHP ORAZ JAVASCRIPT ORAZA PODMIANA CUDZYSLOWOW
	$_POST['textAktW'] = str_replace("'",'`',str_replace("\"",'`',strip_tags($_POST['textAktW'])));
	$_POST['textArtW'] = str_replace("'",'`',str_replace("\"",'`',strip_tags($_POST['textArtW'])));
# ************************************************************************************************************************************************************
# FUNKCJA SPRAWDZAJACA CZY ZAPYTANIE JEST ZAPYTANIE AJAXOWYM
# DODANIE ARTYKULU DO BAZY DANYCH
# ************************************************************************************************************************************************************
	 if(isset($_POST['dane']))
	 	{
		$query = "INSERT INTO aktualnosci SET 
					tytulakt = '".$_POST['tytulAktW']."',
					tytulart = '".$_POST['tytulArtW']."',
					data = '".$datepickerW."',
					autor = '".$_POST['autorW']."',
					tekstAkt = '".$_POST['textAktW']."',
					tekstArt = '".$_POST['textArtW']."',
					dataUtw = '".$dataUtworzenia."',
					dataEdy = '".$dataUtworzenia."',
					typView = '".$_POST['typArt']."',
					galPicId = '".$new_idincrement."', 
					folderPic = '".$_POST['check2']."',
					redaktor = '1',
					kategorie = '".$_POST['katAktW']."',
					aktywnosc = '".$_POST['check1']."'";			
		# DODANIE DO BAZY DANYCH 
		if(mysql_query($query))
			{
		# TWORZENIE FOLDERU DLA ARTYKULU
			if(mkdir($path_file."artykuly/".$new_idincrement, 0777) and mkdir($path_file."miniatury/".$new_idincrement, 0777))
				{
				$response = "OK";
			}else{
				$response = "NIE UTWORZONO KATALOGU";
				}
		}else{
			$response = "NIE DODDANO ARTYKULU DO BAZY DANYCH";
			}
# ************************************************************************************************************************************************************
# DDANIE TAGOW I KATEGORII DO BAZY W RELACJI Z ARTYKULEM 
# ************************************************************************************************************************************************************
		$_POST['tagAktW'] = substr($_POST['tagAktW'],0,-1);
		$_POST['katAktW'] = substr($_POST['katAktW'],0,-1);
		
		$tagAktWArray = explode(',',$_POST['tagAktW']);
		$katAktWArray = explode(',',$_POST['katAktW']);
	
		# POBRANIE ID ARTYKULU
		$query = "SELECT id FROM aktualnosci WHERE dataUtw = '".$dataUtworzenia."'";
		$ask = mysql_query($query) or die (mysql_error());
		$asocarray = mysql_fetch_array($ask);
		# ZAPIS DO BAZY DANYCH TABLICY ROZBITYCH TAGOW W RELACJI Z ARTYKULEM
		while($tagAktWAsoc = each($tagAktWArray))
			{
			$tagAktWquery = "SELECT id FROM tagi WHERE nazwa = '".$tagAktWAsoc['value']."'";
			$tagAktWAsk = mysql_query($tagAktWquery) or die (mysql_error());
			$tagAktWAsoc1 = mysql_fetch_array($tagAktWAsk);
			$tagAktWquery = "INSERT INTO taglist SET
								tagID = '".$tagAktWAsoc1['id']."',
								artID = '".$asocarray['id']."',
								nazwa = '".$tagAktWAsoc['value']."'";
			mysql_query($tagAktWquery) or die (mysql_error());
			}
		# ZAPIS DO BAZY DANYCH TABLICY ROZBITYCH KATEGORII	 W RELACJI Z ARTYKULEM
		while($katAktWAsoc = each($katAktWArray))
			{
			$katAktWquery = "SELECT id FROM kategorie WHERE nazwa = '".$katAktWAsoc['value']."'";
			$katAktWAsk = mysql_query($katAktWquery) or die (mysql_error());
			$katAktWAsoc1 = mysql_fetch_array($katAktWAsk);
			$katAktWquery = "INSERT INTO kategorielist SET
								katID = '".$katAktWAsoc1['id']."',
								artID = '".$asocarray['id']."',
								nazwa = '".$katAktWAsoc['value']."'";
			mysql_query($katAktWquery) or die (mysql_error());
			}
		# PRZYPISANIE ARTYKULU DO GORNEGO MENU JESLI ZACHODZI
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
