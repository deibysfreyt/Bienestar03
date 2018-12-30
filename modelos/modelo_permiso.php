<?php 
		//Incluimos inicialmente la conexión a la base de datos
	require_once("../controlador/conexion.php");

	Class Permiso{
			//Implementamos nuestro constructor
		function __construct(){

		}

			//Implementar un método para listar los registros
		public function listar(){
		
			$sql="SELECT * FROM permiso";
			
			return ejecutarConsulta($sql);		
		}
	}

?>