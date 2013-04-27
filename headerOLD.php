<? session_start();
require_once("conectar.php");
require_once("sapv/includes/funciones.php");
?>
<html>
<head>
<title>Alquiler de Apartamento en Miami | Apartamento de Lujo en Miami | Vacaciones de Lujo | rentingflorida.net</title>
<meta http-equiv="Content-Language" content="en-us">
<meta name="Keywords" content="Apartamento en Miami, Apartamento en Doral, Alquiler de apartamento en Miami, Vacaciones en Miami, rentingflorida.net">
<meta name="Description" content="Como una alternativa a los hoteles, este acogedor y lujoso apartamento en Miami se ofrece al público con un excelente precio, rentingflorida.net">
<meta name="Robots" content="index, follow">
<meta http-equiv="Revisit-After" content="14 days">
<meta name="Author" content="Apartamento de Lujo en Miami - Alquiler de apartamento en Miami - rentingflorida.net">
<meta name="Copyright" content="Apartamento de Lujo en Miami - Alquiler de apartamento en Miami - rentingflorida.net">
<meta name="Distribution" content="Global">
<meta name="Rating" content="General">
<meta name="Generator" content="Apartamento de Lujo en Miami - Alquiler de apartamento en Miami - rentingflorida.net">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252"/>
<style>
body{
/*Remove below line to make bgimage NOT fixed*/
background-attachment:fixed;
background-repeat: no-repeat;
/*Use center center in place of 300 200 to center bg image*/
background-position: center center;
}
</style>

<script language="JavaScript1.2">

//Background Image Slideshow- © Dynamic Drive (www.dynamicdrive.com)
//For full source code, 100's more DHTML scripts, and TOS,
//visit http://www.dynamicdrive.com

//Specify background images to slide
var bgslides=new Array()
bgslides[0]="images/back1.jpg"
bgslides[1]="images/back2.jpg"
bgslides[2]="images/back3.jpg"

//Specify interval between slide (in miliseconds)
var speed=5000

//preload images
var processed=new Array()
for (i=0;i<bgslides.length;i++){
processed[i]=new Image()
processed[i].src=bgslides[i]
}

var inc=-1

function slideback(){
if (inc<bgslides.length-1)
inc++
else
inc=0
document.body.background=processed[inc].src
}

if (document.all||document.getElementById)
window.onload=new Function('setInterval("slideback()",speed)')

</script>
<link rel="stylesheet" href="http://www.rentingflorida.net/css/lightbox.css" type="text/css" media="screen" />
<script type="text/javascript" src="http://www.rentingflorida.net/js/lightbox.js"></script>
<script type='text/javascript' src='sapv/js/jquery.js'></script>
<script src="sapv/js/jquery.uniform.js" type="text/javascript"></script>
<link rel="stylesheet" href="sapv/css/uniform.default.css" type="text/css" media="screen" charset="utf-8" />
<link rel="stylesheet" href="sapv/css/blitzer/jquery-ui-1.7.2.custom.css" type="text/css">
<script type="text/javascript" src="sapv/js/jquery-ui-1.7.2.custom.js"></script>
<script type='text/javascript' src='sapv/js/jqueryEspanol.js'></script>
<script type='text/javascript' src='js/bxGallery/jquery.bxGallery.1.1.min.js'></script>
<script>
$(document).ready(function(){
 $("input[type='text'], input[type='password'], input[type='checkbox'], input[type='radio'], input[type='file'], textarea").uniform(); 
 
  $("#llegada").datepicker({
    constrainInput: true,
    minDate:"+3D",
    maxDate: "+1Y",
    onClose: function( selectedDate ) {
        $("#salida").datepicker( "option", "minDate", selectedDate );
   }
    });
    $("#salida").datepicker({
    constrainInput: true,
    minDate:"+3D",
    maxDate: "+1Y"
    });
 $(".calendarios").datepicker( $.datepicker.regional[ "es" ] );

 });

</script>
<style>

select{
  background: #fbfbfb;
  border-top: solid 1px #aaa;
  border-left: solid 1px #aaa;
  border-bottom: solid 1px #ccc;
  border-right: solid 1px #ccc;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  padding: 1px;
}
html{
font-size:12px;
}
  body {
font-size:12px;

	}
</style>
</head>

