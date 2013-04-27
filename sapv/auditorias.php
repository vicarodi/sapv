<?
if(isset($_GET['tipo'])&&$_GET['tipo']=='detalle'){
$rowdetalle=mysql_fetch_assoc(mysql_query("Select Accion,beforee,afterr from auditoria where id='".$_GET['id']."'"));
?>
<table  width="100%">
<tr>
    <td colspan="2"><strong><?=$rowdetalle['Accion']?></strong></td>
</tr>
    <tr>
        <td width="50%">
            <fieldset>
                <legend><b>ANTES</b></legend>
                <p><?=$rowdetalle['beforee']?></p>
            </fieldset>
        </td>
       
        <td width="50%">
             <fieldset>
                <legend><b>DESPUES</b></legend>
                <p> <?=$rowdetalle['afterr']?></p>
            </fieldset>
        </td>
    </tr>
</table>
<?
die;
}
?>
<fieldset style="width:80%"> <legend style="font-weight:bold;text-align:left; font-family:Tahoma; font-size:14px">Auditor&iacute;as</legend>
<form name="form1" method="post" action="index.php?doc=auditorias&consulta=consultar" onsubmit="return fechas()">
<table class="general">
	<tr>
		<td><b>Usuario:</b></td>
		<td>
        <input type="hidden" name="idusu" id="idusu">
        <input type="text" size="30" id="nomusu" name="nomusu"></td>
	</tr>
	<tr>
	<td><b>Acci&oacute;n Realizada:</b></td>
	<td><select name="accion">
				<option value="">---Seleccione---</option>
				<option value="login">Login</option>
				<option value="agregar">Agregar</option>
				<option value="modificar">Modificar</option>
				<option value="eliminar">Eliminar</option>
		</select>
	</td>
	</tr>
	<tr>
		<td colspan="2">
			<b>Ver auditorias desde</b> <input type="text" size="10" id="datepicker" name="desde"> <b>hasta el</b> <input name="hasta" type="text" size="10" id="datepicker2">
		</td>
	</tr>
<tr>
    <td>&nbsp;
    </td>
</tr>
<tr>
<td colspan="2" align="center">
<?creador_boton('submit',' Ver ','Ver');?>


