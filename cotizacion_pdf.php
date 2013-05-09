<?php
//ini_set('memory_limit', '512M');
//set_time_limit(0);
//include ("includes/conectar.php");
require_once('includes/config/lang/eng.php');
require_once('includes/tcpdf.php');
$queryCOnfig=mysql_query("select * from configuracion");
while($rowConfig=mysql_fetch_assoc($queryCOnfig)){
  define($rowConfig['nombre_variable'],$rowConfig['valor']);  
}
function devuelveRutadim($ruta,$width,$height,$bandera=1){
	$troxosRuta=explode("/",$ruta);
	$rutaPDF="sapv/images/propiedades/pdf/".$troxosRuta[count($troxosRuta)-1];

		if(strtolower(substr($ruta,-3))=='jpg'){
			$fuente = @imagecreatefromjpeg($ruta); 
		}elseif(strtolower(substr($ruta,-3))=='gif'){
			$fuente = @imagecreatefromgif($ruta); 
		}elseif(strtolower(substr($ruta,-3))=='png'){
			$fuente = @imagecreatefrompng($ruta);
		}
		$imgAncho = imagesx ($fuente); 
		$imgAlto =imagesy($fuente);
		
		$ancho=$width;
		@$alto=($imgAlto*$ancho/$imgAncho);
    	if ($alto>$height){
    		$alto=$height;
    		@$ancho=($imgAncho*$alto/$imgAlto);
    	}
		//echo $ancho.",".$alto;
		if($bandera==1){
			$imagen = imagecreatetruecolor($ancho,$alto); 
			ImageCopyResampled($imagen,$fuente,0,0,0,0,$ancho,$alto,$imgAncho,$imgAlto);
			$troxosRuta=explode("/",$ruta);
			$rutaPDF="sapv/images/propiedades/pdf/".$troxosRuta[count($troxosRuta)-1];
			if(strtolower(substr($ruta,-3))=='jpg'){
				imagejpeg($imagen,$rutaPDF,100);
			}elseif(strtolower(substr($ruta,-3))=='gif'){
				imagegif($imagen,$rutaPDF);
			}elseif(strtolower(substr($ruta,-3))=='png'){
				imagepng($imagen,$rutaPDF);
			}
			return 'src="'.$rutaPDF.'"';
		}else{
			$rutaPDF=$ruta;
			return 'src="'.$rutaPDF.'" width="'.$ancho.'px" height="'.$alto.'px"';
		}
		
}

function devuelveFechasPago($fechaDelVIaje){
	$arregloDiasH=array("Monday","Tuesday","Wednesday","Thursday","Friday");
	$arregloDiasNH=array("Saturday","Sunday");
	$verificador=0;
	list($ano2,$mes2,$dia2)=explode("-",date("Y-m-d"));
    //calculo timestam de las dos fechas
    $h=2;
	while($verificador==0){
		$timestamp2 = mktime(0,0,0,$mes2,($dia2+$h),$ano2);
		$nombreDia=date("l",$timestamp2);
		if(in_array($nombreDia, $arregloDiasH)){
			$nombreDia=date("d/m/Y",$timestamp2);
			$verificador=1;
		}
		$h++;
			
	}
	list($ano2,$mes2,$dia2)=explode("-",$fechaDelVIaje);
	$timestamp2 = mktime(0,0,0,$mes2,($dia2-30),$ano2);
	$otraFecha=date("d/m/Y",$timestamp2);
	return $nombreDia."|@|".$otraFecha;
}

$_GET['id']=$id_cotizcacion;
$queryCotizacion=mysql_fetch_assoc(mysql_query("select * from cotizaciones where id='".$_GET['id']."'"));
$setPropiedades=mysql_query("SELECT propiedades.id as idPropiedad,propiedades.*, tipo_propiedad.nombre as tipoProp FROM tipo_propiedad inner join propiedades on tipo_propiedad.id=id_tipo_propiedad where propiedades.id='".$queryCotizacion['id_propiedad']."'");
$registroPropiedades=mysql_fetch_assoc($setPropiedades);

class MYPDF extends TCPDF {

    //Page header
    public function Header() {
      // Logo
        $image_file = 'sapv/images/encabezaPdf.jpg';
        $html = '<table><tr><td><img src="'.$image_file.'" width="515px" height="131px" /></td></tr></table>';
     $this->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'top', $autopadding = true);

