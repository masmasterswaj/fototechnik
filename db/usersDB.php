<?php
# *************************************************************************************************************************
# SKRYPT TESTU BAZY DANYCH UZYTKOWNIKOW
# CREATED BY MACIEJ KOLANKIEWICZ (C) 2012
# *************************************************************************************************************************
# *************************************************************************************************************************
# OBSLUGA BLEDOW
# *************************************************************************************************************************
	ini_set ( 'display_errors' ,  1 ); 
# *************************************************************************************************************************
	if(!TableExists("users"))
		{
		$queryDBUsers = "
		CREATE TABLE  `cms5`.`users` (
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
		`login` VARCHAR( 50 ) NOT NULL ,
		`haslo` VARCHAR( 32 ) NOT NULL ,
		`imie` VARCHAR( 50 ) NOT NULL ,
		`nazwisko` VARCHAR( 50 ) NOT NULL ,
		`email` VARCHAR( 100 ) NOT NULL ,
		`gg` VARCHAR( 20 ) NOT NULL ,
		`skype` VARCHAR( 20 ) NOT NULL ,
		`www` VARCHAR( 200 ) NOT NULL ,
		`plec` VARCHAR( 2 ) NOT NULL ,
		`adres` VARCHAR( 50 ) NOT NULL ,
		`miasto` VARCHAR( 50 ) NOT NULL ,
		`wojewodztwo` VARCHAR( 30 ) NOT NULL ,
		`kod` VARCHAR( 6 ) NOT NULL ,
		`nrdomu` VARCHAR( 10 ) NOT NULL ,
		`nrmieszkania` VARCHAR( 10 ) NOT NULL ,
		`pesel` VARCHAR( 20 ) NOT NULL ,
		`nip` VARCHAR( 20 ) NOT NULL ,
		`firma` VARCHAR( 50 ) NOT NULL ,
		`nrkonta` VARCHAR( 100 ) NOT NULL ,
		`dataurodzenia` VARCHAR( 30 ) NOT NULL ,
		`telkom` VARCHAR( 20 ) NOT NULL ,
		`telefon` VARCHAR( 20 ) NOT NULL ,
		`emailsend` VARCHAR( 2 ) NOT NULL ,
		`avatar` VARCHAR( 50 ) NOT NULL ,
		`opis` TEXT NOT NULL ,
		`active` VARCHAR( 2 ) NOT NULL ,
		`datafirst` VARCHAR( 20 ) NOT NULL ,
		`datalast` VARCHAR( 20 ) NOT NULL
		) ENGINE = INNODB;";
		if(!mysql_query($queryDBUsers) or die (mysql_error()))
		  msgViewTest('<b>ERROR [11]</b> - USERS : ',"Proces kreowania tabeli USERS w DB zatrzymany",$viewTest); 
		else
		  msgViewTest('<b>USERS</b> : ',"Proces tworzenia tabeli USERS zakonczyl sie pozytywnie",$viewTest); 
		}
# *************************************************************************************************************************
	