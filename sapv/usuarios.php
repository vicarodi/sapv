<?
$accion='guarda';
$boton="Guardar";
$tipo="reset";
switch ($_GET['accion']){
	case "guarda":
    if($_POST[grupo]==2){
        $selectMedico=mysql_fetch_assoc(mysql_query("Select * from medicos where id='".$_POST['medico']."'"));
        mysql_query("Insert into user_list values ('','".$selectMedico[cedula]."','".$_POST[email]."','".$selectMedico[nombre]."','".$selectMedico[telefono_movil]."','".$_POST[usuario]."','".md5($_POST[password])."','".$_POST[grupo]."','".$_POST['medico']."')")or die(mysql_error());
   $after="<b>Nombre y Apellido:</b>".$selectMedico[nombre]."<br><strong>Cedula:</strong>".$selectMedico[cedula]."<br><strong>Email:</strong>".$_POST[email]."<br><strong>Usuario:</strong>".$_POST[usuario]."<br><strong>Grupo:</strong>".devuelve_valor($_POST[grupo],'nombre','grupos');
    }else{
        $after="<b>Nombre y Apellido:</b>".$_POST[nombre]."<br><strong>Cedula:</strong>".$_POST[cedula]."<br><strong>Email:</strong>".$_POST[email]."<br><strong>Usuario:</strong>".$_POST[usuario]."<br><strong>Grupo:</strong>".devuelve_valor($_POST[grupo],'nombre','grupos');
        mysql_query("Insert into user_list values ('','".$_POST[cedula]."','".$_POST[email]."','".$_POST[nombre]."','".$_POST[telefono]."','".$_POST[usuario]."','".md5($_POST[password])."','".$_POST[grupo]."','')")or die(mysql_error());
    }
		//Cambiar la palabra user_list por el nombre de la tabla y los nombres de los campos en la BD que les toco a uds
		
		
        auditoria("CREO AL USUARIO: ".$_POST['nombre'],'',$after,'agregar');
		//cambiar todo lo que dice index.php?doc=user_list por el el nombre del archivo que les toco por ejemplo si te toco insumos debes poner index.php?doc=insumos y lo demas queda igual
		redireccionador("index.php?doc=usuarios&mensaje=1");
		break;
	case "editar":
		//Cambiar la palabra user_list por el nombre de la tabla en la BD que les toco a uds
		$row_medico=mysql_fetch_assoc(mysql_query("Select * FROM user_list where id = '".$_GET['id']."'"));
		$accion='modificar';
		$boton="Modificar";
		$tipo="button";
		$onclick="onclick=window.location.href='".$limpiar."'";
		break;
	case "modificar":
    $selectMedico=mysql_fetch_assoc(mysql_query("Select * from user_list where ID='".$_POST['id']."'"));
		$before="<b>Nombre y Apellido:</b>".$selectMedico[nombre]."<br><strong>Cedula:</strong>".$selectMedico[cedula]."<br><strong>Email:</strong>".$selectMedico[email]."<br><strong>Usuario:</strong>".$selectMedico[usuario]."<br><strong>Grupo:</strong>".devuelve_valor($selectMedico[nivel_acceso],'nombre','grupos');
         $after="<b>Nombre y Apellido:</b>".$_POST[nombre]."<br><strong>Cedula:</strong>".$_POST[cedula]."<br><strong>Email:</strong>".$_POST[email]."<br><strong>Usuario:</strong>".$_POST[usuario]."<br><strong>Grupo:</strong>".devuelve_valor($_POST[grupo],'nombre','grupos');
        //Cambiar la palabra user_list por el nombre de la tabla, y los nombres de los campos en la BD que les toco a uds
		mysql_query("update user_list set cedula='".$_POST[cedula]."',nombre='".$_POST[nombre]."',email='".$_POST[email]."',telefono='".$_POST[telefono]."',usuario='".$_POST[usuario]."',nivel_acceso='".$_POST[grupo]."' where ID='".$_POST['id']."'")or die(mysql_error());
		auditoria("MODIFICO LOS DATOS DEL USUARIO: ".$_POST['nombre'],$before,$after,'modificar');
		//cambiar todo lo que dice index.php?doc=user_list por el el nombre del archivo que les toco por ejemplo si te toco insumos debes poner index.php?doc=insumos y lo demas queda igual

		redireccionador("index.php?doc=usuarios&mensaje=2");
		break;
	case "eliminar":
		//Cambiar la palabra user_list por el nombre de la tabla en la BD que les toco a uds
		auditoria("ELIMINO AL USUARIO:".devuelve_valor($_GET[id],'nombre','user_list'));
		mysql_query("Delete FROM user_list where ID='".$_GET['id']."'");
		//cambiar todo lo que dice index.php?doc=empresas por el el nombre del archivo que les toco por ejemplo si te toco insumos debes poner index.php?doc=insumos y lo demas queda igual

		redireccionador("index.php?doc=usuarios&mensaje=3");
		break;
}

?>

