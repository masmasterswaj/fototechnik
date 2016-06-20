<?php
# **************************************************************************************************************************************
# FUNKCJA UPLOADU PLIKU ORAZ WYSWIETLENIA ZAWARTOSCI FOLDEROW DLA DOWNLOADERA DROPZONE.JS
# CREATE BY MACIEJ KOLANKIEWICZ(C) 2014
# **************************************************************************************************************************************

# **************************************************************************************************************************************
# DEKLAROWANE TYPY PLIKOW KTORE BEDA MOZLIWE DO DOWNLOADU
# **************************************************************************************************************************************
	$typeFiles = '.doc,.docx,.pps,.ppt,.pptx,.ppsx,.xls,.xlsx,.pdf,.jpg,.jpeg,.gif,.bmp,.png,.mp3,.mp4,.flv,.avi';	
# **************************************************************************************************************************************
# WARTOSCI SZESNASTKOWE PIERWSZYCH WSPOLNYCH BAJTOW DLA DANEGO TYPY PLIKU
# **************************************************************************************************************************************
	$typeBytes = Array(
			'.doc' => array('0D444F43','DBA52D00','d0cf11e0a1b11ae1'),
			'.docx' => array('504b030414'),
			'.pps' => array('d0cf11e0a1b11ae1'),
			'.ppt' => array('d0cf11e0a1b11ae1'),
			'.pptx' => array('504b030414'),
			'.ppsx' => array('504b030414'),
			'.xlsx' => array('504b030414'),
			'.xls' => array('504b030414','d0cf11e0a1b11ae1'),
			'.mp4' => array('0000001466747970','0000001866747970','0000001C66747970','0000002066747970','4D534E5601290046','4D534E566D703432'),
			'.flv' => array('464c560105'),
			'.avi' => array('52494646','41636365','41564920'),
			'.mp3' => array('494433'),
			'.gif' => array('474946383961'),
			'.png' => array('89504E470D0A1A0A'),
			'.jpg' => array('ffd8ffe0','ffd8ffe1','ffd8ffe8'),
			'.jpeg' => array('ffd8ffe0','ffd8ffe1','ffd8ffe8'),
			'.wma' => array('3026B2758E66CF11','A6D900AA0062CE6C'),
			'.pdf' => array('25504446'),
			'.bmp' => array('424d')
			);
# **************************************************************************************************************************************
# UTWORZENIE TABLICY DOPUSZCZALNYCH TYPOW PLIKÓW 
# **************************************************************************************************************************************
	$typeArray = explode(',',$typeFiles);
# **************************************************************************************************************************************
# FUNCKJA WYSZUKUJACA KLUCZ W TABLICY
# **************************************************************************************************************************************
	if(!function_exists('array_rsearch')){
	   function array_rsearch($search, $array, $strict = false){
		   $array = array_reverse($array, true);
		   foreach($array as $key => $value){
			   if($strict){
				   if($key === $search)
					   return $key;
			   } else {
				   if(strpos($key, $search))
					   return $key;
				}
			}
			return false;
		}
	}
# **************************************************************************************************************************************
# PRZESZUKIWANIE TABLICY POD KATEM OBECNOSCI ROZSZEZEN I WZORCOW BINARNYCH I TWORZENIE TABLICY DOPUSZCALNYCH ROZSZEZEN I ICHWARTOSCI BIN
# **************************************************************************************************************************************
	foreach( $typeArray as $type => $byte)
		{
		if(array_rsearch($byte, $typeBytes,true))
			{
			for ($i = 0; $i < count($typeBytes[$byte]); $i++)
				$typeNewBytes[$byte][$i] = $typeBytes[$byte][$i];
			}
		}
# **************************************************************************************************************************************
# **************************************************************************************************************************************
# DANE UPLOADOWE - POLOZENIE, SEPARATOR
# **************************************************************************************************************************************
	$ds = DIRECTORY_SEPARATOR; 
	 
	$uploadFolder = 'upload';  
# **************************************************************************************************************************************
# SKANOWANIE ZAWARTOSCI FOLDERU POD KATEM PLIKÓW I WYSLANIE ICH DO SKRYPTU JAVASCRIPTS
# **************************************************************************************************************************************	 
	if (!empty($_FILES)) {
	 
		$tempFile = $_FILES['file']['tmp_name'];         
	 
		$targetPath = dirname( __FILE__ ) . $ds. $uploadFolder . $ds; 
	 
		$targetFile =  $targetPath. $_FILES['file']['name']; 
	 
		move_uploaded_file($tempFile,$targetFile);
	 
	} else { 
# **************************************************************************************************************************************
# **************************************************************************************************************************************
# ANALIZA PLIKOW Z FOLDERU ORAZ OKRESLANIE ICH TYPOW
# **************************************************************************************************************************************  
 	$result = array();				
	$files = scandir($uploadFolder);                 //1
	if ( false!==$files ) {
		foreach ( $files as $file ) {
			if ( '.'!=$file && '..'!=$file) {
				$obj['name'] = $file;
                $obj['size'] = filesize($uploadFolder.$ds.$file);
				
				$fileobj = fopen($uploadFolder.$ds.$file, 'r');
				$bytes = strtolower(bin2hex(fread($fileobj, 20)));
				
				reset($typeNewBytes);
				$findType = false;
				foreach ($typeNewBytes as $type => $byte)
					{			 
					for ($i = 0; $i < count($byte); $i++ )
						{
						if(substr($bytes,0,strlen($byte[$i])) == strtolower($byte[$i]) and strtolower(substr($file,strrpos($file,'.'))) == $type)
							{
							$obj['type'] = $type;
							$findType = true;	
							}
						}
					}
				fclose($fileobj);
				if(!$findType) $obj['type'] = "nieznany";
				$result[] = $obj;
			}
		}
	}
# **************************************************************************************************************************************
# WYSLANIE PLIKOW DO SKRYPTU JAVASCRIPTS ZA POSREDNICTWEM JSON
# **************************************************************************************************************************************  
    header('Content-type: text/json');              //3
    header('Content-type: application/json');
    echo json_encode($result);
}
# **************************************************************************************************************************************  
?>