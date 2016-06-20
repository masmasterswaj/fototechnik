<?php   
# *************************************************************************************************************************
# SKRYPT PRZETWARZANIA AJAX
# *************************************************************************************************************************
?>
<!-- ------ AJAX SCRIPTS --------------------------------------------------------------------------------------------- -->
<script type="text/javascript"> // pierwsza czesc kodu 
var ObiektXMLHttp = false;if(window.XMLHttpRequest){ObiektXMLHttp=new XMLHttpRequest();}else if(window.ActiveXObject) 
{ObiektXMLHttp=new ActiveXObject("Microsoft.XMLHTTP");}function getData(zrodlo,cel){if(ObiektXMLHttp){
var cel=document.getElementById(cel);var loading=document.getElementById('loading');ObiektXMLHttp.open("GET",zrodlo);
ObiektXMLHttp.onreadystatechange=function(){if(ObiektXMLHttp.readyState==4){cel.innerHTML=ObiektXMLHttp.responseText; 
loading.innerHTML="";}} 
ObiektXMLHttp.send(null);}} function ascii_value(c)
{c=c.charAt(0);var i;for(i=0;i<256;++i){var h=i.toString(16);if(h.length==1)h="0"+h;h="%"+h;h=unescape(h);
if(h==c) break;}return i;} function d2h(d) {return d.toString(16);}	function CA(c){var i;var z1,z2,z3,z4;
var b1,c2;b1='';c2='';for(i=0;i<=(c.length-1);i++){z1=c.substr(i,1);z1=ascii_value(z1);//z1 = d2h(z1);
b1=b1+z1+' ';}return b1;}function CS(c){String.prototype.reverse = function(){s=this.split("");
r=s.reverse();r1=r.join("");return r1;}
var i;var z1,z2,z3,z4;var b1,c2;var dl;var kkk='',kk='',k1='',k2='',kkkk;var k=document.getElementById('k').value;
k=k+'';if(k.length<c.length){dl = Math.ceil(c.length / k.length);for (i=1;i<=dl;i++) k=k+k;}b1 = '';c2 = '';
for(i=0;i<=(c.length-1);i++){z1=c.substr(i,1);key1=k.substr(i,1);z1=ascii_value(z1);key1=ascii_value(key1);
z1=z1+key1;z1=d2h(z1);z2=Math.floor(Math.random()*99);z3=Math.floor(Math.random()*10);z4=Math.floor(Math.random()*10);
z2 = z2+'';z3 = z3+'';z4 = z4+'';z1=z1+'';if(z2.length==1)z2='0'+z2;b1=b1+z1+z2;}b1=z3+k1+b1+k2+z4;
for(i=0;i<=(b1.length-1);i=i+2){z1=b1.substr(i,2);z1=z1.reverse();c2=c2+z1;}return(c2);}function sendValue(c){
var w=document.getElementById(c).value;return(w);}   
</script> 
<?php
# *************************************************************************************************************************
?>