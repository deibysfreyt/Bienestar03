var tabla; // Variable Global para almacenar todos los Datos en el Data Table

	//Función que se ejecuta al inicio
function init(){		
	mostrarform(false); //No mostramos el formulario
	listar(); //Listamos los datos en el Data Table
		
	$("#formulario").on("submit",function(e){ //Si en el formulario se activa el evento submit
		guardaryeditar(e); //Llamamos a la función
	})

		//Cargamos los items al select Solicitante
		//Mediante JQuery enviamos la opción y las opciones las agregamos al ID
	$.post("../ajax/visita_social.php?op=selectpersona",function(r){
			//las opciones las agregamos al ID
		$("#id_solicitud").html(r);
		$('#id_solicitud').selectpicker('refresh');
	})

		//Obtenemos la fecha actual
	var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);
	var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
    $('#fecha_actual').val(today);
    $('#fecha_a').val(now.toLocaleString());
}

	//Función limpiar los objetos del formulario ID
function limpiar(){
	$("#id_visita_social").val("");
	$("#observaciones").val("");
	$("#trabajador_social").val("");
	$("#id_solicitud").val("");

		//Obtenemos la fecha_v actual
	var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);
	var today = now.getFullYear()+"-"+(month)+"-"+(day);
    $('#fecha_v').val(today);
    $('#fecha_a').val(today);
}

	//Función mostrar formulario
		//"flag" es una bandera puede ser true o false
function mostrarform(flag){
	limpiar(); //Limpiamos el formulario
	if (flag) { //Si es true va mostrar el formulario y ocultar el listado
		$("#listadoregistros").hide(); //Ocultamos el listado
		$("#formularioregistros").show(); //Mostramos el formulario
		$("#btnGuardar").prop("disabled",false); //Cuando muestre el formulario el botón va a estar activo
		$("#btnagregar").hide(); //Ocultamos el botón de agregar nuevo formulario
	}else{ //Si es false va ocultar el formulario y muestra el listado 
		$("#listadoregistros").show(); //Mostramos el listado
		$("#formularioregistros").hide(); //Ocultamos el formulario
		$("#btnagregar").show(); //Mostramos el botón para agregar nuevo formulario
	}
}

	//Función para cancelar el Formulario
function cancelarform(){
	limpiar(); //Limpiamos el formulario
	mostrarform(false); //le enviamos el flag = false  para que no este visible
}

	//función listar
function listar(){
	tabla = $('#tbllistado').dataTable({
		"aProcessing": true, //Activamos el procesamiento del datatables
		"aServerSide": true, //Paginación y filtrado realizados por el servidor
		dom: 'Bfrtip', //Definimos los elementos del control de tabla
		buttons: [],
		"ajax": {
			url: '../ajax/visita_social.php?op=listar',
			type : "get",
			dataType: "json",
			error: function(e){ //Si tenemos un error,
					//lo mostramos en un texto plano en la consola del navegador
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		"iDisplayLength": 5, //Paginación
		"order": [[0,"desc"]] //Ordenar según la table (Columna de referencia,tipo de orden)
	}).DataTable();
}

	// Función para Guardar y Editar
function guardaryeditar(e){
	e.preventDefault(); // Nose activara la acción predeterminada del evento del formulario sutmit
	$("btnGuardar").prop("disabled",true); //Al darle click al botón guardar lo deshabilitamos
	var formData = new FormData($("#formulario")[0]); //Obtenemos los datos de todo el formulario

	$.ajax({
		url: "../ajax/visita_social.php?op=guardaryeditar",
		type: "POST",
		data: formData, //Los datos que estemos enviando lo vamos a obtener de la "var formData"
		contentType: false,
		processData: false,
			//Si se ejecuta correctamente
		success: function(datos){				
			bootbox.alert(datos); //Muestro los datos que estoy recibiendo en el alert (el "echo $rspta")
			mostrarform(false); //Ocultamos el formulario flag = false
			tabla.ajax.reload(); //Actualizo o recargo el Data Table
		}
	});
	limpiar(); //Limpiamos el formulario
}

	//Mostramos los datos referente al ID
function mostrar(id_solicitud){
		//Mediante JQuery enviamos la opción y la variable ID
	$.post("../ajax/visita_social.php?op=mostrar",{id_solicitud : id_solicitud}, function(data, status) //La función va a obtener un valor que lo vamos almacenar en data
	{
		data = JSON.parse(data); //Convierto los datos que recibo en objeto JavaScrip
		mostrarform(true); //Mostramos el formulario flag = true
			//Busco los objeto cuyo ID y le enviamos el nuevo objeto
		$("#id_solicitud").val(data.id_solicitud); 
		$('#id_solicitud').selectpicker('refresh');
		$("#fecha_v").val(data.fecha_v);
		$("#observaciones").val(data.observaciones);
		$("#trabajador_social").val(data.trabajador_social);
		$("#id_visita_social").val(data.id_visita_social);
	})
}

init(); //AL finalizar el código siempre ejecute la función init()