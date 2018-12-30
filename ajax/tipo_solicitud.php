<?php 
		//Llamamos al modelo
	require_once ("../modelos/modelo_tipo_solicitud.php");

	$tipo_solicitud = new Tipo_solicitud();

		// Limpiamos cada variable que es enviada por el AJAX con la función "LimpiarCadena()"
	$id_tipo_solicitud=isset($_POST["id_tipo_solicitud"])? limpiarCadena($_POST["id_tipo_solicitud"]):"";
	$solicitud=isset($_POST["solicitud"])? limpiarCadena($_POST["solicitud"]):"";
	$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";

	switch ($_GET["op"]){ // según la opción "op" enviado por el AJAX se procede a comparar

		case 'guardaryeditar':
				//Verificamos si el ID esta vació
			if (empty($id_tipo_solicitud)){ //si el ID esta vació guardamos un nuevo registro

				$rspta=$tipo_solicitud->insertar($solicitud,$descripcion);
					//Dependiendo de la inserción, la variable "repta" puede ser True o false
				echo $rspta ? "Categoría registrada" : "Categoría no se pudo registrar";
			}else { // Si el ID no esta vació procedemos a Editar o Actualizar la tabla
				$rspta=$tipo_solicitud->editar($id_tipo_solicitud,$solicitud,$descripcion);
					//Dependiendo de la inserción, la variable "repta" puede ser True o false
				echo $rspta ? "Categoría actualizada" : "Categoría no se pudo actualizar";
			}
		break;

		case 'desactivar':
				//Enviamos el ID a desactivar 
			$rspta=$tipo_solicitud->desactivar($id_tipo_solicitud);
				//Dependiendo de Desactiva, la variable "repta" puede ser True o false
	 		echo $rspta ? "Categoría Desactivada" : "Categoría no se puede desactivar";

		break;

		case 'activar':
				//Enviamos el ID a activar 
			$rspta=$tipo_solicitud->activar($id_tipo_solicitud);
				//Dependiendo de activar, la variable "repta" puede ser True o false
	 		echo $rspta ? "Categoría activada" : "Categoría no se puede activar";

		break;

		case 'mostrar':
				//Enviamos el ID para traer todo los datos referente a ella 
			$rspta=$tipo_solicitud->mostrar($id_tipo_solicitud);
	 			//Codificar el resultado utilizando json
	 		echo json_encode($rspta);

		break;

		case 'listar':
				//Listamos todo los datos para mostrarlo en el DATA TABLE
			$rspta=$tipo_solicitud->listar();
	 			//declaramos un array almacenar todos los registro que voy a listar
	 		$data= Array();
	 			//Recorrernos todos los registro 1 a 1 y lo almaceno en la variable $reg
	 		while ($reg=$rspta->fetchObject()){
	 				//Almacenamos todos los datos obtenido en el array $data
	 			$data[]=array(  //Los almacenamos en cada variable
	 				"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->id_tipo_solicitud.')"><i class="fa fa-pencil"></i></button>'.
	 					' <button class="btn btn-danger" onclick="desactivar('.$reg->id_tipo_solicitud.')"><i class="fa fa-close"></i></button>':
	 					'<button class="btn btn-warning" onclick="mostrar('.$reg->id_tipo_solicitud.')"><i class="fa fa-pencil"></i></button>'.
	 					' <button class="btn btn-primary" onclick="activar('.$reg->id_tipo_solicitud.')"><i class="fa fa-check"></i></button>',
	 				"1"=>$reg->solicitud,
	 				"2"=>$reg->descripcion,
	 				"3"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
	 				'<span class="label bg-red">Desactivado</span>'
	 				);
	 		} //Declaramos un nuevo array y le asignamos los valores
	 		$results = array( 
	 			"sEcho"=>1, //Información para el datatables
	 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
	 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
	 			"aaData"=>$data); // le enviamos el array que almacenamos los datos
				//Devolvemos a la petición AJAX el ultimo array
	 		echo json_encode($results);

		break;
	}
?>