<?php
# *********************************************************************************************
# FUNKCJA SPRAWDZAJACA CZY EMAIL JEST POPRAWNY.
# CREATED BY MACIEJ KOLANKIEWICZ (C) 2011
# *********************************************************************************************
	function check_email_address($email) {
	  if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
		return false;
	  }
	  $email_array = explode("@", $email);
	  $local_array = explode(".", $email_array[0]);
	  for ($i = 0; $i < sizeof($local_array); $i++) {
		if(!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]".
				 "{0,63})|(\"[^(\\|\")]{0,62}\"))$",$local_array[$i])) 
		{
		  return false;
		}
	  }
	  if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) {
		$domain_array = explode(".", $email_array[1]);
		if (sizeof($domain_array) < 2) 
		{
			return false;
		}
	  for ($i = 0; $i < sizeof($domain_array); $i++) 
		{
		  if(!ereg("^(([A-Za-z0-9][A-Za-z0-9\._-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$",$domain_array[$i])) 
		  {
			return false;
		  }
		}
	  }
	  return true;
	}

	function check_email ($email)
	{
	if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email) and 
	check_email_address($email))
		return true;
	else
		return false;
	}
	
	echo md5('qwerty')."<br>";
	echo time()."<br>";
	echo date("Y-m-d H:i:s", time())."<br>";
	echo date("Y-m-d H:i:s", 1297439170)."<br>";
	echo date("Y-m-d H:i:s", 1265893200)."<br>";
# *********************************************************************************************
?>