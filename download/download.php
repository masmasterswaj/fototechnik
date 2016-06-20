<?php
# *********************************************************************************************
# FUNKCJA SPRAWDZAJACA CZY KATALOG ISTNIEJE
# *********************************************************************************************
	function dir_exists($dir_name)
		{
		if(file_exists($dir_name) && filetype($dir_name) == "dir")  
		 	return true;
		 else
			return false;
		}

	$uploadpath = "uploades";
	$scriptPath = 'uploades'; 
	
	$fd = fopen($uploadpath."/logs.txt", "a+") or die ( "BLAD ZAPISU DO PLIKU LOGS.TXT" );
	
	fwrite($fd, "Rozpoczecie dzialania skryptu"."\r\n");
# *********************************************************************************************
# TWORZENIE KATALOGU
# *********************************************************************************************
	if(!dir_exists($uploadPath))
		fwrite($fd, "Nie odnaleziono katalogu"."\r\n");
	else
		fwrite($fd, "Katalog jest juz utworzony"."\r\n");
# *********************************************************************************************
# SPRAWDZENIE CZY KATALOG JEST ZAPISYWALNY
# *********************************************************************************************
	if (!is_writable($uploadPath))
		fwrite($fd, "Katalog nie ma uprawnien do zapisywania"."\r\n");
	else
		fwrite($fd, "W katalogu da sie zapisac pliki"."\r\n");
# *********************************************************************************************
# POZOSTALE TESTY NAD PLIKIEM
# *********************************************************************************************		
	if (!isset($_FILES["file"]))
		fwrite($fd, "Plik nie zostal przeslany: Przekroczony POST_MAX_SIZE"."\r\n");
	else
		fwrite($fd, "Plik zostal przeslany"."\r\n");
	if (!is_uploaded_file($_FILES["file"]["tmp_name"]))
		fwrite($fd, "Upload nie jest plikiem"."\r\n");
	else
		fwrite($fd, "Upload po stronie kienta zakonczyl sie powodzeniem"."\r\n");
	if ( $_FILES["file"]["error"] != 0)
		fwrite($fd, "Upload nie powidl sie ze wzgledu na ERROR"."\r\n");
	else
		fwrite($fd, "Upload na serwer zakonczyl sie bez bledow"."\r\n");
# *********************************************************************************************
# SPRAWDZENIE BLEDOW Z PRZESYLANYM PLIKIEM
# *********************************************************************************************
	if (!isset($_FILES["file"]) || 
		 !is_uploaded_file($_FILES["file"]["tmp_name"]) || 
		 $_FILES["file"]["error"] != 0) 
		{
		switch ($_FILES['file']["error"]) 
			{
			case 1: $error_msg = 'Serwer nie dopuszcza uploadu tak dużego pliku: '.
								  ini_get('upload_max_filesize').'.'; 
			case 2: $error_msg = 'Plik przekroczyl dopuszczalna wielkosc.'; 
			case 3: $error_msg = 'Plik uploadowal sie tylko w czesci.'; 
			case 4: $error_msg = 'Plik sie nie uplodowal.';
			}
		fwrite($fd, "Error: ".$error_msg."\r\n");
		fwrite($fd, "Dane blednego pliku: ".$_FILES["file"]["name"]."\r\n".
							' - PHP Error: '.$error_msg."\r\n".
							' - Sciezka zapisu: '.$uploadPath."\r\n".
							' - $_FILES dane: '.
							"\r\n\t Rozmiar pliku max: ". ini_get('upload_max_filesize').
							"\r\n\t Rozmiar pliku: ".$_FILES["file"]["size"].
							"\r\n\t Sciezka użytkownika: ".$_FILES["file"]["tmp_name"].
							"\r\n\t Nazwa pliku: ".$_FILES["file"]["name"].
							"\r\n\t Bledy: ".$_FILES["file"]["error"].
							"\r\n\t Typ pliku: ".$_FILES["file"]["type"]."\r\n"
							 );
		fwrite($fd, "Plik nie zostal uploadowany: ".$_FILES["file"]["name"]."\r\n");
		fclose($fd);
		exit(0);
	} else {
		fwrite($fd, "Plik gotowy do uploadowania: ".$_FILES["file"]["name"]."\r\n".
					"Dane pliku: ".$_FILES["file"]["name"]."\r\n".
					' - Sciezka zapisu: '.$uploadPath."\r\n".
					' - $_FILES dane: '.
					"\r\n\t Rozmiar pliku: ".$_FILES["file"]["size"].
					"\r\n\t Sciezka użytkownika: ".$_FILES["file"]["tmp_name"].
					"\r\n\t Nazwa pliku: ".$_FILES["file"]["name"].
					"\r\n\t Bledy: ".$_FILES["file"]["error"].
					"\r\n\t Typ pliku: ".$_FILES["file"]["type"]."\r\n");

# *********************************************************************************************
# WYSYLANIE PLIKU DO KATALOGU UPLODOWANEGO
# *********************************************************************************************
		$uploadfile = "uploades/".$_FILES['file']['name'];
		fwrite($fd, "Pelna sciezka dostepu: ".$uploadfile."\r\n");
		if ( move_uploaded_file( $_FILES['file']['tmp_name'] , $uploadfile ) ) 
			fwrite($fd, "Plik zostal uploadowany: ".$_FILES["file"]["name"]."\r\n");
		else
			fwrite($fd, "Plik nie zostal uploadowany: ".$_FILES["file"]["name"]."\r\n");
	}
?>