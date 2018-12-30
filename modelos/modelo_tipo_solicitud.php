<?php 
		//Incluimos icinicalmente la conexion a la base de datos
	require_once("../controlador/conexion.php");

	Class Tipo_solicitud {
			//Implementamos nuestro constructor
		function __construct(){

		}

			//Implementamos un método para insertar registros
		public function insertar($solicitud,$descripcion){
			
			$sql="INSERT INTO tipo_solicitud (solicitud,descripcion,condicion) VALUES ('$solicitud','$descripcion','1')";
			
			return ejecutarConsulta($sql);
		}

			//Implementamos un método para editar registros
		public function editar($id_tipo_solicitud,$solicitud,$descripcion){
			
			$sql="UPDATE tipo_solicitud SET solicitud='$solicitud',descripcion='$descripcion' WHERE id_tipo_solicitud='$id_tipo_solicitud'";
			
			return ejecutarConsulta($sql);
		}

			//Implementamos un método para desactivar categorías
		public function desactivar($id_tipo_solicitud){
			
			$sql="UPDATE tipo_solicitud SET condicion='0' WHERE id_tipo_solicitud='$id_tipo_solicitud'";
			
			return ejecutarConsulta($sql);
		}

			//Implementamos un método para activar categorías
		public function activar($id_tipo_solicitud){
			
			$sql="UPDATE tipo_solicitud SET condicion='1' WHERE id_tipo_solicitud='$id_tipo_solicitud'";
			
			return ejecutarConsulta($sql);
		}

			//Implementar un método para mostrar los datos de un registro a modificar
		public function mostrar($id_tipo_solicitud){
			
			$sql="SELECT * FROM tipo_solicitud WHERE id_tipo_solicitud='$id_tipo_solicitud'";
			
			return ejecutarConsultaSimpleFila($sql);
		}

			//Implementar un método para listar los registros
		public function listar(){
			
			$sql="SELECT * FROM tipo_solicitud";
			
			return ejecutarConsulta($sql);		
		}
		
			//Implementar un método para listar los registros y mostrar en el select
		public function select(){
			
			$sql="SELECT id_tipo_solicitud,solicitud,descripcion FROM tipo_solicitud where condicion='1'";
			
			return ejecutarConsulta($sql);		
		}
	}

?>