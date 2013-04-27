<form id="disponibilidad">
                        <table cellpadding="6" style="margin:5px;font-size: 12px; font-family: Arial;border:1px solid #666;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;" width="100%">
                            <tr>
                             <td align="center" colspan="2" style="padding:10px;height:10px;background: url(img/header-bg.png) repeat-x;"><strong>COTIZE SU VIAJE AQUI</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Llegada</strong></td>
                                <td><input type="text" value="<?=$_SESSION['llegada']?>" size="10" name="llegada" id="llegada" class="calendario" /></td>
                            </tr>
                            <tr>
                                <td><strong>Salida</strong></td>
                                <td><input type="text"  value="<?=$_SESSION['salida']?>" size="10" name="salida" id="salida" class="calendario" /></td>
                            </tr>
                            <tr>
                                <td><strong>Adultos</strong></td>
                                <td>
                                    <select name="adultos" id="adultos">
                                        <?
                                            for($i=1;$i<=8;$i++){
                                             echo "<option value='".$i."'>".$i."</option>";
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Ni&ntilde;os</strong></td>
                                <td>
                                    <select name="ninos" id="ninos">
                                        <?
                                         echo "<option value='0'>0</option>";
                                            for($i=1;$i<=8;$i++){
                                             echo "<option value='".$i."'>".$i."</option>";
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                             <td colspan="2" align="center"><input type="button" value="Buscar Disponibilidad" onclick="buscaDisponibilidad()" /></td>
                            </tr>
                        </table>
                    </form>
<script>
function buscaDisponibilidad(){
   var envias='';
    $("#disponibilidad :input").each(function(){
      envias+=$(this).attr('name')+"="+$(this).val()+"&"; 
      //$(this).val(''); 
    });
    $.ajax({
    type: "POST",
    url: "ajax.php",
    beforeSend: function(){
        $("#muestraDisp").html('<img src="images/ajax-loader.gif">');
    },
    data: envias+"accion=buscaDisp",
    complete: function(datos){
        $("#muestraDisp").html(datos.responseText);
         $("a.boton").button();
     }
    });  
}
</script>