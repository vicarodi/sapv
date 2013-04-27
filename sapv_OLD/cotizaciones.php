

<?
//cambiar el nombre de la tabla por la que te corresponde a ti

		$sql="SELECT * FROM cotizaciones ";
		$res=mysql_query($sql);
//donde dicen orden deben cambiarlo por el nombre del campo por el que quieren ordenar ejemplo: si tu listado tiene ordenar por nombre en tonces debes colocar href='".$_SERVER["PHP_SELF"]."?doc=".$_GET['doc']."&pagina=".$pagina."&orden=nombre&parametro=".urlencode($parametro)."'
//comienzo del encabezado del listado
		echo "<table id='listado' class='display' align='center' width='100%' border='0' cellspacing='0'><thead><tr>";
	
		echo "<th>Nro. Cot</th>";
        echo "<th>Propietario</th>";
        echo "<th>Cliente</th>";
        echo "<th>Tel&eacute;fono</th>";
        echo "<th>Email</th>";
        echo "<th>Llegada</th>";
        echo "<th>Salida</th>";
        echo "<th>Noches</th>";
		echo "<th>Monto</th></tr></thead>";
//fin del encabezado del listado


echo "<tbody>";
		while($registro=mysql_fetch_array($res))
		{
?>
<!-- tabla de resultados aqui van los campos que muestras en tu listado -->
  <tr>

    <td><? echo $registro["codigo"]; ?></td>
    <td><? echo $registro["capacidad"]; ?></td>
	<td>
<!--cambiar todo lo que dice index2.php?doc=tipos_camas por el el nombre del archivo que les toco por ejemplo si te toco insumos debes poner index.php?doc=insumos y lo demas queda igual-->
	</td>

  </tr>
<!-- fin tabla resultados -->
<?
		}echo "</tbody>";
		echo "</table>";?>
		<!-- dejar como esta -->
        <script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#listado').dataTable( {
					"bJQueryUI": true,
					"sPaginationType": "full_numbers"
				} );
			} );
		</script>