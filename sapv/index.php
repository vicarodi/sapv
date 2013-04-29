<?session_start();
include ("includes/conectar.php");
if(!file_exists($_GET['doc'].'.php')){
 redireccionador("index.php?doc=principal");
}
?>
<html>
<head>
<meta content="text/html; charset=iso-8859-1" http-equiv="Content-Type" />
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
 $("input[type='submit'], input[type='button'], input[type='reset']").button();

});

</script>
</head>
<body>
<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%">
	<tr>
		<td valign="top" height="56px">
        	<table style="background: url(images/backrepeat.jpg) repeat-x;"  width="100%" height="89" border="0" cellpadding="0" cellspacing="0">
        		<tr>
            		<td align="left" ><img src="images/logo.png" /></td>
                    <td align="right" style="padding-right: 10px;"><h2 style="text-align: center;"><img align="right" src="images/nombre.png" /></h2></td>
        		</tr>
        		<tr><td bgcolor="<?=$colorLineaInf?>" height="5px" width="100%" colspan="2">	</td></tr>
            </table>
		</td>
	</tr>
	<?
		if (isset($_SESSION['usuario_id'])){
	?>
	<tr>
		<td valign="top" height="24px">
			<table width="100%" cellpadding="0" cellspacing="0" bgcolor="<?=$colorMenu?>">
				<tr>
					<td>
					<ul id='nav'>
                    <li><a href='index.php?doc=propiedades'>Principal</a></li>
					   <?
					   $seelct=mysql_query("select * from menu where padre=0 and id in (Select id_menu from grupos_menu where id_grupo = '".$_SESSION['usuario_nivel']."')");
						while($row=mysql_fetch_assoc($seelct)){
							echo "<li><a href='".$row['ruta']."'>".$row['nombre']."</a>";
							$seelct2=mysql_query("select * from menu where padre='".$row['id']."' and id in (Select id_menu from grupos_menu where id_grupo = '".$_SESSION['usuario_nivel']."') order by id ASC");
							if(mysql_num_rows($seelct2)>0){
								echo "<ul>";
								while($row2=mysql_fetch_assoc($seelct2)){
									if($row2['titulo']==1){
										echo "<li><a class='titulo' href='".$row2['ruta']."'>".$row2['nombre']."</a></li>";
									}else{
										echo "<li><a href='".$row2['ruta']."'>".$row2['nombre']."</a></li>";
									}
								}
								echo "</ul>";
							}
							echo "</li>";
						}
					   ?>
					</ul></td>
                    <td style="color:<?=$colorLineaInf?>" align="right">
                    <table style="color:<?=$colorLineaInf?>" align="right">
                        <tr>
                            <td>Bienvenido: <b><?=$_SESSION['usuario_login']?></b></td>
                            <td align="right"></td>
                        </tr>
                    </table>
                    </td>
				</tr>
			</table>
		</td>
	</tr>
    
	<?}?>
	<tr>
		<td valign="top">
			<table border="0" cellspacing="0" cellpadding="0" height="100%" width="100%" class="contenido" align="center">
            <tr>
            <td>
            <br />
            </td>
            </tr>
                <tr>
				<td width="15%"></td>
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
                <td width="15%"></td>
                </tr>
			</table>
		</td>

	</tr>
		<tr>
		<td colspan="2" id="mensaje21"></td>
	</tr>
	<tr>
		<td height="20px" valign="bottom" ><br />
<?
			//include('includes/footerp.php');
			?>
		</td>
	</tr>
</table>
			<div style="display:none" id="errorvalida" title="Error">

			 </div>
</body>
</html>