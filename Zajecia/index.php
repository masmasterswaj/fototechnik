<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Dodawanie i zarządzanie użytkownikami</title>
	<style>
		body{
			margin:0px;
			font-family:Verdana, Geneva, sans-serif;
			font-size:14px;
			color:#0d263d;
		}
		#glbanner {
			width:100%;
			height:398px;
			marin:0px auto;
			background-image:url(image/tlobanner.jpg);
			#background-repeat:repeat-x;
		}
		#banner {
			width:1000px;
			height:398px;
			background-image:url(image/banner.jpg);
			margin:0px auto;
		}
		#pasek {
			width:100%;
			height:50px;
			marin:0px auto;
			background-image:-webkit-linear-gradient(top,#8bbae7,#5e9dd7);
			background-image:-o-linear-gradient(top,#8bbae7,#5e9dd7);
			background-image:-moz-linear-gradient(top,#8bbae7,#5e9dd7);
			background-image:linear-gradient(top,#8bbae7,#5e9dd7);
			border-bottom:1px solid #3970a2;
			border-top:1px solid #3970a2;
		}
		#menu {
			width:1000px;
			height:50px;
			margin:0px auto;
			border-left:1px dotted #3970a2;
		}
		.elmenu{
			width:auto;
			padding: 0px 30px 0px 30px;
			line-height:50px;
			font-family:Verdana, Geneva, sans-serif;
			font-size:14px;
			color:#0d263d;
			border-right:1px dotted #3970a2;
			float:left;
		}	
		
		.elmenu:hover {
			width:auto;
			padding: 0px 30px 0px 30px;
			line-height:50px;
			font-family:Verdana, Geneva, sans-serif;
			font-size:14px;
			color:#fff;
			border-right:1px dotted #3970a2;
			float:left;
			background-color:#1b4062;
		}	
		#tresc{
			width:898px;
			height:auto;
			min-height:300px;
			margin:0px auto;
			border:1px solid #b8c7e3;
			background-image:-webkit-linear-gradient(top,#fafcff,#b8c7e3);
			background-image:-o-linear-gradient(top,#fafcff,#b8c7e3);
			background-image:-moz-linear-gradient(top,#fafcff,#b8c7e3);
			background-image:linear-gradient(top,#fafcff,#b8c7e3);
			padding:50px;
		}
		#tabela {
			background:#e2ecff;
			border:1px solid #b8c7e3;
		}
		#tabela td {
			background:#e2ecff;
			border:1px solid #b8c7e3;
			text-align:center;
			font-family:Verdana, Geneva, sans-serif;
			font-size:14px;
			color:#0d263d;
			height:30px;
			line-height:30px;
		}
		.skasuj a {
			text-decoration:none;
			color:#C00;
		}
		.skasuj a:hover {
			text-decoration:none;
			color:#C00;
			font-weight:bold;
		}
		#formularz {
			width:800px;
		}
		#formularz label{
			width:200px;
			padding:10px;
		}
		#formularz input{
			width:300px;
			margin:10px;
			background-color:#5e9dd7;
		}
		
	</style>

</head>

<body>
	<div id="glbanner">
    	<div id="banner">
        	
        </div>
    </div>
    <div id="pasek">
    	<div id="menu">
        	<a href="#">
            	<div class="elmenu">
                	Home
                </div>
            </a>
            <a href="#">
            	<div class="elmenu">
                	Użytkownicy
                </div>
            </a>
             <a href="#">
            	<div class="elmenu">
                	Formularz
                </div>
            </a>
        </div>
    </div>
    <div id="tresc">
    	<table width="900" border="0" cellspacing="0" cellpadding="0" id="tabela">
          <tr id="tr">
            <td width="60"><strong>id</strong></td>
            <td width="120"><strong>imię</strong></td>
            <td width="150"><strong>nazwisko</strong></td>
            <td width="170"><strong>login</strong></td>
            <td width="300"><strong>email</strong></td>
            <td width="100"><strong>usuwanie</strong></td>
          </tr>
          <tr>
            <td>1</td>
            <td>Robert</td>
            <td>Kowalski</td>
            <td>rkowalski</td>
            <td>rkowalski@wp.pl</td>
            <td><span class="skasuj"><a href="#">skasuj</a></span></td>
          </tr>
          <tr>
            <td>2</td>
            <td>Adrian</td>
            <td>Gruby</td>
            <td>agruby</td>
            <td>gruby.adrian@gmail.com</td>
            <td><span class="skasuj"><a href="#">skasuj</a></span></td>
          </tr>
          <tr>
            <td>3</td>
            <td>Damian</td>
            <td>Nosowski</td>
            <td>dnosowski</td>
            <td>nosowski@one.pl</td>
            <td><span class="skasuj"><a href="#">skasuj</a></span></td>
          </tr>
          <tr>
            <td>4</td>
            <td>Anna</td>
            <td>Nosowska</td>
            <td>anosowska</td>
            <td>nosowska.a@gmail.com</td>
            <td><span class="skasuj"><a href="#">skasuj</a></span></td>
          </tr>
        </table>
        
        <br />
        <br />
        <div id="formularz">
        	<label><input type="text" name="login" /> Login</label>
             <br />
            <label><input type="password" name="haslo1" /> Hasło</label>
            <br />
            <label><input type="password" name="haslo2" /> Potwierdź hasło</label>
             <br />
            <label><input type="text" name="imie" /> Imię</label>
             <br />
            <label><input type="text" name="nazwisko" /> Nazwisko</label>
             <br />
            <label><input type="text" name="email" /> Email</label>
             <br />
            <input type="submit" name="wyslij" value="Zarejestruj" style="width:100px;" />
        </div>
 
    </div>
    
</body>
</html>