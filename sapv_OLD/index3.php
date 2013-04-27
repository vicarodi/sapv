<? session_start();
include ("includes/conectar.php");
?>
<html>
<head>
<title>..::<?=$nombreSistema?>::..</title>
<link rel="stylesheet" href="css/estilo.css" type="text/css">
<link rel="stylesheet" href="css/blitzer/jquery-ui-1.7.2.custom.css" type="text/css">
<script type='text/javascript' src='js/jquery.js'></script>
<script type='text/javascript' src='js/jquery.droppy.js'></script>
<link rel="stylesheet" href="css/droppy.css" type="text/css" />
<script type='text/javascript' src='js/thickbox.js'></script>
<link rel="stylesheet" href="css/thickbox.css" type="text/css" />
<script type="text/javascript" src="js/jquery-ui-1.7.2.custom.js"></script>
<script type='text/javascript' src='js/bsn.AutoSuggest_c_2.0.js'></script>
<link rel="stylesheet" href="css/autosuggest_inquisitor.css" type="text/css" />
<link rel="stylesheet" href="css/sugest.css" type="text/css" />
<script type='text/javascript' src='js/jquery.maskedinput-1.2.2.js'></script>
<script type='text/javascript' src='js/funcionesvarias.js'></script>
<script src="js/jquery.uniform.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/uniform.default.css" type="text/css" media="screen" charset="utf-8" />
<script type='text/javascript' src='js/jquery.dataTables.js'></script>
<script type='text/javascript' src='js/jqueryEspanol.js'></script>
<style type="text/css" title="currentStyle">
			@import "css/jquery.dataTables_themeroller.css";

		</style>
<script>
$(document).ready(function(){
 $("input[type='text'], input[type='password'], input[type='checkbox'], input[type='radio'], input[type='file'], textarea").uniform(); 
 $("input[type='submit'], input[type='button']").button();

});

</script>
</head>

<body>
<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%">

	<tr>
		<td valign="top">
			<table border="0" cellspacing="0" cellpadding="0" height="100%" width="100%" class="contenido" align="center">
				<tr>

					<td align="center" valign="top">
<br>
					 <?
					 if (!isset($_SESSION['usuario_id'])){
					 	include("login.php");
					 }else{
					 	 if(isset($_GET['doc'])){
					 			include($_GET['doc'].'.php');
						 }
					 }

					 ?>

					</td>

			</table>
		</td>

	</tr>
		<tr>
		<td colspan="2" id="mensaje21"></td>
	</tr>
</table>
</body>
</html>

