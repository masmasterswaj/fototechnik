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
# ************************************************************************************************************************************************************
# POBRANIE DANYCH Z BAZY DANYCH NA PODSTAWIE IDENTYFIKATORA 
# ************************************************************************************************************************************************************
	function queryString($query,$queryOld)
		{
		#$queryOld = $_SERVER['QUERY_STRING'];
		$queryOldArray = explode('&',$queryOld);
		$queryNew = '';
		while($queryOldAsoc = each($queryOldArray))
			{
			$queryOldName = substr($queryOldAsoc['value'],0,strpos($queryOldAsoc['value'],"="));
			$queryName = substr($query,0,strpos($query,"="));	
			if($queryOldName != $queryName)
				$queryNew = $queryNew.$queryOldAsoc['value']."&";
			#echo "[".$queryOldAsoc['key']."] = ".$queryOldAsoc['value']." zmienna = ".$queryOldName." zmienna poszuk = ".$queryName."<br />";
			}
		$queryNew = $queryNew.$query;
		return($queryNew);
		}

	$query = "nri=10";
	$queryOld = "kat=kwalifikacje&nri=20&tag=nasze%20prace";
	echo queryString($query,$queryOld);
# ************************************************************************************************************************************************************
?>


</body>
</html>