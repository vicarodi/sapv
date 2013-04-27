  $(function() {
    $('#nav').droppy();
  });
  ///-------------menu
  var nav42 = window.Event ? true : false;
function enter(evt){
	var key = nav42 ? evt.which : evt.keyCode;
	if (key == 13 )
		valido_usuario(key)
}
	function valido_usuario(valor){
	 if(valor==13 || valor==''){
			$.ajax({
			   type: "POST",
			   url: "login.php",
			     beforeSend: function(){
				    $("#loadin").html('<img src="images/ajax-loader.gif">');
				  },

			   data: "tipo=1&user="+$("#user").val()+"&pass2="+$("#pass2").val(),
			   complete: function(datos){
				 $("#loadin").html('');
			   	if(datos.responseText==0){
			   		 $("#mensaje").slideDown("fast");
			   		 $("#mensaje").html("<p><span class='ui-icon ui-icon-alert' style='float: left; margin-right: 0.3em;'></span><b>Nombre de usuario o contrase&ntilde;a incorrecta</b>");
			   	}else if(datos.responseText==1){
			   		window.location.href='index.php?doc=propiedades';
			   	}

			   }
			 });
	 	 }
	}
	//---------------login

//------------traer estados municipios etc
function crea_selects(codigo,tabla,select,otra_tabla){
	 $.ajax({
	   type: "POST",
	   url: "ajaxs.php",
	   data: "tipo=2&tabla="+tabla+"&codigo="+codigo+"&otratabla="+otra_tabla+"&select="+select,
	   complete: function(datos){
			$("#"+select).html(datos.responseText);
	   	  }
	 });
}
//---------------mascaras
jQuery(function($){
   $(".cedula").mask("v-99999999");
   $(".telefono").mask("(9999)9999999");
   $(".rif").mask("r-99999999***");
   
});
//------------
function eliminar(cadena){
	$("#dialog2").dialog({
			bgiframe: true,
			autoOpen: true,

			modal: true,
			buttons: {
				Si: function() {
					$(this).dialog('close');
					window.location.href=cadena;
				},
				No: function() {
					$(this).dialog('close');
				}
			}

		});
	$("#dialog2").dialog('open');
}

function validarEmail(valor) {
    if(valor!=""){
        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3,4})+$/.test(valor)){
     return true;
    } else {
     return false;
    }    
    }

}
function validar(){
	falta='';
	$('#formulario :input').each(function (i) {
		if(($(this).attr('title')!="" && $(this).attr('title')!=undefined) && ($(this).val()=="" || $(this).val()=="-")){
		  //alert($(this).attr('type'));
			$(this).css('background-color','#ffbcbc');
			falta+='-'+$(this).attr('title')+'<br>';
		}else if($(this).attr('title')!="" && $(this).attr('type')!="submit"){
            $(this).css('background-color','#FFFFFF');
		}

	});

	if(falta!=''){

		$("#mensaje21").html('<div id="dialog3" title="Campos requeridos"><p>Favor indicar los siguientes campos:<br>'+falta+'</p></div>');
		$("#dialog3").dialog({
			bgiframe: true,
			autoOpen: true,

			modal: true,
			buttons: {
				Ok: function() {
					$(this).dialog('close');

				}
			}

		});
		//alert("Favor indicar los siguientes campos:\n\n"+falta);
		return false;
	}else{
	return true;
	}
}


//----------------funcio para validar campos existente

	function campos_existentes(valor,tabla,id_campo,nombre_campo,id_div){
	 $.ajax({
	   type: "POST",
	   url: "ajaxs.php",
	   data: "tipo=3&valor="+valor+"&tabla="+tabla+"&campo="+nombre_campo,
	   complete: function(datos){
			if (datos.responseText==1){
				$('#errorvalida').html('<p>'+id_div+'</p>');
				$("#errorvalida").dialog({
					resizable:false,
					bgiframe: true,
					autoOpen: true,
					modal: true,
					buttons: {
						Ok: function() {
							$(this).dialog('close');
							if(id_campo!=""){
							 $('#'+id_campo).val('');
							 $('#'+id_campo).focus();
							}

						}
					}
				});

				$("#errorvalida").dialog('open');
			}
	   	  }
	 });
}
//-------------------Validar que se ingresen solo numeros y coma
var nav4 = window.Event ? true : false;
function acceptNum(evt){
	var key = nav4 ? evt.which : evt.keyCode;
	return (key <= 13 || (key>= 48 && key <= 57) || key == 44 || key==46);
}

//-------------------Validar que se ingresen solo numeros y coma
///----------------otrosse-----------
function crea_selects2(valor,tablabusq,campo,select,otros){
	 $.ajax({
	   type: "POST",
	   url: "ajaxs.php",
	   data: "tipo=4&tabla="+tablabusq+"&codigo="+valor+"&otratabla="+campo+"&otros="+otros+"&select="+select,
	   complete: function(datos){
			$("#"+select).html(datos.responseText);
	   	  }
	 });
}
//----- Calcular edad
    function calcular_edad(fecha,hoy){
       	//calculo la fecha de hoy
      	//calculo la fecha que recibo
       	//La descompongo en un array
    	hoy2=hoy.split("/");
       	var array_fecha = fecha.split("/")
       	//si el array no tiene tres partes, la fecha es incorrecta
    
       	//compruebo que los ano, mes, dia son correctos
       	var ano
       	ano = parseInt(array_fecha[2]);
       	var mes
       	mes = parseInt(array_fecha[1]);
       	var dia
       	dia = parseInt(array_fecha[0]);
    
       	//resto los años de las dos fechas
       	edad=hoy2[2]- ano - 1; //-1 porque no se si ha cumplido años ya este año
    //alert((hoy2[0] - dia));
       	//si resto los meses y me da menor que 0 entonces no ha cumplido años. Si da mayor si ha cumplido
       	if (hoy2[1] - mes < 0) //+ 1 porque los meses empiezan en 0
    
       	$("#edad").val(edad);
    
       	if ((hoy2[1])- mes > 0)
       	$("#edad").val(edad+1);
    
       	//entonces es que eran iguales. miro los dias
       	//si resto los dias y me da menor que 0 entonces no ha cumplido años. Si da mayor o igual si ha cumplido
     	if (hoy2[1] - mes == 0){
    	   	if ((hoy2[0] - dia) >= 0)
    	      $("#edad").val(edad+1);
              else
              $("#edad").val(edad);
    	   	//$("#edad").val(edad);
    	}
        
    }
