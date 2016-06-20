<html>
<head>
<script type="text/javascript">
var roz = new Date().getTime()-(<?php echo date(U); ?>*1000);

function zegar(){
	miesiace= new Array ('Stycznia', 'Lutego', 'Marca', 'Kwietnia', 'Maja', 'Czerwca', 'Lipca', 'Sierpnia', 'Września', 'Października', 'Listopada', 'Grudnia')
	D = new Date();
	D.setTime(D.getTime()-roz);
	G = D.getHours();
	M = D.getMinutes(); M=M<10?'0'+M:M;
	S = D.getSeconds(); S=S<10?'0'+S:S;
	r = D.getFullYear();
	m = miesiace[D.getMonth()];
	d = D.getDate();
	
	document.getElementById('czas').innerHTML=' '+ G + ':' + M + ':' + S;
	document.getElementById('data').innerHTML=' '+ d + ' ' + m + ' ' + r + ' ' + 'roku';
	setTimeout('zegar()', 1000);
}
 window.onload = function(e){
    document.getElementById('link2').onclick = function(e){
      e.target.setAttribute('class', e.target.getAttribute('class') == 'klasa2'?'klasa1':'klasa2');
    }
    document.getElementById('przycisk').click();
  }
  
</script>
</head>
<body>
Następnie gdzieś  body:
Listing
Dziś jest <span id="data"></span><br>
Godzina <span id="czas"></span>
<script type="text/javascript">
zegar();

</script>
<br />
<br />
<br />
<br />
<style>
	#menu {
		width:1000px;
		height:45px;
		margin:0px auto;
	}
	#menu-l {
		width:49px;
		height:45px;
		background-image:url(menul.png);
		float:left;
	}
	#menu-s {
		width:903px;
		height:45px;
		background-image:url(menus.png);	
		float:left;
	}
	#menu-r {
		width:48px;
		height:45px;
		background-image:url(menur.png);
		float:left;
	}
	#menuel {
		padding:0px 20px 0px 20px;
		height:45px;
		background-image:url(menur.png);
		float:left;	
	}
	div.link
	{
		background: url(rollduble.png) no-repeat;
		display:block;
		height:45px;
		overflow:hidden;
		width:100px;
		float:left;
		text-align:center;
		color:#fff;
		font-weight:bold;
		font-family:Verdana, Geneva, sans-serif;
		font-size:14px;
	}
	div.link:hover
	{
		background-position: 0px -45px;
	}
	div.link span
	{
		display:block;
		text-indent: -9999px;
	}
	*:hover {
		-moz-transition: 0.3s linear;
  		-webkit-transition: 0.3s linear;
	}
	* div.link{
		-moz-transition: 0.3s linear;
  		-webkit-transition: 0.3s linear;
	}
	
	.klasa1 {
		width:118px;
		height:45px;
		background-image:url(rollout.png);
		text-align:center;
		color:#fff;
		font-weight:bold;
		font-family:Verdana, Geneva, sans-serif;
		font-size:14px;
		float:left;
		line-height:45px;
	}
	.klasa2 {
		width:118px;
		height:45px;
		background-image:url(rollin.png);
		float:left;
		text-align:center;
		color:#fff;
		font-weight:bold;
		font-family:Verdana, Geneva, sans-serif;
		font-size:14px;
		float:left;
		line-height:45px;
	}
	
	
</style>
<div id="menu">
	<div id="menu-l">
    </div>
    <div id="menu-s">
    	<div class="link"
        onMouseOver="document.getElementById('el1').src='rollin.png'" 
        onMouseOut="document.getElementById('el1').src='rollout.png'">
        Nazwa
        <img src="rollout.png" id="el1" border="0">
        
        </div>
        <div class="link">
        	Nazwa
        </div>
        <div id="link2" class="klasa1">
		 	Nazwa	
        </div>
    </div>
    <div id="menu-r">
    </div>
</div>
<br />
<br />
<br />
<br />
<br />
<br />



<button id="przycisk">Kliknij mnie!</button>

</body>


</html>













