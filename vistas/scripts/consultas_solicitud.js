var tabla;

//Funcion que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();
	$("#fecha_inicio").change(listar);
	$("#fecha_fin").change(listar);

	//Cargamos los items al select Tipo solicitud
	$.post("../ajax/informe_social.php?op=selectTipoSolicitud",function(r){
		$("#id_tipo_solicitud").html(r);
		$('#id_tipo_solicitud').selectpicker('refresh');
	})

	//Obtenemos la fecha actual
	var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);
	var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
    $('#fecha_actual').val(today);
}

//Funcion limpiar
function limpiar(){

	//Solicitante
	$("#id_solicitante").val("");
	$("#cedula").val("");
	$("#nombre_apellido").val("");
	$("#sexo").val("");
	$("#direccion").val("");
	$("#telefono_1").val("");
	$("#telefono_2").val("");
	$("#email").val("");
	$("#parroquia").val("");
	$("#estado_civil").val("");
	$("#ocupacion").val("");
	$("#esterilizada").val("");
	$("#beneficio_gubernamental").val("");

	//Beneficiario
	$("#id_beneficiario").val("");
	$("#cedula_b").val("");
	$("#nombre_apellido_b").val("");
	$("#parentesco").val("");
	$("#semana_embarazo_b").val("");
	$("#id_tipo_solicitud").val("");
	$("#talla_zapato").val("");
	$("#talla_pantalon").val("");
	$("#talla_franela").val("");

	//Informacion adicional
	$("#id_solicitud").val("");
	$("#medio_informacion").val("");
	$("#observacion").val("");
	$("#tipo_vivienda").val("");
	$("#tenencia").val("");
	$("#construccion").val("");
	$("#tipo_piso").val("");
    $('#fecha').val("");

    //removemos las filas de los familiares
	$(".filas").remove();

}

//Funcion mostrar formulario
function mostrarform(flag){
	limpiar();
	if (flag) {
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		//$("#btnGuardar").prop("disabled",false);
		//$("#btnagregar").hide();
	}else{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		//$("#btnagregar").show();
	}
}

//Funcion para cancelar el Formulario
function cancelarform(){
	limpiar();
	mostrarform(false);
}

//funcion listar
function listar(){

	var fecha_inicio = $("#fecha_inicio").val();
	var fecha_fin = $("#fecha_fin").val();

	tabla = $('#tbllistado').dataTable({
		"aProcessing": true, //Activamos el procesamiento del datatables
		"aServerSide": true, //Paginacion y filtrado realizados por el servidor
		dom: 'Bfrtip', //Definimos los elementos del control de tabla
		buttons: [
			'copyHtml5',
			'excelHtml5',
			'csvHtml5',
			'pdf'
		],
		"ajax": {
			url: '../ajax/consultas.php?op=consultasfecha',
			data:{fecha_inicio: fecha_inicio, fecha_fin: fecha_fin},
			type : "get",
			dataType: "json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		"iDisplayLength": 5, //Paginacion
		"order": [[0,"desc"]]//Ordenar (Columna,orden)
	}).DataTable();
}

function mostrar(id_solicitud){
	//mostrars(id_solicitante);
	//mostrarb(id_solicitud);
	$.post("../ajax/consultas.php?op=mostrar",{id_solicitud : id_solicitud}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);

		//Devuelvo los datos del Solicitante
		//$("#id_solicitante").val(data.id_solicitante);
		$("#cedula").val(data.cedula);
		$("#nombre_apellido").val(data.nombre_apellido);
		$("#fecha_nacimiento").val(data.fecha_nacimiento);
		$("#sexo").val(data.sexo);
		$("#direccion").val(data.direccion);
		$("#telefono_1").val(data.telefono_1);
		$("#telefono_2").val(data.telefono_2);
		$("#email").val(data.email);
		$("#parroquia").val(data.parroquia);		
		$("#estado_civil").val(data.estado_civil);		
		$("#ocupacion").val(data.ocupacion);
		$("#esterilizada").val(data.esterilizada);		
		$("#beneficio_gubernamental").val(data.beneficio_gubernamental);
		$("#num_hijo").val(data.num_hijo);
		$("#ingreso").val(data.ingreso);
		
		//Devuelvo los datos del Beneficiario 
		$("#cedula_b").val(data.cedula_b);
		$("#nombre_apellido_b").val(data.nombre_apellido_b);
		$("#fecha_nacimiento_b").val(data.fecha_nacimiento_b);
		$("#parentesco").val(data.parentesco);		
		$("#semana_embarazo").val(data.semana_embarazo);		
		$("#talla_zapato").val(data.talla_zapato);		
		$("#talla_pantalon").val(data.talla_pantalon);		
		$("#talla_franela").val(data.talla_franela);
		
		//$("#id_beneficiario").val(data.id_beneficiario);

		//Solicitud
		$("#id_solicitud").val(data.id_solicitud);
		$("#fecha").val(data.fecha);
		$("#solicitud").val(data.solicitud);
		$("#descripcion").val(data.descripcion);
		$("#medio_informacion").val(data.medio_informacion);
		$("#observacion").val(data.observacion);
		$("#tipo_vivienda").val(data.tipo_vivienda);
		$("#tenencia").val(data.tenencia);
		$("#construccion").val(data.construccion);
		$("#tipo_piso").val(data.tipo_piso);
		
	});

	$.post("../ajax/consultas.php?op=listarFamiliar&id="+id_solicitud,function(r)
	{
		$("#detalles").html(r);	
	});

}

//Función para Aceptar la solicitud
function aceptar(id_solicitud)
{	
	var fecha_actual = $("#fecha_actual").val();

    //$('#fecha_actual').val(today);
	bootbox.confirm("¿Está Seguro que desea Aceptar la solicitud?", function(result){
		if(result)
        {
        	$.post("../ajax/consultas.php?op=aceptar", {id_solicitud : id_solicitud, fecha_actual : fecha_actual}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

init();