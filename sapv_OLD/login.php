<?session_start();
	if($_POST['tipo']==1){
		include ("includes/conectar.php");
		$usuario_consulta = mysql_query("SELECT ID,usuario,pass,nivel_acceso,nombre FROM user_list WHERE pass = '".md5($_POST['pass2'])."' and usuario='".$_POST['user']."'")or die(mysql_error());
		if (mysql_num_rows($usuario_consulta) > 0) {
		    // almacenamos datos del Usuario en un array para empezar a chequear.
		 	$usuario_datos = mysql_fetch_array($usuario_consulta);
		    // definimos usuarios_id como IDentificador del usuario en nuestra BD de usuarios
		    $_SESSION['usuario_id']=$usuario_datos['ID'];
		    // definimos usuario_nivel con el Nivel de acceso del usuario de nuestra BD de usuarios
		    $_SESSION['usuario_nivel']=$usuario_datos['nivel_acceso'];
		    //definimos usuario_nivel con el Nivel de acceso del usuario de nuestra BD de usuarios
		    $_SESSION['usuario_login']=$usuario_datos['usuario'];
            $_SESSION['usuario_nombre']=$usuario_datos['nombre'];
		    //definimos usuario_password con el password del usuario de la sesión actual (formato md5 encriptado)
		    $_SESSION['usuario_password']=$usuario_datos['pass'];
            $_SESSION['usuario_medico']=$usuario_datos['id_medico'];
            auditoria('ENTRO AL SISTEMA EL USUARIO: '.strtoupper($usuario_datos['nombre']),'','','login');
        	echo"1";
		   }else{
		   	echo"0";
		   }
		   die;
	}else{
?><br><br><br><br>
<br><br><br><br>
<table width="400" border="0"  cellpadding="0" cellspacing="0" style="border:1px solid #026ab6" bordercolor="#026ab6" bgcolor="#ffffff">
        <form action="login.php" method="post" class="jqtransform" name="validar">
          <tr>

          <td rowspan="3"><br />
          <img src="images/login_icon.png">

          </td>
            <td colspan="2">
              <div align="center">
                <table width="100%" border="0" cellspacing="0" cellpadding="5">
                  <tr>
                    <td>
                      <div ><font face="Tahoma" size="2"><strong>Usuario:</strong></font></div>
                    </td>
                    
                    <td>

                        <input type="text" id="user" name="user" size="15" value="">  <img src="images/users.png" border="0">

                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div><font face="Tahoma" size="2"><strong>Contrase&ntilde;a: </strong></font></div>
                    </td>
                   
                    <td>

                        <input onkeypress="enter(event)" type="password" id="pass2" name="pass2" size="15" value="">  <img src="images/checked_out.png" border="0">

                    </td>
                  </tr>
                </table>
              </div>
            </td>
          </tr>

          <tr valign="middle">
            <td colspan="2" height="50" align="center">
              <font face="Arial" color=black size=2>
                <input id="button" class="ui-state-default ui-corner-all" name=submit type="button" onclick="valido_usuario('')" value="  Entrar  " class="botones">
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
      <?
	}
      ?>
