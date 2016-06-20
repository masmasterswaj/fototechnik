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
# *********************************************************************************************

# ************************************************************************************************************************************************************
# FUNKCJA SPRAWDZAJACA CZY ZAPYTANIE JEST ZAPYTANIE AJAXOWYM
# ************************************************************************************************************************************************************
	 if(isset($_POST['kat']))
	 	{
		$query = "SELECT nazwa FROM kategorie WHERE nazwa = '".$_POST['kat']."'";
		if($ask = mysql_query($query))
			{
			if(mysql_num_rows($ask) > 0)
				{
				$query = "DELETE FROM kategorie WHERE nazwa = '".$_POST['kat']."'";
				if(mysql_query($query))
					$response = "OK";
				else
					$response = "ERROR - BLAD ZAPISU DO MySQL";
					
				$query = "DELETE FROM kategorielist WHERE nazwa = '".$_POST['kat']."'";
				if(mysql_query($query))
					$response = "OK";
				else
					$response = "ERROR - BLAD ZAPISU DO MySQL";
				}else{
				$response = "ERROR - TAKA KATEGORIA NIE ISTNIEJE W BAZIE";	
				}
			}else{
			$response = "ERROR - BLAD ZAPYTANIA DO BAZY DANYCH";
			}
		}else{
		$response = "ERROR - KATEGORIA NIE PRZESLANA";
		}
  	echo json_encode($response);
# ************************************************************************************************************************************************************
?>
