<?
    $u=$_SESSION['usuario_login'];
	$sql="select cedula, pass from user_list where usuario = '".$u."'";
	$insert=mysql_query($sql);
     while($select=mysql_fetch_array($insert))
	                 {
		                $p=$select['pass'];
		                $x=$select['cedula'];
		              }
$accion='modificar';
$boton="Modificar";
$tipo="reset";
$at= md5($_POST[actual]);
if(isset($_GET['accion'])){
 if  ($at==$p){
     mysql_query("update user_list set pass='".md5 ($_POST[confipass])."' where usuario ='$u'" )or die(mysql_error());
        auditoria("CAMBIO SU CLAVE DE ACCESO: ".$_POST['nombre'],'','','modificar');
         redireccionador("index.php?doc=cambioclave&mensaje=2");
         break;
 }else{
    redireccionador("index.php?doc=cambioclave&mensaje=4");
 }
 
 }
?>
<fieldset style="width:70%"> <legend style="font-weight:bold;text-align:left; font-family:Tahoma; font-size:14px">Cambio de Clave</legend>
<form name="form1" id="formulario" method="post" action="index2.php?doc=cambioclave&accion=<?=$accion?>" onsubmit="return validarContrasena()">
<input type="hidden" name="id" value="<?=$_GET['id']?>">
<table class="general">

	    <td><b>Contrase&ntilde;a actual:</b></td>
	    <td><input type="password" name="actual" id="actual" size="15"></td>
	</tr>
	    <td><b>Contrase&ntilde;a:</b></td>
	    <td><input type="password" name="password" id="password" size="15"> M&iacute;nimo 6 caracteres</td>
	</tr>
	<tr>
		<td><b>Verificar Contrase&ntilde;a:</b></td>
		<td><input type="password" name="confipass" id="confipass" size="15" onblur="validar_contras_usu(this.value)"></td>

<tr>
<td colspan="2" align="center">
<? creador_boton('submit',$boton,$boton);?>&nbsp;&nbsp;
<? creador_boton($tipo,'Cancelar','Cancelar',$onclick);?></td>
</tr>
</table>
<p>&nbsp;</p>



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
function validarContrasena(){
    var passito=$("#password").val();
    if(passito.length<6){
      $('#errorvalida').html('<p>La clave debe tener minimo 6 caracteres</p>');
		$("#errorvalida").dialog({
			resizable:false,
			bgiframe: true,
			autoOpen: true,
			modal: true,
			buttons: {
				Ok: function() {
					$(this).dialog('close');
                    $("#password").val('');
                    $('#confipass').val('');
    				$('#password').focus();
				}
			}
		});

		$("#errorvalida").dialog('open');   
        return false;
    }
}
function validar_contras_usu(valor){

        if(valor!=$("#password").val() &&(valor!='')){
    	   $('#errorvalida').html('<p>Las contrase&ntilde;as deben ser iguales</p>');
    		$("#errorvalida").dialog({
    			resizable:false,
    			bgiframe: true,
    			autoOpen: true,
    			modal: true,
    			buttons: {
    				Ok: function() {
    					$(this).dialog('close');
    					$("#password").val('');
                        $('#confipass').val('');
    					$('#password').focus();
    				}
    			}
    		});
    
    		$("#errorvalida").dialog('open'); 
    }

}
</script>