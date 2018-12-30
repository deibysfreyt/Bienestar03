<?php 
		//Llamamos al modelo
	require_once "../modelos/modelo_permiso.php";

	$permiso = new Permiso();

	switch ($_GET["op"]){  // según la opción "op" enviado por el AJAX se procede a comparar

		case 'listar':
				//Listamos todo los datos para mostrarlo en el DATA TABLE
			$rspta=$permiso->listar();
 				//declaramos un array almacenar todos los registro que voy a listar
 			$data= Array();
 				//Recorrernos todos los registro 1 a 1 y lo almaceno en la variable $reg
 			while ($reg=$rspta->fetchObject()){
 					//Almacenamos todos los datos obtenido en el array $data
 				$data[]=array( //Los almacenamos en cada variable
 					"0"=>$reg->nombre
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