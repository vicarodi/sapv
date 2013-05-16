<?
include("header.php");
$sql="SELECT propiedades.id as idPropiedad,propiedades.*,propietarios.*, tipo_propiedad.nombre as tipoProp FROM tipo_propiedad inner join propiedades on tipo_propiedad.id=id_tipo_propiedad inner join propietarios on propietarios.id = id_propietario where propiedades.id='".$_GET['id']."'";
		$res=mysql_query($sql) or die(mysql_error());
        $rowPropiedad=mysql_fetch_assoc($res);
?>
                    
<td id="muestraDisp">
    <?
    if($_SESSION['cotiza'][$_GET['id']]==1){
        ?>
        <div>
        <table width="100%" style="font-family: Arial;font-size: 14px;">
        <tr>
            <td align="right"><strong>PROPIEDAD DISPONIBLE</strong><br />del <?=$_SESSION['llegada']?> al <?=$_SESSION['salida']?>, <?=$_SESSION['adultos']?> Adultos, <?=$_SESSION['ninos']?> Ni&ntilde;os</td>
            </tr>
            <tr>
            <td align="right"><a href="order_confirmation.php?id=<?=$_GET['id']?>"><input type="button" value="Cotizar" /></a></td>
            </tr>
        </table>
        </div>
        <?
    }
    ?>
    <table width="100%" border="0" style="font-family: Arial;font-size: 12px;">
        <tr>
            <td style="margin: 0px;padding: 0px;">
             <div style="margin-top: 10px; text-align: right">
                <table width="100%" style="font-family: Arial;font-size: 12px;">
                    <tr>
                        <td align="right"><strong><?=$rowPropiedad['tipoProp']?></strong><br />
                        <b>Direcci&oacute;n:</b> <?=$rowPropiedad['direccion']?>, <?=$rowPropiedad['ciudad']?>, <?=$rowPropiedad['estado']?>, <?=$rowPropiedad['codigo_postal']?><br/>
                        <?php if($rowPropiedad['km_const']==""){ $km_const=0;}else{$km_const=$rowPropiedad['km_const'];}?>
                        <?php echo $km_const;?> m2 de construcci&oacute;n.
                        </td>
                        
                        </tr>
                    </table>
             </div>
             <ul id="slidesVic" style="margin: 10px 10px;padding: 0px;">
                 <?php
                 $queryImagenes=mysql_query("select * from propiedad_imagenes where id_propiedad='".$_GET['id']."' order by orden");
                 $numeroImagenes=mysql_num_rows($queryImagenes);
                 while($rowIMagenes=mysql_fetch_assoc($queryImagenes)){
                   ?>
                   <li>
                   <img src="sapv/images/propiedades/<?=$rowIMagenes['ruta_imagen']?>" border="0"/>
                   </li>
                   <? 
                 }
              ?>
             </ul>
            
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <table width="100%" style="font-family: Arial;font-size: 12px;">
                    <tr>
                        <td align="center" colspan="2" bgcolor="#CCCCCC"><strong>Especificaciones de la Propiedad</strong></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table style="font-family: Arial;font-size: 12px;" width="90%" align="center">
                                <tr>
                                    <td width="30%"><b>Capacidad: </b><?php echo $rowPropiedad['capacidad'];?> Personas</td>
                                    <td width="30%"><b>Habitaciones: </b><?php echo $rowPropiedad['habitaciones'];?></td>
                                    <td width="30%"><b>Ba&ntilde;os: </b><?php echo $rowPropiedad['banos'];?></td>
                                    
                                </tr>
                                <tr>
                                    <td colspan="3"><b>Estacionamiento: </b><?php echo $rowPropiedad['puestos_est'];?> puestos</td>
                                </tr>
                                <tr>
                                    <td><b>Tipos de Cama: </b></td>
                                    <td><b>Servicios: </b></td>
                                </tr>
                                <tr>
                                    <td valign="top" width="50%">
                                        <?
                                            $querynHabitin=mysql_query("select * from propiedad_habitaciones where id_propiedad='".$_GET['id']."'");
                                           
                                            $numnero=mysql_num_rows($querynHabitin);
                                            $contenido="<table width='90%' cellspacing='0' style='font-family: Arial;font-size: 12px;'>";
                                            $i=0;
                                            while( $queryHabDorm=mysql_fetch_assoc($querynHabitin)){
                                              $contenido.="<tr><td style='padding-left: 70px;'><strong>Habitaci&oacute;n ".($i+1).": </strong></td><td>";
                                              $arregloCamas=devuelve_valor($queryHabDorm['id_cama'],"nombre","tipo_camas","id");
                                              $contenido.=$arregloCamas['nombre'];
                                              $contenido.="</td></tr>";
                                              $i++;
                                            }
                                            $contenido.="</table>";
                                            echo $contenido;
                                            ?>
                                    </td>
                                    <td  width="50%" colspan="2">
                                        <?
                                         $x=1;
                                         $serviciosUsados=mysql_query("select servicios.nombre from propiedad_servicios inner join servicios on servicios.id=propiedad_servicios.id_servicio where id_propiedad='".$_GET['id']."'");
                                         while($rowServicio=mysql_fetch_assoc($serviciosUsados)){
                                            if($x>1){ $tam="70px;";}else{ $tam="10px;";}
                                             //<?php echo $tam;
                                          ?>       
                                            <span style="width:50%;float:left">- <?=$rowServicio['nombre']?></span>
                                          <?
                                          $x++;
                                         }
                                        ?>
                                    </td>
                                </tr>
                 
                            </table>
                        </td>
                    </tr>
                 
                </table>
         
            </td>
        </tr>
    </table>
    
</td>
                    <style>


                    #slidesVic{
                        margin: 0px;
                        padding: 0px;
                    }
                    #slidesVic li{
                        list-style: none;
                         margin:0px 5px 0px 5px;
                         padding: 5px;
                    }
                    ul.thumbs li img{
                       /*margin-left:5px;*/
                       margin-bottom:5px;
                       border:5px solid #FBFBFB
                    }
                    ul.thumbs{
                        margin:115px 5px 0px 5px;
                        padding: 5px;
                    }
                    </style>
                   <script>
                        $(document).ready(function(){
                            $('#slidesVic').bxGallery({
                               maxheight :300,
                                maxwidth :380,
                                thumbwidth: 75,
                                thumbplacement: 'right',
                                thumbcontainer: 380,
                                thumbcrop:true, 
                                load_image: 'sapv/images/ajax-loader.gif'
                            });
                      
                        });
                    </script>
                 
                    <? include("footer.php")?>