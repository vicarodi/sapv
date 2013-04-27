<?
$accion='guarda';
$boton="Guardar";
$tipo="reset";
switch ($_GET['accion']){
	case "guarda":

        $after="<b>Titulo:</b>".$_POST['titulo']."<br><strong>Variable:</strong>".$_POST['nombre_variable']."<br><strong>Valor:</strong>".$_POST['valor']."<br>";
        mysql_query("Insert into configuracion values ('','".$_POST['titulo']."','".$_POST['valor']."','".$_POST['nombre_variable']."')")or die(mysql_error());
		//Cambiar la palabra configuracion por el nombre de la tabla y los nombres de los campos en la BD que les toco a uds
		
		
        auditoria("CREO LA CONFIGURACION: ".$_POST['titulo'],'',$after,'agregar');
		//cambiar todo lo que dice index.php?doc=configuracion por el el nombre del archivo que les toco por ejemplo si te toco insumos debes poner index.php?doc=insumos y lo demas queda igual
		redireccionador("index.php?doc=configuracion&mensaje=1");
		break;
	case "editar":
		//Cambiar la palabra configuracion por el nombre de la tabla en la BD que les toco a uds
		$row_medico=mysql_fetch_assoc(mysql_query("Select * FROM configuracion where id = '".$_GET['id']."'"));
		$accion='modificar';
		$boton="Modificar";
		$tipo="button";
		$onclick="onclick=window.location.href='".$limpiar."'";
		break;
	case "modificar":
    $selectMedico=mysql_fetch_assoc(mysql_query("Select * from configuracion where id='".$_POST['id']."'"));
		$before="<b>Titulo:</b>".$selectMedico['titulo']."<br><strong>Variable:</strong>".$selectMedico['nombre_variable']."<br><strong>Valor:</strong>".$selectMedico['valor']."<br>";
         $after="<b>Titulo:</b>".$_POST['titulo']."<br><strong>Variable:</strong>".$_POST['nombre_variable']."<br><strong>Valor:</strong>".$_POST['valor']."<br>";
        //Cambiar la palabra configuracion por el nombre de la tabla, y los nombres de los campos en la BD que les toco a uds
		mysql_query("update configuracion set nombre_variable='".$_POST['nombre_variable']."',valor='".$_POST['valor']."',titulo='".$_POST['titulo']."' where id='".$_POST['id']."'")or die(mysql_error());
		auditoria("MODIFICO LA CONFIGURACION: ".$_POST['titulo'],$before,$after,'modificar');
		//cambiar todo lo que dice index.php?doc=configuracion por el el nombre del archivo que les toco por ejemplo si te toco insumos debes poner index.php?doc=insumos y lo demas queda igual

		redireccionador("index.php?doc=configuracion&mensaje=2");
		break;
	case "eliminar":
		$nombre_conf=devuelve_valor($_GET['id'],'titulo','configuracion');
		//Cambiar la palabra configuracion por el nombre de la tabla en la BD que les toco a uds
		auditoria("ELIMINO LA CONFIGURACION: ".$nombre_conf['titulo'],'','','eliminar');
		mysql_query("Delete FROM configuracion where id='".$_GET['id']."'");
		//cambiar todo lo que dice index.php?doc=empresas por el el nombre del archivo que les toco por ejemplo si te toco insumos debes poner index.php?doc=insumos y lo demas queda igual

		redireccionador("index.php?doc=configuracion&mensaje=3");
		break;
}

?>

<form name="form1" id="formulario" method="post" action="index2.php?doc=configuracion&accion=<?=$accion?>" onsubmit="return validar()">
<input type="hidden" name="id" value="<?=$_GET['id']?>">
<?titulosPag("CONFIGURACION")?>
<table class="general">
	<tr>
		<td><b>T&iacute;tulo:</b></td>
		<td><input title="T&iacute;tulo" type="text" name="titulo" id="titulo" size="30" value="<?=$row_medico['titulo']?>"></td>
	</tr>
	<tr>
		<td><b>Variable:</b></td>
		<td><input type="text" title="Variable" name="nombre_variable" id="nombre_variable" size="30" value="<?=$row_medico['nombre_variable']?>"></td>
	</tr>
	<tr>
		<td><b>Valor:</b></td>
		<td><input type="text" title="Valor" name="valor" id="valor" size="15" value="<?=$row_medico['valor']?>"></td>
	</tr>


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

		$sql="SELECT * FROM configuracion";
		$res=mysql_query($sql);
//donde dicen orden deben cambiarlo por el nombre del campo por el que quieren ordenar ejemplo: si tu listado tiene ordenar por nombre en tonces debes colocar href='".$_SERVER["PHP_SELF"]."?doc=".$_GET['doc']."&pagina=".$pagina."&orden=nombre&parametro=".urlencode($parametro)."'
//comienzo del encabezado del listado
		echo "<table id='listado' class='display' align='center' width='100%' border='0' cellspacing='0'><thead><tr>";
		echo "<th>T&iacute;tulo</th>";
		echo "<th>Nombre variable</th>";
		echo "<th>Valor</th>";
		echo "<th>Acciones</th></tr></thead>";
//fin del encabezado del listado


echo "<tbody>";
		while($registro=mysql_fetch_array($res))
		{
?>
<!-- tabla de resultados aqui van los campos que muestras en tu listado -->
  <tr>
  	<?php $id_medico=$registro["id"]; ?>
    <td><? echo $registro["titulo"]; ?></td>
    <td><? echo $registro["nombre_variable"]; ?></td>
    <td><? echo $registro["valor"]; ?></td>
	<td>
<!--cambiar todo lo que dice index2.php?doc=usuarios por el el nombre del archivo que les toco por ejemplo si te toco insumos debes poner index.php?doc=insumos y lo demas queda igual-->

<a href="index.php?doc=configuracion&accion=editar&id=<?=$registro["id"]?>"><?botones('editar');?></a>
<!--cambiar todo lo que dice index2.php?doc=usuarios por el el nombre del archivo que les toco por ejemplo si te toco insumos debes poner index.php?doc=insumos y lo demas queda igual-->

<a href="javascript:void(0)" onclick="eliminar('index2.php?doc=configuracion&accion=eliminar&id=<?=$registro["id"]?>')"><?botones('eliminar');?></a>
	</td>

  </tr>
<!-- fin tabla resultados -->
<?
		}echo "</tbody>";
		echo "</table>";?>
		<!-- dejar como esta -->
			<div style="display:none" id="dialog2" title="Confirmar">
				<p>¿Est&aacute; ud seguro de eliminar este registro?</p>
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