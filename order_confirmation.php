<?
include("header.php");
$setPropiedades=mysql_query("SELECT propiedades.id as idPropiedad,propiedades.*, tipo_propiedad.nombre as tipoProp FROM tipo_propiedad inner join propiedades on tipo_propiedad.id=id_tipo_propiedad where propiedades.id='".$_GET['id']."'");
$registro=mysql_fetch_assoc($setPropiedades);
?> <script type="text/javascript">
 var RecaptchaOptions = {
    theme : 'white'
 };
 </script>
 <td id="muestraDisp">
 <table width="100%" cellpadding="5" style="font-family: Arial;font-size: 12px;" border="0">
        <tr>
        <td colspan="4" align="right" style="font-family: Arial;font-size: 14px;"><strong>COTIZACION</strong><br />del <strong><?=$_SESSION['llegada']?></strong> al <strong><?=$_SESSION['salida']?></strong>, <?=$_SESSION['adultos']?> Adultos, <?=$_SESSION['ninos']?> Ni&ntilde;os</td>
        </tr>
        <tr>
        <td width="40%" valign="top">
        <br />
        <table  style="font-family: Arial;font-size: 12px;">
        <tr>
        <td align="center" width="150px">
           <?
            $queryRandom=mysql_fetch_assoc(mysql_query("select * from propiedad_imagenes where id_propiedad='".$registro['idPropiedad']."' and imagen_principal=1"));
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
            echo "<strong>Propiedad a Cotizar:<br>".$registro['tipoProp']."</strong> ".$km_const." m2<br>";
            echo $registro['capacidad']." Personas<br>";
            echo "Ubic ".$registro['ciudad'].", ".$registro['estado']."<br>";
            echo calculaCosto($_GET['id']);
        ?>
        </td>
        </tr>
        
        </table>
        </td>      
                     <td valign="top">
                          <br />
                        <div align="center" id="formularioCotizacion">
                        <table width="70%" cellspacing="5" align="left" style="font-family: Arial;font-size: 12px;">
                            <tr>
                                <td colspan="2" style="border-bottom: 2px solid #1D5987;text-align: left;color:#1D5987;font-size:14px"><strong>INFORMACION PERSONAL</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Nombres:</strong></td>
                                <td><input type="text" class="validador" title="Nombre" name="nombre" id="nombre" /></strong></td>
                            </tr>
                            <tr>
                                <td><strong>Apellidos:</strong></td>
                                <td><input type="text" class="validador" title="Apellido" name="apellido" id="apellido" /></strong></td>
                            </tr>
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td><input type="text" class="validador" title="Email" name="email" id="email" /></strong></td>
                            </tr>
                            <tr>
                            	<td><strong>Confirmaci&oacute;n de Email:</strong></td>
                            	<td><input type="text" class="validador" title="Confirmacion Email" name="confirmacion_email" id="confirmacion_email"  onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false" autocomplete="off"></td>
                            	
                            </tr>
                               <tr>
                                <td><strong>Tel&eacute;fono:</strong></td>
                                <td><input type="text" class="validador" title="Tel&eacute;fono" name="telefono" id="telefono" /></strong></td>
                            </tr>
                            <tr>
                            	<td colspan="2">
                            	<?php
          						//require_once('recaptchalib.php');

								// Get a key from https://www.google.com/recaptcha/admin/create
								$publickey = "6LcOzuASAAAAAOUTub2dqrorRizvOLLm_0jslYJq";

								# the response from reCAPTCHA
								$resp = null;
								# the error code from reCAPTCHA, if any
								$error = null;
								
								echo recaptcha_get_html($publickey);
        						?>
                            	</td>
                            	
                            </tr>
                            <tr>
                                <td colspan="2" align="center"><br /><a class="boton" onclick="mandaCotizacion()">Recibir Cotizaci&oacute;n</a></td>
                            </tr>
                        </table>
                        <br />
                        </div>
                        </td> </tr></table>
                      
                        
 </td>

<script>
$(document).ready(function(){
	$("input[name='recaptcha_response_field']").css("background-color","#fff");
});
 function mandaCotizacion(){
    var envias='';
    var falta='';
    $("#formularioCotizacion :input").each(function(){
        if($(this).val()==''){
        	if($(this).attr('title')==undefined){
        		falta+="- Codigo de Seguridad \n";
        	}else{
        		falta+="- "+$(this).attr('title')+"\n";
        	}
           
        }else{
          envias+=$(this).attr('name')+"="+$(this).val()+"&";  
        }
    });
    
    var email=$("#email").val();
    var confirmacion=$("#confirmacion_email").val();
    if(email!=confirmacion){
    alert("Los correos electronicos que ingreso no son correctos, por favor verifique la informacion");	
    }else{
	    if(falta!=""){
	       alert("Los siguientes Campos son obligatorios:\n\n"+falta); 
	    }else{
	    	
	      $.ajax({
	        type: "POST",
	        url: "ajax.php",
	        data: envias+"accion=creaCoti&id_Propiedad=<?=$_GET['id']?>",
	        complete: function(datos){
	        	if(datos.responseText=='0'){
	        		alert("El codigo de seguridad que ingreso no es correcto");
	        	}else{
	        		$("#formularioCotizacion").html("<div class='ui-state-highlight ui-corner-all' style='margin-top: 20px; padding: 0px 0.7em;'><p><span class='ui-icon ui-icon-info' style='float: left; margin-right: 0.3em;'></span>Su cotizaci&oacute;n ha sido enviada a "+email+". No dude en contactarnos para hacer la reserva.</div>");
	        	}
	            
	            
	         }
	      });    
	    }	
    }

 
 }
 </script>

<? include("footer.php")?>