<?php
# *********************************************************************************************
# SKRYPT SESJI UZYTKOWNIKA
# CREATED BY MACIEJ KOLANKIEWICZ (C) 2010
# *********************************************************************************************
# *********************************************************************************************
# funkcja wyswietlajaca informacje.
# *********************************************************************************************
	ini_set( 'display_errors', 'On' ); 
	error_reporting( E_ALL );
# *********************************************************************************************
# ZNAJDOWANIE UNIWERSALEJ SCIEZKI DOSTEPU DO PLIKU ORAZ OKRESLANIE JEGO LOKALIZACJI
# *********************************************************************************************
	$lokalizator = 0;$path_file = "";clearstatcache();
	$name_file = substr($_SERVER['PHP_SELF'],strpos(strrev($_SERVER['PHP_SELF']),'/',0)*(-1));
	while(!file_exists($path_file."path.php")){$path_file = "";
	for($q=0; $q <=(substr_count($_SERVER['PHP_SELF'], "/"))-$lokalizator; $q++)
	$path_file = $path_file."../";$lokalizator++;}
# *********************************************************************************************
# MODOL WYKLUCZANY PO URUCHOMIENIU DLA ULATWIENIA GENEROWANIA HTML
# *********************************************************************************************
	if(true){
    mb_http_input("utf-8"); mb_http_output("utf-8");?>
	<meta http-equiv="Content-Language" content="pl">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href="../../css/styl.css" rel="stylesheet" type="text/css">
	<?php }
# ************************************************************************************************************************
# SPRAWDZENIE CZY TABELA USERS i SESSION ISTNIEJE
# ************************************************************************************************************************
	#include_once($path_file."db/usersDB.php");
	#include_once($path_file."db/sessionDB.php");
# *********************************************************************************************
# AUTOLOGOWANIE
# *********************************************************************************************
	#$_GET['weblogin'] = "macmaster";
	#$_GET['webhaslo'] = "gscc9zrrn";
	#$_POST['Wyloguj'] = "Wyloguj";
# *********************************************************************************************
# SPRAWDZENIE METODY PRZESLANIA DANYCH GET - POST
# *********************************************************************************************
	if(isset($_GET['weblogin']) and isset($_GET['webhaslo']))
		{
		$_POST['weblogin'] = $_GET['weblogin'];
		$_POST['webhaslo'] = $_GET['webhaslo'];
		}
	if(isset($_GET['Wyloguj']) and $_GET['Wyloguj'] == 'Wyloguj')
		$_POST['Wyloguj'] = $_GET['Wyloguj'];
# WYKRYCIE PROBY PODSTAWIENIA LOGOWANIA UZYTKOWNIKA
# *********************************************************************************************
		if(!isset($_SESSION['sid']) and (isset($_POST['weblogin']) and isset($_POST['webhaslo'])))
			{
			msgViewTest('ERROR [11] - PROBA WLAMANIA : ',"Proces przetwazania zatrzymany",$viewTest);  
			reload($path_file."denied.php",0,2,$path_file);
			break;
			}
# *********************************************************************************************
# WYGENEROWANIE ZMIENNEJ CZASU
# *********************************************************************************************
	function getmicrotime(){ 
    	list($usec, $sec) = explode(" ",microtime()); 
    	return ((float)$usec + (float)$sec); 
    	} 
	$webTime = getmicrotime();
	$webTimeUnix = substr($webTime,0,strpos($webTime,'.'));
	$webTimeMikr = substr($webTime,strpos($webTime,'.')+1);
	$webTime = @date("Y:m:d H:i:s",$webTimeUnix).":".$webTimeMikr;
	msgViewTest('Czas: ',$webTime,$viewTest);
	msgViewTest('Czas UNIX: ',time(),$viewTest);
# *********************************************************************************************
# SPRAWDZENIE CZY SESJA NIE WYGASLA. 
# *********************************************************************************************
# USUNIĘCIE SESJI JESLI PRZEKROCZONY CZAS SESJI ***********************************************
	$changeSid = false;
	msgViewTest('Czas sessionTime: ',$sessionTime,$viewTest);
	if (!isset($_SESSION['EXPIRES'])) $_SESSION['EXPIRES'] = time() + $sessionTime;
	msgViewTest('Koniec sesji za [sek]:',time() - $_SESSION['EXPIRES'],$viewTest);
	if ($_SESSION['EXPIRES'] < time()) 
		{
    	session_destroy();
    	$_SESSION = array();
		$changeSid = true;
		}
# USUNIĘCIE SESJI JESLI WCISNIETY WYLOGUJ ******************************************************
	if(isset($_POST['Wyloguj']) and $_POST['Wyloguj'] == "Wyloguj" )
		{
		$query = "DELETE FROM session WHERE id='".$_SESSION['sid']."'";
		$ansquery = mysql_query($query)
				   or die (msgViewTest('[SESSION][0]: ERROR DELETE SESSION<br>',mysql_error(),$viewTest));
		if($ansquery and $viewTest) msgViewTest('Zakończenie sesji z DB:',mysql_affected_rows(),$viewTest);
		session_destroy();
    	$_SESSION = array();
		$changeSid = true;
		}
	if($changeSid) @session_start(); 
	$_SESSION['EXPIRES'] = time() + $sessionTime;
