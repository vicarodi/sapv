
	function valido_usuario(valor){
	 if(valor==13 || valor==''){
			$.ajax({
			   type: "POST",
			   url: "login.php",
			     beforeSend: function(){
				    $("#mensaje").html('<img src="images/ajax-loader.gif">');
				  },

			   data: "tipo=1&user="+$("#user").val()+"&pass2="+$("#pass2").val(),
			   complete: function(datos){

			   	if(datos.responseText==0){
			   		 $("#mensaje").slideDown("fast");
			   		 $("#mensaje").html("<p><span class='ui-icon ui-icon-alert' style='float: left; margin-right: 0.3em;'></span><b>Nombre de usuario o contrase&ntilde;a incorrecta</b>");
			   	}else{
			   		window.location.href='index.php?doc=principal';
			   	}

			   }
			 });
	 	 }
	}
	//---------------login
	$('.ui-state-default').hover(

	  	function (){
	  		$(this).addClass("ui-state-hover");

	  	},
	  	function (){
	  		$(this).removeClass("ui-state-hover");
	  	}
	);
	//--------------botones

	$('#listado tr.registros:odd').addClass('cebra');
	$('.registros').hover(

	  	function (){
	  		$(this).addClass("footer2");

	  	},
	  	function (){
	  		$(this).removeClass("footer2");
	  	}
	);
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
function validar(){
	falta='';
	$('#formulario :input').each(function (i) {
		if($(this).attr('title')!="" && $(this).val()==""){
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
							$('#'+id_campo).val('');
							$('#'+id_campo).focus();
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
	return (key <= 13 || (key>= 48 && key <= 57) || key <= 44);
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
	   	//$("#edad").val(edad);
	}
}
///------------sol examen

function evalua(valor){
		if (valor=='2'){
			$('.tdempresa').css("display","");

		}else if (valor=='1'){
			$('.tdempresa').css("display",'none');

		}
	}