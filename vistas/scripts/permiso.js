var tabla; // Variable Global para almacenar todos los Datos en el Data Table

	//Función que se ejecuta al inicio
function init(){ 
	mostrarform(false); //No mostramos el formulario
	listar(); //Listamos los datos en el Data Table

	//Obtenemos la fecha actual
	var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);
	var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
    $('#fecha_actual').val(today);
}

	//Función mostrar formulario
		//"flag" es una bandera puede ser true o false
function mostrarform(flag){
	if (flag){ //Si es true va mostrar el formulario y ocultar el listado
		//$("#listadoregistros").hide();
		//$("#formularioregistros").show();
		//$("#btnGuardar").prop("disabled",false);
		//$("#btnagregar").hide();
	}else{
		$("#listadoregistros").show();
		//$("#formularioregistros").hide();
		//$("#btnagregar").hide();
	}
}

//Función Listar
function listar()
{
	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [ ],
		"ajax":
				{
					url: '../ajax/permiso.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

init();