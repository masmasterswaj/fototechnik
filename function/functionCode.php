<?php
# *********************************************************************************************
# FUNKCJA SZYFRUJACA NA PODSTAWIE KLUCZA
# *********************************************************************************************
	function descript($string,$key){$str1='';$str2='';$str3='';$key2='';$key3=
	'';for($x=0;$x<=strlen($string)-1;$x++)$str1=$str1.dechex(ord(substr($string
	,$x,1))).dechex(rand(20,255));for($x=0;$x<=strlen($str1)-1;$x=$x+2)$str2=
	$str2.strrev(substr($str1,$x,2));$key1=ceil(strlen($string)/strlen($key));
	for($x=0;$x<=$key1;$x++)$key2=$key2.$key;$key2=substr($key2,0,strlen($string
	));for($x=0;$x<=strlen($key2)-1;$x++)$key3=$key3.dechex(ord(substr($key2,$x,
	1))).dechex(rand(20,255));for($x=0;$x<=strlen($key3)-1;$x=$x+2){$key_var=
	substr($key3,$x,2);$str_var=substr($str2,$x,2);$str3=$str3.(dechex(hexdec(
	$key_var)+hexdec($str_var)+300));}$str3=strrev($str3);return $str3;}
# *********************************************************************************************
# FUNKCJA DESZYFRUJACA NA PODSTAWIE KLUCZA
# *********************************************************************************************
	function undescript($string,$key){$str0=strrev($string);$key2='';$key3='';
	$y=0;$str1='';$str2='';$str4='';$str5='';$key1=ceil(((strlen($str0)/3)/2)/
	strlen($key));for($x=0;$x<=$key1;$x++)$key2=$key2.$key;$key2=substr($key2,
	0,(strlen($str0)/3)/2);for($x=0;$x<=strlen($key2)-1;$x++)$key3=$key3.dechex
	(ord(substr($key2,$x,1)));for($x=0;$x<=strlen($str0)-1;$x=$x+6)$str5=$str5
	.substr($str0,$x,3);for($x=0;$x<=strlen($str5)-1;$x=$x+3){$key_var=substr(
	$key3,$y,2);$str_var=substr($str5,$x,3);$str_val=dechex((hexdec($str_var)-
	hexdec($key_var))-300);if(hexdec($str_val)<16)$str_val="0".$str_val;$str1=
	$str1.$str_val;$y=$y+2;}for($x=0;$x<=strlen($str1)-1;$x=$x+2)$str2=$str2.
	strrev(substr($str1,$x,2));for($x=0;$x<=strlen($str2)-1;$x=$x+2)$str4=$str4
	.chr(hexdec(substr($str2,$x,2)));return $str4;}
# *********************************************************************************************
?>