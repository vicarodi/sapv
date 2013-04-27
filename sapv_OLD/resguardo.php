<?php session_start();?>

</fieldset>
<fieldset style="width:70%">
	<legend style="font-weight:bold; font-family:Tahoma; font-size:14px">Resguardo de la Base de Datos </legend>
<script language="javascript">

function Pregunta(Documentos){
respu=confirm("Desea Restaurar La Base de Datos?... Se perdera la Data Actual");

	if (respu==true){

		//return (true);
		return (true);
	}else{
	return (false);
	}
}

function Enviar(Doc){
respu=confirm("¿Desea Eliminar Las Copias Existentes?");

	if (respu==true){

		//return (true);
		return (true);
	}else{
	return (false);
	}
}

function Confirmacion(Documentos){
    $("#dialog4").dialog({
			bgiframe: true,
			autoOpen: true,

			modal: true,
			buttons: {
				Si: function() {
					$(this).dialog('close');
					return true;
				},
				No: function() {
					$(this).dialog('close');
                    return false;
				}
			}

		});
	$("#dialog4").dialog('open');
}

</script>
<center>
<div id="dialog4" style="display: none;">Esta ud seguro de actualizar la Base de datos?</div>
<table cellspacing="0" cellpadding="0" border="0" >
    <tr>
      <td rowspan="5" width="40" height="100%" background="bg1222.jpg" style="background-position:right top; background-repeat:repeat-y"></td>
  <td></td>
     <td rowspan="5" width="40" height="100%" background="bg1223.jpg" style="background-position:left top; background-repeat:repeat-y"></td>
    </tr>

	 <tr >
 <td width="455" align="center"><font color=""><b>Permite subir una data nueva al Servidor y eliminar la existente.</b></font></td>
    </tr>
 
        
			<?php
 if (!isset ($_FILES["ficheroDeCopia"])){ // Se comprueba si ya existe un fichero enviado o aun no.
/* Si aun no existe un fichero enviado, se define un formulario para que el usuario
pueda enviarlo. Este debe ser el fichero de copia de seguridad con la consulta SQL para
recrear la base de datos perdida o estropeada.
En el formulario se deben incluir las clases que definen el aspecto de los distintos elementos,
a partir del fichero de estilos CSS.*/
 $contenidoDeFormulario="  <form action='index.php?doc=resguardo' method='post' enctype='multipart/form-data' name='formularioDeRestauracion'";
	  $contenidoDeFormulario.="id='formularioDeRestauracion'>\n";
      $contenidoDeFormulario.="    <table width='600' border='0' class=''>\n";
      $contenidoDeFormulario.="        <tr>\n";
      $contenidoDeFormulario.="          <td width='82' class=''>&nbsp;</td>\n";
      $contenidoDeFormulario.="        </tr>\n";
      $contenidoDeFormulario.="        <tr>\n";
      $contenidoDeFormulario.="          <td class=''>&nbsp;</td>\n";
      $contenidoDeFormulario.="          <td colspan='2' align='center' class=''><input  type='file' name='ficheroDeCopia' id='ficheroDeCopia'";
      $contenidoDeFormulario.="size='50'></td>\n";
      $contenidoDeFormulario.="          <td class=''>&nbsp;</td>\n";
      $contenidoDeFormulario.="        </tr>\n";
      $contenidoDeFormulario.="        <tr>\n";
      $contenidoDeFormulario.="          <td class=''>&nbsp;</td>\n";
      $contenidoDeFormulario.="          <td colspan='2' class=''>&nbsp;</td>\n";
      $contenidoDeFormulario.="          <td class=''>&nbsp;</td>\n";
      $contenidoDeFormulario.="        </tr>\n";
      $contenidoDeFormulario.="        <tr>\n";
      $contenidoDeFormulario.="          <td class=''>&nbsp;</td>\n";
      $contenidoDeFormulario.="          <td width='204' align='right' class=''><input style='height:25px' class='ui-state-default ui-corner-all' name='envio' type='submit' ";
      $contenidoDeFormulario.="id='envio' value='Aceptar'></td>\n";
     // $contenidoDeFormulario.="          <td width='226' align='left' class=''><input class=boton name='regreso' type='button' ";
	 // $contenidoDeFormulario.="onClick='javascript:botonCancelar();'";
     // $contenidoDeFormulario.="id='regreso' value='Cancelar'></td>\n";
      $contenidoDeFormulario.="          <td class=''>&nbsp;</td>\n";
      $contenidoDeFormulario.="        </tr>\n";
      $contenidoDeFormulario.="      </tbody>\n";
      $contenidoDeFormulario.="    </table>\n";
      $contenidoDeFormulario.="  </form>\n";
/* Se muestra el formulario. */
      echo ($contenidoDeFormulario);
    } else {
/* Si el fichero ya existe, se efectúa la carga del mismo y se inicia su procesado. */
/* Empezamos grabando el archivo de copia en el servidor. */
      $archivoRecibido=$_FILES["ficheroDeCopia"][tmp_name];
      $destino="./ficheroParaRestaurar.sql";
	  if (!@move_uploaded_file ($archivoRecibido, $destino)){
        die ("EL PROCESO HA FALLADO. INTÉNTELO DE NUEVO.");
      }

/* DATOS QUE CAMBIAN EN CADA INSTALACIÓN DE LA APLICACIÓN. */
      $usuario = $Usuario;
      $clave = $Password;
      $servidor = "localhost";
      $baseDeDatos = $BaseDeDatos;
/* AQUÍ TERMINAN LOS DATOS QUE CAMBIAN EN CADA INSTALACIÓN DE LA APLICACIÓN. */
/* Se conecta con la base de datos elegida. */
      $conexion = mysql_connect($servidor,$usuario,$clave) or die(mysql_error());
      @mysql_select_db($baseDeDatos,$conexion);

/* Una vez subido el fichero al servidor, se abre para su lectura, línea a linea. */
      $manejadorDeFichero=fopen ("ficheroParaRestaurar.sql", "r");
/* Se inicializa una variable que se usará para almacenar las consultas antes de
ejecutarlas sobre la base de datos. */
      $consultaSQL="";
/* Mediante un bucle se va a leer el fichero hasta encontrar el final del mismo. */
      while (!feof($manejadorDeFichero)){
/* Se almacena el contenido, línea a línea. */
        $lectura=fgets($manejadorDeFichero);
/* A continuación se comprueba si la línea empieza por "# ". Esto indica que se trata de
un comentario. En ese caso se pasa a la siguiente iteración, ignorando toda esa línea
recién leida. También se pasa a la siguiente línea si la que estamos leyendo no tiene más
contenido que el salto de línea.*/
        if (substr ($lectura,0,2)=="# " || $lectura=="\n") continue;
/* Se determina la longitud de la línea restando el carácter de salto. */
		$longitudLeida=strlen ($lectura)-1;
/* Se elimina el carácter de salto de línea */
        $lectura=chop($lectura);
/* Llegados a este punto, la línea leida es parte de una consuilta SQL,
por lo que se incorpora a la variable que contendrá la misma para su
posterior ejecución. */
        $consultaSQL.=$lectura;
/* A continuación se comprueba si el último carácter de la ínea es un punto y coma,
lo que determina el final de una consulta SQL. Dado el formato que ha recibido el fichero,
el último carácter puede no ser un caracter válido, por lo que se comprueba si el punto y coma
el último o el penúltimo. */
        if (substr($lectura, $longitudLeida-2, 1)==";" || substr($lectura, $longitudLeida-1, 1)==";"){
/* Llegados aqui, ya tenemos la consulta SQL lista para su ejecución. */
          @mysql_query($consultaSQL,$conexion);
          /*if (mysql_errno()!=0){ // Si se produce algún error, a pesar de todo.
            $mensajeDeError="SE HA PRODUCIDO EL ERROR SIGUIENTE<br>";
            $mensajeDeError.=mysql_errno()."***".mysql_error()."<br>";
            $mensajeDeError.="NO SE HA PODIDO COMPLETAR LA OPERACIÓN.";
            die ($mensajeDeError);
          }*/
/* Ahora e limpia la variable donde se almacena la consulta SQL, para empezar con la siguiente. */
          $consultaSQL="";
        }
      }
      fclose ($manejadorDeFichero); // Se cierra el fichero.
/* Se elimina el fichero del servidor. */
	  unlink ("ficheroParaRestaurar.sql");
      echo "<div id='errorvalida' style='display:none'></div></table>";
	  ?>
      <script>
      function listo(){
      	   $('#errorvalida').html('<p>La Base de datos si ha actualizado con exito</p>');
		$("#errorvalida").dialog({
			resizable:false,
			bgiframe: true,
			autoOpen: true,
			modal: true,
			buttons: {
				Ok: function() {
					$(this).dialog('close');
				    window.location.href='index.php?doc=resguardo';
				}
			}
		});

		$("#errorvalida").dialog('open'); 
    }
    listo();
      </script>
      <?
    }

	?>

