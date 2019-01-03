<?php 
		//Incluimos inicialmente la conexión a la base de datos
	require_once("../controlador/conexion.php");

	class VisitaSocial {
		
		function __construct(){
		
		}

		 //Implementamos un método para registrar
		public function insertar($id_solicitud,$fecha_v,$observaciones,$trabajador_social,$id_usuario,$fecha_a){

			$sw_v = true;
			$sql = "INSERT INTO visita_social (id_solicitud,fecha_v,observaciones,trabajador_social) VALUES ('$id_solicitud','$fecha_v','$observaciones','$trabajador_social')";

			// return ejecutarConsulta($sql);
			ejecutarConsulta($sql) or $sw_v = false;

			//Insertamos en la tabla bitacora para llevar un registro de los movimiento en el sistema
			$sw_bi = true;
			$sql_bi = "INSERT INTO bitacora (id_usuario,fecha_b,accion,descripcion) VALUES ('$id_usuario','$fecha_a','Agrego','Visita Social')";
			
				//en caso de los datos no se hallan guardado $sw_us guardamos false 
			ejecutarConsulta($sql_bi) or $sw_bi = false;

			if ($sw_bi && $sw_v) {
					// Si todo los datos Fuero correctamente insertado retornamos Verdadero
				return true;
			}else{
					//En el caso que algún SQL no fue guardado con existo enviamos falso
				return false;
			}
		}

		 //Implementamos un método para editar registros
		public function editar($id_visita_social,$id_solicitud,$fecha_v,$observaciones,$trabajador_social,$id_usuario,$fecha_a){

			$sw_v = true;
			$sql = "UPDATE visita_social SET id_solicitud='$id_solicitud',fecha_v='$fecha_v',observaciones='$observaciones',trabajador_social='$trabajador_social' WHERE id_visita_social='$id_visita_social'";

			// return ejecutarConsulta($sql);
			ejecutarConsulta($sql) or $sw_v = false;

			//Insertamos en la tabla bitacora para llevar un registro de los movimiento en el sistema
			$sw_bi = true;
			$sql_bi = "INSERT INTO bitacora (id_usuario,fecha_b,accion,descripcion) VALUES ('$id_usuario','$fecha_a','Edito','Visita Social')";
			
				//en caso de los datos no se hallan guardado $sw_us guardamos false 
			ejecutarConsulta($sql_bi) or $sw_bi = false;

			if ($sw_bi && $sw_v) {
					// Si todo los datos Fuero correctamente insertado retornamos Verdadero
				return true;
			}else{
					//En el caso que algún SQL no fue guardado con existo enviamos falso
				return false;
			}
		}

		 //Llamamos todos los datos referente a ID a consultar
		public function mostrar($id_solicitud){

			$sql = "SELECT s.id_solicitud,vs.id_visita_social,vs.fecha_v,vs.observaciones,vs.trabajador_social FROM visita_social vs INNER JOIN solicitud s ON s.id_solicitud=vs.id_solicitud WHERE vs.id_solicitud='$id_solicitud'";

			return ejecutarConsultaSimpleFila($sql);
		}

		 //Implementar un método para listar los registros en el Data Table
		public function listar(){
			
			$sql = "SELECT s.id_solicitud,vs.id_visita_social,b.nombre_apellido_b as beneficiario,b.cedula_b as cedula,Date(vs.fecha_v) as fecha,vs.observaciones,vs.trabajador_social FROM visita_social vs INNER JOIN solicitud s ON s.id_solicitud=vs.id_solicitud INNER JOIN beneficiario b ON b.id_beneficiario=s.id_beneficiario";

			return ejecutarConsulta($sql);
		}

	}


 ?>