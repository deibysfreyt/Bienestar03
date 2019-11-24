<?php
		//Llamamos al modelo
	require_once("../modelos/modelo_informe_social.php");
		// Validamos si la Sesión esta iniciada
	if (strlen(session_id()) < 1)
		session_start();

	$informe_social = new Informe_social();
		// Limpiamos cada variable que es enviada por el AJAX con la función "LimpiarCadena()"

		//Solicitante
	$id_solicitante = isset($_POST["id_solicitante"])? limpiarCadena($_POST["id_solicitante"]): "";
	$cedula = isset($_POST["cedula"])? limpiarCadena($_POST["cedula"]): "";
	$nombre_apellido = isset($_POST["nombre_apellido"])? limpiarCadena($_POST["nombre_apellido"]): "";
	$fecha_nacimiento = isset($_POST["fecha_nacimiento"])? limpiarCadena($_POST["fecha_nacimiento"]): "";
	$direccion = isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]): "";
	$telefono_1 = isset($_POST["telefono_1"])? limpiarCadena($_POST["telefono_1"]): "";
	$telefono_2 = isset($_POST["telefono_2"])? limpiarCadena($_POST["telefono_2"]): "";
	$parroquia = isset($_POST["parroquia"])? limpiarCadena($_POST["parroquia"]): "";
	$ocupacion = isset($_POST["ocupacion"])? limpiarCadena($_POST["ocupacion"]): "";
	$ingreso = isset($_POST["ingreso"])? limpiarCadena($_POST["ingreso"]): "";
	$estado_civil = isset($_POST["estado_civil"])? limpiarCadena($_POST["estado_civil"]): "";
	$edad_s = isset($_POST["edad_s"])? limpiarCadena($_POST["edad_s"]): "";

		//Solicitud
	$id_solicitud = isset($_POST["id_solicitud"])? limpiarCadena($_POST["id_solicitud"]): "";
	$id_tipo_solicitud = isset($_POST["id_tipo_solicitud"])? limpiarCadena($_POST["id_tipo_solicitud"]): "";
	$id_usuario = $_SESSION["id_usuario"];
	$fecha = isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]): "";
	$tipo_vivienda = isset($_POST["tipo_vivienda"])? limpiarCadena($_POST["tipo_vivienda"]): "";
	$tenencia = isset($_POST["tenencia"])? limpiarCadena($_POST["tenencia"]): "";
	$construccion = isset($_POST["construccion"])? limpiarCadena($_POST["construccion"]): "";
	$tipo_piso = isset($_POST["tipo_piso"])? limpiarCadena($_POST["tipo_piso"]): "";
	$diagnostico = isset($_POST["diagnostico"])? limpiarCadena($_POST["diagnostico"]): "";
	$observacion = isset($_POST["observacion"])? limpiarCadena($_POST["observacion"]): "";
	$recaudos = isset($_POST["recaudos"])? limpiarCadena($_POST["recaudos"]): "";

		//Beneficiario
	$id_beneficiario = isset($_POST["id_beneficiario"])? limpiarCadena($_POST["id_beneficiario"]): "";
	$cedula_b = isset($_POST["cedula_b"])? limpiarCadena($_POST["cedula_b"]): "";
	$nombre_apellido_b = isset($_POST["nombre_apellido_b"])? limpiarCadena($_POST["nombre_apellido_b"]): "";
	$fecha_nacimiento_b = isset($_POST["fecha_nacimiento_b"])? limpiarCadena($_POST["fecha_nacimiento_b"]): "";
	$semana_embarazo = isset($_POST["semana_embarazo"])? limpiarCadena($_POST["semana_embarazo"]): "";
	$edad_b = isset($_POST["edad_b"])? limpiarCadena($_POST["edad_b"]): "";
	$estado = isset($_POST["estado"])? limpiarCadena($_POST["estado"]): "En espera";

	$id_familiar = isset($_POST["id_familiar"])? $_POST["id_familiar"] : "" ;
	$nombre_apellido_f = isset($_POST["nombre_apellido_f"])? $_POST["nombre_apellido_f"] : "";
	$edad_f = isset($_POST["edad_f"])? $_POST["edad_f"] : "";
	$parentesco_f = isset($_POST["parentesco_f"])? $_POST["parentesco_f"] : "";
	$ocupacion_f = isset($_POST["ocupacion_f"])? $_POST["ocupacion_f"] : "";
	$observacion_f = isset($_POST["observacion_f"])? $_POST["observacion_f"] : "";

	switch ($_GET["op"]) { // según la opción "op" enviado por el AJAX se procede a comparar

		case 'guardaryeditar':
				//Verificamos si ambos ID esta vació
			if (empty($id_solicitante) && empty($id_beneficiario)) { //si el ID esta vació guardamos un nuevo registro
					//Si no existe el solicitante y el beneficiario, ambos se agrega
				$rspta = $informe_social->insertar($cedula,$nombre_apellido,$fecha_nacimiento,$direccion,$telefono_1,$telefono_2,$parroquia,$ocupacion,$ingreso,$cedula_b,$nombre_apellido_b,$fecha_nacimiento_b,$semana_embarazo,$id_tipo_solicitud,$id_usuario,$fecha,$tipo_vivienda,$tenencia,$construccion,$tipo_piso,$id_familiar,$nombre_apellido_f,$edad_f,$parentesco_f,$ocupacion_f,$observacion_f,$estado_civil,$diagnostico,$observacion,$edad_s,$edad_b,$recaudos,$estado);

				//Verificamos si uno de los ID esta vació
			}else if (empty($id_beneficiario) && !empty($id_solicitante)){
				// Se actualiza el Solicitante cuando este existe en la base de datos pero no el beneficiario
				$rspta = $informe_social->editars($id_solicitante,$cedula,$nombre_apellido,$fecha_nacimiento,$direccion,$telefono_1,$telefono_2,$parroquia,$ocupacion,$ingreso,$cedula_b,$nombre_apellido_b,$fecha_nacimiento_b,$semana_embarazo,$id_tipo_solicitud,$id_usuario,$fecha,$tipo_vivienda,$tenencia,$construccion,$tipo_piso,$id_familiar,$nombre_apellido_f,$edad_f,$parentesco_f,$ocupacion_f,$observacion_f,$estado_civil,$diagnostico,$observacion,$edad_s,$edad_b,$recaudos,$estado);	

			}else {
				//Cundo El beneficiario y el Solicitante Existe en el Sistema
				$rspta = $informe_social->insertarbs($id_solicitante,$cedula,$nombre_apellido,$fecha_nacimiento,$direccion,$telefono_1,$telefono_2,$parroquia,$ocupacion,$ingreso,$id_beneficiario,$cedula_b,$nombre_apellido_b,$fecha_nacimiento_b,$semana_embarazo,$id_tipo_solicitud,$id_usuario,$fecha,$tipo_vivienda,$tenencia,$construccion,$tipo_piso,$id_familiar,$nombre_apellido_f,$edad_f,$parentesco_f,$ocupacion_f,$observacion_f,$estado_civil,$diagnostico,$observacion,$edad_s,$edad_b,$recaudos,$estado);				
			}
		break;

		case 'mostrar':
				//Enviamos el ID para traer todo los datos referente a ella
			$rspta = $informe_social->mostrar($id_solicitud);
				//Codificar el resultado utilizando json
			echo json_encode($rspta);
		break;

		case 'listar':
				//Listamos todo los datos para mostrarlo en el DATA TABLE
			$rspta=$informe_social->listar();
	 			//declaramos un array almacenar todos los registro que voy a listar
	 		$data= Array();
	 			//Recorrernos todos los registro 1 a 1 y lo almaceno en la variable $reg
	 		while ($reg=$rspta->fetchObject()){
	 				//Almacenamos todos los datos obtenido en el array $data
	 			$data[]=array( //Los almacenamos en cada variable
	 				"0"=>'<button class="btn btn-warning" onclick="mostrart('.$reg->id_solicitud.')"><i class="fa fa-users"></i></button>',
	 				"1"=>'<button class="btn btn-warning" onclick="mostrars('.$reg->id_solicitud.')"><i class="fa fa-user"></i></button> '.$reg->solicitante.' - '.$reg->cedulas,
	 				"2"=>$reg->beneficiario.' - '.$reg->cedulab,
	 				"3"=>$reg->id_solicitud,
	 				"4"=>$reg->solicitud.' - '.$reg->descripcion,
	 				"5"=>$reg->fecha
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

		case 'selectTipoSolicitud': //Seleccionamos la solicitud a Mostrar
				//Llamamos el Modelo para acceder a el
			require_once("../modelos/modelo_tipo_solicitud.php");
				//Almacenamos todo los datos que se fueron a consultar
			$tipo_solicitud = new Tipo_solicitud();
				//Recorrernos todos los registro 1 a 1 y lo almaceno en la variable $reg
			$rspta = $tipo_solicitud->select();

			while ($reg = $rspta->fetchObject()) {
					//Mostramos o imprimimos los dato uno a uno
				echo '<option value='.$reg->id_tipo_solicitud.'>'.$reg->solicitud.' - '.$reg->descripcion.'</option>';
			}
		break;

	}

 ?>