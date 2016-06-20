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
	if(!TableExists("geo_miasta"))
		{
		$query = "
		CREATE TABLE IF NOT EXISTS `geo_miasta` (
		  `id` int(11) NOT NULL DEFAULT '0',
		  `miejscowosc` varchar(30) COLLATE utf8_polish_ci NOT NULL,
		  `woj` varchar(3) COLLATE utf8_polish_ci NOT NULL,
		  `pow` varchar(3) COLLATE utf8_polish_ci NOT NULL,
		  `gmi` varchar(3) COLLATE utf8_polish_ci NOT NULL,
		  `rodz` varchar(3) COLLATE utf8_polish_ci NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;";
		if(!mysql_query($query) or die (mysql_error()))
		  msgViewTest('<b>ERROR [11]</b> - USERS : ',"Proces kreowania tabeli USERS w DB zatrzymany",$viewTest); 
		else
		  msgViewTest('<b>USERS</b> : ',"Proces tworzenia tabeli USERS zakonczyl sie pozytywnie",$viewTest); 
		}
# *************************************************************************************************************************
	