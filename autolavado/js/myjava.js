$(function(){
	$('#bd-desde').on('change', function(){
		var desde = $('#bd-desde').val();
		var hasta = $('#bd-hasta').val();
		var url = '../php/busca_producto_fecha.php';
		$('#bs-prod').hide();
		$.ajax({
		type:'POST',
		url:url,
		data:'desde='+desde+'&hasta='+hasta,
		success: function(datos){
			$('#agrega-registros').html(datos);
		}
	});
	return false;
	});
	
	$('#bd-hasta').on('change', function(){
		var desde = $('#bd-desde').val();
		var hasta = $('#bd-hasta').val();
		var url = '../php/busca_producto_fecha.php';
		$('#bs-prod').hide();
		$.ajax({
		type:'POST',
		url:url,
		data:'desde='+desde+'&hasta='+hasta,
		success: function(datos){
			$('#agrega-registros').html(datos);
		}
	});
	return false;
	});
	
	$('#nuevo-producto').on('click',function(){
		$('#formulario')[0].reset();
		$('#pro').val('Registro');
		$('#edi').hide();
		$('#reg').show();
		//window.location="http://192.168.0.100/autolavado/vistas/registro.php";
		$('#registra-producto').modal({
			show:true,
			backdrop:'static'
		});
	});

	// modal nuevo para fotos

	$('#nueva-foto').on('click',function(){
		$('#formulario2')[0].reset();
		$('#pro').val('Registro');
		$('#edi').hide();
		$('#reg').show();
		//window.location="http://192.168.0.100/autolavado/vistas/registro.php";
		$('#registra-foto').modal({
			show:true,
			backdrop:'static'
		});
	});

	$('#nuevo-estado').on('click',function(){
		$('#formulario3')[0].reset();
		//$('#pro').val('Registro');
		//$('#edi').hide();
		//$('#reg').show();
		//window.location="http://192.168.0.100/autolavado/vistas/registro.php";
		$('#registra-estado').modal({
			show:true,
			backdrop:'static'
		});
	});

	
	$('#bs-prod').on('keyup',function(){
		var dato = $('#bs-prod').val();
		var url = '../php/busca_producto.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'dato='+dato,
		success: function(datos){
			$('#agrega-registros').html(datos);
		}
	});
	return false;
	});
	
});

function agregaRegistro(){
	var url = '../php/agrega_vehiculo.php';
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario').serialize(),
		success: function(registro){
			if ($('#pro').val() == 'Registro'){
			$('#formulario')[0].reset();
			$('#mensaje').addClass('bien').html('Registro completado con exito').show(200).delay(2500).hide(200);
			$('#agrega-registros').html(registro);
			return false;
			}else{
			$('#mensaje').addClass('bien').html('Edicion completada con exito').show(200).delay(2500).hide(200);
			$('#agrega-registros').html(registro);
			return false;
			}
		}
	});
	return false;
}

function agregaRegistroEstado(){
	var url = '../php/agrega_estado.php';
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario3').serialize(),
		success: function(registro){
			$('#formulario3')[0].reset();
			$('#mensaje3').addClass('bien').html('Registro completado con exito').show(200).delay(2500).hide(200);
			$('#agrega-estados').html(registro);
			return false;
		}
	});
	return false;
}

//agrega fotooooos

function agregaRegistroFotos(){
	var url = '../php/insertar.php';
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario2').serialize(),
		success: function(registro){
			$('#formulario2')[0].reset();
			//$('#mensaje').addClass('bien').html('Registro completado con exito').show(200).delay(2500).hide(200);
			$('#agrega-registros').html(registro);
			return false;
		}
	});
	return false;
}

function eliminarProducto(id_vehiculo,id_conductor){
	var url = '../php/elimina_vehiculo.php';
	var pregunta = confirm('¿Esta seguro de eliminar este cliente?');
	if(pregunta==true){
		$.ajax({
		type:'POST',
		url:url,
		data:'id_vehiculo='+id_vehiculo+'&id_conductor='+id_conductor,
		success: function(registro){
			$('#agrega-registros').html(registro);
			return false;
		}
	});
	return false;
	}else{
		return false;
	}
}

// FOTO INTENTO NUEVO

function fotoProducto(id_vehiculo){
	var url = '../php/verImagenes.php';
		$('#bs-prod').hide();
		$('#bd-desde').hide();
		$('#bd-hasta').hide();
		$('#guia').hide();
		$('#edicion').hide();
		$('#ver').hide();
		$('#eliminar').hide();
		$('#galeria').hide();
		$('#fin').hide();
		document.getElementById("modulo-inspeccion").style.margin="10px 0px -40px 310px";
		document.getElementById("modulo-inspeccion").style.align="center";
		$.ajax({
		type:'POST',
		url:url,
		data:'id_vehiculo='+id_vehiculo,
		success: function(registro){
			$('#agrega-registros').html(registro);
			return false;
		}
	});
	return false;
	}


