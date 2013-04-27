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
 $("input[type='submit'], input[type='button'], input[type='reset'], a.boton").button();
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

        
<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr><td width="5%">&nbsp;</td>
		<td align="center" valign="top">
        	<table style="background: url(sapv/images/backrepeat.jpg) repeat-x;"  width="100%" height="89" border="0" cellpadding="0" cellspacing="0">
        		<tr>
            		<td align="left" ><img src="sapv/images/logo.png" /></td>
                    <td align="right" style="padding-right: 10px;"><h2 style="text-align: center;"><img align="right" src="sapv/images/headFront.png" /></h2></td>
        		</tr>
                	<tr><td bgcolor="#1D5987" height="30px" width="100%" colspan="2" align="right">	
                    <table style="font-family: Arial;">
                        <tr>
                            <td><a style="color: #fff;text-decoration: none;" href="index.php"><strong>INICIO</strong></a></td>                   
                        </tr>
                    </table>
                    </td></tr>
        	
            </table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0" >
			<tr>
				<td align="left" valign="top" bgcolor="#fbfbfb">
				<table border="0" width="100%" cellspacing="0" cellpadding="0">
					<tr>
                    <td>
                    <table width="100%" cellspacing="0">
                    <tr>
                    <td width="25%" valign="top" style="padding: 5px 10px;">
                    <?
                    include("coitizador.php");
                    ?>
                    </td>