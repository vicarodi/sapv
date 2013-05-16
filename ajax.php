<? session_start();
include ("conectar.php");
require_once("sapv/includes/funciones.php");
function enviaMail($mensaje,$email,$ruta,$from,$asuntos){
	include("phpmailer/class.phpmailer.php");
	$mail= new PHPMailer(); // defaults to using php "mail()"
	//$mail->IsSMTP(); // telling the class to use SMTP
	$body= $mensaje;
	$mail->AddReplyTo($from,"");  
	$mail->SetFrom($from,"Renting Florida");
	if($from!=""){
		$mail->Addcc($from, "");
	}
	$address = $email;
	$mail->AddAddress($address, "");
	$mail->Subject    = $asuntos;
	$mail->MsgHTML($body);
	if($ruta!=''){
		$mail->AddAttachment($ruta);     
	}	
	if($mail->Send()){
		echo "se envio";
	}else{
		echo $mail->ErrorInfo;
	}
}
switch ($_POST['accion']){
    case "buscaDisp":
        
        $_SESSION['llegada']=$_POST['llegada'];
        $_SESSION['salida']=$_POST['salida'];
        $_SESSION['adultos']=$_POST['adultos'];
        $_SESSION['ninos']=$_POST['ninos'];
        $totalPe=$_POST['adultos']+$_POST['ninos'];
        $setPropiedades=mysql_query("SELECT propiedades.id as idPropiedad,propiedades.*, tipo_propiedad.nombre as tipoProp FROM tipo_propiedad inner join propiedades on tipo_propiedad.id=id_tipo_propiedad where capacidad>='".$totalPe."'");
        $restanDiasV=diasDiferencia(fechasql($_POST['llegada']),fechasql($_POST['salida']));
            for($j=0;$j<=$restanDiasV;$j++){
              $arregloEle[]=dame_fecha_proxima($_POST['llegada'],$j);
            }
        ?>
        <table width="98%" style="font-family: Arial;font-size: 14px;margin-left: 5px;">
        <tr>
        <td colspan="5" align="right"><strong>PROPIEDADES DISPONIBLES</strong><br />del <strong><?=$_POST['llegada']?></strong> al <strong><?=$_POST['salida']?></strong>, <?=$_POST['adultos']?> Adultos, <?=$_POST['ninos']?> Ni&ntilde;os</td>
        </tr>
        <?
        while($registro=mysql_fetch_assoc($setPropiedades)){
            ?>
            <!-- <tr>
             <td>
                <table style="font-family: Arial;font-size: 14px;" border="1">-->
                    <tr>
                        <td align="center" width="150px">
                           <?
                            $queryRandom=mysql_fetch_assoc(mysql_query("select * from propiedad_imagenes where id_propiedad='".$registro['idPropiedad']."'  and imagen_principal=1"));
                            if($queryRandom['ruta_imagen']!=""){
                                ?>
                                <img src='sapv/thumb.php?ancho=150&alto=150&ruta=images/propiedades/<?=$queryRandom['ruta_imagen']?>' />
                                <?
                            }
                           ?>
                        </td>
                        <td align="left" width="150px">
                        <?
                        if($registro['km_const']==""){
                            $km_const='0';
                        }else{
                            $km_const=$registro['km_const'];
                        }
                            echo "<strong>".$registro['tipoProp']."</strong> ".$km_const." m2<br>";
                            echo $registro['capacidad']." Personas<br>";
                            echo "Ubic ".$registro['ciudad'].", ".$registro['estado']."<br>";
                        ?>
                        </td>  
                        <td align="left" style="font-family: Arial;font-size: 12px;" width="200px">
                      <?
                      $queryBloqueadas=mysql_query("select * from propiedades_disponibilidad where id_propiedad='".$registro['idPropiedad']."' order by fecha_inicio");
                       $i=0;
                       $arreglo=array();
                       $yes=0;
                       while($rowBloqueadas=mysql_fetch_assoc($queryBloqueadas)){
                        $arregloBloq[$yes]['fecha_inicio']=$rowBloqueadas['fecha_inicio'];
                        $arregloBloq[$yes]['fecha_fin']=$rowBloqueadas['fecha_fin'];
                        $restan=diasDiferencia($rowBloqueadas['fecha_fin'],$rowBloqueadas['fecha_inicio']);
                        for($j=0;$j<=$restan;$j++){
                          $arreglo[$i][$j]=dame_fecha_proxima(fechasnormal($rowBloqueadas['fecha_inicio']),$j);
                        }
                        $i++;
                        $yes++;
                       }
                       $nodisponible=0;
                      if(count($arreglo)==0){
                        echo "<strong>DISPONIBLE</strong>"; 
                        $_SESSION['cotiza'][$registro['idPropiedad']]=1;  
                      }else{
                        
                        for($h=0;$h<count($arreglo);$h++){
                           for($i=0;$i<count($arregloEle);$i++){
                               if(in_array($arregloEle[$i],$arreglo[$h])){
                                $nodisponible=1;
                                break;
                               } 
                           } 
                        }
                        if($nodisponible==0){
                          echo "<strong>DISPONIBLE</strong>"; 
                          $_SESSION['cotiza'][$registro['idPropiedad']]=1;  
                        }else{
                          echo "<div style='color:#CE2A1D'><strong>NO DISPONIBLE</strong> para el per&iacute;odo seleccionada del ".$_POST['llegada']." al ".$_POST['salida']."</div><br><strong>Disponibilidad</strong>";
                          $_SESSION['cotiza'][$registro['idPropiedad']]=0;  
                          ?>
   <table width="100%" style="font-size: 12px;" border="0">
     <?
     for($con=0;$con<count($arregloBloq);$con++){
       if($con==0){
           $diasdif=diasDiferencia($arregloBloq[$con]['fecha_inicio'],date("Y-m-d"));
           if(($diasdif>0) && ($arregloBloq[$con]['fecha_inicio']>date("Y-m-d"))){
            ?>
            <tr>
                <td>Del <?=date("d/m/Y")?> al <?=dame_fecha_proxima(fechasnormal($arregloBloq[$con]['fecha_inicio']),-1)?></td>
            </tr>
            <?
           }
       }
       if($arregloBloq[$con]['fecha_fin']>date("Y-m-d")){
       ?>
       <tr>
       <td>Del <?=dame_fecha_proxima(fechasnormal($arregloBloq[$con]['fecha_fin']),1)?> al 
            <? 
              if($arregloBloq[$con+1]['fecha_inicio']!=''){
               echo dame_fecha_proxima(fechasnormal($arregloBloq[$con+1]['fecha_inicio']),(-1));
              }else{
               echo "En adelante";
              }
              
            ?>
       </td>
       </tr>
       <?
       }
     }
     ?></table>
                          <?  
                        }
                      }
                      ?>
                        </td>
                        <td width="5%"><a class="boton" href="propiedades.php?id=<?=$registro['idPropiedad']?>">Detalle</a></td>
                        
                        <td width="5%">
                        <?
                        if($nodisponible==0){
                            ?>
                            <a class="boton" href="order_confirmation.php?id=<?=$registro['idPropiedad']?>">Cotizar</a>
                            <?
                        }
                        ?>
                        </td>
                    </tr>
                <!--</table>-->
                <?
            }
            ?>
            </table><br />
            </td>
            
            </tr>
        <?
    break;

    case "creaCoti":
		$privatekey = "6LcOzuASAAAAACX4B88Prsu9A2h-grkwDnLBiIwN";
		$resp = recaptcha_check_answer ($privatekey,
		                                $_SERVER["REMOTE_ADDR"],
		$_POST["recaptcha_challenge_field"],
		$_POST["recaptcha_response_field"]);
		
		if (!$resp->is_valid) {
		echo 0;
		} else {

        $queyCliente=mysql_query("select * from clientes where email='".$_POST['email']."'");
        if(mysql_num_rows($queyCliente)>0){
            $rowCliente=mysql_fetch_assoc($queyCliente); 
            $id_cliente=$rowCliente['id'];
        }else{
            mysql_query("insert into clientes (nombre,apellido,email,telefono) values ('".$_POST['nombre']."','".$_POST['apellido']."','".$_POST['email']."','".$_POST['telefono']."')"); 
            $id_cliente=mysql_insert_id();
        }
        $fetchIds=mysql_num_rows(mysql_query("select * from cotizaciones where DATE_FORMAT(fecha_registro,'%Y-%m-%d') = '".date("Y-m-d")."'"));
        //echo $fetchIds;
        $codigo=date("dmY")."-".($fetchIds+1);
        list($montoTotal,$montoDiario,$noches,$limpieza)=explode("|@|",calculaCosto($_POST['id_Propiedad'],2));
        mysql_query("insert into cotizaciones (codigo,id_cliente,fecha_in,fecha_out,monto_diario,monto_total,limpieza,adultos,fecha_registro,st,ninos,nombre,apellido,email,telefono,id_propiedad,noches) 
        values ('".$codigo."','".$id_cliente."','".fechasql($_SESSION['llegada'])."','".fechasql($_SESSION['salida'])."','".$montoDiario."','".$montoTotal."','".$limpieza."','".$_SESSION['adultos']."','".date("Y-m-d H:i:s")."',0,'".$_SESSION['ninos']."','".$_POST['nombre']."','".$_POST['apellido']."','".$_POST['email']."','".$_POST['telefono']."','".$_POST['id_Propiedad']."','".$noches."')");
        unset($_SESSION['cotiza']);
        unset($_SESSION['llegada']);
        unset($_SESSION['salida']);
        unset($_SESSION['adultos']);
        unset($_SESSION['ninos']);
        $id_cotizcacion=mysql_insert_id();
		$mensaje="Estimado (a) ".$_POST['nombre']." ".$_POST['apellido']."<br />
        Muchas gracias por habernos contactado.<br />
        Le adjunto la cotizaci&oacute;n que solicit&oacute; a trav&eacute;s de nuestra p&aacute;gina web<br /> No dude en contactarnos por esta v&iacute;a o por tel&eacute;fono si tiene alguna pregunta
        ";
        include("cotizacion_pdf.php");
		enviaMail($mensaje,$_POST['email'],"cotizaciones/".$queryCotizacion['codigo'].".pdf","doral.renting@gmail.com","Renting Florida - Cotizacion ".$queryCotizacion['codigo']);
        unlink("cotizaciones/".$queryCotizacion['codigo'].".pdf");		    
		}
    break;
}
?>