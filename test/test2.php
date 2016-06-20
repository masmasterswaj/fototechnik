<?php
# ************************************************************************************************************************************************************
	$dane = fread(fopen("tekst.txt", "r"), filesize("tekst.txt"));
	$excel = fread(fopen("excel.csv", "r"), filesize("excel.csv"));
	$tablicaTxt = explode(" ",$dane);
	$tablicaExcel = explode(";\n",$excel);
	
	echo "<h1>Nowe emaile znalezione na tej stronie</h1><br /><br />";
	while($asocArray = each($tablicaTxt))
		{
		if(strpos($asocArray['value'],"@") > 0 )
			{
			if(!array_search(substr($asocArray['value'],0,-2),$tablicaExcel)>0) 
				echo "Nr:<b>".$asocArray['key']."</b>\t Email: <b>".substr($asocArray['value'],0,-2)."</b><br />";
			else
				echo "Nr:<b><span style=\"color:#F00\">".$asocArray['key']."</span></b>\t Email: <b>".$asocArray['value']."</b><br />";
			if(!array_search(substr($asocArray['value'],0,-2),$tablicaExcel)>0) 
				$excel_csv = $excel_csv.substr($asocArray['value'],0,-2).";\n";
			}
		}
	echo "<h1>Juz istniejace</h1><br /><br />";
	while($asocArrayExcel = each($tablicaExcel))
		{
		echo "Nr:<b>".$asocArrayExcel['key']."</b>\t Email: <b>".$asocArrayExcel['value']."</b><br />";
		}
	$excel_csv = ''; 
	// otwarcie pliku do zapisu
	$fp = fopen("excel.csv", "a+");
	
	// zapisanie danych
	fputs($fp, $excel_csv);
	
	// zamknięcie pliku
	fclose($fp);
# ************************************************************************************************************************************************************
?>