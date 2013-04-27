<?php session_start();
    $readonly="";
    if ($_REQUEST['sc']==1){
        $readonly="readonly";
    }
?>
<html>
<head>
<meta content="text/html; charset=iso-8859-1" http-equiv="Content-Type" />
<title></title>
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
<script>
$(document).ready(function(){
    <?
    if($_GET['doc']!='resguardo'){
        ?>
        $("input,textarea").uniform();
        <?
    }else{
        ?>
        $("input[type!='file']&&[type!='submit'],textarea").uniform();
        
        <?
    }
    ?>
 
/*$(":input").blur(function(){
  $(this).val($(this).val().toUpperCase()); 
});  */
});

</script>
</head>
<body onload="mueveReloj()">
<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%">
	<tr>
		<td valign="top" height="56px">
        	<table  width="100%" height="89" border="0" cellpadding="0" cellspacing="0">
        		<tr>
            		<td align="left" bgcolor="ffffff">
            		<img src="images/logo.png" />
        		  </td>
        		</tr>
        		<tr><td bgcolor="#DE2823" height="5px" width="100%" colspan="2">	</td></tr>
            </table>
		</td>
	</tr>

	<tr>
		<td valign="top">
			<table border="0" cellspacing="0" cellpadding="0" height="100%" width="100%" class="contenido" align="center">
            <tr>
            <td>
            <br />
            </td>
            </tr>
                <tr>
				<td width="10%"></td>
				<td align="center" valign="top">
                    <br/>
					 <!-- TABLA DE CONTENIDO-->
                     
                        <br/><br/><br/><br/><br/><br/><br/><br/>
<table width="500" border="0"  cellpadding="0" cellspacing="0" style="border:1px solid #026ab6" bordercolor="#026ab6" bgcolor="#ffffff">
        <form action="olvido_contrasena.php" method="post" class="jqtransform" name="validar">
          <tr>

          <td rowspan="3"><br />
          <img src="images/login_icon.png" />

          </td>
            <td colspan="2">
              <div align="center">
                <table width="100%" border="0" cellspacing="0" cellpadding="5">
                  <tr>
                    <td colspan="2">
                      <div ><font face="Tahoma" size="2"><br /><strong>Obtener una Contrase&ntilde;a Nueva</strong><br />
                      
                      </font></div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" valign="top">
                      <font style="font-size: 9px;">Si Olvido su Contrase&ntilde;a puede Obtener una Nueva para Acceder al Sistema.</font>
                    </td>
                  </tr>
                  <tr id="fila1">
                        <td>
                          <div ><font face="Tahoma" size="2"><strong>Usuario:</strong></font></div>
                        </td>
                        
                        <td>
                            <input <?php echo $readonly?> type="text" id="user" name="user" size="15" value="<?php echo $_SESSION['user']?>" />  
                        </td>
                      </tr>
                      <tr id="fila2">
                        <td>
                          <div><font face="Tahoma" size="2"><strong>Correo: </strong></font></div>
                        </td>
                       
                        <td>
                            <input <?php echo $readonly?> type="text" id="pass2" name="pass2" size="15" value="<?php echo $_SESSION['correo']?>" />  
                        </td>
                      </tr>
                  <?php if ($_REQUEST['sc']==1){?>
                    
                          <tr id="fila3">
                            <td><div><font face="Tahoma" size="2"><strong>Contrase&ntilde;a Nueva: </strong></font></div></td>
                            <td><input type="password" id="passnew" name="passnew" size="15" value="" /></td>
                          </tr>
                          <tr id="fila4">
                            <td><div><font face="Tahoma" size="2"><strong>Repetir Contrase&ntilde;a Nueva: </strong></font></div></td>
                            <td><input type="password" id="passverifnew" name="passverifnew" size="15" value="" />  </td>
                          </tr>

                          
                  <?php }?>
                  <!--<tr>
                    <td><div><font face="Tahoma" size="2"><strong>Contrase&ntilde;a Nueva: </strong></font></div></td>
                    <td><input onkeypress="enter(event)" type="password" id="passnew" name="passnew" size="15" value="" /></td>
                  </tr>-->
                  <!--<tr>
                    <td><div><font face="Tahoma" size="2"><strong>Repetir Contrase&ntilde;a Nueva: </strong></font></div></td>
                    <td><input onkeypress="enter(event)" type="password" id="passnew" name="passnew" size="15" value="" />  </td>
                  </tr>-->
                </table>
              </div>
            </td>
          </tr>

          <tr valign="middle">
            <td colspan="2" height="50" align="center" id="botoncambiarclave">
              <font face="Arial" color="black" size="2" >
              <?php if ($_REQUEST['sc']==1){?>
                        <input id="button" class="ui-state-default ui-corner-all" name="submit" type="button" onclick="validar_clavesiguales()" value="  Cambiar  " class="botones" />
              <?php }else{?>
                        <input id="button" class="ui-state-default ui-corner-all" name="submit" type="button" onclick="valido_usuario_recuperarclave('')" value="  Verificar  " class="botones" />&nbsp;
              <?php }?> 
              <input onclick="window.location.href='index.php?doc=principal'" id="cancelar" class="ui-state-default ui-corner-all" name="cancela" type="button" onclick="" value="  CANCELAR  " class="botones" /> 
              </font>
            </td>
          </tr>
          <tr>
          	<td colspan="2" align="center" id="loadin"></td>
          </tr>
          <tr>
          <td></td>
          	<td align="center" ><div id="mensaje" style="margin:5px;padding:1px;display:none" class="ui-state-error ui-corner-all"></div></td>
          </tr>
        </form>
      </table>
                     
                     <!-- TABLA DE CONTENIDO-->
				</td>
                <td width="10%"></td>
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