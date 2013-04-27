<?
$accion='guarda';
$boton="Guardar";
$tipo="reset";
switch ($_GET['accion']){
	case "guarda":
        $after="<b>Nombre:</b>".$_POST['nombre']."<br>";
        mysql_query("Insert into tipo_propiedad values ('','".$_POST['nombre']."','1')")or die(mysql_error());
		//Cambiar la palabra tipo_propiedad por el nombre de la tabla y los nombres de los campos en la BD que les toco a uds
        auditoria("CREO EL TIPO DE PROPIEDAD: ".$_POST['nombre'],'',$after,'agregar');
		//cambiar todo lo que dice index.php?doc=tipo_propiedad por el el nombre del archivo que les toco por ejemplo si te toco insumos debes poner index.php?doc=insumos y lo demas queda igual
		redireccionador("index.php?doc=tipo_propiedad&mensaje=1");
		break;
	case "editar":
		//Cambiar la palabra tipo_propiedad por el nombre de la tabla en la BD que les toco a uds
		$row_medico=mysql_fetch_assoc(mysql_query("Select * FROM tipo_propiedad where id = '".$_GET['id']."'"));
		$accion='modificar';
		$boton="Modificar";
		$tipo="button";
		$onclick="onclick=window.location.href='".$limpiar."'";
		break;
	case "modificar":
   
	   //Cambiar la palabra tipo_propiedad por el nombre de la tabla, y los nombres de los campos en la BD que les toco a uds
		mysql_query("update tipo_propiedad set nombre='".$_POST['nombre']."' where id='".$_POST['id']."'")or die(mysql_error());
		auditoria("MODIFICO LOS DATOS DEL TIPO DE PROPIEDAD: ".$_POST['nombre'],$before,$after,'modificar');
		//cambiar todo lo que dice index.php?doc=tipo_propiedad por el el nombre del archivo que les toco por ejemplo si te toco insumos debes poner index.php?doc=insumos y lo demas queda igual
		redireccionador("index.php?doc=tipo_propiedad&mensaje=2");
		break;
	case "eliminar":
		//Cambiar la palabra tipo_propiedad por el nombre de la tabla en la BD que les toco a uds
		auditoria("ELIMINO AL TIPO DE PROPIEDAD:".devuelve_valor($_GET['id'],'nombre','tipo_propiedad'));
		mysql_query("Delete FROM tipo_propiedad where id='".$_GET['id']."'");
		//cambiar todo lo que dice index.php?doc=empresas por el el nombre del archivo que les toco por ejemplo si te toco insumos debes poner index.php?doc=insumos y lo demas queda igual
		redireccionador("index.php?doc=tipo_propiedad&mensaje=3");
		break;
}

?>
<form name="form1" id="formulario" method="post" action="index2.php?doc=tipo_propiedad&accion=<?=$accion?>" onsubmit="return validar()">
<input type="hidden" name="id" value="<?=$_GET['id']?>" />
<?titulosPag("GESTION DE tipo_propiedad")?>
<table class="general">
    <tr>
        <td><strong>Nombre del tipo de propiedad</strong></td>
        <td><input type="text" name="nombre" id="nombre" value="<?=$row_medico['nombre']?>" title="Nombre del TIPO DE PROPIEDAD" /></td>
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

		$sql="SELECT * FROM tipo_propiedad ";
		$res=mysql_query($sql);
//donde dicen orden deben cambiarlo por el nombre del campo por el que quieren ordenar ejemplo: si tu listado tiene ordenar por nombre en tonces debes colocar href='".$_SERVER["PHP_SELF"]."?doc=".$_GET['doc']."&pagina=".$pagina."&orden=nombre&parametro=".urlencode($parametro)."'
//comienzo del encabezado del listado
		echo "<table id='listado' class='display' align='center' width='100%' border='0' cellspacing='0'><thead><tr>";
	
		echo "<th>Nombre</th>";
		echo "<th>Acciones</th></tr></thead>";
//fin del encabezado del listado


echo "<tbody>";
		while($registro=mysql_fetch_array($res))
		{
?>
<!-- tabla de resultados aqui van los campos que muestras en tu listado -->
  <tr>

    <td><? echo $registro["nombre"]; ?></td>
	<td>
<!--cambiar todo lo que dice index2.php?doc=tipo_propiedad por el el nombre del archivo que les toco por ejemplo si te toco insumos debes poner index.php?doc=insumos y lo demas queda igual-->

<a href="index.php?doc=tipo_propiedad&accion=editar&id=<?=$registro["id"]?>"><?botones('editar');?></a>
<!--cambiar todo lo que dice index2.php?doc=tipo_propiedad por el el nombre del archivo que les toco por ejemplo si te toco insumos debes poner index.php?doc=insumos y lo demas queda igual-->

<a href="javascript:void(0)" onclick="eliminar('index2.php?doc=tipo_propiedad&accion=eliminar&id=<?=$registro["id"]?>')"><?botones('eliminar');?></a>
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