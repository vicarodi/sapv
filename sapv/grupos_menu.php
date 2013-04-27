<?
switch ($_GET['accion']){
	case "editar":
		//Cambiar la palabra medicos por el nombre de la tabla en la BD que les toco a uds
		$row_medico=mysql_fetch_assoc(mysql_query("Select * from grupos where id = '".$_GET['id']."'"));
		$accion='modificar';
		$boton="Modificar";
		break;
	case "modificar":
		mysql_query("delete from grupos_menu where id_grupo='".$_POST['id_usu']."'");
		foreach($_POST['menu'] as $valor){
			mysql_query("insert into grupos_menu values('','".$_POST['id_usu']."','".$valor."')");
		}
		redireccionador("index.php?doc=grupos_menu&mensaje=1");
		break;
}
?>
<?
	if(isset($_GET['id'])){
?>
<fieldset style="width:70%"> <legend style="font-weight:bold;text-align:left; font-family:Tahoma; font-size:14px">Permisos a Usuarios</legend>
<form name="form1" method="post" action="index2.php?doc=grupos_menu&accion=modificar" >
<input type="hidden" name="id_usu" value="<?=$_GET['id']?>">
<table class="general">
	<tr>
		<td><b>Asignar permisos de usuario al grupo:</b><?=$row_medico['nombre']?></td>
		<td></td>
	</tr>
	<tr>
		<td colspan="2">

				<? $i=1;
					$seelct=mysql_query("select * from menu where padre=0 ");
					while($row=mysql_fetch_assoc($seelct)){
							if(mysql_num_rows(mysql_query("select * from grupos_menu where id_grupo='".$_GET['id']."' and id_menu='".$row['id']."'"))>0){
							$chechkeds='checked';
						}else{
							$chechkeds='';
						}
						if($is==2){
							echo "<div style='float:right'>
									<table>
										<tr>
										<td>
											<input ".$chechkeds." type='checkbox' name='menu[]' value='".$row['id']."'><strong>".$row['nombre']."</strong>
										</td>
									</tr>";
							$is=0;
						}else{
							echo "<div style='float:left'>
									<table>
										<tr>
										<td>
											<input ".$chechkeds." type='checkbox' name='menu[]' value='".$row['id']."'><strong>".$row['nombre']."</strong>
										</td>
									</tr>";
							$is++;
						}
						$seelcts=mysql_query("select * from menu where padre='".$row['id']."' order by id");
						while($rows=mysql_fetch_assoc($seelcts)){

						if(mysql_num_rows(mysql_query("select * from grupos_menu where id_grupo='".$_GET['id']."' and id_menu='".$rows['id']."'"))>0){
							$chechked='checked';
						}else{
							$chechked='';
						}
                        if($rows['titulo']==0){
                          $padding=" style='padding-left:20px'";  
                        }else{
                          $padding=" style='padding-left:10px'";  
                        }
						?>
						<tr>
							<td <?=$padding?>>
								<input <?=$chechked?> type="checkbox" name="menu[]" value="<?=$rows['id']?>"><?=$rows['nombre']?>
							</td>
						</tr>
				<?
						}
						echo "</table></div>";
					}
				?>

		</td>
	</tr>
<tr>
<td colspan="2" align="center">
<?creador_boton('submit','Guardar','Guardar');?>
</td>
</tr>
</table>
</fieldset>
<?
	}
?>
<fieldset style="width:70%">
	<legend style="font-weight:bold; font-family:Tahoma; font-size:14px">Listado de Usuarios</legend>

	<?
		$sql="SELECT * FROM grupos ORDER BY id";
		$res=mysql_query($sql);
		echo "<table id='listado' style='border:1px solid #1676bb' class='general' align='center' width='100%' border='0' cellspacing='0'><tr class='encabezado'>";
		echo "<td ><a  href=''>Nombre y Apellido</a></td>";
		echo "<td align='right'>Acciones</td></tr>";


		while($registro=mysql_fetch_array($res))
		{
?>
<!-- tabla de resultados -->
  <tr class="registros" >
  	<?php $id_medico=$registro["id"]; ?>

    <td  align="left"><? echo $registro["nombre"]; ?></td>
	<td style="padding-right:3px" align="right" >

<a href="index.php?doc=grupos_menu&accion=editar&id=<?=$registro["id"]?>"><?botones('editar');?></a>
	</td>

  </tr>
<!-- fin tabla resultados -->
<?
		}//fin while
		echo "</table>";?>
</fieldset>