<form name="form1" id="formulario" method="post" action="index2.php?doc=usuarios&accion=<?=$accion?>" onsubmit="return validar()">
<input type="hidden" name="id" value="<?=$_GET['id']?>">
<?titulosPag("GESTION DE USUARIOS")?>
<table class="general">
	<tr>
		<td><b>Grupo de usuario:</b></td>
		<td><select title="Grupo de Usuario" name="grupo" id="grupo" onchange="carga_doctores(this.value)">
				<option value="">-----Seleccione-----</option>
				<?
				if($row_medico['nivel_acceso']==1){
					$selected1='selected';
				}
				?>
		      	<option <?=$selected1?> value="1">Administrador</option>
			</select></td>
	</tr>
	<tr>
		<td><b>Nombre y Apellido:</b></td>
		<td><input title="Nombre y Apellido" type="text" name="nombre" id="nombre" size="30" value="<?=$row_medico['nombre']?>"></td>
	</tr>
	<tr >
		<td><b>Tel&eacute;fono:</b></td>
		<td><input class="telefono" type="text" name="telefono" id="telefono" size="15" value="<?=$row_medico['telefono']?>"></td>
	</tr>
	<tr>
		<td><b>Correo electr&oacute;nico:</b></td>
		<td><input type="text" title="Correo electr&oacute;nico" name="email" id="email" size="30" value="<?=$row_medico['email']?>"></td>
	</tr>
	<tr>
		<td><b>Nombre de usuario:</b></td>
		<td><input type="text" title="Nombre de usuario" onblur="campos_existentes(this.value,'user_list',this.id,'usuario','El nombre de usuario ya existe')" name="usuario" id="usuario" size="15" value="<?=$row_medico['usuario']?>"></td>
	</tr>
    <?
       if(!isset($_GET['accion'])){

    ?>	
    <tr>
		<td><b>Contrase&ntilde;a:</b></td>
		<td><input title="Clave" type="password" name="password" id="password" size="15"></td>
	</tr>
	<tr>
		<td><b>Verificar Contrase&ntilde;a:</b></td>
		<td><input title="Verificar Clave" type="password" name="confipass" id="confipass" onblur="validar_contras_usu(this.value)" size="15" ></td>
	</tr>
    <?      
        }
    ?>

        <tr>
        <td colspan="2" align="center">(<font color="#CC0000">*</font>) Campos Requeridos</td>
    </tr>
<tr>
<td colspan="2" align="center">
<? creador_boton('submit',$boton,$boton);?>&nbsp;&nbsp;
<? creador_boton($tipo,'Cancelar','Cancelar',$onclick);?></td>
</tr>
</table>
<p>&nbsp;</p>
</form>


<?
//cambiar el nombre de la tabla por la que te corresponde a ti

		$sql="SELECT * FROM user_list";
		$res=mysql_query($sql);
//donde dicen orden deben cambiarlo por el nombre del campo por el que quieren ordenar ejemplo: si tu listado tiene ordenar por nombre en tonces debes colocar href='".$_SERVER["PHP_SELF"]."?doc=".$_GET['doc']."&pagina=".$pagina."&orden=nombre&parametro=".urlencode($parametro)."'
//comienzo del encabezado del listado
		echo "<table id='listado' class='display' align='center' width='100%' border='0' cellspacing='0'><thead><tr>";
		echo "<th>C&eacute;dula</th>";
		echo "<th>Nombre</th>";
		echo "<th>Tel&eacute;fono</th>";
		echo "<th>Grupo</th>";
		echo "<th>Acciones</th></tr></thead>";
//fin del encabezado del listado


echo "<tbody>";
		while($registro=mysql_fetch_array($res))
		{
?>
<!-- tabla de resultados aqui van los campos que muestras en tu listado -->
  <tr>
  	<?php $id_medico=$registro["id"]; 
      $arreglo=devuelve_valor($registro["nivel_acceso"],'nombre','grupos');
      ?>
    <td><? echo $registro["cedula"]; ?></td>
    <td><? echo $registro["nombre"]; ?></td>
    <td><? echo $registro["telefono"]; ?></td>
	<td><? echo $arreglo["nombre"] ?></td>
	<td>
<!--cambiar todo lo que dice index2.php?doc=usuarios por el el nombre del archivo que les toco por ejemplo si te toco insumos debes poner index.php?doc=insumos y lo demas queda igual-->

<a href="index.php?doc=usuarios&accion=editar&id=<?=$registro["ID"]?>"><?botones('editar');?></a>
<!--cambiar todo lo que dice index2.php?doc=usuarios por el el nombre del archivo que les toco por ejemplo si te toco insumos debes poner index.php?doc=insumos y lo demas queda igual-->

<a href="javascript:void(0)" onclick="eliminar('index2.php?doc=usuarios&accion=eliminar&id=<?=$registro["ID"]?>')"><?botones('eliminar');?></a>
	</td>

  </tr>
<!-- fin tabla resultados -->
<?
		}echo "</tbody>";
		echo "</table>";?>
		<!-- dejar como esta -->
			<div style="display:none" id="dialog2" title="Confirmar">
				<p>�Est&aacute; ud seguro de eliminar este registro?</p>
			 </div>
	
		<!-- dejar como esta -->
		<!--Aqui termina el listado-->

<?
//Dejar tal cual como esta
	if(isset($_GET['mensaje'])){
		dialogos($_GET['mensaje']);
	}
?>
<script>
<?
	if(isset($_GET['mensaje'])){
?>

//Dejar tal cual como esta
	$(function() {
		$("#dialog").dialog({
			resizable:false,
			bgiframe: true,
			modal: true,
			buttons: {
				Ok: function() {
					$(this).dialog('close');
				}
			}
		});
	});
<?
	}
?>
function validar_contras_usu(valor){
    if(valor!=$("#password").val() &&(valor!='')){
	   $('#errorvalida').html('<p>Las contrase&ntilde;as deben ser iguales</p>');
		$("#errorvalida").dialog({
			resizable:false,
			bgiframe: true,
			autoOpen: true,
			modal: true,
			buttons: {
				Ok: function() {
					$(this).dialog('close');
					$('#confipass').val('');
					$('#confipass').focus();
				}
			}
		});

		$("#errorvalida").dialog('open'); 
    }
}

</script>
<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#listado').dataTable( {
					"bJQueryUI": true,
					"sPaginationType": "full_numbers"
				} );
			} );
		</script>