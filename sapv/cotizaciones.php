<?
    $where_aux= array(); 

    if($_POST['ordenDesde']!="" && $_POST['ordenHasta']==""){
        	$where_aux[]="DATE_FORMAT(fecha_registro,'%Y-%m-%d') >= '".fechasql($_POST['ordenDesde'])."'";
    }
    if($_POST['ordenDesde']=="" && $_POST['ordenHasta']!=""){
            	$where_aux[]="DATE_FORMAT(fecha_registro,'%Y-%m-%d') <= '".fechasql($_POST['ordenHasta'])."'";
    }
    
     if($_POST['ordenDesde']!='' && $_POST['ordenHasta']!=''){
       //$where_aux[]="DATE_FORMAT(fecha_reclamo,'%d/%m/%Y') BETWEEN '".$_POST['ordenDesde']."' and '".$_POST['ordenHasta']."'"; 
		$where_aux[]="fecha_registro BETWEEN '".fechasql($_POST['ordenDesde'])."' and '".fechasql($_POST['ordenHasta'])."'";
      
    }
    
    $where = (count($where_aux)>0)?implode($where_aux," AND "):"";
    $where = ($where != "")?" where ".$where:"";
    
    //cambiar el nombre de la tabla por la que te corresponde a ti
	$sql="SELECT *,DATE_FORMAT(fecha_registro,'%Y-%m-%d') as fechaNueva FROM cotizaciones ".$where."";
    
    //echo $sql; 
	$res=mysql_query($sql);
    $TOTALregistro=mysql_num_rows($res);
?>

<?titulosPag("COTIZACIONES")?>
<form action="" method="POST" onsubmit="return validar_fechas('buscar');">
<table width="90%" >
<tr>
    <td colspan="5" align="center"><b>Eliminar Cotizaciones entre fechas</b></td>
</tr>
<tr>
        <td><strong>Desde:</strong></td><td><input class="datepicker" name="ordenDesde" size="10" id="ordenDesde" type="text" value="<?php echo $_POST['ordenDesde'];?>"/></td>
        <td><strong>Hasta:</strong></td><td><input class="datepicker" name="ordenHasta" size="10" id="ordenHasta" type="text" value="<?php echo $_POST['ordenHasta'];?>"/></td>
        <td>
            <input type="submit" name="buscar" id="buscar" value="Buscar"/>
            <?php
            if(isset($_POST['ordenDesde']) && $TOTALregistro>0){?>
                <input type="button" name="eliminar" id="eliminar" value="Eliminar" onclick="validar_fechas('eliminar')" />
            <?php 
            }?>
            
        </td>
    </tr>

