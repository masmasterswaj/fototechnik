<?php
# *********************************************************************************************
# FUNKCJE BAZODANOWE
# CREATED BY MACIEJ KOLANKIEWICZ (C) 2008
# *********************************************************************************************
# ZNAJDOWANIE UNIWERSALEJ SCIEZKI DOSTEPU DO PLIKU ORAZ OKRESLANIE JEGO LOKALIZACJI
# *********************************************************************************************
	$lokalizator = 0;$path_file = "";clearstatcache();
	$name_file = substr($_SERVER['PHP_SELF'],strpos(strrev($_SERVER['PHP_SELF']),'/',0)*(-1));
	while(!file_exists($path_file."path.php")){$path_file = "";
	for($q=0; $q <=(substr_count($_SERVER['PHP_SELF'], "/"))-$lokalizator; $q++)
	$path_file = $path_file."../";$lokalizator++;}
# *********************************************************************************************
# DEKODOWANIE ZASZYFROWANEGO HASLA I NAZWY UZYTKOWNIKA
# *********************************************************************************************
	$mysql_login = undescript($mysql_login,$key);
	$mysql_password = undescript($mysql_password,$key);
# *********************************************************************************************
# FUNKCJA LOGUJACA SIE DO MYSQL
# *********************************************************************************************
	$mysqlConnect = @mysql_connect($mysql_host,$mysql_login,$mysql_password)
				    or die (msgViewTest('Polaczenie z MySQL:',"Nie powiodlo sie<br>".
					mysql_error(),2,$path_file));
	if($mysqlConnect and $viewTest) msgViewTest('Polaczenie z MySQL:',"Powiodlo sie",3,$path_file);
# *********************************************************************************************
# FUNKCJA LACZACA Z BAZA DANYCH
# *********************************************************************************************
	$mysqlDb = @mysql_select_db($mysql_db) 
			   or die (msgViewTest('Polaczenie z DB:',"Nie powiodlo sie<br>".mysql_error(),2,$path_file));
	if($mysqlDb and $viewTest) msgViewTest('Polaczenie z DB:',"Powiodlo sie",3,$path_file);
# *********************************************************************************************
?>