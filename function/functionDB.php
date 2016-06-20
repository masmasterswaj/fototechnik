<?php
# *********************************************************************************************
# SPRAWDZENIE CZY TABELA ISTNIEJE W MySQL
# *********************************************************************************************
	function TableExists($table)
		{
		$m_dsResult = mysql_query('SHOW TABLES LIKE \''.$table.'\'');
		if ($m_dsResult != NULL)
			{
			if (($m_dsResult && mysql_num_rows($m_dsResult))==1)
				{
				$wynik = true;
				msgViewTest('Tabela '.$table.': ',"Tabela istnieje");
			}else{
				$wynik = false;
				msgViewTest('Tabela '.$table.': ',"Tabela nie istnieje"); 
				}
			}
			return $wynik;
		}	
# *********************************************************************************************
?>