# *********************************************************************************************
# *********************************************************************************************
# WYGENEROWANIE SESJI SID
# *********************************************************************************************
# USTALENIE ADRESU HOSTA I ADRESU IP **********************************************************
		$remoteDomain = @getHostByAddr($_SERVER["REMOTE_ADDR"]);
		if (!isset($remoteDomain) or $remoteDomain == '') $remoteDomain = 'Lokalny Host';
		if($_SERVER["REMOTE_ADDR"]=='::1') 
			$remoteIp="127.0.0.1"; 
		else 
			$remoteIp=$_SERVER["REMOTE_ADDR"];
# WYGENEROWANIE IDENTYFIKATORA SID ************************************************************
	if(!isset($_SESSION['sid'])) 
		{
		$_SESSION['sid'] = md5($webTime.$remoteIp.$remoteDomain.rand());
# *********************************************************************************************
# ZAPISANIE NOWEJ SESJI DO DB
# *********************************************************************************************
		$query = "INSERT INTO session (id,user,datacreate,dataend,datalast,status,ip,host) 
				  VALUES (
				  '".$_SESSION['sid']."',
				  '1',
				  '".time()."',
				  '".(time()+$sessionTime)."',
				  '".time()."',
				  '1',
				  '".$remoteIp."',
				  '".$remoteDomain."')";
		$ansquery = mysql_query($query)
				   or die (msgViewTest('[SESSION][1]: ERROR INSERT SESSION<br>',mysql_error(),$viewTest));
		if($ansquery and $viewTest) msgViewTest('Dodanie sesji do DB:',"Powiodlo sie",$viewTest);
# *********************************************************************************************
# WYKASOWANIE NIEAKTYWNYCH SESJI.
# *********************************************************************************************
		$query = "DELETE FROM session WHERE dataend < '".time()."'";
		$ansquery = mysql_query($query)
				   or die (msgViewTest('[SESSION][2]: ERROR DELETE SESSION<br>',mysql_error(),$viewTest));
		if($ansquery and $viewTest) msgViewTest('Usunięcie sesji z DB:',mysql_affected_rows(),$viewTest);
		}
