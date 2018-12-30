<?php 
		//Incluimos inicialmente la conexión a la base de datos
	require_once("../controlador/conexion.php");
	
	class Consultas {
		
		function __construct(){
		
		}

		// Funcion para aceptar la solicitud
		public function aceptar($id_solicitud,$id_usuario,$fecha_actual){
			
			$sql="UPDATE solicitud SET estado='Aprobado' WHERE id_solicitud='$id_solicitud'";
			
			ejecutarConsulta($sql);

				// Registramos en la base de Datos que Usuario Hizo la operación
			$sw_us = true;
			
			$sql_us = "INSERT INTO usuario_solicitud (id_solicitud,id_usuario,fecha_hora_u,descripcion_u) VALUES ('$id_solicitud','$id_usuario','$fecha_actual','Aprobo la Solicitud')";
			
				//En caso de los datos no se hallan guardado $sw_us guardamos false 
			ejecutarConsulta($sql_us) or $sw_us = false;

			return $sw_us;
		}		

			//Implementar un método para listar los solicitud según su rango de fecha
		public function consultasfecha($fecha_inicio,$fecha_fin){

			$sql = "SELECT s.id_solicitud,o.nombre_apellido as solicitante,o.cedula as cedula_s,o.parroquia,p.nombre_apellido_p as beneficiario,p.cedula_p,Date(p.fecha_nacimiento_p) as fecha_p,t.solicitud,t.descripcion,Date(s.fecha) as fecha,s.estado FROM solicitud s INNER JOIN solicitante o ON s.id_solicitante=o.id_solicitante INNER JOIN tipo_solicitud t ON t.id_tipo_solicitud=s.id_tipo_solicitud INNER JOIN persona p ON p.id_persona=s.id_persona WHERE Date(s.fecha)>='$fecha_inicio' AND Date(s.fecha)<='$fecha_fin'";
			
			return ejecutarConsulta($sql);
		}

		//listar familiares
		public function listarFamiliar($id_solicitud){

			$sql = "SELECT f.nombre_apellido_f,f.fecha_nacimiento_f,f.parentesco_f,f.ocupacion_f,f.ingreso_f,f.peso_f,f.talla_f FROM familiar f INNER JOIN familiar_solicitud fs ON f.id_familiar=fs.id_familiar INNER JOIN solicitud s ON fs.id_solicitud=s.id_solicitud WHERE fs.id_solicitud='$id_solicitud'";
			
			return ejecutarConsulta($sql);
		}

			// Implementamos un método para consultar los movimiento en el sistema heha por el Usuario
		public function consultasistema($fecha_inicio,$fecha_fin){
			
			$sql = "SELECT s.id_solicitud,Date(us.fecha_hora_u) as fecha_us,u.nombre_apellido as usuario,us.descripcion_u,u.cargo FROM usuario_solicitud us INNER JOIN solicitud s ON us.id_solicitud=s.id_solicitud INNER JOIN usuario u ON u.id_usuario=us.id_usuario WHERE Date(s.fecha)>='$fecha_inicio' AND Date(s.fecha)<='$fecha_fin'";
			
			return ejecutarConsulta($sql);
		}

		public function imprimir($id_solicitud){

			$sql = "SELECT s.id_solicitud,o.nombre_apellido as solicitante,o.cedula as cedula_s,Date(o.fecha_nacimiento) as fecha_s,o.sexo,o.direccion,o.telefono_1,o.telefono_2,o.email,o.parroquia,o.estado_civil,o.ocupacion,o.esterilizada,o.beneficio_gubernamental,o.num_hijo,o.ingreso,p.nombre_apellido_p as beneficiario,p.cedula_p,Date(p.fecha_nacimiento_p) as fecha_p,p.parentesco,p.semana_embarazo,p.talla_zapato,p.talla_pantalon,p.talla_franela,t.solicitud,t.descripcion,Date(s.fecha) as fecha,s.tipo_vivienda,s.tenencia,s.construccion,s.tipo_piso,s.estado FROM solicitud s INNER JOIN solicitante o ON s.id_solicitante=o.id_solicitante INNER JOIN tipo_solicitud t ON t.id_tipo_solicitud=s.id_tipo_solicitud INNER JOIN persona p ON p.id_persona=s.id_persona WHERE s.id_solicitud='$id_solicitud' AND s.estado='Aprobado'" ;
			
			return ejecutarConsulta($sql);
		}

		//Implementemos un método para mostrar los datos de un registro a modificar
		public function mostrar($id_solicitud){
			
			$sql = "SELECT s.id_solicitud,o.nombre_apellido,o.cedula,o.fecha_nacimiento,o.sexo,o.direccion,o.telefono_1,o.telefono_2,o.email,o.parroquia,o.estado_civil,o.ocupacion,o.esterilizada,o.beneficio_gubernamental,o.num_hijo,o.ingreso,p.nombre_apellido_p,p.cedula_p,p.fecha_nacimiento_p,p.parentesco,p.semana_embarazo,p.talla_zapato,p.talla_pantalon,p.talla_franela,t.solicitud,t.descripcion,s.fecha,s.tipo_vivienda,s.tenencia,s.construccion,s.tipo_piso,s.estado,s.medio_informacion FROM solicitud s INNER JOIN solicitante o ON s.id_solicitante=o.id_solicitante INNER JOIN tipo_solicitud t ON t.id_tipo_solicitud=s.id_tipo_solicitud INNER JOIN persona p ON p.id_persona=s.id_persona WHERE s.id_solicitud='$id_solicitud'";
			
			return ejecutarConsultaSimpleFila($sql);
		}

	}

 ?>