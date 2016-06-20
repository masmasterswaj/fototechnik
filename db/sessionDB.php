<?php
# *************************************************************************************************************************
# SKRYPT TESTU BAZY DANYCH SESJI
# CREATED BY MACIEJ KOLANKIEWICZ (C) 2012
# *************************************************************************************************************************
# *************************************************************************************************************************
# OBSLUGA BLEDOW
# *************************************************************************************************************************
	ini_set ( 'display_errors' ,  1 ); 
# *************************************************************************************************************************
# SPRAWDZENIE CZY ISTNIEJE BAZA DANYCH
# *************************************************************************************************************************
	if(!TableExists("session"))
		{
		$query = "CREATE TABLE IF NOT EXISTS `users` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `login` varchar(20) NOT NULL,
		  `haslo` varchar(50) NOT NULL,
		  `haslo2` varchar(200) NOT NULL,
		  `imie` varchar(20) NOT NULL,
		  `nazwisko` varchar(30) NOT NULL,
		  `email` varchar(50) NOT NULL,
		  `www` varchar(200) NOT NULL,
		  `telefonk` varchar(20) NOT NULL,
		  `telefon` varchar(20) NOT NULL,
		  `adres` varchar(200) NOT NULL,
		  `miejscowosc` varchar(30) NOT NULL,
		  `kod` varchar(30) NOT NULL,
		  `kontob` varchar(100) NOT NULL,
		  `nip` varchar(20) NOT NULL,
		  `datafirst` varchar(20) NOT NULL,
		  `datalast` varchar(20) NOT NULL,
		  `grupa` varchar(20) NOT NULL,
		  `status` varchar(20) NOT NULL,
		  `logstatus` varchar(20) NOT NULL,
		  `opis` text NOT NULL,
		  `wysmail` varchar(10) NOT NULL,
		  `wysdane` varchar(10) NOT NULL,
		  `gg` varchar(20) NOT NULL,
		  `skype` varchar(20) NOT NULL,
		  `securecod` varchar(100) NOT NULL,
		  `active` varchar(20) NOT NULL,
		  `pozytywy` varchar(20) NOT NULL,
		  `negatywy` varchar(20) NOT NULL,
		  `neutralne` varchar(20) NOT NULL,
		  `logo` varchar(200) NOT NULL,
		  `typkonta` varchar(20) NOT NULL,
		  `ilosctranzakcji` varchar(20) NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3
		";
		#$ask = mysql_query($query) or die (mysql_error());
		if(!mysql_query($query) or die (mysql_error()))
		  msgViewTest('<b>ERROR [11]</b> - SESSION : ',"Proces kreowania zatrzymany",$viewTest); 
		else
		  msgViewTest('<b>SESSION</b> : ',"Proces tworzenia tabeli zakonczyl sie pozytywnie",$viewTest); 
		}
# *************************************************************************************************************************
?>