</td>
</tr>
</table>
</form>
</fieldset>
<?
if(isset($_GET['consulta']) && $_GET['consulta']=='consultar'){
    ?>
<fieldset style="width:80%">
	<legend style="font-weight:bold; font-family:Tahoma; font-size:14px">Listado de Acciones</legend>

	<?	
    	$parametros= str_replace("\\","",$_GET['parametro']);
		
        if(!isset($_GET['parametro'])){
			
				$y=0;
				$parametros=' where DATE_FORMAT(Fecha,"%d/%m/%Y") between "'.$_POST['desde'].'" and "'.$_POST['hasta'].'"';
				if($_POST['idusu']!=''){
					$parametros.=" and Usuario = '".$_POST['idusu']."'";
				}
				if($_POST['accion']!=''){
					$parametros.=" and accion_realizada = '".$_POST['accion']."'";
				}
		}
    
    //////////elementos para el orden
		$orden=$_GET['orden'];
		$pagina=$_GET['pagina'];
//cambiar el nombre de la tabla por la que te corresponde a ti
		$sql="SELECT * FROM auditoria ".$parametros;

		$res=mysql_query($sql);
		$numeroRegistros=mysql_num_rows($res);

		if(!isset($_GET['orden']))
		{
			$orden="Fecha";
		}
    if(!isset($_GET["pagina"]))
    {
       $pagina=1;
       $inicio=1;
       $final=$tamPag;
    }else{
       $pagina = $_GET["pagina"];
    }

    $limitInf=($pagina-1)*$tamPag;

    $numPags=ceil($numeroRegistros/$tamPag);
    if(!isset($pagina))
    {
       $pagina=1;
       $inicio=1;
       $final=$tamPag;
    }else{
       $seccionActual=intval(($pagina-1)/$tamPag);
       $inicio=($seccionActual*$tamPag)+1;

       if($pagina<$numPags)
       {
          $final=$inicio+$tamPag-1;
       }else{
          $final=$numPags;
       }

       if ($final>$numPags){
          $final=$numPags;
       }
    }

		//////////fin de dicho calculo

		//////////creacion de la consulta con limites
		$sql="SELECT *,DATE_FORMAT(Fecha,'%d/%m/%Y %H:%i:%s') as Fecha FROM auditoria ".$parametros." ORDER BY ".$orden." ASC LIMIT ".$limitInf.",".$tamPag;
        $res=mysql_query($sql)or die(mysql_error());

		//////////fin consulta con limites

			echo "<table id='listado' style='border:1px solid #1676bb' class='general' align='center' width='100%' border='0' cellspacing='0'><tr class='encabezado'>";
		echo "<td ><a  href='".$_SERVER["PHP_SELF"]."?doc=".$_GET['doc']."&pagina=".$pagina."&orden=Fecha&parametro=".urlencode($parametros)."'>Fecha y Hora</a></td>";
		echo "<td><a  href='".$_SERVER["PHP_SELF"]."?doc=".$_GET['doc']."&pagina=".$pagina."&orden=Usuario&parametro=".urlencode($parametros)."'>Usuario</a></td>";
		echo "<td ><a  href='".$_SERVER["PHP_SELF"]."?doc=".$_GET['doc']."&pagina=".$pagina."&orden=accion_realizada&parametro=".urlencode($parametros)."'>  Acci&oacute;n realizada</a></td>";
		echo "<td ><a  href='".$_SERVER["PHP_SELF"]."?doc=".$_GET['doc']."&pagina=".$pagina."&orden=Accion&parametro=".urlencode($parametros)."'>Acci&oacute;n</a></td>";
		echo "<td >Acciones</td>";

		while($registro=mysql_fetch_array($res))
		{
?>
        <tr class="registros" >
      	<?php $id_medico=$registro["Fecha"]; ?>
    	<td  align="left"><? echo $registro["Fecha"]; ?></td>
        <td  align="left"><? echo strtoupper(devuelve_valor($registro["Usuario"],'nombre','user_list')); ?></td>
        <td  align="left"><? echo strtoupper($registro["accion_realizada"]); ?></td>
        <td  align="left"><? echo $registro["Accion"]; ?></td>
    	<td  align="left" height="24px"><?
        if($registro["accion_realizada"]!='login' && $registro["accion_realizada"]!='eliminar'){
           ?>
          <a href="index3.php?doc=auditorias&tipo=detalle&id=<?=$registro["Id"]?>&KeepThis=true&TB_iframe=true&height=430&width=600" title="Detalle del Registro" class="thickbox"><?botones('detalles')?></a> 
        <?
        }
        ?></td>
        </tr>

<?
		}//fin while?>

		<? echo "</table>";?>
									<table border="0" cellspacing="0" cellpadding="0" align="center" style="border:none">
							<tr><td align="center" valign="top" style="border:none">

						<?
							paginador($_GET['doc']."&consulta=consultar",$pagina,$orden,$parametros,$inicio,$final,$numPags);

						?>
							</td></tr>
							</table>
		</fieldset>
<?
}
?>
		<script>
        function fechas(){
   var desde=$("#datepicker").val();
    var hasta=$("#datepicker2").val();
    if((desde=='') || (hasta=='')){
        $('#errorvalida').html('<p>Debe introducir un rango de fechas</p>');
		$("#errorvalida").dialog({
			resizable:false,
			bgiframe: true,
			autoOpen: true,
			modal: true,
			buttons: {
				Ok: function() {
					$(this).dialog('close');
				}
			}
		});
	$("#errorvalida").dialog('open');
    return false;    
   
    }else{
        return true;
    }
}
	$(function() {
		$("#datepicker2").datepicker({maxDate: '+0d'});
		$("#datepicker").datepicker({maxDate: '+0d'});
	});
		var options = {
		script:"suggestusuarios.php?tipo=nombre&json=true&",
		varname:"input",
		json:true,
		callback: function (obj) { document.getElementById('nomusu').value = obj.value;document.getElementById('idusu').value=obj.id }
	};
	var as_json = new AutoSuggest('nomusu', options);
</script>