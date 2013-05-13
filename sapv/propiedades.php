<?

$accion='guarda';
$boton="Guardar";
$tipo="reset";
switch ($_GET['accion']){
	case "guarda":
    if($_POST['id_propietario']=='OTRO'){
       mysql_query("insert into propietarios (nombre,apellido,email,telefono) values ('".$_POST['nombre_propietario']."','".$_POST['apellido_propietario']."','".$_POST['email_propietario']."','".$_POST['telefono_propietario']."')");
       $idPropietario=mysql_insert_id();  
    }else{
       $idPropietario= $_POST['id_propietario'];
    }
       
        mysql_query("Insert into propiedades (id_propietario,id_tipo_propiedad,direccion,ciudad,estado,codigo_postal,id_pais,habitaciones,banos,gps,capacidad,km_const,puestos_est,deposito) 
        values ('".$idPropietario."','".$_POST['id_propiedad']."','".$_POST['direccion']."','".$_POST['ciudad']."','".$_POST['estado']."','".$_POST['codigo_postal']."','".$_POST['pais']."','".$_POST['habitaciones']."','".$_POST['banos']."','".$_POST['coordenadas']."','".$_POST['capacidad']."','".$_POST['km_const']."','".$_POST['puestos_est']."','".$_POST['deposito']."')")or die(mysql_error());
        $idUltimo=mysql_insert_id();
        
        $mapaGeneral=$_FILES['mapa_general']['tmp_name'];
        move_uploaded_file($mapaGeneral,$rutaCompleta."images/propiedades/".$idUltimo."_".$_FILES['mapa_general']['name']);
        $mapaCerrado=$_FILES['mapa_cerrado']['tmp_name'];
        move_uploaded_file($mapaCerrado,$rutaCompleta."images/propiedades/".$idUltimo."_".$_FILES['mapa_cerrado']['name']);
          
          
        
        for($i=0;$i<10;$i++){
         if($_FILES['imagenes'.$i]['tmp_name']!=''){
          $mapaadicional=$rutaCompleta."images/propiedades/".$idUltimo."adicionales_".$_FILES['imagenes'.$i]['name'];
          move_uploaded_file($_FILES['imagenes'.$i]['tmp_name'],$mapaadicional);  
          mysql_query("insert into propiedad_imagenes(id_propiedad,ruta_imagen) values('".$idUltimo."','".$idUltimo."adicionales_".$_FILES['imagenes'.$i]['name']."')"); 
         }
          
        }
                     
        for($i=0;$i<count($_POST['servicios']);$i++){
          mysql_query("insert into propiedad_servicios(id_propiedad,id_servicio) values('".$idUltimo."','".$_POST['servicios'][$i]."')");  
        }
        $j=1;
        $capacidad=0;
        foreach($_POST['tiposHab'] as $habitaciones){
          $queryCapacidad=mysql_query("select * from tipo_camas where id='".$habitaciones."'");
          $fetchCapacidad=mysql_fetch_assoc($queryCapacidad);
          $capacidad+=$fetchCapacidad['capacidad'];
          mysql_query("insert into propiedad_habitaciones(id_propiedad,hab,id_cama) values('".$idUltimo."','".$j."','".$habitaciones."')");  
          $j++;
        }
	mysql_query("update propiedades set mapa_general='".$idUltimo."_".$_FILES['mapa_general']['name']."', mapa_cerrado='".$idUltimo."_".$_FILES['mapa_cerrado']['name']."', capacidad='".$capacidad."' where id='".$idUltimo."'")or die(mysql_error());
        $queryUsuarios=mysql_query("select * from user_list where nivel_acceso=1 and ID!=1");
        while($rowUsers=mysql_fetch_assoc($queryUsuarios)){
            mysql_query("insert into propiedad_comision (id_propiedad,id_usuario,comision) values('".$idUltimo."','".$rowUsers['ID']."','".$_POST['comision'.$rowUsers['ID']]."')");
        }
   
    	//Cambiar la palabra propiedades por el nombre de la tabla y los nombres de los campos en la BD que les toco a uds
        auditoria("CREO EL SERVICIO: ".$_POST['nombre'],'',$after,'agregar');
		//cambiar todo lo que dice index.php?doc=propiedades por el el nombre del archivo que les toco por ejemplo si te toco insumos debes poner index.php?doc=insumos y lo demas queda igual
		redireccionador("index.php?doc=propiedades&accion=editar&id=".$idUltimo."&mensaje=1");
		break;
	case "editar":
		//Cambiar la palabra propiedades por el nombre de la tabla en la BD que les toco a uds
		$row_medico=mysql_fetch_assoc(mysql_query("Select * FROM propiedades where id = '".$_GET['id']."'"));
		$accion='modificar';
		$boton="Modificar";
		$tipo="button";
		$onclick="onclick=window.location.href='".$limpiar."'";
		break;
	case "modificar":
       if($_POST['id_propietario']=='OTRO'){
           mysql_query("insert into propietarios (nombre,apellido,email,telefono) values ('".$_POST['nombre_propietario']."','".$_POST['apellido_propietario']."','".$_POST['email_propietario']."','".$_POST['telefono_propietario']."')");
           $idPropietario=mysql_insert_id();  
        }else{
           $idPropietario= $_POST['id_propietario'];
        }
	   //Cambiar la palabra propiedades por el nombre de la tabla, y los nombres de los campos en la BD que les toco a uds
       

        $idUltimo=$_POST['id'];
        if($_FILES['mapa_general']['tmp_name']!=""){
          $mapaGeneral=$_FILES['mapa_general']['tmp_name'];
          move_uploaded_file($mapaGeneral,$rutaCompleta."images/propiedades/".$idUltimo."_".$_FILES['mapa_general']['name']);  
          mysql_query("update propiedades set mapa_general='".$idUltimo."_".$_FILES['mapa_general']['name']."' where id='".$idUltimo."'")or die(mysql_error());
        }
        if($_FILES['mapa_cerrado']['tmp_name']!=""){
         $mapaCerrado=$_FILES['mapa_cerrado']['tmp_name'];
         move_uploaded_file($mapaCerrado,$rutaCompleta."images/propiedades/".$idUltimo."_".$_FILES['mapa_cerrado']['name']);
         mysql_query("update propiedades set mapa_cerrado='".$idUltimo."_".$_FILES['mapa_cerrado']['name']."' where id='".$idUltimo."'")or die(mysql_error());        
        }
        //print($_FILES);die;
        for($i=0;$i<10;$i++){
         if($_FILES['imagenes'.$i]['tmp_name']!=''){
          $mapaadicional=$rutaCompleta."images/propiedades/".$idUltimo."adicionales_".$_FILES['imagenes'.$i]['name'];
          move_uploaded_file($_FILES['imagenes'.$i]['tmp_name'],$mapaadicional);  
          mysql_query("insert into propiedad_imagenes(id_propiedad,ruta_imagen) values('".$idUltimo."','".$idUltimo."adicionales_".$_FILES['imagenes'.$i]['name']."')"); 
         }
          
        }
        //print_r($_POST['servicios']);die;
        mysql_query("delete from propiedad_servicios where id_propiedad='".$idUltimo."'");
        for($i=0;$i<count($_POST['servicios']);$i++){
          mysql_query("insert into propiedad_servicios(id_propiedad,id_servicio) values('".$idUltimo."','".$_POST['servicios'][$i]."')");  
        }
        $j=1;
        mysql_query("delete from propiedad_habitaciones where id_propiedad='".$idUltimo."'");
        foreach($_POST['tiposHab'] as $habitaciones){
            $queryCapacidad=mysql_query("select * from tipo_camas where id='".$habitaciones."'");
          $fetchCapacidad=mysql_fetch_assoc($queryCapacidad);
          $capacidad+=$fetchCapacidad['capacidad'];
          mysql_query("insert into propiedad_habitaciones(id_propiedad,hab,id_cama) values('".$idUltimo."','".$j."','".$habitaciones."')");  
          $j++;
        }
         mysql_query("update propiedades set id_propietario='".$idPropietario."',
        id_tipo_propiedad='".$_POST['id_propiedad']."',
        direccion='".$_POST['direccion']."',
        ciudad='".$_POST['ciudad']."',
        estado='".$_POST['estado']."',
        codigo_postal='".$_POST['codigo_postal']."',
        id_pais='".$_POST['pais']."',
        habitaciones='".$_POST['habitaciones']."',
        banos='".$_POST['banos']."',capacidad='".$capacidad."',
        gps='".$_POST['coordenadas']."',
        capacidad='".$_POST['capacidad']."',
		km_const='".$_POST['km_const']."',puestos_est='".$_POST['puestos_est']."', deposito='".$_POST['deposito']."'
		where id='".$_POST['id']."'")or die(mysql_error());
	    mysql_query("delete from propiedad_comision where id_propiedad='".$idUltimo."'");
        $queryUsuarios=mysql_query("select * from user_list where nivel_acceso=1 and ID!=1");
        while($rowUsers=mysql_fetch_assoc($queryUsuarios)){
            mysql_query("insert into propiedad_comision (id_propiedad,id_usuario,comision) values('".$idUltimo."','".$rowUsers['ID']."','".$_POST['comision'.$rowUsers['ID']]."')");
        }
		auditoria("MODIFICO LOS DATOS DEL SERVICIO: ".$_POST['nombre'],$before,$after,'modificar');
		//cambiar todo lo que dice index.php?doc=propiedades por el el nombre del archivo que les toco por ejemplo si te toco insumos debes poner index.php?doc=insumos y lo demas queda igual
		redireccionador("index.php?doc=propiedades&mensaje=2");
		break;
	case "eliminar":
		//Cambiar la palabra propiedades por el nombre de la tabla en la BD que les toco a uds
		auditoria("ELIMINO AL SERVICIO:".devuelve_valor($_GET['id'],'nombre','propiedades'));
		mysql_query("Delete FROM propiedades where id='".$_GET['id']."'");
		//cambiar todo lo que dice index.php?doc=empresas por el el nombre del archivo que les toco por ejemplo si te toco insumos debes poner index.php?doc=insumos y lo demas queda igual
		redireccionador("index.php?doc=propiedades&mensaje=3");
		break;
        case "tarifas":
        $tipoAccion='agregaTarifa';
        if($_GET['tipo']=="editar"){
            $QUERYTAri=mysql_query("select * from propiedad_tarifas where id='".$_GET['idTarifa']."'");
            $rowTarifa=mysql_fetch_assoc($QUERYTAri);
            $tipoAccion='editaTarifa';
        }
        ?>
         <table width="50%" id="tarifas">
                <tr>
                    <td><strong>Fecha Inicio:</strong></td>
                    <td><input type="text" name="fecha_inicio" value="<?=$rowTarifa['fecha_comienzo']?>" size="10" class="calendarios" /></td>
                </tr>
                <tr>
                    <td><strong>Fecha Fin:</strong></td>
                    <td><input type="text" name="fecha_fin" value="<?=$rowTarifa['fecha_fin']?>" size="10" class="calendarios" /></td>
                </tr>
                <tr>
                    <td><strong>Precio Noche:</strong></td>
                    <td><input type="text" name="precio_noche" value="<?=$rowTarifa['precio_diario']?>" size="10" /><strong>$</strong></td>
                </tr>
                <tr>
                    <td><strong>Precio Mensual:</strong></td>
                    <td><input type="text" name="precio_mensual"  value="<?=$rowTarifa['precio_mensual']?>" size="10"  /><strong>$</strong></td>
                </tr>
                <tr>
                    <td><strong>Fee Limpieza:</strong></td>
                    <td><input type="text" name="fee_limpieza" value="<?=$rowTarifa['limpieza']?>" size="10"  /><strong>$</strong></td>
                </tr>
                <tr>
                <td colspan="2" align="center">
                
                <input type="button" onclick="agregarTarifa()" value="Agregar" />
                <input type="hidden" name="id_tarifa" value="<?=$_GET['idTarifa']?>" />
                </td>
                </tr>
            </table>
            <script>
                  function agregarTarifa(){
                        var envias='';
                        $("#tarifas input").each(function(){
                          envias+=$(this).attr('name')+"="+$(this).val()+"&";  
                        });
                        $.ajax({
                        type: "POST",
                        url: "ajaxs.php",
                        
                        data: envias+"tipo=<?=$tipoAccion?>&id_propiedad=<?=$_GET['propiedad']?>",
                        complete: function(datos){
                          parent.$("#divTarifas").html(datos.responseText);   
                          parent.tb_init('a.deCarga');
                          $("#tarifas").html("<tr><td><div class='ui-state-highlight ui-corner-all' style='margin-top: 20px; padding: 0px 0.7em;'><p><span class='ui-icon ui-icon-info' style='float: left; margin-right: 0.3em;'></span>El registro se ha creado con &eacute;xito</div></td></tr>");             
                        }
                        });  
                    }
                    
                    $(document).ready(function() {
                        
                        $(".calendarios").datepicker({
                           dateFormat:"yy-mm-dd",
                           changeMonth: true,
                           changeYear: true, 
                           maxDate: "+1Y",
                           yearRange: "c-1:c+1",
                          
                            
                        });
                         $(".calendarios").datepicker( $.datepicker.regional[ "es" ] );
			         } );
            </script>
        <?
        die;
        break;
}

?>
<form name="form1" id="formulario" method="post" action="index2.php?doc=propiedades&accion=<?=$accion?>" onsubmit="return validar()" enctype="multipart/form-data">
<input type="hidden" name="id" id="id_propiedad" value="<?=$_GET['id']?>" />
<?titulosPag("GESTION DE PROPIEDADES")?>
	<div id="tabsGeneral">
     <ul>
        
        <li><a href="#frag_Propiedad">Datos de la Propiedad</a></li>
        <li><a href="#frag_disponible">Disponibilad</a></li>
     </ul>

     <div id="frag_Propiedad">
     <?titulosPag("DATOS DEL PROPIETARIO")?>
         <table width="70%">
    <tr>
        <td><strong>Propietario:</strong></td>
        <td>
            <select name="id_propietario" onchange="despliegaDivProp(this.value)">
            <option value="">Seleccione</option>
                <?
                crear_combos("propietarios","id","CONCAT(nombre,' ',apellido) as nombre",$row_medico['id_propietario']);
                ?>
                <option value="OTRO">Nuevo Propietario</option>
            </select>
        </td>
    </tr>
    <tr>
    <td colspan="2">
        <div id="OTRO" style="display: none;">
            <table width="100%">
                <tr>
                    <td><strong>Nombre:</strong></td>
                    <td><input type="text" name="nombre_propietario" title="" /></td>
                </tr>
                <tr>
                    <td><strong>Apellido:</strong></td>
                    <td><input type="text" name="apellido_propietario" title="" /></td>
                </tr>
                <tr>
                    <td><strong>Email:</strong></td>
                    <td><input type="text" name="email_propietario"/></td>
                </tr>
                <tr>
                    <td><strong>Telefono:</strong></td>
                    <td><input class="telefono" type="text" name="telefono_propietario"/></td>
                </tr>
            </table>
        </div>
    </td>
    </tr>
</table>
<?titulosPag("DATOS DE LA PROPIEDAD")?>
<table width="70%">
    <tr>
        <td><strong>Tipo propiedad:</strong></td>
        <td>
        <select name="id_propiedad">
        <?
        crear_combos("tipo_propiedad","id","nombre",$row_medico['id_propiedad']);
        ?>
        </select>
        </td>
    </tr>
    <tr>
        <td><strong>Direcci&oacute;n:</strong></td>
        <td><textarea name="direccion" title="Direccion"><?=$row_medico['direccion']?></textarea></td>
    </tr>
    <tr>
        <td><strong>Ciudad:</strong></td>
        <td><input type="text" name="ciudad" title="Ciudad" value="<?=$row_medico['ciudad']?>" /></td>
    </tr>
    <tr>
        <td><strong>Estado:</strong></td>
        <td><input type="text" name="estado" value="<?=$row_medico['estado']?>" title="Estado"/></td>
    </tr>
    <tr>
        <td><strong>C&oacute;digo Postal:</strong></td>
        <td><input type="text" name="codigo_postal" value="<?=$row_medico['codigo_postal']?>" title="Codigo Postal"/></td>
    </tr>
    <tr>
        <td><strong>Pais:</strong></td>
        <td>
         <select  name="pais" title="Pais">
            <option value="">Seleccione</option>
                <?
                crear_combos("pais","countries_id","countries_name",$row_medico['id_pais']);
                ?>
          </select>
        </td>
    </tr>
    <tr>
        <td><strong>Habitaciones:</strong></td>
        <td>
        <select name="habitaciones" title="Habitaciones" onchange="traeHab(this.value)">    
        <?
        for($i=0;$i<=5;$i++){
            if($row_medico['habitaciones']==$i){
             echo "<option selected value='".$i."'>".$i."</option>";   
            }else{
              echo "<option value='".$i."'>".$i."</option>";   
            }
            
        }
        ?>
        </select>
        <div>
            <? 
                echo habitacion_capacidad();
            ?>
        </div>
        </td>
    </tr>
    <tr>
    <td colspan="2" id="habitaciones_div">
    
    </td>
    </tr>
    <tr>
        <td>
            <strong>Capacidad:</strong>
        </td>
        <td>
            <input type="text" name="capacidad" id="capacidad" value="<?=$row_medico['capacidad']?>" size="1px" maxlength="2" title="Capacidad"/>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Dep&oacute;sito:</strong>
        </td>
        <td>
            <input type="text" name="deposito" id="deposito" value="<?=$row_medico['deposito']?>" title="Deposito"/>
        </td>
    </tr>
     <tr>
        <td><strong>Ba&ntilde;os:</strong></td>
        <td>
        	
        <select name="banos" title="Ba&ntilde;os">    
	        <?
	         for($i=1;$i<=5;$i++){
	         	$variable=$i." 1/2";
	            if($row_medico['banos']==$variable){
	              echo "<option value='".$i."'>".$i."</option>";  
	              echo "<option selected value='".$i." 1/2'>".$i." 1/2</option>";  
	            }elseif($row_medico['banos']==$i){
	              echo "<option selected value='".$i."'>".$i."</option>";   
	              echo "<option value='".$i." 1/2'>".$i." 1/2</option>";
	            }else{
	              echo "<option value='".$i."'>".$i."</option>";  
	              echo "<option value='".$i." 1/2'>".$i." 1/2</option>";    
	    		}
	        }
        ?>
        </select>
        </td>
    </tr>
    <tr>
        <td><strong>Coordenadas GPS:</strong></td>
        <td><input type="text" name="coordenadas" value="<?=$row_medico['gps']?>" title="Coordenadas GPS"/></td>
    </tr>
    <tr>
        <td><strong>Metros Cuadrados:</strong></td>
        <td><input type="text" name="km_const" id="km_const" value="<?=$row_medico['km_const']?>" title="Km2 Construcci&oacute;n"/></td>
    </tr>
	    <tr>
        <td><strong>P. de Estacionamiento:</strong></td>
        <td><input type="text" name="puestos_est" id="puestos_est" value="<?=$row_medico['puestos_est']?>" title="Puestos de Estacionamiento"/></td>
    </tr>
</table>
	<div id="tabs" style="width: 80%;">
     <ul>
        <li><a href="#frag_servicios">Servicios</a></li>
        <li><a href="#frag_imagenes">Imagenes</a></li>
        <li><a href="#frag_tarifas">Tarifas y Comisiones</a></li>
     </ul>
     <div id="frag_servicios">
     <table width="70%">
         <?
         $x=0;
         $y=0;
         $serviciosUsados=mysql_query("select * from propiedad_servicios where id_propiedad='".$_GET['id']."'");
         while($row_services=mysql_fetch_assoc($serviciosUsados)){
            $arregloServicios[]=$row_services['id_servicio'];
         }
         //print_r($arregloServicios);
         $query=mysql_query("select * from servicios where st=1 order by nombre");
         while($rowServicios=mysql_fetch_assoc($query)){
           
           if($x==0 &&  $y!=0 ){
            echo "</tr><tr>";
           }
           if($y==0){
             echo "<tr>";
             $y++;
           }
           $x++;
           $checked='';
           if(is_array($arregloServicios)){
            if(in_array($rowServicios['id'],$arregloServicios)){
                $checked='checked';
            }
           }
            ?>       
            <td><input type="checkbox" <?=$checked?> name="servicios[]" value="<?=$rowServicios['id']?>" /> <?=$rowServicios['nombre']?></td>
            <?
            if($x==3){
              $x=0;  
            }
         }
         ?>
         </tr>
     </table>
     </div>
     <div id="frag_imagenes">
     <?=titulosPag("IMAGENES DE UBICACION")?>
     <table width="60%">
     <tr>
        <td><strong>Mapa General:</strong></td>
        <td><input type="file" name="mapa_general"/></td>
        </tr>
    
        <?
        if($row_medico['mapa_general']!=""){
          ?> <tr>
          <td align="center" colspan="2"><img src="thumb.php?ancho=200&alto=200&ruta=images/propiedades/<?=$row_medico['mapa_general']?>"/></td>
          </tr>
          <?  
        }
        ?>
     
     <tr>
        <td><strong>Mapa Cerrado:</strong></td>
        <td><input type="file" name="mapa_cerrado"/></td>     
        </tr>
         <?
        if($row_medico['mapa_cerrado']!=""){
          ?>
           <tr>
          <td align="center" colspan="2"><img src="thumb.php?ancho=200&alto=200&ruta=images/propiedades/<?=$row_medico['mapa_cerrado']?>"/></td>
          </tr>
          <?  
        }
        ?>
     </table>
     <?=titulosPag("IMAGENES DE LA PROPIEDAD")?>
     <table id="idImagenes" border="0">
     <?
     $h="";
     $v=0;
     $queryImagenes=mysql_query("select * from propiedad_imagenes where id_propiedad='".$_GET['id']."'");
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
				<td align='right'>
					<div align='right' title='".$textimg."'><input type='radio' ".$checimg." name='imagenprincipal' id='imagenprincipal".$rowIMagenes['id']."' value='".$rowIMagenes['id']."' onclick='img_principal(this.value)' alt='Establecer como Imagen Principal' title='' ></div>
				</td>
			</tr>
            <tr>
                <td align='center' height='150px'><img src='thumb.php?ancho=150&alto=150&ruta=images/propiedades/".$rowIMagenes['ruta_imagen']."' /></td>
            </tr>
            <tr>
                <td valign='bottom' align='center'><a class='eliminaButton' href='javascript:void(0)' onclick='eliminaImagen(".$rowIMagenes['id'].")'>Eliminar</a></td>
            </tr>
           </table>
            </td>"; 
       $h++;
       if($h==3){
        $h=0;
       }
     }
     echo "</tr>";
     ?>
     
     </table>
     <table align="center" width="80%">
     <tr>
         <td align="center">
         <?
         $style='';
         if($numeroImagenes==10){
            $style="style='display:none'";
         }
         ?>
         <a id="enlaceIMagene" href="javascript:void(0)" onclick="agragFile()" <?=$style?>><strong>Agregar M&aacute;s im&aacute;genes</strong></a></td>
     </tr>
     <tr>
        <td id="inputsImagenes">
        <?
        for($i=0;$i<10;$i++){
        ?>
        <div id="div<?=$i?>" style="display: none;"><input type="file" class="fileinput" name="imagenes<?=$i?>" /> <a href="javascript:void(0)"  class='eliminaButton'  onclick="eliminaDiv('div<?=$i?>')">Eliminar</a></div>
        <?
        }
        ?>
        </td>
     </tr>
     </table>
     </div>
     <div id="frag_tarifas">
     <?=titulosPag("TARIFAS")?>
     <?
     if($_GET['id']==''){
        ?>
        <table width="100%" align="center">
            <tr><td align="center">Debe guardar los datos generales de la propiedad</td></tr>
        </table>
        <?
     }else{
        ?>
         <a href="index3.php?doc=propiedades&accion=tarifas&propiedad=<?=$_GET['id']?>&KeepThis=true&TB_iframe=true&height=220&width=440" class="thickbox"><button id="agTar">Agregar Tarifa</button></a>  
         <div id="divTarifas">
            <?
                $queryTarifas=mysql_query("select * from propiedad_tarifas where id_propiedad='".$_GET['id']."'");
                if(mysql_num_rows($queryTarifas)>0){
                    echo "<table width='100%'>";
                     echo "<tr>
                        <td><strong>Fecha Inicio</strong></td>
                        <td><strong>Fecha Fin</strong></td>
                        <td><strong>Precio Noche</strong></td>
                        <td><strong>Precio Mensual</strong></td>
                        <td><strong>Fee Limpieza</strong></td>
                        <td><strong>Acciones</strong></td>
                        </tr>";
                  while($rowTarifas=mysql_fetch_assoc($queryTarifas)){
                   echo "<tr>
                        <td>".fechasnormal($rowTarifas['fecha_comienzo'])."</td>
                        <td>".fechasnormal($rowTarifas['fecha_fin'])."</td>
                        <td>$ ".$rowTarifas['precio_diario']."</td>
                        <td>$ ".$rowTarifas['precio_mensual']."</td>
                        <td>$ ".$rowTarifas['limpieza']."</td>
                        <td>";
                        ?>
                        <a class="thickbox editaList" href="index3.php?doc=propiedades&accion=tarifas&tipo=editar&propiedad=<?=$_GET['id']?>&idTarifa=<?=$rowTarifas["id"]?>&KeepThis=true&TB_iframe=true&height=220&width=440">Editar</a>                     
                        <a class='eliminaButton' href="javascript:void(0)" onclick="eliminarTarifa('<?=$rowTarifas['id']?>')">Eliminar</a>
                <?                   
                    echo "</td>
                        </tr>";
                  } 
                    echo "</table>"; 
                }
                
            ?>
         </div>
        <?
     }
     ?>
     
     <?=titulosPag("COMISIONES POR VENTAS")?>
     <table width="40%">
        <?
        $queryUsuarios=mysql_query("select * from user_list where nivel_acceso=1 and ID!=1");
        while($rowUsers=mysql_fetch_assoc($queryUsuarios)){
            $fetcUser=mysql_fetch_assoc(mysql_query("select * from propiedad_comision where id_propiedad='".$_GET['id']."' and id_usuario='".$rowUsers['ID']."'"));
           ?>
           <tr>
            <td><strong><?=$rowUsers['nombre']?>:</strong></td>
            <td>
            <select name="comision<?=$rowUsers['ID']?>">
            <?
            
            for($i=0;$i<=30;$i+=5){
                $selected='';
                if($fetcUser['comision']==$i){
                    $selected='selected';
                }
              ?>
              <option <?=$selected?> value="<?=$i?>"><?=$i?></option>
              <?  
            }
            ?>
            </select> <strong>%</strong>
            </td>
           </tr>
           <? 
        }
        
        ?>
     </table>
     </div>
    </div>
     </div>
     <div id="frag_disponible">
     <?
     if($_GET['id']!=""){
        ?>
             <table id="disponibilidad">
         <tr>
            <td><strong>Desde:</strong></td>
            <td><input type="text" size="10" id="disp_inicio" name="disp_inicio" class="calendarios21"/></td>
           </tr>
         <tr>
            <td><strong>Hasta:</strong></td>
            <td><input type="text" size="10" id="disp_fin" name="disp_fin" class="calendarios21"/></td>
         </tr>
         <tr>
            <td colspan="4" align="center">
            <input type="button" value="Bloquear" onclick="guardaDisp()" />
            </td>
         </tr>
     </table>
     <div id="listaDisponibilidad">
     <?
     dameDisponibilidades($_GET['id']);
     ?>
     </div>
        <?
     }else{
        ?>
        <div align="center">Debe Guardar los datos generales de la propiedad</div>
        <?
     }
     ?>

     </div>
     </div>


<table class="general">
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

		$sql="SELECT propiedades.id as idPropiedad,propiedades.*,propietarios.*, tipo_propiedad.nombre as tipoProp FROM tipo_propiedad inner join propiedades on tipo_propiedad.id=id_tipo_propiedad inner join propietarios on propietarios.id = id_propietario ";
		$res=mysql_query($sql) or die(mysql_error());
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

    <td>
        <table>
            <tr>
                <td align="center" width="150px">
                    <?
                        $queryRandom=mysql_fetch_assoc(mysql_query("select * from propiedad_imagenes where id_propiedad='".$registro['idPropiedad']."' and imagen_principal=1 "));//order by RAND()
                    if($queryRandom['ruta_imagen']!=""){
                        ?>
                        <img src='thumb.php?ancho=150&alto=150&ruta=images/propiedades/<?=$queryRandom['ruta_imagen']?>' />
                        <?
                    }
                    ?>
                </td>
                <td align="left">
                <?
                    echo $registro['tipoProp']."<br>";
                    echo $registro['capacidad']." Personas<br>";
                    echo $registro['nombre']." ".$registro['apellido']."<br>";
                    echo $registro['email']."<br>";
                    echo $registro['telefono']."<br>";
                ?>
                </td>
            </tr>
        </table>
    
    </td>
	<td>
<!--cambiar todo lo que dice index2.php?doc=propiedades por el el nombre del archivo que les toco por ejemplo si te toco insumos debes poner index.php?doc=insumos y lo demas queda igual-->

<a href="index.php?doc=propiedades&accion=editar&id=<?=$registro["idPropiedad"]?>"><?botones('editar');?></a>
<!--cambiar todo lo que dice index2.php?doc=propiedades por el el nombre del archivo que les toco por ejemplo si te toco insumos debes poner index.php?doc=insumos y lo demas queda igual-->

<a href="javascript:void(0)" onclick="eliminar('index2.php?doc=propiedades&accion=eliminar&id=<?=$registro["id"]?>')"><?botones('eliminar');?></a>
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

</script>
<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#listado').dataTable( {
					"bJQueryUI": true,
					"sPaginationType": "full_numbers"
				} );
                	$('#tabs').tabs();
                    $('#tabsGeneral').tabs();
                    
                    $(".calendarios").datepicker({
                        showMonth:true
                        
                    });
			} );
            function despliegaDivProp(div){
                if(div=='OTRO'){
                  $("#OTRO").slideDown("slow");  
                }else{
                  $("#OTRO").slideUp("slow");  
                }
               
               
            }
      
            $(document).ready(function(){
               <?
               if($row_medico['habitaciones']!=""){
                ?>
                    traeHab(<?=$row_medico['habitaciones']?>,<?=$_GET['id']?>);
                <?
               }
               ?> 
            });
