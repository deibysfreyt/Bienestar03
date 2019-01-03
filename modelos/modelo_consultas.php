<?php 
		//Incluimos inicialmente la conexión a la base de datos
	require_once("../controlador/conexion.php");
	
	class Consultas {
		
		function __construct(){
		
		}

		// Funcion para aceptar la solicitud
		public function aceptar($id_solicitud,$id_usuario,$fecha_actual){
			
			$sw_a = true;
			$sql="UPDATE solicitud SET estado='Aprobado' WHERE id_solicitud='$id_solicitud'";
			
			ejecutarConsulta($sql) or $sw_a = false;

			//Insertamos en la tabla bitacora para llevar un registro de los movimiento en el sistema
			$sw_bi = true;
			$sql_bi = "INSERT INTO bitacora (id_usuario,fecha_b,accion,descripcion) VALUES ('$id_usuario','$fecha_actual','Acepto','Solicitud')";
			
				//en caso de los datos no se hallan guardado $sw_us guardamos false 
			ejecutarConsulta($sql_bi) or $sw_bi = false;

			if ($sw_a && $sw_bi) {
				return true;
			}else{
				return false;
			}
		}		

			//Implementar un método para listar los solicitud según su rango de fecha
		public function consultasfecha($fecha_inicio,$fecha_fin){

			$sql = "SELECT s.id_solicitud,o.nombre_apellido as solicitante,o.cedula as cedula_s,o.parroquia,b.nombre_apellido_b as beneficiario,b.cedula_b,t.solicitud,t.descripcion,Date(s.fecha) as fecha,s.estado FROM solicitud s INNER JOIN solicitante o ON s.id_solicitante=o.id_solicitante INNER JOIN tipo_solicitud t ON t.id_tipo_solicitud=s.id_tipo_solicitud INNER JOIN beneficiario b ON b.id_beneficiario=s.id_beneficiario WHERE Date(s.fecha)>='$fecha_inicio' AND Date(s.fecha)<='$fecha_fin'";
			
			return ejecutarConsulta($sql);
		}

		//listar familiares
		public function listarFamiliar($id_solicitud){

			$sql = "SELECT f.nombre_apellido_f,f.fecha_nacimiento_f,f.parentesco_f,f.ocupacion_f,f.ingreso_f,f.peso_f,f.talla_f FROM familiar f INNER JOIN familiar_solicitud fs ON f.id_familiar=fs.id_familiar INNER JOIN solicitud s ON fs.id_solicitud=s.id_solicitud WHERE fs.id_solicitud='$id_solicitud'";
			
			return ejecutarConsulta($sql);
		}

			// Implementamos un método para consultar los movimiento en el sistema heha por el Usuario
		public function consultasistema($fecha_inicio,$fecha_fin){
			
			$sql = "SELECT bi.id_bitacora,s.id_solicitud,Date(bi.fecha_b) as fecha_b,u.cargo,u.nombre_apellido as usuario,bi.accion,bi.descripcion FROM bitacora bi INNER JOIN usuario u ON u.id_usuario=bi.id_usuario INNER JOIN solicitud s ON s.id_usuario=u.id_usuario WHERE Date(bi.fecha_b)>='$fecha_inicio' AND Date(bi.fecha_b)<='$fecha_fin'";
			
			return ejecutarConsulta($sql);
		}

		public function imprimir($id_solicitud){

			$sql = "SELECT s.id_solicitud,o.nombre_apellido as solicitante,o.cedula as cedula_s,Date(o.fecha_nacimiento) as fecha_s,o.sexo,o.direccion,o.telefono_1,o.telefono_2,o.email,o.parroquia,o.estado_civil,o.ocupacion,o.esterilizada,o.beneficio_gubernamental,o.num_hijo,o.ingreso,b.nombre_apellido_b as beneficiario,b.cedula_b,Date(b.fecha_nacimiento_b) as fecha_b,b.parentesco,b.semana_embarazo,b.talla_zapato,b.talla_pantalon,b.talla_franela,t.solicitud,t.descripcion,Date(s.fecha) as fecha,s.tipo_vivienda,s.tenencia,s.construccion,s.tipo_piso,s.estado FROM solicitud s INNER JOIN solicitante o ON s.id_solicitante=o.id_solicitante INNER JOIN tipo_solicitud t ON t.id_tipo_solicitud=s.id_tipo_solicitud INNER JOIN beneficiario b ON b.id_beneficiario=s.id_beneficiario WHERE s.id_solicitud='$id_solicitud' AND s.estado='Aprobado'" ;
			
			return ejecutarConsulta($sql);
		}

		//Implementemos un método para mostrar los datos de un registro a modificar
		public function mostrar($id_solicitud){
			
			$sql = "SELECT s.id_solicitud,o.nombre_apellido,o.cedula,o.fecha_nacimiento,o.sexo,o.direccion,o.telefono_1,o.telefono_2,o.email,o.parroquia,o.estado_civil,o.ocupacion,o.esterilizada,o.beneficio_gubernamental,o.num_hijo,o.ingreso,b.nombre_apellido_b,b.cedula_b,b.fecha_nacimiento_b,b.parentesco,b.semana_embarazo,b.talla_zapato,b.talla_pantalon,b.talla_franela,t.solicitud,t.descripcion,s.fecha,s.tipo_vivienda,s.tenencia,s.construccion,s.tipo_piso,s.estado,s.medio_informacion FROM solicitud s INNER JOIN solicitante o ON s.id_solicitante=o.id_solicitante INNER JOIN tipo_solicitud t ON t.id_tipo_solicitud=s.id_tipo_solicitud INNER JOIN beneficiario b ON b.id_beneficiario=s.id_beneficiario WHERE s.id_solicitud='$id_solicitud'";
			
			return ejecutarConsultaSimpleFila($sql);
		}

	}

 ?>