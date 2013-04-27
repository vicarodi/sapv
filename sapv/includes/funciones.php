<?
function botones($clase){
	switch ($clase){
		case 'editar':
			$img='editar.png';
			$alt='Modificar registro';
			break;
		case 'eliminar':
			$img='eliminar.png';
			$alt='Eliminar registro';
			break;
        case 'detalles':
			$img='detalles.png';
			$alt='Detalles del registro';
			break;
		case 'aprobar':
			$img='aprobar.png';
			$alt='Aprobar Cotizacion';
			break;
        case 'dinero':
			$img='dinero.png';
			$alt='Abonar dinero a la factura';
			break;
        case 'history':
        	$img='history.png';
			$alt='Ver Historia M&eacute;dica';
			break;
       case 'anular':
        	$img='anular.png';
			$alt='Anular Cotizacion';
			break;     
	}
	$a='<img width="24px" height="24px"  class="botoneria" border="0" src="images/'.$img.'" alt="'.$alt.'" title="'.$alt.'">';
	echo $a;
}
function crea_error($mensaje){
	echo "<div class='ui-state-error ui-corner-all' style='display:none' id='val_max'><span style='float:left' class='ui-icon ui-icon-alert'></span>$mensaje</div>";

}
function creador_boton($tipo,$value,$nombre,$parametro=''){
	echo '<input '.$parametro.' class="ui-state-default ui-corner-all" type="'.$tipo.'" value="'.$value.'" name="'.$nombre.'">';
}
function auditoria($accion,$before='',$after='',$accion_realizada=''){
	mysql_query("insert into auditoria values ('','".date("Y-m-d H:i:s")."','".$accion_realizada."','".$accion."','".$_SESSION['usuario_id']."','".$before."','".$after."')");
}
function devuelve_valor($id,$campo,$tabla,$campow='id'){
	$row_nombre=mysql_fetch_assoc(mysql_query("Select ".$campo." from ".$tabla." where ".$campow."='".$id."'"));
	return $row_nombre;
}
function redireccionador($url){
	header("Location:".$url);
}

function dialogos($tipo){
	if($tipo==1){
		echo '<div id="dialog" title="Registro guardado">
				<p>El registro se ha guardado con &eacute;xito.</p>
			 </div>';
	}elseif($tipo==2){
		echo '<div id="dialog" title="Registro modificado">
				<p>El registro se ha modificado con &eacute;xito.</p>
			 </div>';
	}elseif ($tipo==3){
		echo '<div id="dialog" title="Registro eliminado">
			<p>El registro se ha eliminado con &eacute;xito.</p>
		 </div>';
	}elseif ($tipo==4){
		echo '<div id="dialog" title="Registro no cincide">
			<p>La contraseña actual es incorrecta.</p>
		 </div>';
		}
}
function fechasql($fecha){
	$trozos=explode("/",$fecha);
	return $trozos[2]."-".$trozos[1]."-".$trozos[0];
}
function fechasnormal($fecha){
	if($fecha!=''){
		$trozos=explode("-",$fecha);
		return $trozos[2]."/".$trozos[1]."/".$trozos[0];
	}
}
function titulosPag($valor){
global $colorLineaInf;
    ?>
    <table width="100%">
<tr>    
    <td>         
     <div style="border-bottom: 2px solid <?=$colorLineaInf?>;text-align: left;color:<?=$colorLineaInf?>"><h2><?=$valor?></h2></div>
    </td>
</tr>
</table>
<?  
}
function crear_combos($tabla,$value,$text,$id=''){
    
	$select=mysql_query("Select $value,$text from $tabla order by 2");
	while($row=mysql_fetch_array($select)){
	
		if($id==$row[0]){
			$selected='selected';
		}else{
			$selected='';
		}
		echo "<option $selected value='$row[0]'>$row[1]</option>";
	}
}
function crear_combos21($tabla,$value,$text,$id=''){
	$select=mysql_query("Select $value,$text from $tabla order by 2");
	while($row=mysql_fetch_assoc($select)){
		if($id==$row[$value]){
			$selected='selected';
		}else{
			$selected='';
		}
		$retorna.= "<option $selected value='$row[$value]'>$row[$text]</option>";
	}
    return $retorna;
}
function dame_fecha_proxima($fecha,$i){
	$ano = substr($fecha,6,4);
	$mes = substr($fecha,3,2);
	$dia = substr($fecha,0,2);
	return date('d/m/Y',mktime(0, 0, 0, $mes  , $dia+$i, $ano));
}
	
function edad($edad){
	list($anio,$mes,$dia) = explode("-",$edad);
	$anio_dif = date("Y") - $anio;
	$mes_dif = date("m") - $mes;
	$dia_dif = date("d") - $dia;
	if ($dia_dif < 0 || $mes_dif < 0)
	$anio_dif--;
	return $anio_dif;
}

