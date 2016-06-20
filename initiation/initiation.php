<?php
# *********************************************************************************************
# SKRYPT INICJACJI STRONY
# CREATED BY MACIEJ KOLANKIEWICZ (C) 2012
# *********************************************************************************************
# *********************************************************************************************
# funkcja wyswietlajaca informacje.
# *********************************************************************************************
	ini_set( 'display_errors', 'On' ); 
	error_reporting( E_ALL );
	@session_start();
# *********************************************************************************************
# ZNAJDOWANIE UNIWERSALEJ SCIEZKI DOSTEPU DO PLIKU ORAZ OKRESLANIE JEGO LOKALIZCJI
# *********************************************************************************************
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
	include_once($path_file."function/functionTime.php");
	include_once($path_file."function/functionWeb.php");
# *********************************************************************************************
# POLACZENIE Z BAZA DANYCH
# *********************************************************************************************
	include_once($path_file."function/dbconnect.php");
# *********************************************************************************************
# UTWORZENIE SESJI UZYTKOWNIKA
# *********************************************************************************************
	//include_once($path_file."session/session.php");

# *********************************************************************************************
# WYGENEROWANIE NAGLOWKA
# *********************************************************************************************
	$webhead = new Template($path_file."header/header.tpl");
	$webhead->add('webtitle', $web_title);
	$webhead->add('webauthor', $web_author);
	$webhead->add('webcharset', $web_charset);
	$webhead->add('webkeywords', $web_keywords);
	$webhead->add('webdescription', $web_description);
	$webhead->add('pathfile', $path_file);
	echo $webhead->execute();
 
# *********************************************************************************************
?>