# *********************************************************************************************
# *********************************************************************************************
# ODCZYTANIE I AKTUALIZACJA DANYCH O UZYTKOWNIKU
# *********************************************************************************************
# ODCZYTANIE SESJI ****************************************************************************
	if(isset($_SESSION['sid'])) 
		{
		$query = "SELECT * FROM session WHERE id='".$_SESSION['sid']."'";
		$ansquery = mysql_query($query)
				   or die (msgViewTest('[SESSION][3]: ERROR READ SESSION<br>',mysql_error(),$viewTest));
		$ansdb = mysql_fetch_array($ansquery);
		$dataCreateSession = $ansdb['datacreate'];
		$dataEndSession = $ansdb['dataend'];
		$userSession = $ansdb['user'];
		$statusSession = $ansdb['status'];
# *********************************************************************************************
# LOGOWANIE - SPRAWDZENIE CZY UZYTKOWNIK JEST W DB
# *********************************************************************************************
		if(isset($_POST['weblogin']) and isset($_POST['webhaslo']) and $statusSession == 1)
			{
			$query = "SELECT * FROM users WHERE 
			 		  login='".$_POST['weblogin']."' and
					  haslo='".(md5($_POST['webhaslo']))."'";
			$ansquery = mysql_query($query)
				   or die (msgViewTest('[SESSION][4]: ERROR READ USER<br>',mysql_error(),2,$viewTest));
			if(mysql_num_rows($ansquery) > 0) {
				$statusSession = 2;
				$userArraySession = mysql_fetch_array($ansquery);
				$userSession = $userArraySession['id'];
				$userLastSession = $userArraySession['datalast'];
				$userLogStatus = $userArraySession['logstatus'];
# USUNIECIE STAREJ SESJI UZYTKOWNIKA NIEZALOGOWANEGO *******************************************
				$query = "DELETE FROM session WHERE id='".$_SESSION['sid']."'";
				$ansquery = mysql_query($query)
				   		or die (msgViewTest('[SESSION][5]: ERROR DELETE SESSION<br>',mysql_error(),$viewTest));
				if($ansquery and $viewTest) msgViewTest('Zmiana sesji w DB:',mysql_affected_rows(),$viewTest);
# WYKASOWANIE STAREJ SESJI *********************************************************************
				@session_destroy();
				$_SESSION = array();
				@session_start(); 
				$_SESSION['EXPIRES'] = time() + $sessionTime;
# WYGENEROWANIE NOWEGO IDENTYFIKATORA SID *****************************************************
				$_SESSION['sid'] = md5($webTime.'CHROME'.$_SERVER['REMOTE_ADDR'].rand());
# ZAPISANIE NOWEJ SESJI DO DB *****************************************************************
				$query = "INSERT INTO session (id,user,datacreate,dataend,datalast,status,ip,host) 
						  VALUES (
						  '".$_SESSION['sid']."',
						  '".$userSession."',
						  '".time()."',
						  '".(time()+$sessionTime)."',
						  '".$userLastSession."',
						  '".$statusSession."',
						  '".$remoteIp."',
						  '".$remoteDomain."')";
				$ansquery = mysql_query($query)
						   or die (msgViewTest('[SESSION][6]: ERROR INSERT SESSION<br>',mysql_error(),$viewTest));
				if($ansquery and $viewTest) msgViewTest('Dodanie sesji DB [CHANGE USER]:',"Powiodlo sie",$viewTest);
# AKTUALIZACJA DANYCH UZYTKOWNIKA *************************************************************
				$query = "UPDATE users SET 
						  datalast='".time()."',
						  logstatus='".($userLogStatus + 1)."' 
						  WHERE id='".$userSession."'";
				$ansquery = mysql_query($query)
						   or die (msgViewTest('[SESSION][7]: ERROR UPDATE USER<br>'.
						   						$query."<br>",mysql_error(),$viewTest));

				}
			}
	msgViewTest('Identyfikator SID: ',$_SESSION['sid'],$viewTest);
# *********************************************************************************************
# WCZYTANIE DANYCH KIEDY UZYTKOWNIK NIE ZALOGOWANY
# *********************************************************************************************
		if($statusSession == 1) {
			$query = "SELECT * FROM users WHERE id='1'";
			$ansquery = mysql_query($query)
				   or die (msgViewTest('[SESSION][8]: ERROR READ USER<br>',mysql_error(),$viewTest));
			$userArraySession = mysql_fetch_array($ansquery);
			$userSession = $userArraySession['id'];
			$infoSession = "Uzytkownik niezalogowany: ".$userArraySession['login']."<br>";
			$infoSession .= "Imię: ".$userArraySession['imie']."<br>";
			$infoSession .= "Nazwisko: ".$userArraySession['nazwisko']."<br>";
			$infoSession .= "Ostatnie logowanie: ".@date("Y:m:d H:i:s",$userArraySession['datalast'])."<br>";
			$infoSession .= "Użytkownik jest po raz: ".$userArraySession['logstatus']."<br>";
			if($ansquery and $viewTest) msgViewTest('Użytkownik:',$infoSession,$viewTest);
			}
		if($statusSession == 2) {
			$query = "SELECT * FROM users WHERE id='".$userSession."'";
			$ansquery = mysql_query($query)
				   or die (msgViewTest('[SESSION][9]: ERROR READ USER<br>',mysql_error(),$viewTest));
			$userArraySession = mysql_fetch_array($ansquery);
			$userSession = $userArraySession['id'];
			$infoSession = "Uzytkownik zalogowany: ".$userArraySession['login']."<br>";
			$infoSession .= "Imię: ".$userArraySession['imie']."<br>";
			$infoSession .= "Nazwisko: ".$userArraySession['nazwisko']."<br>";
			$infoSession .= "Ostatnie logowanie: ".@date("Y:m:d H:i:s",$userArraySession['datalast'])."<br>";
			//$infoSession .= "Użytkownik jest po raz: ".$userArraySession['logstatus']."<br>";
			if($ansquery and $viewTest) msgViewTest('Użytkownik:',$infoSession,$viewTest);
			}
# *********************************************************************************************
# AKTUALIZACJA SESJI
# *********************************************************************************************
		$query = "UPDATE session SET 
				  dataend='".(time()+$sessionTime)."',
				  status='".$statusSession."',
				  user='".$userSession."' 
				  WHERE id='".$_SESSION['sid']."'";
		$ansquery = mysql_query($query)
				   or die (msgViewTest('[SESSION][10]: ERROR UPDATE SESSION<br>',mysql_error(),$viewTest));
		
		$infoSession = "Zakonczylo sie powodzeniem<br>";
		$infoSession .= "start: ".@date("Y:m:d H:i:s",$dataCreateSession)."<br>";
		$infoSession .= "end: ".@date("Y:m:d H:i:s",$dataEndSession)."<br>";
		$infoSession .= "Czas sesji: ".@date("H:i:s",
						 strtotime(@date("H:i:s",$dataEndSession-$sessionTime))-
						 strtotime(@date("H:i:s",$dataCreateSession))-3600)."<br>";
		$infoSession .= "Status sesji: ".$statusSession;
		if($ansquery and $viewTest) msgViewTest('Update sesji w DB:',$infoSession,$viewTest);

		}
# *********************************************************************************************
?>