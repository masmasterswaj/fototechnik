<?php
include('config/config.php');
if($_SESSION['RF']["verify"] != "RESPONSIVEfilemanager") die('forbiden');
include('include/utils.php');


$storeFolder = $_POST['path'];
$storeFolderThumb = $_POST['path_thumb'];

$path_pos=strpos($storeFolder,$current_path);
$thumb_pos=strpos($_POST['path_thumb'],$thumbs_base_path);
if($path_pos!==0 
    || $thumb_pos !==0
    || strpos($storeFolderThumb,'../',strlen($thumbs_base_path))!==FALSE
    || strpos($storeFolderThumb,'./',strlen($thumbs_base_path))!==FALSE
    || strpos($storeFolder,'../',strlen($current_path))!==FALSE
    || strpos($storeFolder,'./',strlen($current_path))!==FALSE )
    die('wrong path');


$path=$storeFolder;
$cycle=true;
$max_cycles=50;
$i=0;
while($cycle && $i<$max_cycles){
    $i++;
    if($path==$current_path)  $cycle=false;
    if(file_exists($path."config.php")){
	require_once($path."config.php");
	$cycle=false;
    }
    $path=fix_dirname($path).'/';
}


if (!empty($_FILES)) {
    $info=pathinfo($_FILES['file']['name']);
    if(in_array(fix_strtolower($info['extension']), $ext)){
	$tempFile = $_FILES['file']['tmp_name'];   
	  
	$targetPath = $storeFolder;
	$targetPathThumb = $storeFolderThumb;
	$_FILES['file']['name'] = fix_filename($_FILES['file']['name'],$transliteration);
	 
	if(file_exists($targetPath.$_FILES['file']['name'])){
	    $i = 1;
	    $info=pathinfo($_FILES['file']['name']);
	    while(file_exists($targetPath.$info['filename']."_".$i.".".$info['extension'])) {
		    $i++;
	    }
	    $_FILES['file']['name']=$info['filename']."_".$i.".".$info['extension'];
	}
	$targetFile =  fix_strtolower($targetPath. $_FILES['file']['name'],$ext); 
	$targetFileThumb =  fix_strtolower($targetPathThumb.$_FILES['file']['name'],$ext);
	$file = fix_strtolower($_FILES['file']['name'],$ext);
	
	if(in_array(fix_strtolower($info['extension']),$ext_img)) $is_img=true;
	else $is_img=false;
	
	
	move_uploaded_file($tempFile,$targetFile);
	chmod($targetFile, 0755);
# *********************************************************************************************************************************************
# PLUGIN DLA UTWORZENIA DODATKOWYCH PLIKÓW
# *********************************************************************************************************************************************			
		$roz = substr($file,strrpos($file,".")+1,strlen($file)-strrpos($file,"."));
		$prefix = substr($file,strrpos($file,".")-2,2);
		$nameImg = substr($file,0,strrpos($file,"."));
		$nameImgNewD = $targetPathThumb.$nameImg.'_d.'.$roz;
		$nameImgNewS = $targetPathThumb.$nameImg.'_s.'.$roz;
		$nameImgNewSS = $targetPathThumb.$nameImg.'_m.'.$roz;
		$nameImgNewX = $targetPathThumb.$nameImg.'_x.'.$roz;
		$nameImgNew00 = $targetPathThumb.$nameImg.'_z.'.$roz;
# SPRAWDZENIE CZY W FOLDERZE MACIERZYSTYM ZNAJDUJE SIE ZDJECIE NA PIERWSZA STRONE		
		$nameImg00 = false;
		if( $handle = @opendir($storeFolderThumb) )
				{
				while ( false !== ($file = readdir( $handle )) )
					{
					$roz = substr($file,strrpos($file,".")+1,strlen($file)-strrpos($file,"."));
					$prefix = substr($file,strrpos($file,".")-2,2);
					$nameImg = substr($file,0,strrpos($file,"."));
					if($prefix == '_z')	$nameImg00 = true;
					}
				}
# TWORZENIE OBRAZKA DLA ARTYKULU
		if (is_readable($targetFile))  
			{ 
			$info = @getimagesize($targetFile); 
		# DETEKCJA RODZAJU PLIKU GRAFICZNEGO I POBRANIE GO ZE SCIEZKI
			switch ($info['mime'])  
				{ 
				case "image/gif": 
					$file = imagecreatefromgif($targetFile); 
					break; 
				case "image/jpeg": 
					$file = imagecreatefromjpeg($targetFile); 
					break; 
				case "image/png": 
					$file = imagecreatefrompng($targetFile); 
					break; 
				} 
		
			$old_x = imageSX($file); 
			$old_y = imageSY($file);
		# SPRAWDZENIE ORIENTACJI OBRAZKA  
			if ($old_x > $old_y)  
				{ 
				$thumb_w=$newD_w; 
				$thumb_h=$old_y*($newD_h/$old_x); 
				} 
			 
			if ($old_x < $old_y)  
				{ 
				$thumb_w=$old_x*($newD_w/$old_y); 
				$thumb_h=$newD_h; 
				} 
			 
			if ($old_x == $old_y)  
				{ 
				$thumb_w=$newD_w; 
				$thumb_h=$newD_h; 
				} 
			
		# UTWORZENIE OBRAZKA 
			$th = ImageCreateTrueColor($thumb_w, $thumb_h); 
			imagecopyresampled($th, $file, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y);
		# ZAPIS OBRAZKA	
			switch ($info['mime'])  
				{ 
				case "image/gif": 
					imagegif($th, $nameImgNewD);
					break; 
				case "image/jpeg": 
					imagejpeg($th, $nameImgNewD);
					break; 
				case "image/png": 
					imagepng($th, $nameImgNewD);
					break; 
				} 	
		# USUNIECIE PAMIECI 
			@imagedestroy($file);  
    		@imagedestroy($th);
# TWORZENIE OBRAZKA DLA GALERII ARTYKULU
			
		$info = @getimagesize($targetFile); 
		# DETEKCJA RODZAJU PLIKU GRAFICZNEGO I POBRANIE GO ZE SCIEZKI
			switch ($info['mime'])  
				{ 
				case "image/gif": 
					$file = imagecreatefromgif($targetFile); 
					break; 
				case "image/jpeg": 
					$file = imagecreatefromjpeg($targetFile); 
					break; 
				case "image/png": 
					$file = imagecreatefrompng($targetFile); 
					break; 
				} 
		
			$old_x = imageSX($file); 
			$old_y = imageSY($file);
		# SPRAWDZENIE ORIENTACJI OBRAZKA  
			# SPRAWDZENIE ORIENTACJI OBRAZKA  
			if ($old_x > $old_y)  
				{ 
				$thumb_w=$newS_w; 
				$thumb_h=$old_y*($newS_h/$old_x); 
				} 
			 
			if ($old_x < $old_y)  
				{ 
				$thumb_w=$old_x*($newS_w/$old_y); 
				$thumb_h=$newS_h; 
				} 
			 
			if ($old_x == $old_y)  
				{ 
				$thumb_w=$newS_w; 
				$thumb_h=$newS_h; 
				} 
			
			
		# UTWORZENIE OBRAZKA 
			$th = ImageCreateTrueColor($thumb_w, $thumb_h);
			imagecopyresampled($th, $file, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y);
			
		# ZAPIS OBRAZKA	
			switch ($info['mime'])  
				{ 
				case "image/gif": 
					imagegif($th, $nameImgNewS);
					break; 
				case "image/jpeg": 
					imagejpeg($th, $nameImgNewS);
					break; 
				case "image/png": 
					imagepng($th, $nameImgNewS);
					break; 
				} 	
		# USUNIECIE PAMIECI 
			@imagedestroy($file);  
    		@imagedestroy($th);
			
			$info = @getimagesize($nameImgNewS); 
		# DETEKCJA RODZAJU PLIKU GRAFICZNEGO I POBRANIE GO ZE SCIEZKI
			switch ($info['mime'])  
				{ 
				case "image/gif": 
					$file = imagecreatefromgif($nameImgNewS); 
					break; 
				case "image/jpeg": 
					$file = imagecreatefromjpeg($nameImgNewS); 
					break; 
				case "image/png": 
					$file = imagecreatefrompng($nameImgNewS); 
					break; 
				} 
		
			$old_x = imageSX($file); 
			$old_y = imageSY($file);
			
		# UTWORZENIE OBRAZKA 
			$th = ImageCreateTrueColor($newSS_w, $newSS_h); 
			imagecopyresampled($th, $file, 0, 0, (ceil(($old_x / 2)-($newSS_w/2))), (ceil(($old_y / 2)-($newSS_h/2))), $newSS_w, $newSS_h, $newSS_w, $newSS_h); 
		# ZAPIS OBRAZKA	
			switch ($info['mime'])  
				{ 
				case "image/gif": 
					imagegif($th, $nameImgNewSS);
					break; 
				case "image/jpeg": 
					imagejpeg($th, $nameImgNewSS);
					break; 
				case "image/png": 
					imagepng($th, $nameImgNewSS);
					break; 
				} 	
		# USUNIECIE PAMIECI 
			@imagedestroy($file);  
    		@imagedestroy($th);
	   if(!$nameImg00)
	   	{	
		# UTWORZENIE OBRAZKA 00000.JPG DLA PIERWSZEJ STONY BLOGA 	***************************************************************************		
		$info = @getimagesize($targetFile); 
		# DETEKCJA RODZAJU PLIKU GRAFICZNEGO I POBRANIE GO ZE SCIEZKI
			switch ($info['mime'])  
				{ 
				case "image/gif": 
					$file = imagecreatefromgif($targetFile); 
					break; 
				case "image/jpeg": 
					$file = imagecreatefromjpeg($targetFile); 
					break; 
				case "image/png": 
					$file = imagecreatefrompng($targetFile); 
					break; 
				} 
		
			$old_x = imageSX($file); 
			$old_y = imageSY($file);
			$newX_h = 800;
			$newX_w = 800;
		# SPRAWDZENIE ORIENTACJI OBRAZKA  
			if ($old_x > $old_y)  
				{ 
				$thumb_w=$newX_w; 
				$thumb_h=$old_y*($newX_h/$old_x); 
				} 
			 
			if ($old_x < $old_y)  
				{ 
				$thumb_w=$old_x*($newX_w/$old_y); 
				$thumb_h=$newX_h; 
				} 
			 
			if ($old_x == $old_y)  
				{ 
				$thumb_w=$newX_w; 
				$thumb_h=$newX_h; 
				} 
			
		# UTWORZENIE OBRAZKA 
			$th = ImageCreateTrueColor($thumb_w, $thumb_h); 
			imagecopyresampled($th, $file, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y);
		# ZAPIS OBRAZKA	
			switch ($info['mime'])  
				{ 
				case "image/gif": 
					imagegif($th, $nameImgNewX);
					break; 
				case "image/jpeg": 
					imagejpeg($th, $nameImgNewX);
					break; 
				case "image/png": 
					imagepng($th, $nameImgNewX);
					break; 
				} 	
		# USUNIECIE PAMIECI 
			@imagedestroy($file);  
    		@imagedestroy($th);
			
		$info = @getimagesize($nameImgNewX); 
		# DETEKCJA RODZAJU PLIKU GRAFICZNEGO I POBRANIE GO ZE SCIEZKI
			switch ($info['mime'])  
				{ 
				case "image/gif": 
					$file = imagecreatefromgif($nameImgNewX); 
					break; 
				case "image/jpeg": 
					$file = imagecreatefromjpeg($nameImgNewX); 
					break; 
				case "image/png": 
					$file = imagecreatefrompng($nameImgNewX); 
					break; 
				} 
		
			$old_x = imageSX($file); 
			$old_y = imageSY($file);
			$new00_w = 600; 
			$new00_h = 400;
		# UTWORZENIE OBRAZKA 
			$th = ImageCreateTrueColor($new00_w, $new00_h); 
			imagecopyresampled($th, $file, 0, 0, (ceil(($old_x / 2)-($new00_w/2))), (ceil(($old_y / 2)-($new00_h/2))), $new00_w, $new00_h, $new00_w, $new00_h); 
		# ZAPIS OBRAZKA	
			switch ($info['mime'])  
				{ 
				case "image/gif": 
					imagegif($th, $nameImgNew00);
					break; 
				case "image/jpeg": 
					imagejpeg($th, $nameImgNew00);
					break; 
				case "image/png": 
					imagepng($th, $nameImgNew00);
					break; 
				} 	
		# USUNIECIE PAMIECI 
			@imagedestroy($file);  
    		@imagedestroy($th);
			#unlink($nameImgNewX);
		}
		}
# *********************************************************************************************************************************************	
	if($is_img){
	    $memory_error=false;
	    if(!create_img_gd($targetFile, $targetFileThumb, 122, 91)){
		$memory_error=false;
	    }else{
		if(!new_thumbnails_creation($targetPath,$targetFile,$_FILES['file']['name'],$current_path,$relative_image_creation,$relative_path_from_current_pos,$relative_image_creation_name_to_prepend,$relative_image_creation_name_to_append,$relative_image_creation_width,$relative_image_creation_height,$relative_image_creation_option,$fixed_image_creation,$fixed_path_from_filemanager,$fixed_image_creation_name_to_prepend,$fixed_image_creation_to_append,$fixed_image_creation_width,$fixed_image_creation_height,$fixed_image_creation_option)){
		    $memory_error=false;
		}else{		    
		    $imginfo =getimagesize($targetFile);
		    $srcWidth = $imginfo[0];
		    $srcHeight = $imginfo[1];
		    
		    if($image_resizing){
			if($image_resizing_width==0){
			    if($image_resizing_height==0){
				$image_resizing_width=$srcWidth;
				$image_resizing_height =$srcHeight;
			    }else{
				$image_resizing_width=$image_resizing_height*$srcWidth/$srcHeight;
			}
			}elseif($image_resizing_height==0){
			    $image_resizing_height =$image_resizing_width*$srcHeight/$srcWidth;
			}
			$srcWidth=$image_resizing_width;
			$srcHeight=$image_resizing_height;
			create_img_gd($targetFile, $targetFile, $image_resizing_width, $image_resizing_height);
		    }
		    //max resizing limit control
		    $resize=false;
		    if($image_max_width!=0 && $srcWidth >$image_max_width){
			$resize=true;
			$srcHeight=$image_max_width*$srcHeight/$srcWidth;
			$srcWidth=$image_max_width;
		    }
		    if($image_max_height!=0 && $srcHeight >$image_max_height){
			$resize=true;
			$srcWidth =$image_max_height*$srcWidth/$srcHeight;
			$srcHeight =$image_max_height;
		    }
		    if($resize)
			create_img_gd($targetFile, $targetFile, $srcWidth, $srcHeight);
		}
	    }		
	    if($memory_error){
		//error
		unlink($targetFile);
		header('HTTP/1.1 406 Not enought Memory',true,406);
		exit();
	    }
	}
    }else{
	header('HTTP/1.1 406 file not permitted',true,406);
	exit();
    }
}else{
    header('HTTP/1.1 405 Bad Request', true, 405);
    exit();
}
if(isset($_POST['submit'])){
    $query = http_build_query(array(
        'type'      => $_POST['type'],
        'lang'      => $_POST['lang'],
        'popup'     => $_POST['popup'],
        'field_id'  => $_POST['field_id'],
        'fldr'      => $_POST['fldr'],
    ));
    header("location: dialog.php?" . $query);
}

?>      