        // Set font
    }

    // Page footer
    public function Footer() {
    	global $registroPropiedades;
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, $registroPropiedades['direccion']." ".$registroPropiedades['ciudad'].", ".$registroPropiedades['estado']." Telf: Miami: +1 (786) 352.83.12 Venezuela: +58 414 455.64.61", 0, false, 'C', 0, '', 0, false, 'T', 'M');
		$this->Ln(3);
		$this->Cell(0, 10, "doral.renting@gmail.com", 0, false, 'C', 0, '', 0, false, 'T', 'M');
		$this->Ln(2);
		$this->Cell(0, 10, $this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');    
}
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator('RentingFlorida');
$pdf->SetAuthor('RentingFlorida');
$pdf->SetTitle('Cotizacion de Propiedad');
$pdf->SetSubject('Cotizacion de Propiedad');
$pdf->SetKeywords('Cotizacion de Propiedad');

// set default header data
$pdf->SetHeaderData('', 40, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

$pdf->setPrintHeader(true);
$pdf->setPrintFooter(true);
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(15, 65, 15);
$pdf->SetHeaderMargin(10);
$pdf->SetFooterMargin(15);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 20);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->setPageFormat( 'LETTER','P');
$pdf->AddPage();
$noches=diasDiferencia($queryCotizacion['fecha_in'],$queryCotizacion['fecha_out'])+1;
$limpiezaTotal=$queryCotizacion['limpieza'];


if($noches>=15){
 $resto=round($noches/15);
 $limpiezaTotal=$queryCotizacion['limpieza']*$resto;
}
// -----------------------------------------------------------------------------
$totalApagar=($queryCotizacion['monto_diario']*$noches)+$limpiezaTotal+(int)$registroPropiedades['deposito'];
list($cincuenta,$totalMon)=explode("|@|",devuelveFechasPago($queryCotizacion['fecha_in']));

$tableContenido='<table width="100%">
  <tr>
    <td><p>Estimado(a) '.$queryCotizacion['nombre'].' '.$queryCotizacion['apellido'].',<br /><br />
Muchas gracias por su contacto.<br /> 
Le informo entonces las tarifas  tal y como las solicit&oacute;.<br />
</p></td>
  </tr> 
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" style="border:1px solid #ccffff"><tr style="background-color:#ccc">
        <td align="center"  width="60%" height="15px" style="line-heigth:5px;border:1px solid #ffffff"><strong>DESCRIPCI&Oacute;N</strong></td>
        <td align="center" width="20%" style="line-heigth:5px;border:1px solid #e1e1e1">&nbsp;<strong>PRECIO POR NOCHE</strong></td>
        <td align="center" width="20%" style="line-heigth:5px;border:1px solid #e1e1e1">&nbsp;<strong>TOTAL</strong></td>
      </tr>
      <tr>
        <td width="60%" height="15px" style="line-heigth:5px;border:1px solid #e1e1e1">&nbsp;Hospedaje Del '.fechasnormal($queryCotizacion['fecha_in']).' al '.fechasnormal($queryCotizacion['fecha_out']).'  '.$noches.' noches </td>
        <td width="20%" align="right" style="line-heigth:5px;border:1px solid #e1e1e1">$ '.round($queryCotizacion['monto_total']/$noches).'&nbsp;</td>
        <td width="20%" align="right" style="line-heigth:5px;border:1px solid #e1e1e1">$ '.$queryCotizacion['monto_total'].'&nbsp;</td>
      </tr>
      <tr style="background-color:#fbfbfb;">
        <td width="60%" height="15px" style="line-heigth:5px;border:1px solid #e1e1e1">&nbsp;Fee de Limpieza (1 cada 2 semanas)</td>
        <td width="20%" align="right" style="line-heigth:5px;border:1px solid #e1e1e1">$ '.$queryCotizacion['limpieza'].'&nbsp;</td>
        <td width="20%" align="right" style="line-heigth:5px;border:1px solid #e1e1e1">$ '.$limpiezaTotal.'&nbsp;</td>
      </tr>
      <tr>
      <td width="60%" height="15px" style="line-heigth:5px;border:1px solid #e1e1e1">&nbsp;Dep&oacute;sito de Seguridad (devuelto 48 horas despu&eacute;s de su check-out)</td>
        <td width="20%" align="right" style="line-heigth:5px;border:1px solid #e1e1e1">$ '.$registroPropiedades['deposito'].'&nbsp;</td>
        <td width="20%" align="right" style="line-heigth:5px;border:1px solid #e1e1e1">$ '.$registroPropiedades['deposito'].'&nbsp;</td>
      </tr>
      <tr>
        <td align="right" width="60%" style="color:#AFAFAF;font-size:20px;border:1px solid #e1e1e1"><br /></td>
        <td align="right" width="20%" style="line-heigth:5px;border:1px solid #e1e1e1"><br /><strong>TOTAL</strong></td>
        <td width="20%" align="right" style="line-heigth:5px;border:1px solid #e1e1e1"><br />$ '.number_format($totalApagar,2,",",".").'&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>';

  $fechaHoy=date("Y-m-d");
  $nochesPagos=diasDiferencia($fechaHoy,$queryCotizacion['fecha_in'])+1;
  if($nochesPagos<30){
  	$tableContenido.='  <tr>
    <td><p>Para reservar su fecha solo debe depositar:<br />
  <b>$ '.number_format((($queryCotizacion['monto_diario']*$noches)),2,",",".").'</b> antes del '.$cincuenta.' o <b>Bs. '.number_format((($queryCotizacion['monto_diario']*$noches))*(int)CAMBIO_DOLAR,2,",",".").'</b> .<br />
  
Puede hacer su pago tanto en $ como en Bs. Recomendamos hacer el dep&oacute;sito de seguridad ('.$registroPropiedades['deposito'].'$) en Bol&iacute;vares.<br />
<br /><br />';
  }else{
  	$tableContenido.='  <tr>
    <td><p>Para reservar su fecha solo debe depositar:<br />
  <b>$ '.number_format((($queryCotizacion['monto_diario']*$noches)/2),2,",",".").'</b> antes del '.$cincuenta.' o <b>Bs. '.number_format((($queryCotizacion['monto_diario']*$noches)/2)*(int)CAMBIO_DOLAR,2,",",".").'</b> .<br />
  <b>$ '.number_format(((($queryCotizacion['monto_diario']*$noches)/2)+$registroPropiedades['deposito']+$limpiezaTotal),2,",",".").'</b> antes del '.$totalMon.' o <b>Bs. '.number_format(((($queryCotizacion['monto_diario']*$noches)/2)+$registroPropiedades['deposito']+$limpiezaTotal)*(int)CAMBIO_DOLAR,2,",",".").'</b><br />
Puede hacer su pago tanto en $ como en Bs. Recomendamos hacer el dep&oacute;sito de seguridad ('.$registroPropiedades['deposito'].'$) en Bol&iacute;vares.<br />
<br /><br />';
  }

