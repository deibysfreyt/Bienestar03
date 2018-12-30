<?php 
	require_once("global.php");

 	try{

 		// Conectamos con la base de Datos mediante PDO
		 $conexion = new PDO('pgsql:host='.DB_HOST.';port='.PUERTO.';dbname='.DB_NAME.';user='.DB_USERNAME.';password='.DB_PASSWORD);
		 
	}catch (PDOException $e){
		 	// report error message
			 echo "No se puedo hacer conexión...!!!".$e->getMessage();
		}

		//Preguntamos si existe la  función para evitar algunos errores una ves ejecutada la conexionan
	if (!function_exists('ejecutarConsulta'))
	{	
		//Una función para ejecutar los SQL de inserción (Insertar, Actualizar)
		function ejecutarConsulta($sql)
		{
			global $conexion;
			$query = $conexion->query($sql);
			return $query;
		}
		//Ejecutamos la consulta con un parámetro obtenemos una fila como resultado en un array
		function ejecutarConsultaSimpleFila($sql)
		{
			global $conexion;
			$query = $conexion->query($sql)->fetch();
			return $query;
		}
		// Ejecutamos la consulta y nos devuelve la llave primaria del registro insertado
		function ejecutarConsulta_retornarID($sql)
		{
			global $conexion;
			$query = $conexion->query($sql);
			return $conexion->lastInsertId();
		}
		//Revisa un parámetro tipo String para limpiar los caracteres
		function limpiarCadena($str)
		{
			//elimine los espacios en blanco (u otros caracteres especiales) desde el principio y el final de una cadena
			$str = trim($str);
			//Filtra una variable con un filtro especificado. Eliminar etiquetas, opcionalmente eliminar o codificar caracteres especiales.
			$str = filter_var($str, FILTER_SANITIZE_STRING);
			//Convertir caracteres especiales a entidades HTML
			return htmlspecialchars($str);
		}
	}
	
 ?>