<?php
# *********************************************************************************************
# FUNKCJA WYSWIETLAJACA INFORMACJE O BLEDACH I KOMUNIKATACH
# *********************************************************************************************

function msgViewTest ($nazwa,$wartosc='NULL',$viewTest=false)
		{
		if($viewTest)
		{
# *********************************************************************************************
# ZNAJDOWANIE UNIWERSALEJ SCIEZKI DOSTEPU DO PLIKU ORAZ OKRESLANIE JEGO LOKALIZACJI
# *********************************************************************************************
	$lokalizator = 0;$path_file = "";clearstatcache();
	$name_file = substr($_SERVER['PHP_SELF'],strpos(strrev($_SERVER['PHP_SELF']),'/',0)*(-1));
	while(!file_exists($path_file."path.php")){$path_file = "";
	for($q=0; $q <=(substr_count($_SERVER['PHP_SELF'], "/"))-$lokalizator; $q++)
	$path_file = $path_file."../";$lokalizator++;}
# *********************************************************************************************
		$infoerror = new Template($path_file."errors/error.tpl");
		$infoerror->add('errornazwa', $nazwa);
		$infoerror->add('errorwartosc', $wartosc);
		echo $infoerror->execute();
		}
		}
# *********************************************************************************************
?>