<?php
# *********************************************************************************************
# PLIK KONFIGURACYJNY DLA STRONY WEBOWEJ 
# CREATED BY MACIEJ KOLANKIEWICZ (C) 2007
# *********************************************************************************************
# *********************************************************************************************
# DANE BAZY DANYCH I UZYTKONIKA ADMINISTRUJACEGO NIA
# *********************************************************************************************
	$mysql_login = 'd728b19626b1a627d1782691fd15a1e124327924c1b62371a41362';
	$mysql_password = '082772b137818627b1892602851222351491e124c1222491692302';
	$mysql_db = 'cms5';
	$mysql_host = 'localhost';
# *********************************************************************************************
# DANE DOTYCZACE STRONY WEB I JEJ PARAMETROW
# *********************************************************************************************
	$web_author = 'Maciej Kolankiewicz';
	$web_title = 'CMS 5.0';
	$web_charset = 'utf-8';
	$web_keywords = 'cms, webmasterin, strony www, mechanizm strony';
	$web_description = 'Mechanizm nowej wersji CMS 5.0';
# *********************************************************************************************
# DANE DLA FACEBOOKA
# *********************************************************************************************
	$face_dns = 'http://fototechnik.pl';
# *********************************************************************************************************************************************
# WARTOSC ILOSCI ARTYKULOW NA STRON ZWIAZANA ZE SKRYPTAMI JQUERY I ICH GENEROWANIEM PRZEZ PHP
# *********************************************************************************************************************************************
	$ilelement =4;
# *********************************************************************************************
# WLACZENIE WIZUALIZACJI ZMIENNYCH DLA TESTOW
# *********************************************************************************************
	$viewTest = false;
# *********************************************************************************************
# KLUCZ SZYFRUJACY. DLA FUNKCJI DESRIPT I UNDESCRIPT
# *********************************************************************************************
	$key = 'a1b2c3d4e5f6a1b2c3d4e5f6a1';
# *********************************************************************************************
# CZAS W SEKUNDACH PO JAKIM SESJA SIE ZAKONCZY
# *********************************************************************************************
	$sessionTime = 1440;
# *********************************************************************************************
# PARAMETRY BANNERA
# JESLI JAKIS ELEMENT JEST NIEOBECNY WPISZ WARTOSC BOLEAN FALSE
# *********************************************************************************************
	$bannerName = 'banner.swf';
	$bannerPosytion = 'images/flash/';
	$bannerColor = '#000000';
	$bannerWidth = 990;
	$bannerHigth = 510;
	$bannerBackground = 'images/background/adminbannertlo.jpg';
	$bannerBackgroundL = 'images/background/adminbannertlolewy.jpg';
	$bannerBackgroundR = 'images/background/adminbannertloprawy.jpg';
# *********************************************************************************************
# USTAWIENIA POL UZYTKOWNIKOW
# USTAWIENIE TO SPOWODUJE WLACZENIE LUB WYLACZENIE OKRESLONYCH POL PRZY REJESTRACJI UZYTKOWNIKOW
# PRZYPISANIE 1 OZNACZA WLACZENIE DANEGO POLA, ZAS JEGO WYLACZENIE POWODUJE ZE BEDZIE ONO
# WYLACZONE I W BAZIE DANYCH BEDZIE ZAPISYWANE JAKO NULL. WPISANIE 2 OZNACZA TO SAMO TYLKO
# DANE POLE BEDZIE WYMAGANE.
# *********************************************************************************************
	$usersFileds = array(
	'login'=>2,
	'haslo'=>2,
	'haslo1'=>2,
	'haslo2'=>2,
	'imie'=>1,
	'nazwisko'=>1,
	'email'=>2,
	'gg'=>1,
	'skype'=>1,
	'www'=>1,
	'plec'=>1,
	'adres'=>1,
	'miasto'=>1,
	'wojewodztwo'=>1,
	'kod'=>1,
	'nrdomu'=>1,
	'nrmieszkania'=>1,
	'pesel'=>1,
	'nip'=>1,
	'firma'=>1,
	'nrkonta'=>1,
	'dataurodzenia'=>1,
	'telkom'=>1,
	'telefon'=>1,
	'opis'=>1,
	'emailsend'=>1	
	);
# *********************************************************************************************
# USTAWIENIA UPLOADU
# *********************************************************************************************
	$uploadImageSize = 700;
	$uploadMiniaSize = 150;
	$uploadIconsSize = 90;
# *********************************************************************************************
?>