<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_ES/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<table border="0" width="100%" cellspacing="0" cellpadding="0" height="100%">
	<tr>
		<td align="center" valign="top">
		<table border="0" width="1000" cellspacing="0" cellpadding="0" height="100%">
			<tr>
				<td align="left" valign="top">
				<table border="0" width="100%" cellspacing="0" cellpadding="0">
					<tr>
						<td background="index_02_02.png" height="192" align="left" valign="top">
						<table border="0" width="100%" cellspacing="0" cellpadding="0">
							<tr>
								<td>
								<table border="0" width="100%" cellspacing="0" cellpadding="0">
									<tr>
										<td width="173">
										<p align="right" style="margin-right: 10px">
										<font face="Arial" style="font-size: 8pt; font-weight: 700">
										English - Español</font></td>
										<td width="159">
								<a href="https://twitter.com/rentingflorida" class="twitter-follow-button" data-show-count="false" data-lang="es">Seguir a @rentingflorida</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></td>
										<td>
								       <div class="fb-like" data-href="http://www.facebook.com/rentingflorida" data-send="true" data-layout="button_count" data-width="450" data-show-faces="false"></div></td>
										<td>
								<p align="right" style="margin-right: 10px">
								<font face="Arial" size="5" color="#FFFF00">Sin 
								utilizar tu cupo Cadivi</font></td>
									</tr>
								</table>
								</td>
							</tr>
							<tr>
								<td>
								<p align="right" style="margin-right: 10px"><b>
								<font face="Arial" size="5">Apartamento en Doral
								</font></b></td>
							</tr>
							<tr>
								<td>
								<p align="right" style="margin-right: 10px"><b>
								<font face="Arial" style="font-size: 11pt">con 
								capacidad para 8 personas</font></b></td>
							</tr>
							<tr>
								<td>
								<p align="right" style="margin-right: 10px">
								<font face="Arial" size="5">
								<a href="mailto:info@rentingflorida.net">doral.renting@gmail.com</a></font></td>
							</tr>
							<tr>
								<td>
								<p align="right" style="margin-right: 10px">
								<font face="Arial" size="5">0414.455.64.61</font></td>
							</tr>
							<tr>
								<td></td>
							</tr>
							<tr>
								<td>
								<p align="right" style="margin-right: 10px">
								<font face="Arial" size="5">$130 por noche</font></td>
							</tr>
							<tr>
								<td>
								<p align="right" style="margin-right: 10px"><b>
								<font style="font-size: 11pt" face="Arial">
								Reserve con solo el 10%</font></b></td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td bgcolor="#FFFFFF" height="90">
						<table border="0" width="100%" cellspacing="0" cellpadding="0" height="100%">
							<tr>
								<td>&nbsp;</td>
								<td align="center">
		
<a href="images/big/1.jpg" rel="lightbox" title="Comedor">
		<img src="images/little/1.jpg" hspace="0" border="0" /></a></td>
								<td align="center">&nbsp;</td>
								<td align="center"><a href="images/big/2.jpg" rel="lightbox" title="Cocina">
		<img src="images/little/2.jpg" hspace="0" border="0" width="80" height="60" /></a></td>
								<td align="center">&nbsp;</td>
								<td align="center"><a href="images/big/3.jpg"  rel="lightbox" title="Cocina">
		<img src="images/little/3.jpg" hspace="0" border="0" width="80" height="60" /></a></td>
								<td align="center">&nbsp;</td>
								<td align="center"><a href="images/big/4.jpg"  rel="lightbox" title="Sala">
		<img src="images/little/4.jpg" hspace="0" border="0" width="80" height="60" /></a></td>
								<td align="center">&nbsp;</td>
								<td align="center"><a href="images/big/5.jpg"  rel="lightbox" title="Comedor">
		<img src="images/little/5.jpg" hspace="0" border="0" width="80" height="60" /></a></td>
								<td align="center">&nbsp;</td>
								<td align="center"><a href="images/big/6.jpg"  rel="lightbox" title="Habitación">
		<img src="images/little/6.jpg" hspace="0" border="0" width="80" height="60" /></a></td>
								<td align="center">&nbsp;</td>
								<td align="center"><a href="images/big/8.jpg"  rel="lightbox" title="Habitación">
		<img src="images/little/8.jpg" hspace="0" border="0" width="80" height="60" /></a></td>
								<td align="center">&nbsp;</td>
								<td align="center"><a href="images/big/9.jpg"  rel="lightbox" title="Habitación">
		<img src="images/little/9.jpg" hspace="0" border="0" width="80" height="60" /></a></td>
								<td align="center">&nbsp;</td>
								<td align="center"><a href="images/big/13.jpg"  rel="lightbox" title="Habitación">
		<img src="images/little/13.jpg" hspace="0" border="0" width="80" height="60" /></a></td>
								<td align="center">&nbsp;</td>
								<td align="center"><a href="images/big/14.jpg"  rel="lightbox" title="Baño">
		<img src="images/little/14.jpg" hspace="0" border="0" width="80" height="60" /></a></td>
								<td align="center">&nbsp;</td>
								<td align="center"><a href="images/big/15.jpg"  rel="lightbox" title="Baño">
		<img src="images/little/15.jpg" hspace="0" border="0" width="80" height="60" /></a></td>
								<td>&nbsp;</td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td height="35" background="backwh.png">
						<p align="center" style="margin-left: 10px">
						<font face="Arial" size="5" color="#FF0865">Ahorre 
						enormes cantidades de dinero hospedándose en esta lujosa 
						propiedad.</font></td>
					</tr>
                    <tr>
                    <td bgcolor="#FFFFFF">
                    <table width="100%" cellspacing="0">
                    <tr>
                    <td width="24%" valign="top" style="padding: 5px 20px;background: #fff;">
                    <?
                    include("coitizador.php");
                    ?>
                    </td>