$tableContenido.=' 
Se aceptan cupos de internet con un recargo del 15%. (Paypal)<br />
Recuerde que los pagos en Bs. son calculados a la tasa del d&iacute;a por lo que el saldo restante ir&aacute; disminuyendo o aumentando de acuerdo a la tasa.
</p><p style="text-align:center;font-size:32px;">
<strong>IMPORTANTE:</strong> Ud  puede escoger la manera mas conveniente de cancelar, o en Bol&iacute;vares, d&oacute;lares o una combinaci&oacute;n de ambos.</p> 
<p style="text-align:center;font-size:34px;color:#CC0000"><br /><strong>Ll&aacute;menos si tiene alguna duda. 0414.455.64.61 Lo atenderemos con mucho gusto.</strong>
</p></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>';

$tbl = <<<EOD
$tableContenido
EOD;

$pdf->writeHTML($tbl, true, false, false, false, ''); 
$pdf->AddPage();

$tableContenido='<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
    <table width="100%" border="1" style="line-height:6px;" cellspacing="0" cellpadding="0">
      <tr  style="background-color:#ccc">
        <td align="center"><strong>En D&oacute;lares:</strong></td>
        <td align="center"><strong>En Bol&iacute;vares:</strong></td>
        
      </tr>
      <tr>
        <td>'.BANCO_DOLARES.'</td>
        <td>'.BANCO_BOLIVARES.'</td>  
      </tr>
    </table>   <br />
    </td>
  </tr>';
  

  $tableContenido.='<table><tr>
    <td align="center"><p style="font-size:20px;color:#CC0000"><strong>POR FAVOR, NO HAGA NINGUNA TRANSFERENCIA ANTES DE NOTIFICARNOS LA MISMA. </strong>