///------------sol examen

    $(document).ready(function(){
       	$('#formulario :input').each(function (i) {
    		if(($(this).attr('title')!="" && $(this).attr('title')!=undefined) && $(this).attr('type')!="hidden"){
    		  //alert('hoa');
    			$("&nbsp;<font color='CC0000'>*</font>").insertAfter($(this));
    		}
    	}); 
    });
    
    function valido_usuario_recuperarclave(valor){
	 if(valor==13 || valor==''){
			$.ajax({
			   type: "POST",
			   url: "ajaxs.php",
			     beforeSend: function(){
				    $("#loadin").html('<img src="images/ajax-loader.gif">');
				  },

			   data: "op=25&user="+$("#user").val()+"&pass2="+$("#pass2").val(),
			   complete: function(datos){
				 $("#loadin").html('');
			   	if(datos.responseText==0){
			   		 $("#mensaje").slideDown("fast");
			   		 $("#mensaje").html("<p><span class='ui-icon ui-icon-alert' style='float: left; margin-right: 0.3em;'></span><b>Nombre de usuario o Correo Incorrecto</b>");
			   	}else if(datos.responseText==1){
			   		window.location.href='olvido_contrasena.php?sc=1';
                    $("#mensaje").attr('style','margin: 5px; padding: 1px; display: none;');
                    //$("#fila1").html('<td><div><font face="Tahoma" size="2"><strong>Contrase&ntilde;a Nueva: </strong></font></div></td><td><input type="password" id="passnew" name="passnew" size="15" value="" /></td>');
                    //$("#fila2").html('<td><div><font face="Tahoma" size="2"><strong>Repetir Contrase&ntilde;a Nueva: </strong></font></div></td><td><input type="password" id="passverifnew" name="passverifnew" size="15" value="" />  </td>')
                    //$("#botoncambiarclave").html('<input id="button" class="ui-state-default ui-corner-all" name="submit" type="button" onclick="validar_clavesiguales()" value="  Cambiar  " class="botones" />');      
			   	}

			   }
			 });
	 	 }
	}
    
        function validar_clavesiguales(){
        //alert("validar claves iguales");
        var pass=$("#passnew").val();
        var passverif=$("#passverifnew").val();
        if (pass==""){
            $("#mensaje").slideDown("fast");
			$("#mensaje").html("<p><span class='ui-icon ui-icon-alert' style='float: left; margin-right: 0.3em;'></span><b>Debe colocar una Contrase&ntilde;a Nueva</b>");
        }else if (passverif==""){
            $("#mensaje").slideDown("fast");
			$("#mensaje").html("<p><span class='ui-icon ui-icon-alert' style='float: left; margin-right: 0.3em;'></span><b>Debe Repetir la Contrase&ntilde;a Nueva</b>");
        }else if (pass==passverif){
            //alert("Las Contrasenas son Iguales");
            $("#mensaje").attr('style','margin: 5px; padding: 1px; display: none;');
            cambiarclave();
        }else{
            $("#mensaje").slideDown("fast");
			$("#mensaje").html("<p><span class='ui-icon ui-icon-alert' style='float: left; margin-right: 0.3em;'></span><b>Las Contrase&ntilde;as No Coinciden,<br/> Ingr&eacute;selas Nuevamente</b>");
            $("#passnew").val('');
            $("#passverifnew").val('');
        }
        
    }
    
    function cambiarclave(){
        $.ajax({
			   type: "POST",
			   url: "ajaxs.php",
			     beforeSend: function(){
				    $("#loadin").html('<img src="images/ajax-loader.gif">');
				  },

			   data: "op=26&user="+$("#user").val()+"&email="+$("#pass2").val()+"&passnew="+$("#passnew").val(),
			   complete: function(datos){
				$("#loadin").html('');
                //alert(datos.responseText);                                
			   	if(datos.responseText==1){
			   	     $("#fila1").html("<p><span class='ui-icon ui-icon-alert' style='float: left; margin-right: 0.3em;'></span><b>Su Contrase&ntilde;a ha sido Cambiada. Ahora puede Acceder al Sistema con su Usuario y su Contrase&ntilde;a Nueva</b>");
			   	     $("#fila2").html('');
                     $("#fila3").html('');$("#fila4").html('');
			   		$("#botoncambiarclave").html('');
                    setTimeout("redireccionar('principal')",4500);
                    $("#mensaje").attr('style','margin: 5px; padding: 1px; display: none;');
                          
			   	}

			   }
			 });
        
    }
    function redireccionar(valor){
        window.location.href='index.php?doc='+valor;
    }
   