function calc_edad($fecha_nac){ 
	//Esta funcion toma una fecha de nacimiento  
	//desde una base de datos mysql 
	//en formato aaaa/mm/dd y calcula la edad en números enteros 
	
	$dia=date("j"); 
	$mes=date("n"); 
	$anno=date("Y"); 
	
	//descomponer fecha de nacimiento 
	$dia_nac=substr($fecha_nac, 8, 2); 
	$mes_nac=substr($fecha_nac, 5, 2); 
	$anno_nac=substr($fecha_nac, 0, 4); 

	if($mes_nac>$mes){ 
		$calc_edad= $anno-$anno_nac-1; 
	}else{ 
		if($mes==$mes_nac AND $dia_nac>$dia){ 
			$calc_edad= $anno-$anno_nac-1;  
		}else{ 
			$calc_edad= $anno-$anno_nac; 
		} 
	} 
    if ($calc_edad==$anno){$calc_edad="";}
	return $calc_edad; 
}
function dameTarifas($idPropiedad){
 $queryTarifas=mysql_query("select * from propiedad_tarifas where id_propiedad='".$idPropiedad."'");
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
                        <a href="index3.php?doc=propiedades&accion=tarifas&tipo=editar&propiedad=<?=$idPropiedad?>&idTarifa=<?=$rowTarifas["id"]?>&KeepThis=true&TB_iframe=true&height=220&width=440" class="thickbox deCarga"><?botones('editar');?></a>                     
                        <a href="javascript:void(0)" onclick="eliminarTarifa('<?=$rowTarifas['id']?>')"><?botones('eliminar');?></a>
                <?                   
                    echo "</td>
                        </tr>";
                  } 
                    echo "</table>"; 
                }   
}
function diasDiferencia($fechaDesde,$fhcaHasta){
    //defino fecha 1
    list($ano1,$mes1,$dia1)=explode("-",$fechaDesde);
    //defino fecha 2  
    list($ano2,$mes2,$dia2)=explode("-",$fhcaHasta);
    //calculo timestam de las dos fechas
    $timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1);
    $timestamp2 = mktime(0,0,0,$mes2,$dia2,$ano2);
    //resto a una fecha la otra
    $segundos_diferencia = $timestamp1 - $timestamp2;
    //echo $segundos_diferencia;
    
    //convierto segundos en días
    $dias_diferencia = $segundos_diferencia / (60 * 60 * 24);
    
    //obtengo el valor absoulto de los días (quito el posible signo negativo)
    $dias_diferencia = abs($dias_diferencia);
    
    //quito los decimales a los días de diferencia
    $dias_diferencia = floor($dias_diferencia);
    
    return $dias_diferencia;  
}
function dameDisponibilidades($id_propiedad){
    echo titulosPag("FECHAS RESERVADAS");
    ?>
    <table width="60%">
     <?
         $queryBloqueadas=mysql_query("select * from propiedades_disponibilidad where id_propiedad='".$id_propiedad."' and fecha_fin >='".date("Y-m-d")."' order by fecha_inicio");
         $yes=0;
         if(mysql_num_rows($queryBloqueadas)>0){
            ?>
            <tr>
                <td><strong>Fecha Inicio</strong></td>
                <td><strong>Fecha Fin</strong></td>
                <td><strong>Acciones</strong></td>
            </tr>
            <?
            while($rowBloqueadas=mysql_fetch_assoc($queryBloqueadas)){
				$arregloBloq[$yes]['fecha_inicio']=$rowBloqueadas['fecha_inicio'];
				$arregloBloq[$yes]['fecha_fin']=$rowBloqueadas['fecha_fin'];
            ?>
				<tr>
					<td><?=fechasnormal($rowBloqueadas['fecha_inicio'])?></td>
					<td><?=fechasnormal($rowBloqueadas['fecha_fin'])?></td>
					<td><a href="javascript:void(0)" class="desbloquear" onclick="desbloquearFecha(<?=$rowBloqueadas['id']?>)">Desbloquear</a></td>
				</tr>
            <?
				$yes++;
			} 
         }
        
     ?>
     </table>
     <?=titulosPag("FECHAS DISPONIBLES");?>
     <table width="60%">
     <tr>
                <td><strong>Desde</strong></td>
                <td><strong>Hasta</strong></td>
              
            </tr>
     <?
     //print_r($arregloBloq);
     for($con=0;$con<count($arregloBloq);$con++){
       if($con==0){
           $diasdif=diasDiferencia($arregloBloq[$con]['fecha_inicio'],date("Y-m-d"));
           if($diasdif>0 && $arregloBloq[$con]['fecha_inicio']>date("Y-m-d")){
            ?>
            <tr>
                <td><?=date("d/m/Y")?></td>
                <td><?=dame_fecha_proxima(fechasnormal($arregloBloq[$con]['fecha_inicio']),-1)?></td>
            </tr>
            <?
           }
       }
       
       ?>
       <tr>
       <td><?=dame_fecha_proxima(fechasnormal($arregloBloq[$con]['fecha_fin']),1)?></td>
       <td>
            <? 
              if($arregloBloq[$con+1]['fecha_inicio']!=''){
               echo dame_fecha_proxima(fechasnormal($arregloBloq[$con+1]['fecha_inicio']),(-1));
              }else{
               //echo dame_fecha_proxima(fechasnormal($arregloBloq[$con]['fecha_fin']),30);
               echo "en adelante";
              }
              
            ?>
       </td>
       </tr>
       <?
     }
     ?>
     
     </table>
    <?
}

