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
           $contenido.="<tr><td width='185px' ><strong>Habitaci&oacute;n ".($i+1)."</strong></td><td><select name='tiposHab[]' onchange='contar_capacidad(this.value)' class='tiposHab'>";
    	   if($_POST['propiedad']!=""){
    	       $queryHabDorm=mysql_fetch_assoc(mysql_query("select * from propiedad_habitaciones where hab='".($i+1)."' and id_propiedad='".$_POST['propiedad']."'"));
    	   }
           $contenido.="<option selected value=''>--Seleccione--</option>";
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
         $queryImagenes=mysql_query("select * from propiedad_imagenes where id_propiedad='".$_POST['id_propiedad']."' order by orden");
         $numeroImagenes=mysql_num_rows($queryImagenes);
         while($rowIMagenes=mysql_fetch_assoc($queryImagenes)){
            if($v==0){
              echo "<tr>";
              $v++;   
            }
            if($h==0){
              echo "</tr><tr>";  
            }
            if($rowIMagenes['imagen_principal']==1){
			$checimg="checked='true'";
			$textimg="Imagen Principal";
			echo "<input type='hidden' name='id_img_princ' id='id_img_princ' value='".$rowIMagenes['id']."'>";
	   }else{
			$checimg="";
			$textimg="Colocar Imagen como Principal";
	   }
	   
       echo "<td align='center' style='border:1px solid #1C5886' >
           <table width='100%'>
		    <tr>
				<td align='right' colspan='2'>
					<div align='right' title='".$textimg."'><input type='radio' ".$checimg." name='imagenprincipal' id='imagenprincipal".$rowIMagenes['id']."' value='".$rowIMagenes['id']."' onclick='img_principal(this.value)' alt='Establecer como Imagen Principal' title='' ></div>
				</td>
			</tr>
            <tr>
                <td align='center'  colspan='2' height='150px'><img src='thumb.php?ancho=150&alto=150&ruta=images/propiedades/".$rowIMagenes['ruta_imagen']."' />
          </td><tr>
                <td valign='bottom' align='center'><a class='eliminaButton' href='javascript:void(0)' onclick='eliminaImagen(".$rowIMagenes['id'].")'>Eliminar</a>
               </td>
                <td align='right'><input type='text' size='3' id='Image_".$rowIMagenes['id']."' value='".$rowIMagenes['orden']."' onchange='cambiaOrdenImage(this.id,this.value)' name='imagen_".$rowIMagenes['id']."' />
                </td>
            </tr>
           </table></td>"; 
           $h++;
           if($h==3){
            $h=0;
           }
         }
         echo "</tr>";
	}elseif($_POST['tipo']=="cambiaOrden"){
		$idImagen=str_replace("Image_", "", $_POST['id']);
		mysql_query("update propiedad_imagenes set orden='".$_POST['valor']."' where id='".$idImagen."'");
		$queryImagenes=mysql_query("select * from propiedad_imagenes where id_propiedad='".$_POST['id_propiedad']."' order by orden");
         $numeroImagenes=mysql_num_rows($queryImagenes);
         while($rowIMagenes=mysql_fetch_assoc($queryImagenes)){
            if($v==0){
              echo "<tr>";
              $v++;   
            }
            if($h==0){
              echo "</tr><tr>";  
            }
            if($rowIMagenes['imagen_principal']==1){
			$checimg="checked='true'";
			$textimg="Imagen Principal";
			echo "<input type='hidden' name='id_img_princ' id='id_img_princ' value='".$rowIMagenes['id']."'>";
	   }else{
			$checimg="";
			$textimg="Colocar Imagen como Principal";
	   }
	   
       echo "<td align='center' style='border:1px solid #1C5886' >
           <table width='100%'>
		    <tr>
				<td align='right' colspan='2'>
					<div align='right' title='".$textimg."'><input type='radio' ".$checimg." name='imagenprincipal' id='imagenprincipal".$rowIMagenes['id']."' value='".$rowIMagenes['id']."' onclick='img_principal(this.value)' alt='Establecer como Imagen Principal' title='' ></div>
				</td>
			</tr>
            <tr>
                <td align='center'  colspan='2' height='150px'><img src='thumb.php?ancho=150&alto=150&ruta=images/propiedades/".$rowIMagenes['ruta_imagen']."' />
          </td><tr>
                <td valign='bottom' align='center'><a class='eliminaButton' href='javascript:void(0)' onclick='eliminaImagen(".$rowIMagenes['id'].")'>Eliminar</a>
                </td>
                <td align='right'><input type='text' size='3' id='Image_".$rowIMagenes['id']."' value='".$rowIMagenes['orden']."' onchange='cambiaOrdenImage(this.id,this.value)' name='imagen_".$rowIMagenes['id']."' />
                
                </td>
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
    }elseif($_POST['op']==25){  //OLVIDO CLAVE
    $valor="";
    //$contrasena=md5($_REQUEST['pass2']);
    $contrasena=$_REQUEST['pass2'];
    $consulta="SELECT * FROM user_list WHERE usuario='".$_REQUEST['user']."' and email='".$contrasena."'";
    $resultado=mysql_query($consulta);
    $totaluser=mysql_num_rows($resultado);
    $arrayuser=mysql_fetch_assoc($resultado);
    if ($totaluser>0){
        $_SESSION['user']=$arrayuser['usuario'];
        $_SESSION['correo']=$arrayuser['email'];
        $valor="1";
    }else{
        $valor="0";
    }
    echo $valor;
}elseif($_POST['op']==26){  // CAMBIO DE CLAVE
    $contrasena=md5($_REQUEST['passnew']);
    $select=mysql_query("update user_list set pass='".$contrasena."' where usuario='".$_REQUEST['user']."' and email='".$_REQUEST['email']."'");
    auditoria("CAMBIO SU CLAVE DE ACCESO DESDE OLVIDO CONTRASE&Ntilde;A: ".$_REQUEST['user'],'','','modificar');
    //echo "update user_list set pass=".$contrasena." where usuario='".$_REQUEST['user']."' and email='".$_REQUEST['pass2']."'";
    echo "1";
}elseif($_POST['op']==27){
	$select=mysql_query("update propiedad_imagenes set imagen_principal='1' where id='".$_REQUEST['id']."'");
	$select2=mysql_query("update propiedad_imagenes set imagen_principal='0' where id_propiedad='".$_REQUEST['id_propiedad']."' and id<>'".$_REQUEST['id']."'");
}elseif($_POST['op']==28){
    
     if($_POST['ordenDesde']!="" && $_POST['ordenHasta']==""){
        $where="where DATE_FORMAT(fecha_registro,'%Y-%m-%d') >= '".fechasql($_POST['ordenDesde'])."'";
    }
    if($_POST['ordenDesde']=="" && $_POST['ordenHasta']!=""){
         $where="where DATE_FORMAT(fecha_registro,'%Y-%m-%d') <= '".fechasql($_POST['ordenHasta'])."'";
    }
    
     if($_POST['ordenDesde']!='' && $_POST['ordenHasta']!=''){
       //$where_aux[]="DATE_FORMAT(fecha_reclamo,'%d/%m/%Y') BETWEEN '".$_POST['ordenDesde']."' and '".$_POST['ordenHasta']."'"; 
		$where="where DATE_FORMAT(fecha_registro,'%Y-%m-%d') BETWEEN '".fechasql($_POST['ordenDesde'])."' and '".fechasql($_POST['ordenHasta'])."'";
      
    }
    
    mysql_query("delete from cotizaciones ".$where."");
    echo 1;
}

?>
