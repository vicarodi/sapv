<? session_start();
	include ("includes/conectar.php");
	if($_POST[tipo]==2){
		$quer_selects=mysql_query("Select * from ".$_POST['tabla']." where id_".$_POST['otratabla']."='".$_POST['codigo']."'");?>

			  <option value = ''>----------Seleccione-------</option>
	<?	while($row_select=mysql_fetch_array($quer_selects)){
			echo "<option value='".$row_select[0]."'>".utf8_encode($row_select[2])."</option>";
		}
	}elseif($_POST[tipo]==3){
		$consulta='Select '.$_POST['campo'].' from '.$_POST['tabla'].' where '.$_POST['campo'].' = "'.$_POST['valor'].'"';
//		echo $consulta; die;
		echo mysql_num_rows(mysql_query($consulta));
	}elseif($_POST[tipo]==4){
		$quer_selects=mysql_query("Select ".$_POST['otros']." from ".$_POST['tabla']." where ".$_POST['otratabla']."='".$_POST['codigo']."'");?>

			  <option value = ''>----------Seleccione-------</option>
	<?	while($row_select=mysql_fetch_array($quer_selects)){
			echo "<option value='".$row_select[0]."'>".utf8_encode($row_select[1])."</option>";
		}
	}elseif($_POST['tipo']==5){
	  
       $contenido="<table width='70%' cellspacing='0'>";
        for($i=0;$i<$_POST['habitaciones'];$i++){
           $contenido.="<tr><td width='160px'><strong>Habitaci&oacute;n ".($i+1)."</strong></td><td><select name='tiposHab[]'>";
    	   if($_POST['propiedad']!=""){
    	       $queryHabDorm=mysql_fetch_assoc(mysql_query("select * from propiedad_habitaciones where hab='".($i+1)."' and id_propiedad='".$_POST['propiedad']."'"));
    	   }
           $option=crear_combos21("tipo_camas","id","nombre",$queryHabDorm['id_cama']); 
           $contenido.=$option;
           $contenido.="</select></td></tr>";
        }
        $contenido.="</table>";
        echo $contenido;
	}elseif($_POST['tipo']=='eliminaImagen'){
	   $queryImagen=mysql_fetch_assoc(mysql_query("select * from propiedad_imagenes where id='".$_POST['id']."'"));
         @unlink("images/propiedades/".$queryImagen['ruta_imagen']);
	     mysql_query("delete from propiedad_imagenes where id='".$_POST['id']."'");
         $queryImagenes=mysql_query("select * from propiedad_imagenes where id_propiedad='".$_POST['id_propiedad']."'");
         $numeroImagenes=mysql_num_rows($queryImagenes);
         while($rowIMagenes=mysql_fetch_assoc($queryImagenes)){
            if($v==0){
              echo "<tr>";
              $v++;   
            }
            if($h==0){
              echo "</tr><tr>";  
            }
           
           echo "<td align='center' style='border:1px solid #1C5886' ><table width='100%'>
            <tr>
                <td align='center' height='150px'><img src='thumb.php?ancho=150&alto=150&ruta=images/propiedades/".$rowIMagenes['ruta_imagen']."' />
          </td><tr>
                <td valign='bottom' align='center'><a class='eliminaButton' href='javascript:void(0)' onclick='eliminaImagen(".$rowIMagenes['id'].")'>Eliminar</a></td>
            </tr>
           </table></td>"; 
           $h++;
           if($h==3){
            $h=0;
           }
         }
         echo "</tr>";
	}elseif($_POST['tipo']=='agregaTarifa'){
	  mysql_query("insert into propiedad_tarifas (id_propiedad,precio_diario,precio_mensual,limpieza,fecha_comienzo,fecha_fin) 
      values ('".$_POST['id_propiedad']."','".$_POST['precio_noche']."','".$_POST['precio_mensual']."','".$_POST['fee_limpieza']."','".$_POST['fecha_inicio']."','".$_POST['fecha_fin']."')"); 
	 dameTarifas($_POST['id_propiedad']);
    }elseif($_POST['tipo']=='editaTarifa'){
     mysql_query("update propiedad_tarifas set precio_diario='".$_POST['precio_noche']."',precio_mensual='".$_POST['precio_mensual']."',limpieza='".$_POST['fee_limpieza']."',fecha_comienzo='".$_POST['fecha_inicio']."',fecha_fin='".$_POST['fecha_fin']."' where id='".$_POST['id_tarifa']."'");   
     dameTarifas($_POST['id_propiedad']);
    }elseif($_POST['tipo']=='eliminaTarifa'){
      mysql_query("delete from propiedad_tarifas where id='".$_POST['id']."'");  
      dameTarifas($_POST['id_propiedad']);
    }elseif($_POST['tipo']=='guardaDisponibilidad'){
        mysql_query("insert into propiedades_disponibilidad (id_propiedad,fecha_inicio,fecha_fin) 
      values ('".$_POST['id_propiedad']."','".$_POST['disp_inicio']."','".$_POST['disp_fin']."')");
      dameDisponibilidades($_POST['id_propiedad']); 
    }elseif($_POST['tipo']=='desbloquea'){
      mysql_query("delete from propiedades_disponibilidad where id='".$_POST['id']."'");  
      dameDisponibilidades($_POST['id_propiedad']);   
    }
?>