<strong>IMPORTANTE: </strong>Si el dep&oacute;sito de seguridad lo realiza en $, tenga en cuenta que le devolveremos el dinero por transferencia, por lo que debemos descontarle el monto de la comisi&oacute;n por la operaci&oacute;n. Si la transferencia es a un banco dentro de los EEUU el costo es de 25$ de lo contrario es de 40$.
</p></td>
  </tr>';
  
    $tableContenido.='<tr>
  <td><br /><br /><br />
  <b>QUE LE OFRECEMOS:</b><br />
  - '.$registroPropiedades['tipoProp'].' de '.$registroPropiedades['km_const'].' con capacidad de '.$registroPropiedades['capacidad'].' personas <br />
  - '.$registroPropiedades['banos'].' ba&ntilde;os <br />
  - '.$registroPropiedades['habitaciones'].' dormitorios; lenceria incluida<br />';
 $serviciosUsados=mysql_query("select servicios.nombre from propiedad_servicios inner join servicios on servicios.id=propiedad_servicios.id_servicio where id_propiedad='".$queryCotizacion['id_propiedad']."'");
 $tableContenido.='<table border="0">';
 $cuentame=0;
 while($rowServicio=mysql_fetch_assoc($serviciosUsados)){
   	if($cuentame==0 or ($cuentame%2)==0){
   		if($cuentame==0){
   		 $tableContenido.='<tr>';	
   		}elseif($cuentame!=0 && ($cuentame%2)==0){
   			$tableContenido.='</tr><tr>';
   		}
   	}      
   $tableContenido.='<td> - '.$rowServicio['nombre'].' </td>';
   $cuentame++;
 }
   $tableContenido.='</tr></table>';
  $tableContenido.='</td>
  </tr></table>';
  //echo $tableContenido;die;
  $tblh = <<<EOD
$tableContenido
EOD;

$pdf->writeHTML($tblh, true, false, false, false, ''); 
$pdf->AddPage();

  $tableContenido='<table><tr>
    <td style="line-height:10px">
<strong>POL&Iacute;TICAS  DE CANCELACI&Oacute;N:</strong><br />
'.POLITICAS.'<br />
Espero que la informaci&oacute;n haya sido de su agrado y en espera de su pr&oacute;ximo contacto,
Jes&uacute;s Granados
</td>
  </tr></table>';
  
$tbl = <<<EOD
$tableContenido
EOD;

$pdf->writeHTML($tbl, true, false, false, false, ''); 
$pdf->AddPage();
$tableContenido='<table><tr>
    <td align="center"><img '.devuelveRutadim('sapv/images/propiedades/'.$registroPropiedades['mapa_general'],350,350,2).' /></td>
  </tr>
  <tr>
    <td align="center" ><img '.devuelveRutadim('sapv/images/propiedades/'.$registroPropiedades['mapa_cerrado'],350,350,2).' /></td>
  </tr></table>';
 
  $tbg = <<<EOD
$tableContenido
EOD;
$pdf->writeHTML($tbg, true, false, false, false, ''); 
 $pdf->AddPage();
 $tableContenido=' <table>
  <tr>
  <td>
  <table border="0">';
  $queryImagenes=mysql_query("select * from propiedad_imagenes where id_propiedad='".$queryCotizacion['id_propiedad']."'");
         $numeroImagenes=mysql_num_rows($queryImagenes);
         $v=0;
		 $h=0;
         while($rowIMagenes=mysql_fetch_assoc($queryImagenes)){ 
        	
			$tamanini=getimagesize('sapv/images/propiedades/'.$rowIMagenes['ruta_imagen']);
			$arregloImagenes[($tamanini[0]-$tamanini[1]).$rowIMagenes['id']]=$rowIMagenes['ruta_imagen'];
			//echo $imgAncho." ".$imgAlto." ".$alto." ".$ancho."<br />";
         }
		//print_r($arregloImagenes);
		krsort($arregloImagenes);
		//print_r($arregloImagenes);
		foreach($arregloImagenes as $clave => $valor){
			$otroArreglo[]=$valor;
			
		}
		
		//print_r($otroArreglo);die;
         for($h=0;$h<count($otroArreglo);$h+=2){
         	$tableContenido.='<tr>';
			$tableContenido.='<td colspan="2"></td>';
			$tableContenido.='</tr>';
         	$tableContenido.='<tr>';
			$tableContenido.='<td><img '.devuelveRutadim('sapv/images/propiedades/'.$otroArreglo[$h],260,260).' /></td>';
			$tableContenido.='<td><img '.devuelveRutadim('sapv/images/propiedades/'.$otroArreglo[($h+1)],260,260).' /></td>';
			$tableContenido.='</tr>';
			
         }
//die;

  $tableContenido.='</table>
  </td>
  </tr>
</table>';

//Close and output PDF document
$tbv = <<<EOD
$tableContenido
EOD;
$pdf->writeHTML($tbv, true, false, false, false, ''); 
$pdf->Output("cotizaciones/".$queryCotizacion['codigo'].'.pdf', 'F');

//============================================================+
// END OF FILE
//============================================================+
?>