<?php
# *********************************************************************************************
# FUNKCJA SPRAWDZAJACA CZY EMAIL JEST POPRAWNY.
# CREATED BY MACIEJ KOLANKIEWICZ (C) 2011
# *********************************************************************************************
	/*
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
	*/
# *********************************************************************************************
# FUNKCJA AUTOMATYCZNEGO PRZELACZENIA NA STRONE
# *********************************************************************************************
	function reload($link, $time)
		{
		echo '
		<script type="text/javascript">
			function reload()
				{
				window.location.replace("'.$link.'");
				}
			window.setTimeout("reload()", '.$time.'*1000)
		</script>';
		}
# *********************************************************************************************
# FUNKCJE OBSLUGI SMTP I WIADOMOSCI MAIL
# *********************************************************************************************
	function send_mail($host_mail,$user_mail,$password_mail,$from_mail,
			$name_mail,$adres_mail,$adres_name,$temat,$body,$altbody,$path_file)
		{
		require($path_file."class/phpmailer/class.phpmailer.php");
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->Host = $host_mail;
		$mail->SMTPAuth = true;
		$mail->Username = $user_mail;
		$mail->Password = $password_mail;
		$mail->From = $from_mail;
		$mail->FromName = $name_mail;
		$mail->AddAddress($adres_mail, $adres_name);
		$mail->WordWrap = 50;
		$mail->AddAttachment("/var/tmp/file.tar.gz");
		$mail->AddAttachment("/tmp/image.jpg", "new.jpg");
		$mail->IsHTML(true);
		$mail->Subject = $temat;
		$mail->Body    = $body;
		$mail->AltBody = $altbody;
		if(!$mail->Send()) return(false); else return(true);
		}
# *********************************************************************************************
# FUNKCJA IDENTYFIKUJACA PRZEGLADARKE
# *********************************************************************************************
	function user_browser() 
		{
		if(eregi("(opera)([0-9]{1,2}.[0-9]{1,3}){0,1}",
			$_SERVER['HTTP_USER_AGENT'],$st_regs) || 
			eregi("(opera/)([0-9]{1,2}.[0-9]{1,3}){0,1}",
			$_SERVER['HTTP_USER_AGENT'],$st_regs))
			{
			$st_browser = "Opera $st_regs[2]"; 
			} 
		elseif(eregi("(konqueror)/([0-9]{1,2}.[0-9]{1,3})",
			$_SERVER['HTTP_USER_AGENT'],$st_regs))
			{ 
			$st_browser = "Konqueror $st_regs[2]"; 
			} 
		elseif(eregi("(lynx)/([0-9]{1,2}.[0-9]{1,2}.[0-9]{1,2})",
			$_SERVER['HTTP_USER_AGENT'],$st_regs))
			{ 
			$st_browser = "Lynx $st_regs[2]"; 
			} 
		elseif( eregi("(links)\(([0-9]{1,2}.[0-9]{1,3})",
			$_SERVER['HTTP_USER_AGENT'],$st_regs))
			{ 
			$st_browser = "Links $st_regs[2]"; 
			} 
		elseif(eregi("(msie) ([0-9]{1,2}.[0-9]{1,3})",
			$_SERVER['HTTP_USER_AGENT'],$st_regs))
			{ 
			$st_browser = "Microsoft Internet Explorer $st_regs[2]"; 
			} 
		elseif(eregi("(netscape6)/(6.[0-9]{1,3})",
			$_SERVER['HTTP_USER_AGENT'],$st_regs))
			{ 
			$st_browser = "Netscape $st_regs[2]"; 
			} 
		elseif(eregi("mozilla/5",$_SERVER['HTTP_USER_AGENT']))
			{ 
			$st_browser = "Netscape"; 
			} 
		elseif(eregi("(mozilla)/([0-9]{1,2}.[0-9]{1,3})",
			$_SERVER['HTTP_USER_AGENT'],$st_regs))
			{ 
			$st_browser = "Netscape $st_regs[2]"; 
			} 
		elseif(eregi("w3m",$_SERVER['HTTP_USER_AGENT']))
			{ 
			$st_browser = "w3m"; 
			} 
		else{$st_browser = "BRAK DANYCH";} 
		return($st_browser);
		}
# *********************************************************************************************
?>