</form>
</table>
<br /><br />
<?
    
    //donde dicen orden deben cambiarlo por el nombre del campo por el que quieren ordenar ejemplo: si tu listado tiene ordenar por nombre en tonces debes colocar href='".$_SERVER["PHP_SELF"]."?doc=".$_GET['doc']."&pagina=".$pagina."&orden=nombre&parametro=".urlencode($parametro)."'
    //comienzo del encabezado del listado
		echo "<table id='listado' class='display' align='center' width='100%' border='0' cellspacing='0'><thead><tr>";
	
		echo "<th>Nro. Cot</th>";
        echo "<th>Fecha Registro.</th>";
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
    <?php 
        $row_medicox=mysql_fetch_assoc(mysql_query("Select id_propietario FROM propiedades where id = '".$registro["id_propiedad"]."'"));
        $nombrepropietario=devuelve_valor($row_medicox["id_propietario"],"nombre,apellido","propietarios","id");?>
        
    <td><? echo $registro["codigo"]; ?></td>
    <td><? echo fechasnormal($registro["fechaNueva"]); ?></td>
    <td><? echo $nombrepropietario["nombre"]; echo " ".$nombrepropietario["apellido"];?></td>
    <td><? echo $registro["nombre"]; echo " ".$registro["apellido"] ?></td>
    <td><? echo $registro["telefono"]; ?></td>
    <td><? echo $registro["email"]; ?></td>
    <td><? echo fechasnormal($registro["fecha_in"]); ?></td>
    <td><? echo fechasnormal($registro["fecha_out"]); ?></td>
    <td><? echo $registro["noches"]; ?></td>
	<td>
    <? echo $registro["monto_diario"]; ?>
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
            
            
            $(document).ready(function(){
                $(".datepicker").datepicker({maxDate: '+0d',changeMonth:true,changeYear:true});
                //$("form input[type=checkbox]").addClass("camposTitle");
            })
            
        function validar_fechas(valor){
               var desde=$("#ordenDesde").val();
                var hasta=$("#ordenHasta").val();
                
                if((desde!='') && (hasta!='')){
                        var desde_dia  =  parseInt(desde.substring(0,2),10);
                        var desde_mes  =  parseInt(desde.substring(3,5),10);
                        var desde_anio =  parseInt(desde.substring(6),10);
                        
                        var hasta_dia  =  parseInt(hasta.substring(0,2),10);
                        var hasta_mes  =  parseInt(hasta.substring(3,5),10);
                        var hasta_anio =  parseInt(hasta.substring(6),10);
                
                    
                        if(hasta_anio<desde_anio){
                            mostrarerrorfechas(); 
                            return false;  
                        }else if(hasta_anio==desde_anio){
                            if(hasta_mes<desde_mes){
                                mostrarerrorfechas(); 
                                return false; 
                            }else if(hasta_mes==desde_mes){
                                if(hasta_dia<desde_dia){
                                    mostrarerrorfechas(); 
                                    return false; 
                                }else{
                                    if(valor=="eliminar"){
                                        verificar_eliminarfechas();
                                    }
                                    if(valor=="buscar"){
                                        return true;
                                    }
                                }
                            }
                        }
                    }else if((desde!='') || (hasta!='')){
                          return true;
                    }
        }
        
         function mostrarerrorfechas (){
             $('#errorvalida').html('<p>Debe introducir un rango de fecha v&aacute;lido</p>');
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
            
         }
         
         function verificar_eliminarfechas(){
             $('#errorvalida').html('<p>�Esta seguro de eliminar todas las cotizaciones en ese rango de fechas?</p>');
        		$("#errorvalida").dialog({
        			resizable:false,
        			bgiframe: true,
        			autoOpen: true,
        			modal: true,
        			buttons: {
                        Aceptar: function() {
                            //alert("eliminadas");
                            eliminarfechas();
                            $(this).dialog('close');
        				},
                        Cancelar: function(){
                            $(this).dialog('close');
                        }                                                                        
        			}
        		});
        	$("#errorvalida").dialog('open');
                     
         }
         
         function eliminarfechas(){
            var desde=$("#ordenDesde").val();
                var hasta=$("#ordenHasta").val();
            
            $.ajax({
			   type: "POST",
			   url: "ajaxs.php",
			     /*beforeSend: function(){
				    $("#loadin").html('<img src="images/ajax-loader.gif">');
				  },*/
			   data: "op=28&ordenDesde="+desde+"&ordenHasta="+hasta+"",
			   complete: function(datos){
			     
                    if(datos.responseText=="1"){
                        $('#errorvalida').html('<p>Las Cotizaciones han sido eliminadas</p>');
                		$("#errorvalida").dialog({
                			resizable:false,
                			bgiframe: true,
                			autoOpen: true,
                			modal: true,
                			buttons: {
                                Ok: function() {
                                    $(this).dialog('close');
                                    window.location.href='index.php?doc=cotizaciones';
                				}                                                                       
                			}
                		});
                	   $("#errorvalida").dialog('open');
                        
                    }else{
                         $('#errorvalida').html('<p>Ha Ocurrido un Error</p>');
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
                        
                    }
    					
			   }
			 });
            
         }
		</script>