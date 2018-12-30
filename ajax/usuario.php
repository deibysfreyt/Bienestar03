<?php
		//Iniciamos Sesión 
	session_start();
		//Llamamos al modelo
	require_once ("../modelos/modelo_usuario.php");

	$usuario = new Usuario();

		// Limpiamos cada variable que es enviada por el AJAX con la función "LimpiarCadena()"
	$id_usuario = isset($_POST["id_usuario"])? limpiarCadena($_POST["id_usuario"]):"";
	$nombre_apellido = isset($_POST["nombre_apellido"])? limpiarCadena($_POST["nombre_apellido"]):"";
	$cedula = isset($_POST["cedula"])? limpiarCadena($_POST["cedula"]):"";
	$telefono = isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
	$email = isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
	$cargo = isset($_POST["cargo"])? limpiarCadena($_POST["cargo"]):"";
	$login = isset($_POST["login"])? limpiarCadena($_POST["login"]):"";
	$clave = isset($_POST["clave"])? limpiarCadena($_POST["clave"]):"";
	$imagen = isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";

	switch ($_GET["op"]){  // según la opción "op" enviado por el AJAX se procede a comparar

		case 'guardaryeditar':
				//Validar que el objeto del formulario "imagen" contenga un archivo del tipo imagen
				//si el Archivo existe o no a sido cargado
			if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name'])){

				$imagen = $_POST["imagenactual"];

			}else {

					//Obtener la extensión del archivo
				$ext = explode(".", $_FILES["imagen"]["name"]);

					// Si existe verificamos que sea del tipo imagen
				if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png"){

						//Re-nombramos el nombre de la imagen
					$imagen = round(microtime(true)) . '.' . end($ext);

						//Cargamos la imagen 					La Almacenamos en la dirección
					move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/usuario/" . $imagen);

				}
			}

				//Hash SHA256 en la contraseña para encriptarla
			$clavehash = hash("SHA256",$clave);

				//Verificamos si la ID esta vació
			if (empty($id_usuario)){ //si el ID esta vació guardamos un nuevo registro

				$rspta = $usuario->insertar($nombre_apellido,$cedula,$telefono,$email,$cargo,$login,$clavehash,$imagen,$_POST['permiso']);
					//Dependiendo de la inserción, la variable "repta" puede ser True o false
				echo $rspta ? "Usuario registrado" : "No se pudieron registrar todos los datos del Usuario";

			}else { // Si la ID no esta vació procedemos a Editar o Actualizar la tabla

				$rspta = $usuario->editar($id_usuario,$nombre_apellido,$cedula,$telefono,$email,$cargo,$login,$clavehash,$imagen,$_POST['permiso']);
					//Dependiendo de la inserción, la variable "repta" puede ser True o false
				echo $rspta ? "Usuario actualizado" : "Usuario no se pudo actualizar";
			}
		break;

		case 'eliminar':
				//Enviamos el ID a eliminar 
			$rspta = $usuario->eliminar($id_usuario);
				//Dependiendo de la eliminación, la variable "repta" puede ser True o false
 			echo $rspta ? "El usuario fue Eliminado con éxito" : "El usuario no se puedo eliminar";

		break;

		case 'desactivar':
				//Enviamos el ID a desactivar 
			$rspta = $usuario->desactivar($id_usuario);
				//Dependiendo de Desactiva, la variable "repta" puede ser True o false
 			echo $rspta ? "Usuario Desactivado" : "El Usuario no se puede desactivar";

		break;

		case 'activar':
				//Enviamos el ID a activar 
			$rspta=$usuario->activar($id_usuario);
				//Dependiendo de activar, la variable "repta" puede ser True o false
 			echo $rspta ? "Usuario activado" : "El Usuario no se puede activar";

		break;

		case 'mostrar':
				//Enviamos el ID para traer todo los datos referente a ella 
			$rspta=$usuario->mostrar($id_usuario);
 				//Codificar el resultado utilizando json
 			echo json_encode($rspta);

		break;

		case 'listar':
				//Listamos todo los datos para mostrarlo en el DATA TABLE
			$rspta=$usuario->listar();
 				//declaramos un array almacenar todos los registro que voy a listar
 			$data= Array();
 				//Recorrernos todos los registro 1 a 1 y lo almaceno en la variable $reg
 			while ($reg=$rspta->fetchObject()){
 				$data[]=array(
 					"0"=>($reg->condicion)?'<button class="btn btn-success" onclick="mostrar('.$reg->id_usuario.')"><i class="fa fa-pencil"></i></button>'.
 						' <button class="btn btn-warning" onclick="desactivar('.$reg->id_usuario.')"><i class="fa fa-close"></i></button>'.' <button class="btn btn-danger" onclick="eliminar('.$reg->id_usuario.')"><i class="fa fa-trash-o"></i></button>':
 						' <button class="btn btn-success" onclick="mostrar('.$reg->id_usuario.')"><i class="fa fa-pencil"></i></button>'.
 						' <button class="btn btn-primary" onclick="activar('.$reg->id_usuario.')"><i class="fa fa-check"></i></button>'.' <button class="btn btn-danger" onclick="eliminar('.$reg->id_usuario.')"><i class="fa fa-trash-o"></i></button>',
 					"1"=>$reg->nombre_apellido,
 					"2"=>$reg->cedula,
 					"3"=>$reg->telefono,
 					"4"=>$reg->email,
 					"5"=>$reg->cargo,
 					"6"=>$reg->login,
 					"7"=>"<img src='../files/usuario/".$reg->imagen."' height='50px' width='50px' >",
 					"8"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
 						'<span class="label bg-red">Desactivado</span>'
 					);
 			}//Declaramos un nuevo array y le asignamos los valores
 			$results = array(
 				"sEcho"=>1, //Información para el data tables
 				"iTotalRecords"=>count($data), //enviamos el total registros al data table
 				"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 				"aaData"=>$data); // le enviamos el array que almacenamos los datos
 				//Devolvemos a la petición AJAX el ultimo array
 			echo json_encode($results);

		break;

		case 'permisos':
				//Obtenemos todos los permisos de la tabla permisos
			require_once ("../modelos/modelo_permiso.php");

			$permiso = new Permiso();
			$rspta = $permiso->listar();

				//Obtener los permisos asignados al usuario
			$id=$_GET['id'];
			$marcados = $usuario->listarmarcados($id);
				//Declaramos el array para almacenar todos los permisos marcados
			$valores=array();
				//Almacenar los permisos asignados al usuario en el array
			while ($per = $marcados->fetchObject()){

				array_push($valores, $per->id_permiso);

			}

				//Mostramos la lista de permisos en la vista y si están o no marcados
			while ($reg = $rspta->fetchObject()){

				$sw=in_array($reg->id_permiso,$valores)?'checked':'';
				
				echo '<li> <input type="checkbox" '.$sw.'  name="permiso[]" value="'.$reg->id_permiso.'">'.$reg->nombre.'</li>';
				}
		
		break;

		case 'verificar':
				//LAs variable del inicio las almacenamos
			$logina=$_POST['logina'];
	    	$clavea=$_POST['clavea'];

	    		//Codificamos con el Hash SHA256 la contraseña
			$clavehash=hash("SHA256",$clavea);
				//Enviamos los datos 
			$rspta=$usuario->verificar($logina,$clavehash);
				//Almacenamos en una variable los datos en una fila
			$fetch=$rspta->fetchObject();
				//Verificamos si hubo alguna dato y lo guardamos en jon
			if ( json_encode($fetch) != 'false') {
					//Declaramos las variables de sesión
		    	$_SESSION['id_usuario'] = $fetch->id_usuario;
		    	$_SESSION['nombre_apellido'] = $fetch->nombre_apellido;
		    	$_SESSION['login'] = $fetch->login;
		    	$_SESSION['imagen'] = $fetch->imagen;

		    		//Obtenemos los permisos del usuario
		    	$marcados = $usuario->listarmarcados($fetch->id_usuario);

		    		//Declaramos el array para almacenar todos los permisos marcados
		   		$valores = array();

		    		//Almacenamos los permisos marcados en un array
		    	while ($per = $marcados->fetchObject()) {
		    		array_push($valores, $per->id_permiso);
		    	}
		   			//Determinamos los accesos del usuario asignando los permisos
				in_array(1,$valores)?$_SESSION['Gestion de Usuario']=1:$_SESSION['Gestion de Usuario']=0;
				in_array(2,$valores)?$_SESSION['Solicitante']=1:$_SESSION['Solicitante']=0;
				in_array(3,$valores)?$_SESSION['Gestion de Solicitud']=1:$_SESSION['Gestion de Solicitud']=0;
				in_array(4,$valores)?$_SESSION['Reportes']=1:$_SESSION['Reportes']=0;
			}
				// Enviamos los datos Obtenido mediante json para su verificación en el login
	    	echo json_encode($fetch);

		break;

		case 'salir':
				//Limpiamos las Variables de Sesión
			session_unset();
				//Destruimos la Sesión
			session_destroy();
				//direccional al Login
			header("location: ../index.php");

		break;

	}
?>