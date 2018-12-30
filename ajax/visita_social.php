<?php 
		//Llamamos al modelo
	require_once("../modelos/modelo_visita_social.php");

	$visita_social = new VisitaSocial();

		// Limpiamos cada variable que es enviada por el AJAX con la función "LimpiarCadena()"
	$id_visita_social = isset($_POST["id_visita_social"])? limpiarCadena($_POST["id_visita_social"]): "";
	$id_persona = isset($_POST["id_persona"])? limpiarCadena($_POST["id_persona"]): "";
	$fecha_v = isset($_POST["fecha_v"])? limpiarCadena($_POST["fecha_v"]): "";
	$observaciones = isset($_POST["observaciones"])? limpiarCadena($_POST["observaciones"]): "";
	$trabajador_social = isset($_POST["trabajador_social"])? limpiarCadena($_POST["trabajador_social"]): "";
	$id_solicitud = isset($_POST["id_solicitud"])? limpiarCadena($_POST["id_solicitud"]): "";
	

	switch ($_GET["op"]) { // según la opción "op" enviado por el AJAX se procede a comparar

		case 'guardaryeditar':
				//Verificamos si el ID esta vació
			if (empty($id_visita_social)) { //si el ID esta vació guardamos un nuevo registro

				$rspta = $visita_social->insertar($id_persona,$fecha_v,$observaciones,$trabajador_social);
					//Dependiendo de la inserción, la variable "repta" puede ser True o false
				echo $rspta ? "La Visita Social a sido registrado correctamente" : "No se pudo Registrar la Visita Social";

			}else{ // Si el ID no esta vació procedemos a Editar o Actualizar la tabla

				$rspta = $visita_social->editar($id_visita_social,$id_persona,$fecha_v,$observaciones,$trabajador_social);
					//Dependiendo de la inserción, la variable "repta" puede ser True o false
				echo $rspta ? "La Visita Social fue actualizado correctamente" : "No se puedo Actualizar la Visita Social";
			}
		break;

		case 'mostrar':
				//Enviamos el ID para traer todo los datos referente a ella 
			$rspta = $visita_social->mostrar($id_persona);
				//Codificar el resultado utilizando json
			echo json_encode($rspta);

		break;

		case 'listar':
				//Listamos todo los datos para mostrarlo en el DATA TABLE
			$rspta = $visita_social->listar();
				//declaramos un array almacenar todos los registro que voy a listar
			$data = Array();
				//Recorrernos todos los registro 1 a 1 y lo almaceno en la variable $reg
			while ($reg = $rspta->fetchObject()) {
					//Almacenamos todos los datos obtenido en el array $data
				$data[] = array( //Los almacenamos en cada variable
					"0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->id_persona.')"><i class="fa fa-pencil"></i></button>',
					"1"=>$reg->beneficiario.' - '.$reg->cedula,
					"2"=>$reg->fecha,
					"3"=>$reg->observaciones,
					"4"=>$reg->trabajador_social
				);
			} //Declaramos un nuevo array y le asignamos los valores
			$results = array(
				"sEcho"=>1, // Información para data tables
				"iTotalRecords"=>count($data), // Enviamos el total registros al data table
				"iTotalDisplayRecords"=>count($data), //Enviamos el total registro a Visualizar
				"aaData"=>$data); // le enviamos el array que almacenamos los datos
				//Devolvemos a la petición AJAX el ultimo array
			echo json_encode($results);

		break;
			
		case 'selectpersona': //Seleccionamos el Beneficiario a Mostrar
				//Llamamos el Modelo para acceder a el
			require_once("../modelos/modelo_informe_social.php");

			$informe_social = new Informe_social();

				//Almacenamos todo los datos que se fueron a consultar
			$rspta = $informe_social->select();
				//Recorrernos todos los registro 1 a 1 y lo almaceno en la variable $reg
			while ($reg = $rspta->fetchObject()) {
					//Mostramos o imprimimos los dato uno a uno
				echo '<option value='.$reg->id_persona.'>'.$reg->id_solicitud.' - '.$reg->nombre_apellido_p.' - '.$reg->cedula_p.'</option>';											
			}

		break;

	}

 ?>