function habitacion_capacidad(){
	$select=mysql_query("Select * from tipo_camas");
	while($row=mysql_fetch_assoc($select)){

		$retorna.= "<input type='hidden' name='cama_".$row['id']."' id='cama_".$row['id']."' value='".$row['capacidad']."' />";
	}
    return $retorna;
}
function calculaCosto($id_propiedad,$devuelve=1){
 $queryTarifas=mysql_query("select * from propiedad_tarifas where (('".fechasql($_SESSION['llegada'])."' BETWEEN fecha_comienzo and fecha_fin) or ('".fechasql($_SESSION['salida'])."' BETWEEN fecha_comienzo and fecha_fin)) and id_propiedad='".$id_propiedad."' order by precio_diario DESC");
 while($rowTarifas=mysql_fetch_assoc($queryTarifas)){
     $fechaInicio=strtotime($rowTarifas['fecha_comienzo']);
     $fechaFin=strtotime($rowTarifas['fecha_fin']);
     for($ij=$fechaInicio; $ij<=$fechaFin; $ij+=86400){
        $arregloRango[$rowTarifas['id']][]= date("Y-m-d", $ij);
     }
     $arreglosIds[]=$rowTarifas['id'];
     $arreglosDatos[$rowTarifas['id']]['precio_diario']=$rowTarifas['precio_diario'];
     $arreglosDatos[$rowTarifas['id']]['precio_mensual']=$rowTarifas['precio_mensual'];
     $arreglosDatos[$rowTarifas['id']]['limpieza']=$rowTarifas['limpieza'];
    
 }
    $diasTour=diasDiferencia(fechasql($_SESSION['llegada']),fechasql($_SESSION['salida']));
     $fechaInicio=strtotime(fechasql($_SESSION['llegada']));
     $fechaFin=strtotime(fechasql($_SESSION['salida']));
// si hay menos de 30 dias calculo en base al precio diario
    if($diasTour<30){
     $monto=0;
     // recorro cada tarifa dentro de la cual esta el tour
     for($ij=$fechaInicio; $ij<=$fechaFin; $ij+=86400){
        $inicio= date("Y-m-d", $ij);
        for($h=0;$h<count($arreglosIds);$h++){
          if(in_array($inicio,$arregloRango[$arreglosIds[$h]])){
            $monto+=$arreglosDatos[$arreglosIds[$h]]['precio_diario'];
             $limpieza=$arreglosDatos[$arreglosIds[$h]]['limpieza'];
            break;
          }   
        }   
     }   
     
    }else{
        // si hay mas de 30 dias calculo en base al precio mensual
       $queryTarifas=mysql_query("select * from propiedad_tarifas where (('".fechasql($_SESSION['llegada'])."' BETWEEN fecha_comienzo and fecha_fin) or ('".fechasql($_SESSION['salida'])."' BETWEEN fecha_comienzo and fecha_fin)) and id_propiedad='".$id_propiedad."' order by precio_mensual DESC LIMIT 0,1"); 
       $rowMensual=mysql_fetch_assoc($queryTarifas); 
       if($diasTour==30){
        $monto=$rowMensual['precio_mensual'];
       }elseif($diasTour>30 && $diasTour<60){// si hay mas de 30 dias y menos de 60  calculo en base al precio mensual y precio diario
        $monto=$rowMensual['precio_mensual'];
        for($ij=$fechaInicio; $ij<=$fechaFin; $ij+=86400){
        $inicio= date("Y-m-d", $ij);
        for($h=0;$h<count($arreglosIds);$h++){
              if(in_array($inicio,$arregloRango[$arreglosIds[$h]])){
                $monto+=$arreglosDatos[$arreglosIds[$h]]['precio_diario'];
                break;
              }   
            }   
         }   
       }else{
        $restan=$diasTour/30;
        list($entero,$decimal)=explode(".",$restan);
        //echo $entero.",".$decimal." ".$rowMensual['precio_mensual'];die;
        $monto=$rowMensual['precio_mensual']*$entero;
        if($decimal!=""){
          $diasAcalcular=$diasTour-(30*$entero);  
          for($h=0;$h<$diasAcalcular;$h++){
              $monto+=$rowMensual['precio_diario'];
            }   
         }
        }
        $limpieza=$rowMensual['limpieza'];
       }
     if($devuelve==1){
      echo "<strong style='font-size:14px'><br>Precio Por Noche <br>$ ".round($monto/$diasTour)."</strong>";  
     }else{
        return $monto."|@|".round($monto/$diasTour)."|@|".$diasTour."|@|".$limpieza;
     }
     
}
?>