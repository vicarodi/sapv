<?
$accion='guarda';
$boton="Guardar";
$tipo="reset";
switch ($_GET['accion']){
	case "guarda":
        $after="<b>Nombre:</b>".$_POST['nombre']."<br>";
        mysql_query("Insert into tipo_camas values ('','".$_POST['nombre']."','1','".$_POST['capacidad']."')")or die(mysql_error());
		//Cambiar la palabra tipos_camas por el nombre de la tabla y los nombres de los campos en la BD que les toco a uds
        auditoria("CREO EL TIPO DE PROPIEDAD: ".$_POST['nombre'],'',$after,'agregar');
		//cambiar todo lo que dice index.php?doc=tipos_camas por el el nombre del archivo que les toco por ejemplo si te toco insumos debes poner index.php?doc=insumos y lo demas queda igual
		redireccionador("index.php?doc=tipos_camas&mensaje=1");
		break;
	case "editar":
		//Cambiar la palabra tipos_camas por el nombre de la tabla en la BD que les toco a uds
		$row_medico=mysql_fetch_assoc(mysql_query("Select * FROM tipo_camas where id = '".$_GET['id']."'"));
		$accion='modificar';
		$boton="Modificar";
		$tipo="button";
		$onclick="onclick=window.location.href='".$limpiar."'";
		break;
	case "modificar":
   
	   //Cambiar la palabra tipos_camas por el nombre de la tabla, y los nombres de los campos en la BD que les toco a uds
		mysql_query("update tipo_camas set nombre='".$_POST['nombre']."', capacidad='".$_POST['capacidad']."' where id='".$_POST['id']."'")or die(mysql_error());
		auditoria("MODIFICO LOS DATOS DEL TIPO DE PROPIEDAD: ".$_POST['nombre'],$before,$after,'modificar');
		//cambiar todo lo que dice index.php?doc=tipos_camas por el el nombre del archivo que les toco por ejemplo si te toco insumos debes poner index.php?doc=insumos y lo demas queda igual
		redireccionador("index.php?doc=tipos_camas&mensaje=2");
		break;
	case "eliminar":
		//Cambiar la palabra tipos_camas por el nombre de la tabla en la BD que les toco a uds
		auditoria("ELIMINO AL TIPO DE PROPIEDAD:".devuelve_valor($_GET['id'],'nombre','tipos_camas'));
		mysql_query("Delete FROM tipo_camas where id='".$_GET['id']."'");
		//cambiar todo lo que dice index.php?doc=empresas por el el nombre del archivo que les toco por ejemplo si te toco insumos debes poner index.php?doc=insumos y lo demas queda igual
		redireccionador("index.php?doc=tipos_camas&mensaje=3");
		break;
}

?>
<form name="form1" id="formulario" method="post" action="index2.php?doc=tipos_camas&accion=<?=$accion?>" onsubmit="return validar()">
<input type="hidden" name="id" value="<?=$_GET['id']?>" />
<?titulosPag("GESTION DE TIPOS DE CAMAS")?>
<table class="general">
    <tr>
        <td><strong>Nombre:</strong></td>
        <td><input type="text" name="nombre" id="nombre" value="<?=$row_medico['nombre']?>" title="Nombre" /></td>
    </tr>
    <tr>
        <td><strong>Capacidad:</strong></td>
        <td><input type="text" name="capacidad" id="capacidad" value="<?=$row_medico['capacidad']?>" title="Capacidad" /></td>
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

		$sql="SELECT * FROM tipo_camas ";
		$res=mysql_query($sql);
//donde dicen orden deben cambiarlo por el nombre del campo por el que quieren ordenar ejemplo: si tu listado tiene ordenar por nombre en tonces debes colocar href='".$_SERVER["PHP_SELF"]."?doc=".$_GET['doc']."&pagina=".$pagina."&orden=nombre&parametro=".urlencode($parametro)."'
//comienzo del encabezado del listado
		echo "<table id='listado' class='display' align='center' width='100%' border='0' cellspacing='0'><thead><tr>";
	
		echo "<th>Nombre</th>";
        echo "<th>Capacidad</th>";
		echo "<th>Acciones</th></tr></thead>";
//fin del encabezado del listado


echo "<tbody>";
		while($registro=mysql_fetch_array($res))
		{
?>
<!-- tabla de resultados aqui van los campos que muestras en tu listado -->
  <tr>

    <td><? echo $registro["nombre"]; ?></td>
    <td><? echo $registro["capacidad"]; ?></td>
	<td>
<!--cambiar todo lo que dice index2.php?doc=tipos_camas por el el nombre del archivo que les toco por ejemplo si te toco insumos debes poner index.php?doc=insumos y lo demas queda igual-->

<a href="index.php?doc=tipos_camas&accion=editar&id=<?=$registro["id"]?>"><?botones('editar');?></a>
<!--cambiar todo lo que dice index2.php?doc=tipos_camas por el el nombre del archivo que les toco por ejemplo si te toco insumos debes poner index.php?doc=insumos y lo demas queda igual-->

<a href="javascript:void(0)" onclick="eliminar('index2.php?doc=tipos_camas&accion=eliminar&id=<?=$registro["id"]?>')"><?botones('eliminar');?></a>
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

</script>
<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#listado').dataTable( {
					"bJQueryUI": true,
					"sPaginationType": "full_numbers"
				} );
			} );
		</script>