var divnumber=<?=$numeroImagenes?>;
            function agragFile(){
                
               //var cadena='<div id="div'+divnumber+'"><input type="file" class="fileinput" name="imagenes[]" /> <a href="javascript:void(0)" onclick="eliminaDiv(\'div'+divnumber+'\')">Eliminar</a></div>'; 
            //$("#inputsImagenes").append(cadena);
            //$("input.fileinput").uniform();
            $("#div"+divnumber).show();
            divnumber++;
            if(divnumber==10){
                $("#enlaceIMagene").hide();
            }
            }
            function eliminaDiv(div){
                $("#"+div).hide();
                divnumber--;
                $("#enlaceIMagene").show();
            }
            function eliminaImagen(id_imagen){
                var id_propiedad='<?=$_GET['id']?>';
              $.ajax({
                type: "POST",
                url: "ajaxs.php",
                beforeSend: function(){
                    $("#idImagenes").html('<img src="images/ajax-loader.gif">');
                },
                
                data: "tipo=eliminaImagen&id_propiedad="+id_propiedad+"&id="+id_imagen,
                complete: function(datos){
                    $("#idImagenes").html(datos.responseText);
                    divnumber--;
                    $("#enlaceIMagene").show();   
                    $(".eliminaButton").button({
      icons: {
        primary: "ui-icon-trash"
      },
text: false
    });                 
                }
                });  
            }
            
            function guardaDisp(){
                
           var envias='';
                        $("#disponibilidad input[type='text']").each(function(){
                          envias+=$(this).attr('name')+"="+$(this).val()+"&"; 
                          $(this).val(''); 
                        });
                        $.ajax({
                        type: "POST",
                        url: "ajaxs.php",
                        
                        data: envias+"tipo=guardaDisponibilidad&id_propiedad=<?=$_GET['id']?>",
                        complete: function(datos){
                            $("#listaDisponibilidad").html(datos.responseText);
                              $(".desbloquear").button({
                                      icons: {
                                        primary: "ui-icon-unlocked"
                                      }
                                    });
                         }
                        });  
                    }
                    
                    $(document).ready(function() {
                        
                        
                         //$(".calendarios21").datepicker( $.datepicker.regional[ "es" ] );
                         $("#disp_fin").datepicker({
                           dateFormat:"yy-mm-dd",
                           changeMonth: true,
                           changeYear: true, 
                           maxDate: "+1Y",
                           yearRange: "c-1:c+1",
                          minDate:"+3D"
                            
                        });
                        
                        $("#disp_inicio").datepicker({
                        	dateFormat:"yy-mm-dd",
                           changeMonth: true,
                           changeYear: true, 
                           maxDate: "+1Y",
                           yearRange: "c-1:c+1",
                          minDate:"+3D",
                          onClose: function( selectedDate ) {
        					$("#disp_fin").datepicker( "option", "minDate", selectedDate );	
                        }
                        });
			         } );
            function traeHab(valor,id_propiedad){
                $.ajax({
                type: "POST",
                url: "ajaxs.php",
                beforeSend: function(){
                $("#habitaciones_div").html('<img src="images/ajax-loader.gif">');
                },
                
                data: "tipo=5&propiedad="+id_propiedad+"&habitaciones="+valor,
                complete: function(datos){
                    $("#habitaciones_div").html(datos.responseText);
                    }
                });
            }
            function traecapacidad(){
                
            }
            function eliminarTarifa(idTarifa){
                	$("#dialog2").dialog({
            			bgiframe: true,
            			autoOpen: true,
            
            			modal: true,
            			buttons: {
            				Si: function() {
            					$(this).dialog('close');
            					$.ajax({
                                type: "POST",
                                url: "ajaxs.php",
                                beforeSend: function(){
                                $("#divTarifas").html('<img src="images/ajax-loader.gif">');
                                },
                                
                                data: "tipo=eliminaTarifa&id_propiedad=<?=$_GET['id']?>&id="+idTarifa,
                                complete: function(datos){
                                    $("#divTarifas").html(datos.responseText);
                                    tb_init('a.deCarga');
                                    }
                                });
            				},
            				No: function() {
            					$(this).dialog('close');
            				}
            			}
            
            		});
            	$("#dialog2").dialog('open');

            }
            function desbloquearFecha(id){
                $("#dialog2").dialog({
            			bgiframe: true,
            			autoOpen: true,
            
            			modal: true,
            			buttons: {
            				Si: function() {
            					$(this).dialog('close');
            					$.ajax({
                                type: "POST",
                                url: "ajaxs.php",
                                beforeSend: function(){
                                $("#listaDisponibilidad").html('<img src="images/ajax-loader.gif">');
                                },
                                
                                data: "tipo=desbloquea&id_propiedad=<?=$_GET['id']?>&id="+id,
                                complete: function(datos){
                                    
                                    $("#listaDisponibilidad").html(datos.responseText);
                                    $(".desbloquear").button({
                                      icons: {
                                        primary: "ui-icon-unlocked"
                                      }
                                    });
                                                                    
                                   }
                                });
            				},
            				No: function() {
            					$(this).dialog('close');
            				}
            			}
            
            		});
            	$("#dialog2").dialog('open');
            }
  $(document).ready(function(){
    $("#agTar").button({
      icons: {
        primary: "ui-icon-plusthick"
      }
    });
    $(".desbloquear").button({
      icons: {
        primary: "ui-icon-unlocked"
      }
    });
    $(".editaList").button({
      icons: {
        primary: "ui-icon-pencil"
      },
text: false
    });
    $(".eliminaButton").button({
      icons: {
        primary: "ui-icon-trash"
      },
text: false
    });
    $("#enlaceIMagene").button({
      icons: {
        primary: "ui-icon-image"
      }
    });
  });
  
  function img_principal(valor){
		//alert(valor);
		var id_propiedad=$("#id_propiedad").val();
		if(confirm("Desea colocar esta imagen como Principal?")){
			//alert('imagen principal');
			$.ajax({
			   type: "POST",
			   url: "ajaxs.php",
			     beforeSend: function(){
				    //$("#loadin").html('<img src="images/ajax-loader.gif">');
				  },

			   data: "op=27&id="+valor+"&id_propiedad="+id_propiedad+"",
			   complete: function(datos){
				 /*$("#loadin").html('');
			   	if(datos.responseText==0){
			   		 $("#mensaje").slideDown("fast");
			   		 $("#mensaje").html("<p><span class='ui-icon ui-icon-alert' style='float: left; margin-right: 0.3em;'></span><b>Nombre de usuario o contrase&ntilde;a incorrecta</b>");
			   	}else if(datos.responseText==1){
			   		window.location.href='index.php?doc=propiedades';
			   	}*/
					$("#id_img_princ").val(valor);
			   }
			 });
		}else{
			//buscar quien esta checado y dejarlo checado
			var id_img_princ=$("#id_img_princ").val();
			$("#imagenprincipal"+id_img_princ).attr("checked","checked");
		}
		//$.("#imagenprincipal"+valor)
  }
  
  function contar_capacidad(valor){
        //alert(valor);
        var acumulador=0;
        
        $('.tiposHab').each(function (i) {
            
            if($(this).val()!=""){
                acumulador+=parseInt($("#cama_"+$(this).val()).val());
            }
            
    
    	});
        //alert(acumulador);
        $("#capacidad").val(acumulador);
    
  }
		</script>