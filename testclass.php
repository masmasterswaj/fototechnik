<?php

class test {
	
var $z1 = 'Maciej';
var $z2 = 'Kolan';	
function wyswietl()
	{
	echo $this->z1.' '.$this->z2;
	}
}

$klasa = new test;
$klasa->z1 = 'Dupa';
$klasa->z2 = 'Jasiu';
$klasa->wyswietl();

?>