function editarProducto(id_vehiculo,id_conductor){
	$('#formulario')[0].reset();
	var url = '../php/edita_producto.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'id_vehiculo='+id_vehiculo+'&id_conductor='+id_conductor,
		success: function(valores){
				var datos = eval(valores);
				$('#reg').hide();
				$('#edi').show();
				$('#pro').val('Edicion');
				$('#id_vehiculo').val(id_vehiculo);
				$('#id_conductor').val(id_conductor);
							
				//$('#condid').val(datos[0]);
				$('#cond').val(datos[0]);
				$('#tel').val(datos[1]);
				$('#tel2').val(datos[2]);
				$('#pla').val(datos[3]);
				$('#an').val(datos[4]);
				$('#col').val(datos[5]);
				$('#veh').val(datos[6]);
				$('#luces_delanteras').val(datos[7]);
				$('#luces_traseras').val(datos[8]);
				$('#antena').val(datos[9]);
				$('#espejo_derecho').val(datos[10]);
				$('#espejo_izquierdo').val(datos[11]);
				$('#vidrios').val(datos[12]);
				$('#emblema_delantero').val(datos[13]);
				$('#emblema_trasero').val(datos[14]);
				$('#tapones_rines').val(datos[15]);
				$('#tapon_gasolina').val(datos[16]);
				$('#carroceria').val(datos[17]);
				$('#encendedor').val(datos[18]);
				$('#espejo_retrovisor').val(datos[19]);
				$('#cenicero').val(datos[20]);
				$('#alfombras').val(datos[21]);
				$('#forros_asientos').val(datos[22]);
				$('#gato').val(datos[23]);
				$('#llave_ruedas').val(datos[24]);
				$('#caucho_repuesto').val(datos[25]);
				$('#estuche_herramientas').val(datos[26]);
				$('#triangulo').val(datos[27]);
				$('#bateria').val(datos[28]);
				$('#tapa_fusilera').val(datos[29]);
				//$('#condid').val(datos[30]);
				$('#registra-producto').modal({
					show:true,
					backdrop:'static'
				});
			return false;
		}
	});
	return false;
}

function verVehiculos(id_vehiculo,id_conductor){
	$('#formulario5')[0].reset();
	var url = '../php/verVehiculo.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'id_vehiculo='+id_vehiculo+'&id_conductor='+id_conductor,
		success: function(valores){
				var datos = eval(valores);
				$('#pro').val('Edicion');
				$('#id_vehiculo').val(id_vehiculo);
				$('#id_conductor').val(id_conductor);
							
				//$('#condid').val(datos[0]);
				$('#cond1').val(datos[0]);
				$('#tel1').val(datos[1]);
				$('#tel22').val(datos[2]);
				$('#pla1').val(datos[3]);
				$('#an1').val(datos[4]);
				$('#col1').val(datos[5]);
				$('#veh1').val(datos[6]);
				$('#luces_delanteras1').val(datos[7]);
				$('#luces_traseras1').val(datos[8]);
				$('#antena1').val(datos[9]);
				$('#espejo_derecho1').val(datos[10]);
				$('#espejo_izquierdo1').val(datos[11]);
				$('#vidrios1').val(datos[12]);
				$('#emblema_delantero1').val(datos[13]);
				$('#emblema_trasero1').val(datos[14]);
				$('#tapones_rines1').val(datos[15]);
				$('#tapon_gasolina1').val(datos[16]);
				$('#carroceria1').val(datos[17]);
				$('#encendedor1').val(datos[18]);
				$('#espejo_retrovisor1').val(datos[19]);
				$('#cenicero1').val(datos[20]);
				$('#alfombras1').val(datos[21]);
				$('#forros_asientos1').val(datos[22]);
				$('#gato1').val(datos[23]);
				$('#llave_ruedas1').val(datos[24]);
				$('#caucho_repuesto1').val(datos[25]);
				$('#estuche_herramientas1').val(datos[26]);
				$('#triangulo1').val(datos[27]);
				$('#bateria1').val(datos[28]);
				$('#tapa_fusilera1').val(datos[29]);
				$('#date').val(datos[30]);
				$('#modal-ver').modal({
					show:true,
					backdrop:'static'
				});
			return false;
		}
	});
	return false;
}


function eliminarEstado(id_estado){
	var url = '../php/elimina_estado.php';
	var pregunta = confirm('¿Esta seguro de eliminar este Estado?');
	if(pregunta==true){
		$.ajax({
		type:'POST',
		url:url,
		data:'id_estado='+id_estado,
		success: function(registro){
			$('#agrega-estados').html(registro);
			return false;
		}
	});
	return false;
	}else{
		return false;
	}
}

/*function confirmDel()
{
  var agree=confirm("¿Realmente desea eliminarlo? ");
  if (agree){
  	return true ;

  }else{
  	alert('No pudo ser eliminada');
  } 
  //return false;

}*/

function preguntar(idImagen,id_vehiculo){
   var url = '../php/eliminarImagen.php';
	var pregunta = confirm('¿Esta seguro de eliminar esta Imagen?');
	if(pregunta==true){
		$.ajax({
		type:'POST',
		url:url,
		data:'idImagen='+idImagen+'&id_vehiculo='+id_vehiculo,
		success: function(registro){
			$('#agrega-registros').html(registro);
			//window.location.href = "http://localhost/autolavado/vistas/";
			return false;
		}
	});
	return false;
	}else{
		return false;
	}
}