<?php 
		//Incluimos inicialmente la conexión a la base de datos
	require_once("../controlador/conexion.php");

	class VisitaSocial {
		
		function __construct(){
		
		}

		 //Implementamos un método para registrar
		public function insertar($id_persona,$fecha_v,$observaciones,$trabajador_social){

			$sql = "INSERT INTO visita_social (id_persona,fecha_v,observaciones,trabajador_social) VALUES ('$id_persona','$fecha_v','$observaciones','$trabajador_social')";

			return ejecutarConsulta($sql);
		}

		 //Implementamos un método para editar registros
		public function editar($id_visita_social,$id_persona,$fecha_v,$observaciones,$trabajador_social){

			$sql = "UPDATE visita_social SET id_persona='$id_persona',fecha_v='$fecha_v',observaciones='$observaciones',trabajador_social='$trabajador_social' WHERE id_visita_social='$id_visita_social'";

			return ejecutarConsulta($sql);
		}

		 //Llamamos todos los datos referente a ID a consultar
		public function mostrar($id_persona){

			$sql = "SELECT p.id_persona,vs.id_visita_social,vs.fecha_v,vs.observaciones,vs.trabajador_social FROM visita_social vs INNER JOIN persona p ON p.id_persona=vs.id_persona WHERE vs.id_persona='$id_persona'";

			return ejecutarConsultaSimpleFila($sql);
		}

		 //Implementar un método para listar los registros en el Data Table
		public function listar(){
			
			$sql = "SELECT p.id_persona,vs.id_visita_social,p.nombre_apellido_p as beneficiario,p.cedula_p as cedula,Date(vs.fecha_v) as fecha,vs.observaciones,vs.trabajador_social FROM visita_social vs INNER JOIN persona p ON p.id_persona=vs.id_persona";

			return ejecutarConsulta($sql);
		}

	}


 ?>