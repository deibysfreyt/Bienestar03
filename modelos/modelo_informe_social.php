<?php 
		//Incluimos icinicalmente la conexion a la base de datos
	require_once("../controlador/conexion.php");
	
	class Informe_social{
		
		function __construct(){
		
		}

			//Implementamos un metodo para registrar
		public function insertar($cedula,$nombre_apellido,$fecha_nacimiento,$sexo,$direccion,$telefono_1,$telefono_2,$email,$parroquia,$estado_civil,$ocupacion,$esterilizada,$beneficio_gubernamental,$num_hijo,$ingreso,$cedula_b,$nombre_apellido_b,$fecha_nacimiento_b,$parentesco_b,$semana_embarazo_b,$talla_zapato,$talla_pantalon,$talla_franela,$id_tipo_solicitud,$medio_informacion,$fecha,$tipo_vivienda,$tenencia,$construccion,$tipo_piso,$id_usuario,$id_familiar,$nombre_apellido_f,$fecha_nacimiento_f,$parentesco_f,$ocupacion_f,$ingreso_f,$peso_f,$talla_f){			

				//Ahora guardamos al Solicitante
			$sql_t = "INSERT INTO solicitante (cedula,nombre_apellido,fecha_nacimiento,sexo,direccion,telefono_1,telefono_2,email,parroquia,estado_civil,ocupacion,esterilizada,beneficio_gubernamental,num_hijo,ingreso) VALUES ('$cedula','$nombre_apellido','$fecha_nacimiento','$sexo','$direccion','$telefono_1','$telefono_2','$email','$parroquia','$estado_civil','$ocupacion','$esterilizada','$beneficio_gubernamental','$num_hijo','$ingreso')";
			
			// Guardamos el ultimo ID de los datos insertado
			$id_solicitante_new=ejecutarConsulta_retornarID($sql_t);

				//Guardamos al beneficiario
			$sql_b = "INSERT INTO persona (cedula_p,nombre_apellido_p,fecha_nacimiento_p,parentesco,semana_embarazo,talla_zapato,talla_pantalon,talla_franela) VALUES ('$cedula_b','$nombre_apellido_b','$fecha_nacimiento_b','$parentesco_b','$semana_embarazo_b','$talla_zapato','$talla_pantalon','$talla_franela')";
			
				// Guardamos el ultimo ID de los datos insertado
			$id_persona_b_new=ejecutarConsulta_retornarID($sql_b);

				//Insertamnos en la tabla solicitud
			$sql_s = "INSERT INTO solicitud (id_solicitante,id_tipo_solicitud,id_persona,fecha,medio_informacion,tipo_vivienda,tenencia,construccion,tipo_piso,estado) VALUES ('$id_solicitante_new','$id_tipo_solicitud','$id_persona_b_new','$fecha','$medio_informacion','$tipo_vivienda','$tenencia','$construccion','$tipo_piso','En espera')";
			
				// Guardamos el ultimo ID de los datos insertado
			$id_solicitud_new=ejecutarConsulta_retornarID($sql_s);

				//Guardams los Familiares -----------------------------------------------------
			$num_elementos=0;
			$sw=true;

			//Agregar familiar
			while ($num_elementos < count($id_familiar))
			{

				//Insertamos la tabla persona
				$sql_p = "INSERT INTO familiar (nombre_apellido_f,fecha_nacimiento_f,parentesco_f,ocupacion_f,ingreso_f,peso_f,talla_f) VALUES ('$nombre_apellido_f[$num_elementos]','$fecha_nacimiento_f[$num_elementos]','$parentesco_f[$num_elementos]','$ocupacion_f[$num_elementos]','$ingreso_f[$num_elementos]','$peso_f[$num_elementos]','$talla_f[$num_elementos]')";
				$id_familiar_new=ejecutarConsulta_retornarID($sql_p);

				// Al mismo tiempo guardamos en la tabla relacion persona_solicitud
				$sql_detalle = "INSERT INTO familiar_solicitud (id_familiar,id_solicitud) VALUES ('$id_familiar_new','$id_solicitud_new')";
				ejecutarConsulta($sql_detalle) or $sw = false;

				$num_elementos=$num_elementos + 1;

			}
				//------------------------------------------------------------------

				//Insertamos en la tabla usuario solicitud para llevar un registro de los movimiento en el sistema
			$sw_us = true;
			
			$sql_us = "INSERT INTO usuario_solicitud (id_solicitud,id_usuario,fecha_hora_u,descripcion_u) VALUES ('$id_solicitud_new','$id_usuario','$fecha','Registro de Solicitud')";
			
				//en caso de los datos no se hallan guardado $sw_us guardamos false 
			ejecutarConsulta($sql_us) or $sw_us = false;

				// Retornamos el valor $sw_us, si es true todo los datos fueron enviado en caso contrario false
			//return $sw_us;
			if ($sw_us && $sw) {
					// Si todo los datos Fuero correctamente insertado retornamos Verdadero
				return true;
			}else{
					//En el caso que algún SQL no fue guardado con existo enviamos falso
				return false;
			}

		}

			//Implementamos un metodo para editar solicitud
		public function editars($id_solicitante,$cedula,$nombre_apellido,$fecha_nacimiento,$sexo,$direccion,$telefono_1,$telefono_2,$email,$parroquia,$estado_civil,$ocupacion,$esterilizada,$beneficio_gubernamental,$num_hijo,$ingreso,$cedula_b,$nombre_apellido_b,$fecha_nacimiento_b,$parentesco_b,$semana_embarazo_b,$talla_zapato,$talla_pantalon,$talla_franela,$id_tipo_solicitud,$medio_informacion,$fecha,$tipo_vivienda,$tenencia,$construccion,$tipo_piso,$id_usuario,$id_familiar,$nombre_apellido_f,$fecha_nacimiento_f,$parentesco_f,$ocupacion_f,$ingreso_f,$peso_f,$talla_f){

				//Ahora guardamos la tabla Solicitante
			$sw_t = true;
			$sql_t = "UPDATE solicitante SET cedula='$cedula',nombre_apellido='$nombre_apellido',fecha_nacimiento='$fecha_nacimiento',sexo='$sexo',direccion='$direccion',telefono_1='$telefono_1',telefono_2='$telefono_2',email='$email',parroquia='$parroquia',estado_civil='$estado_civil',ocupacion='$ocupacion',esterilizada='$esterilizada',beneficio_gubernamental='$beneficio_gubernamental',num_hijo='$num_hijo',ingreso='$ingreso' WHERE id_solicitante='$id_solicitante'";
			
				//En caso de los datos no se hallan guardado $sw_t guardamos false 	
			ejecutarConsulta($sql_t) or $sw_t=false;

				//Solo el beneficiario
			$sql_b = "INSERT INTO persona (cedula_p,nombre_apellido_p,fecha_nacimiento_p,parentesco,semana_embarazo,talla_zapato,talla_pantalon,talla_franela) VALUES ('$cedula_b','$nombre_apellido_b','$fecha_nacimiento_b','$parentesco_b','$semana_embarazo_b','$talla_zapato','$talla_pantalon','$talla_franela')";
			
				// Guardamos el ultimo ID de los datos insertado
			$id_persona_b_new=ejecutarConsulta_retornarID($sql_b);

				//Insertamos en la tabla solicitud
			$sql_s = "INSERT INTO solicitud (id_solicitante,id_tipo_solicitud,id_persona,fecha,medio_informacion,tipo_vivienda,tenencia,construccion,tipo_piso,estado) VALUES ('$id_solicitante','$id_tipo_solicitud','$id_persona_b_new','$fecha','$medio_informacion','$tipo_vivienda','$tenencia','$construccion','$tipo_piso','En espera')";
			
				// Guardamos el ultimo ID de los datos insertado
			$id_solicitud_new=ejecutarConsulta_retornarID($sql_s);


			//Guardams los Familiares -----------------------------------------------------
			$num_elementos=0;
			$sw=true;

			//Agregar familiar
			while ($num_elementos < count($id_familiar))
			{

				//Insertamos la tabla persona
				$sql_p = "INSERT INTO familiar (nombre_apellido_f,fecha_nacimiento_f,parentesco_f,ocupacion_f,ingreso_f,peso_f,talla_f) VALUES ('$nombre_apellido_f[$num_elementos]','$fecha_nacimiento_f[$num_elementos]','$parentesco_f[$num_elementos]','$ocupacion_f[$num_elementos]','$ingreso_f[$num_elementos]','$peso_f[$num_elementos]','$talla_f[$num_elementos]')";
				$id_familiar_new=ejecutarConsulta_retornarID($sql_p);

				// Al mismo tiempo guardamos en la tabla relacion persona_solicitud
				$sql_detalle = "INSERT INTO familiar_solicitud (id_familiar,id_solicitud) VALUES ('$id_familiar_new','$id_solicitud_new')";
				ejecutarConsulta($sql_detalle) or $sw = false;

				$num_elementos=$num_elementos + 1;

			}

				//Insertamos en la tabla usuario solicitud para llevar un registro de los movimiento en el sistema
			$sw_us = true;
			
			$sql_us = "INSERT INTO usuario_solicitud (id_solicitud,id_usuario,fecha_hora_u,descripcion_u) VALUES ('$id_solicitud_new','$id_usuario','$fecha','Registro de Solicitud')";
			
				//En caso de los datos no se hallan guardado $sw_us guardamos false 
			ejecutarConsulta($sql_us) or $sw_us = false;

			if ($sw_t && $sw_us && $sw) {
					// Si todo los datos Fuero correctamente insertado retornamos Verdadero
				return true;
			}else{
					//En el caso que algún SQL no fue guardado con existo enviamos falso
				return false;
			}

		}

			// Función editar cuando el Beneficiario existe y no el Solicitante
		public function editarb($cedula,$nombre_apellido,$fecha_nacimiento,$sexo,$direccion,$telefono_1,$telefono_2,$email,$parroquia,$estado_civil,$ocupacion,$esterilizada,$beneficio_gubernamental,$num_hijo,$ingreso,$id_persona,$cedula_b,$nombre_apellido_b,$fecha_nacimiento_b,$parentesco_b,$semana_embarazo_b,$talla_zapato,$talla_pantalon,$talla_franela,$id_tipo_solicitud,$medio_informacion,$fecha,$tipo_vivienda,$tenencia,$construccion,$tipo_piso,$id_usuario,$id_familiar,$nombre_apellido_f,$fecha_nacimiento_f,$parentesco_f,$ocupacion_f,$ingreso_f,$peso_f,$talla_f){			

				//Ahora guardamos la tabla Solicitante
			$sql_t = "INSERT INTO solicitante (cedula,nombre_apellido,fecha_nacimiento,sexo,direccion,telefono_1,telefono_2,email,parroquia,estado_civil,ocupacion,esterilizada,beneficio_gubernamental,num_hijo,ingreso) VALUES ('$cedula','$nombre_apellido','$fecha_nacimiento','$sexo','$direccion','$telefono_1','$telefono_2','$email','$parroquia','$estado_civil','$ocupacion','$esterilizada','$beneficio_gubernamental','$num_hijo','$ingreso')";
			
			// Guardamos el ultimo ID de los datos insertado
			$id_solicitante_new=ejecutarConsulta_retornarID($sql_t);

				//Solo el beneficiario
			$sw_p = true;
			
			$sql_b = "UPDATE persona SET cedula_p='$cedula_b',nombre_apellido_p='$nombre_apellido_b',fecha_nacimiento_p='$fecha_nacimiento_b',parentesco='$parentesco_b',semana_embarazo='$semana_embarazo_b',talla_zapato='$talla_zapato',talla_pantalon='$talla_pantalon',talla_franela='$talla_franela' WHERE id_persona='$id_persona'";

				//En caso de los datos no se hallan guardado $sw_p guardamos false 
			ejecutarConsulta($sql_b) or $sw_p = false;

				//Insertamos en la tabla solicitud
			$sql_s = "INSERT INTO solicitud (id_solicitante,id_tipo_solicitud,id_persona,fecha,medio_informacion,tipo_vivienda,tenencia,construccion,tipo_piso,estado) VALUES ('$id_solicitante_new','$id_tipo_solicitud','$id_persona','$fecha','$medio_informacion','$tipo_vivienda','$tenencia','$construccion','$tipo_piso','En espera')";
				
				// Guardamos el ultimo ID de los datos insertado
			$id_solicitud_new=ejecutarConsulta_retornarID($sql_s);


			//Guardams los Familiares -----------------------------------------------------
			$num_elementos=0;
			$sw=true;

			//Agregar familiar
			while ($num_elementos < count($id_familiar))
			{

				//Insertamos la tabla persona
				$sql_p = "INSERT INTO familiar (nombre_apellido_f,fecha_nacimiento_f,parentesco_f,ocupacion_f,ingreso_f,peso_f,talla_f) VALUES ('$nombre_apellido_f[$num_elementos]','$fecha_nacimiento_f[$num_elementos]','$parentesco_f[$num_elementos]','$ocupacion_f[$num_elementos]','$ingreso_f[$num_elementos]','$peso_f[$num_elementos]','$talla_f[$num_elementos]')";
				$id_familiar_new=ejecutarConsulta_retornarID($sql_p);

				// Al mismo tiempo guardamos en la tabla relacion persona_solicitud
				$sql_detalle = "INSERT INTO familiar_solicitud (id_familiar,id_solicitud) VALUES ('$id_familiar_new','$id_solicitud_new')";
				ejecutarConsulta($sql_detalle) or $sw = false;

				$num_elementos=$num_elementos + 1;

			}


				//Insertamos en la tabla usuario solicitud para llevar un registro de los movimiento en el sistema
			$sw_us = true;
			
			$sql_us = "INSERT INTO usuario_solicitud (id_solicitud,id_usuario,fecha_hora_u,descripcion_u) VALUES ('$id_solicitud_new','$id_usuario','$fecha','Registro de Solicitud')";
				
				//En caso de los datos no se hallan guardado $sw_us guardamos false 
			ejecutarConsulta($sql_us) or $sw_us = false;

			if ($sw_p && $sw_us && $sw) {
					// Si todo los datos Fuero correctamente insertado retornamos Verdadero
				return true;
			}else{
					//En el caso que algún SQL no fue guardado con existo enviamos falso
				return false;
			}

		}

			//Cuando El beneficiario y el Solicitante Existen
		public function insertarbs($id_solicitante,$cedula,$nombre_apellido,$fecha_nacimiento,$sexo,$direccion,$telefono_1,$telefono_2,$email,$parroquia,$estado_civil,$ocupacion,$esterilizada,$beneficio_gubernamental,$num_hijo,$ingreso,$id_persona,$cedula_b,$nombre_apellido_b,$fecha_nacimiento_b,$parentesco_b,$semana_embarazo_b,$talla_zapato,$talla_pantalon,$talla_franela,$id_tipo_solicitud,$medio_informacion,$fecha,$tipo_vivienda,$tenencia,$construccion,$tipo_piso,$id_usuario,$id_familiar,$nombre_apellido_f,$fecha_nacimiento_f,$parentesco_f,$ocupacion_f,$ingreso_f,$peso_f,$talla_f){			

			//Ahora guardamos la tabla Solicitante
			$sw_t = true;
			
			$sql_t = "UPDATE solicitante SET cedula='$cedula',nombre_apellido='$nombre_apellido',fecha_nacimiento='$fecha_nacimiento',sexo='$sexo',direccion='$direccion',telefono_1='$telefono_1',telefono_2='$telefono_2',email='$email',parroquia='$parroquia',estado_civil='$estado_civil',ocupacion='$ocupacion',esterilizada='$esterilizada',beneficio_gubernamental='$beneficio_gubernamental',num_hijo='$num_hijo',ingreso='$ingreso' WHERE id_solicitante='$id_solicitante'";

				//En caso de los datos no se hallan guardado $sw_t guardamos false 
			ejecutarConsulta($sql_t) or $sw_t=false;

				//Solo el beneficiario
			$sw_p = true;
			
			$sql_b = "UPDATE persona SET cedula_p='$cedula_b',nombre_apellido_p='$nombre_apellido_b',fecha_nacimiento_p='$fecha_nacimiento_b',parentesco='$parentesco_b',semana_embarazo='$semana_embarazo_b',talla_zapato='$talla_zapato',talla_pantalon='$talla_pantalon',talla_franela='$talla_franela' WHERE id_persona='$id_persona'";
			
				//En caso de los datos no se hallan guardado $sw_p guardamos false 
			ejecutarConsulta($sql_b) or $sw_p = false;

				//Insertamos en la tabla solicitud
			$sql_s = "INSERT INTO solicitud (id_solicitante,id_tipo_solicitud,id_persona,fecha,medio_informacion,tipo_vivienda,tenencia,construccion,tipo_piso,estado) VALUES ('$id_solicitante','$id_tipo_solicitud','$id_persona','$fecha','$medio_informacion','$tipo_vivienda','$tenencia','$construccion','$tipo_piso','En espera')";
			
				// Guardamos el ultimo ID de los datos insertado
			$id_solicitud_new=ejecutarConsulta_retornarID($sql_s);


			//Guardams los Familiares -----------------------------------------------------
			$num_elementos=0;
			$sw=true;

			//Agregar familiar
			while ($num_elementos < count($id_familiar))
			{

				//Insertamos la tabla persona
				$sql_p = "INSERT INTO familiar (nombre_apellido_f,fecha_nacimiento_f,parentesco_f,ocupacion_f,ingreso_f,peso_f,talla_f) VALUES ('$nombre_apellido_f[$num_elementos]','$fecha_nacimiento_f[$num_elementos]','$parentesco_f[$num_elementos]','$ocupacion_f[$num_elementos]','$ingreso_f[$num_elementos]','$peso_f[$num_elementos]','$talla_f[$num_elementos]')";
				$id_familiar_new=ejecutarConsulta_retornarID($sql_p);

				// Al mismo tiempo guardamos en la tabla relacion persona_solicitud
				$sql_detalle = "INSERT INTO familiar_solicitud (id_familiar,id_solicitud) VALUES ('$id_familiar_new','$id_solicitud_new')";
				ejecutarConsulta($sql_detalle) or $sw = false;

				$num_elementos=$num_elementos + 1;

			}
				//------------------------------------------------------------------

				//Insertamos en la tabla usuario solicitud para llevar un registro de los movimiento en el sistema
			$sw_us = true;
			
			$sql_us = "INSERT INTO usuario_solicitud (id_solicitud,id_usuario,fecha_hora_u,descripcion_u) VALUES ('$id_solicitud_new','$id_usuario','$fecha','Registro de Solicitud')";
			
				//En caso de los datos no se hallan guardado $sw_us guardamos false 
			ejecutarConsulta($sql_us) or $sw_us = false;

			if ($sw_t && $sw_p && $sw_us && $sw) {
					// Si todo los datos Fuero correctamente insertado retornamos Verdadero
				return true;
			}else{
					//En el caso que algún SQL no fue guardado con existo enviamos falso
				return false;
			}

		}

			//Implementemos un método para mostrar los datos de un registro a modificar
		public function mostrar($id_solicitud){
			
			$sql = "SELECT p.id_persona,p.cedula_p,p.nombre_apellido_p,p.fecha_nacimiento_p,p.parentesco,p.semana_embarazo,p.talla_zapato,p.talla_pantalon,p.talla_franela,o.id_solicitante,o.cedula,o.nombre_apellido,o.fecha_nacimiento,o.sexo,o.direccion,o.telefono_1,o.telefono_2,o.email,o.parroquia,o.estado_civil,o.ocupacion,o.esterilizada,o.beneficio_gubernamental,o.num_hijo,o.ingreso FROM solicitante o INNER JOIN solicitud s ON o.id_solicitante=s.id_solicitante INNER JOIN persona p ON s.id_persona=p.id_persona WHERE id_solicitud='$id_solicitud'";
			
			return ejecutarConsultaSimpleFila($sql);
		}

			//Implementar un método para listar los solicitud
		public function listar(){

			$sql = "SELECT s.id_solicitud ,p.id_persona,o.id_solicitante,o.nombre_apellido as solicitante,o.cedula as cedulas,p.nombre_apellido_p as beneficiario,p.cedula_p as cedulab,t.solicitud,t.descripcion,Date(s.fecha) as fecha FROM solicitud s INNER JOIN solicitante o ON s.id_solicitante=o.id_solicitante INNER JOIN tipo_solicitud t ON s.id_tipo_solicitud=t.id_tipo_solicitud INNER JOIN persona p ON p.id_persona=s.id_persona";
			
			return ejecutarConsulta($sql);
		}

			// Seleccionar el Beneficiario según la visita Social
		public function select(){

			$sql = "SELECT s.id_solicitud,p.id_persona,p.nombre_apellido_p,p.cedula_p FROM solicitud s INNER JOIN persona p ON s.id_persona=p.id_persona INNER JOIN tipo_solicitud ts ON ts.id_tipo_solicitud=s.id_tipo_solicitud WHERE s.estado='En espera' AND ts.condicion='1'";
			
			return ejecutarConsulta($sql);
		}

	}

 ?>