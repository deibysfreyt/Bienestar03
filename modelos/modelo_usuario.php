<?php 
		//Incluimos inicialmente la conexión a la base de datos
	require "../controlador/conexion.php";

	Class Usuario {
			//Implementamos nuestro constructor
		function __construct(){

		}

			//Implementamos un método para insertar registros
		public function insertar($nombre_apellido,$cedula,$telefono,$email,$cargo,$login,$clave,$imagen,$permisos){

			$sql="INSERT INTO usuario (nombre_apellido,cedula,telefono,email,cargo,login,clave,imagen,condicion) VALUES ('$nombre_apellido','$cedula','$telefono','$email','$cargo','$login','$clave','$imagen','1') ";
			// Retornamos el ID insertado
			$id_usuarionew = ejecutarConsulta_retornarID($sql);

			$num_elementos=0;
			$sw=true;
			// Para asignar la cantidad de permiso asociada al Usuario
			while ($num_elementos < count($permisos)){

				$sql_detalle = "INSERT INTO usuario_permiso(id_usuario, id_permiso) VALUES('$id_usuarionew', '$permisos[$num_elementos]')";

				ejecutarConsulta($sql_detalle) or $sw = false;

				$num_elementos=$num_elementos + 1;
			}

			return $sw;
		}

			//Implementamos un método para editar registros
		public function editar($id_usuario,$nombre_apellido,$cedula,$telefono,$email,$cargo,$login,$clave,$imagen,$permisos){

			$sql="UPDATE usuario SET nombre_apellido='$nombre_apellido',cedula='$cedula',telefono='$telefono',email='$email',cargo='$cargo',login='$login',clave='$clave',imagen='$imagen' WHERE id_usuario='$id_usuario'";
			
			ejecutarConsulta($sql);

				//Eliminamos todos los permisos asignados para volverlos a registrar
			$sqldel="DELETE FROM usuario_permiso WHERE id_usuario='$id_usuario'";
			
			ejecutarConsulta($sqldel);

			$num_elementos=0;
			$sw=true;

			while ($num_elementos < count($permisos)){
				
				$sql_detalle = "INSERT INTO usuario_permiso(id_usuario, id_permiso) VALUES('$id_usuario', '$permisos[$num_elementos]')";

				ejecutarConsulta($sql_detalle) or $sw = false;

				$num_elementos=$num_elementos + 1;
			}

			return $sw;

		}

			// Eliminamos al Usuario
		public function eliminar($id_usuario){

			$sql = "DELETE FROM usuario WHERE id_usuario='$id_usuario'";
			
			return ejecutarConsulta($sql);
		}

			//Implementamos un método para desactivar registros
		public function desactivar($id_usuario){
			
			$sql="UPDATE usuario SET condicion='0' WHERE id_usuario='$id_usuario'";

			return ejecutarConsulta($sql);
		}

			//Implementamos un método para activar registros
		public function activar($id_usuario){
			
			$sql="UPDATE usuario SET condicion='1' WHERE id_usuario='$id_usuario'";
			
			return ejecutarConsulta($sql);
		}

			//Implementar un método para mostrar los datos de un registro a modificar
		public function mostrar($id_usuario){
			
			$sql="SELECT * FROM usuario WHERE id_usuario='$id_usuario'";
			
			return ejecutarConsultaSimpleFila($sql);
		}

			//Implementar un método para listar los registros
		public function listar(){
			
			$sql="SELECT * FROM usuario";
			
			return ejecutarConsulta($sql);		
		}

			//Implementar un método para listar los permisos marcados
		public function listarmarcados($id_usuario){
			
			$sql="SELECT * FROM usuario_permiso WHERE id_usuario='$id_usuario'";
			
			return ejecutarConsulta($sql);
		}

			//Función para verificar el acceso al sistema
		public function verificar($login,$clave){
    		
    		$sql="SELECT id_usuario,nombre_apellido,cedula,telefono,email,cargo,imagen,login FROM usuario WHERE login='$login' AND clave='$clave' AND condicion='1'"; 
    		
    		return ejecutarConsulta($sql);  
    	}

	}

?>