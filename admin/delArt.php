﻿<?php
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
# *********************************************************************************************
# FUNKCJA USUWAJACA CALY KATALOG Z PLIKAMI 
# *********************************************************************************************
	function removeDir($path) 
		{
		$dir = new DirectoryIterator($path);
		foreach ($dir as $fileinfo) 
			{
			if($fileinfo->isFile() || $fileinfo->isLink()) 
				{
				unlink($fileinfo->getPathName());
			}elseif(!$fileinfo->isDot() && $fileinfo->isDir()) 
				{
				removeDir($fileinfo->getPathName());
				}
			}
		rmdir($path);
		}
# ************************************************************************************************************************************************************
# FUNKCJA SPRAWDZAJACA CZY ZAPYTANIE JEST ZAPYTANIE AJAXOWYM
# ************************************************************************************************************************************************************
	$queryDel = "DELETE FROM aktualnosci WHERE id = '".$_POST['idArtDel']."'";
	$askDel = mysql_query($queryDel) or die (mysql_error());
	
	$queryDel = "DELETE FROM kategorielist WHERE artID = '".$_POST['idArtDel']."'";
	$askDel = mysql_query($queryDel) or die (mysql_error());
	
	$queryDel = "DELETE FROM taglist WHERE artID = '".$_POST['idArtDel']."'";
	$askDel = mysql_query($queryDel) or die (mysql_error());
	
	$queryDel = "DELETE FROM taglist WHERE artID = '".$_POST['idArtDel']."'";
	$askDel = mysql_query($queryDel) or die (mysql_error());
	
	$queryLinkMenu = "UPDATE menugorne SET
								art = '0'
								WHERE art = '".$_POST['idArtDel']."'";
	mysql_query($queryLinkMenu) or die (mysql_error());
	
	if($_POST['delGalery'] == 1)
		{
		removeDir($path_file."artykuly/".$_POST['galPicId']."/"); 
		removeDir($path_file."miniatury/".$_POST['galPicId']."/"); 
		}
	$response = 'OK';
  	echo json_encode($response);
# ************************************************************************************************************************************************************
?>
