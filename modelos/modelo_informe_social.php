<?php 
		//Incluimos icinicalmente la conexion a la base de datos
	require_once("../controlador/conexion.php");
	
	class Informe_social{
		
		function __construct(){
		
		}

			//Implementamos un metodo para registrar
		public function insertar($cedula,$nombre_apellido,$fecha_nacimiento,$sexo,$direccion,$telefono_1,$telefono_2,$email,$parroquia,$estado_civil,$ocupacion,$esterilizada,$beneficio_gubernamental,$num_hijo,$ingreso,$cedula_b,$nombre_apellido_b,$fecha_nacimiento_b,$parentesco,$semana_embarazo,$talla_zapato,$talla_pantalon,$talla_franela,$id_tipo_solicitud,$id_usuario,$fecha,$medio_informacion,$tipo_vivienda,$tenencia,$construccion,$tipo_piso,$observacion,$id_familiar,$nombre_apellido_f,$fecha_nacimiento_f,$parentesco_f,$ocupacion_f,$ingreso_f,$peso_f,$talla_f){			

				//Ahora guardamos al Solicitante
			$sql_s = "INSERT INTO solicitante (cedula,nombre_apellido,fecha_nacimiento,sexo,direccion,telefono_1,telefono_2,email,parroquia,estado_civil,ocupacion,esterilizada,beneficio_gubernamental,num_hijo,ingreso) VALUES ('$cedula','$nombre_apellido','$fecha_nacimiento','$sexo','$direccion','$telefono_1','$telefono_2','$email','$parroquia','$estado_civil','$ocupacion','$esterilizada','$beneficio_gubernamental','$num_hijo','$ingreso')";
			
			// Guardamos el ultimo ID de los datos insertado
			$id_solicitante_new=ejecutarConsulta_retornarID($sql_s);

				//Guardamos al beneficiario
			$sql_b = "INSERT INTO beneficiario (cedula_b,nombre_apellido_b,fecha_nacimiento_b,parentesco,semana_embarazo,talla_zapato,talla_pantalon,talla_franela) VALUES ('$cedula_b','$nombre_apellido_b','$fecha_nacimiento_b','$parentesco','$semana_embarazo','$talla_zapato','$talla_pantalon','$talla_franela')";
			
				// Guardamos el ultimo ID de los datos insertado
			$id_beneficiario_b_new=ejecutarConsulta_retornarID($sql_b);


				//Insertamnos en la tabla solicitud
			$sql_so = "INSERT INTO solicitud (id_solicitante,id_tipo_solicitud,id_beneficiario,id_usuario,fecha,medio_informacion,tipo_vivienda,tenencia,construccion,tipo_piso,estado,observacion) VALUES ('$id_solicitante_new','$id_tipo_solicitud','$id_beneficiario_b_new','$id_usuario','$fecha','$medio_informacion','$tipo_vivienda','$tenencia','$construccion','$tipo_piso','En espera','$observacion')";
			
				// Guardamos el ultimo ID de los datos insertado
			$id_solicitud_new=ejecutarConsulta_retornarID($sql_so);

				//Guardams los Familiares -----------------------------------------------------
			$num_elementos=0;
			$sw=true;

			//Agregar familiar
			while ($num_elementos < count($id_familiar))
			{

				//Insertamos la tabla familiares
				$sql_f = "INSERT INTO familiar (nombre_apellido_f,fecha_nacimiento_f,parentesco_f,ocupacion_f,ingreso_f,peso_f,talla_f) VALUES ('$nombre_apellido_f[$num_elementos]','$fecha_nacimiento_f[$num_elementos]','$parentesco_f[$num_elementos]','$ocupacion_f[$num_elementos]','$ingreso_f[$num_elementos]','$peso_f[$num_elementos]','$talla_f[$num_elementos]')";
				$id_familiar_new=ejecutarConsulta_retornarID($sql_f);

				// Al mismo tiempo guardamos en la tabla relacion familiar_solicitud
				$sql_familiar = "INSERT INTO familiar_solicitud (id_familiar,id_solicitud) VALUES ('$id_familiar_new','$id_solicitud_new')";
				ejecutarConsulta($sql_familiar) or $sw = false;

				$num_elementos=$num_elementos + 1;

			}
				//------------------------------------------------------------------

				//Insertamos en la tabla bitacora para llevar un registro de los movimiento en el sistema
			$sw_bi = true;
			$sql_bi = "INSERT INTO bitacora (id_usuario,fecha_b,accion,descripcion) VALUES ('$id_usuario','$fecha','Agrego','Solicitud')";
			
				//en caso de los datos no se hallan guardado $sw_us guardamos false 
			ejecutarConsulta($sql_bi) or $sw_bi = false;

				// Retornamos el valor $sw_us, si es true todo los datos fueron enviado en caso contrario false
			if ($sw_bi && $sw) {
					// Si todo los datos Fuero correctamente insertado retornamos Verdadero
				return true;
			}else{
					//En el caso que algún SQL no fue guardado con existo enviamos falso
				return false;
			}

		}

			//Implementamos un metodo para editar solicitud
		public function editars($id_solicitante,$cedula,$nombre_apellido,$fecha_nacimiento,$sexo,$direccion,$telefono_1,$telefono_2,$email,$parroquia,$estado_civil,$ocupacion,$esterilizada,$beneficio_gubernamental,$num_hijo,$ingreso,$cedula_b,$nombre_apellido_b,$fecha_nacimiento_b,$parentesco,$semana_embarazo,$talla_zapato,$talla_pantalon,$talla_franela,$id_tipo_solicitud,$id_usuario,$fecha,$medio_informacion,$tipo_vivienda,$tenencia,$construccion,$tipo_piso,$observacion,$id_familiar,$nombre_apellido_f,$fecha_nacimiento_f,$parentesco_f,$ocupacion_f,$ingreso_f,$peso_f,$talla_f){

				//Ahora guardamos la tabla Solicitante
			$sw_s = true;
			$sql_s = "UPDATE solicitante SET cedula='$cedula',nombre_apellido='$nombre_apellido',fecha_nacimiento='$fecha_nacimiento',sexo='$sexo',direccion='$direccion',telefono_1='$telefono_1',telefono_2='$telefono_2',email='$email',parroquia='$parroquia',estado_civil='$estado_civil',ocupacion='$ocupacion',esterilizada='$esterilizada',beneficio_gubernamental='$beneficio_gubernamental',num_hijo='$num_hijo',ingreso='$ingreso' WHERE id_solicitante='$id_solicitante'";
			
				//En caso de los datos no se hallan guardado $sw_s guardamos false 	
			ejecutarConsulta($sql_s) or $sw_s=false;

				//Solo el beneficiario
			$sql_b = "INSERT INTO beneficiario (cedula_b,nombre_apellido_b,fecha_nacimiento_b,parentesco,semana_embarazo,talla_zapato,talla_pantalon,talla_franela) VALUES ('$cedula_b','$nombre_apellido_b','$fecha_nacimiento_b','$parentesco','$semana_embarazo','$talla_zapato','$talla_pantalon','$talla_franela')";
			
				// Guardamos el ultimo ID de los datos insertado
			$id_beneficiario_b_new=ejecutarConsulta_retornarID($sql_b);

				//Insertamnos en la tabla solicitud
			$sql_so = "INSERT INTO solicitud (id_solicitante,id_tipo_solicitud,id_beneficiario,id_usuario,fecha,medio_informacion,tipo_vivienda,tenencia,construccion,tipo_piso,estado,observacion) VALUES ('$id_solicitante','$id_tipo_solicitud','$id_beneficiario_b_new','$id_usuario','$fecha','$medio_informacion','$tipo_vivienda','$tenencia','$construccion','$tipo_piso','En espera','$observacion')";
			
				// Guardamos el ultimo ID de los datos insertado
			$id_solicitud_new=ejecutarConsulta_retornarID($sql_so);


			//Guardams los Familiares -----------------------------------------------------
			$num_elementos=0;
			$sw=true;

			//Agregar familiar
			while ($num_elementos < count($id_familiar))
			{

				//Insertamos la tabla familiares
				$sql_f = "INSERT INTO familiar (nombre_apellido_f,fecha_nacimiento_f,parentesco_f,ocupacion_f,ingreso_f,peso_f,talla_f) VALUES ('$nombre_apellido_f[$num_elementos]','$fecha_nacimiento_f[$num_elementos]','$parentesco_f[$num_elementos]','$ocupacion_f[$num_elementos]','$ingreso_f[$num_elementos]','$peso_f[$num_elementos]','$talla_f[$num_elementos]')";
				$id_familiar_new=ejecutarConsulta_retornarID($sql_f);

				// Al mismo tiempo guardamos en la tabla relacion familiar_solicitud
				$sql_familiar = "INSERT INTO familiar_solicitud (id_familiar,id_solicitud) VALUES ('$id_familiar_new','$id_solicitud_new')";
				ejecutarConsulta($sql_familiar) or $sw = false;

				$num_elementos=$num_elementos + 1;

			}

				//Insertamos en la tabla bitacora para llevar un registro de los movimiento en el sistema
			$sw_bi = true;
			$sql_bi = "INSERT INTO bitacora (id_usuario,fecha_b,accion,descripcion) VALUES ('$id_usuario','$fecha','Agrego','Solicitud')";
			
				//en caso de los datos no se hallan guardado $sw_us guardamos false 
			ejecutarConsulta($sql_bi) or $sw_bi = false;

			if ($sw_s && $sw_bi && $sw) {
					// Si todo los datos Fuero correctamente insertado retornamos Verdadero
				return true;
			}else{
					//En el caso que algún SQL no fue guardado con existo enviamos falso
				return false;
			}

		}

			// Función editar cuando el Beneficiario existe y no el Solicitante
		public function editarb($cedula,$nombre_apellido,$fecha_nacimiento,$sexo,$direccion,$telefono_1,$telefono_2,$email,$parroquia,$estado_civil,$ocupacion,$esterilizada,$beneficio_gubernamental,$num_hijo,$ingreso,$id_beneficiario,$cedula_b,$nombre_apellido_b,$fecha_nacimiento_b,$parentesco,$semana_embarazo,$talla_zapato,$talla_pantalon,$talla_franela,$id_tipo_solicitud,$id_usuario,$fecha,$medio_informacion,$tipo_vivienda,$tenencia,$construccion,$tipo_piso,$observacion,$id_familiar,$nombre_apellido_f,$fecha_nacimiento_f,$parentesco_f,$ocupacion_f,$ingreso_f,$peso_f,$talla_f){			

				//Ahora guardamos al Solicitante
			$sql_s = "INSERT INTO solicitante (cedula,nombre_apellido,fecha_nacimiento,sexo,direccion,telefono_1,telefono_2,email,parroquia,estado_civil,ocupacion,esterilizada,beneficio_gubernamental,num_hijo,ingreso) VALUES ('$cedula','$nombre_apellido','$fecha_nacimiento','$sexo','$direccion','$telefono_1','$telefono_2','$email','$parroquia','$estado_civil','$ocupacion','$esterilizada','$beneficio_gubernamental','$num_hijo','$ingreso')";
			
			// Guardamos el ultimo ID de los datos insertado
			$id_solicitante_new=ejecutarConsulta_retornarID($sql_s);

				//Solo el beneficiario
			$sw_b = true;
			$sql_b = "UPDATE beneficiario SET cedula_b='$cedula_b',nombre_apellido_b='$nombre_apellido_b',fecha_nacimiento_b='$fecha_nacimiento_b',parentesco='$parentesco',semana_embarazo='$semana_embarazo',talla_zapato='$talla_zapato',talla_pantalon='$talla_pantalon',talla_franela='$talla_franela' WHERE id_beneficiario='$id_beneficiario'";

				//En caso de los datos no se hallan guardado $sw_p guardamos false 
			ejecutarConsulta($sql_b) or $sw_b = false;

				//Insertamnos en la tabla solicitud
			$sql_so = "INSERT INTO solicitud (id_solicitante,id_tipo_solicitud,id_beneficiario,id_usuario,fecha,medio_informacion,tipo_vivienda,tenencia,construccion,tipo_piso,estado,observacion) VALUES ('$id_solicitante_new','$id_tipo_solicitud','$id_beneficiario','$id_usuario','$fecha','$medio_informacion','$tipo_vivienda','$tenencia','$construccion','$tipo_piso','En espera','$observacion')";
			
				// Guardamos el ultimo ID de los datos insertado
			$id_solicitud_new=ejecutarConsulta_retornarID($sql_so);


			//Guardams los Familiares -----------------------------------------------------
			$num_elementos=0;
			$sw=true;

			//Agregar familiar
			while ($num_elementos < count($id_familiar))
			{

				//Insertamos la tabla beneficiario
				$sql_f = "INSERT INTO familiar (nombre_apellido_f,fecha_nacimiento_f,parentesco_f,ocupacion_f,ingreso_f,peso_f,talla_f) VALUES ('$nombre_apellido_f[$num_elementos]','$fecha_nacimiento_f[$num_elementos]','$parentesco_f[$num_elementos]','$ocupacion_f[$num_elementos]','$ingreso_f[$num_elementos]','$peso_f[$num_elementos]','$talla_f[$num_elementos]')";
				$id_familiar_new=ejecutarConsulta_retornarID($sql_f);

				// Al mismo tiempo guardamos en la tabla relacion familiar_solicitud
				$sql_familiar = "INSERT INTO familiar_solicitud (id_familiar,id_solicitud) VALUES ('$id_familiar_new','$id_solicitud_new')";
				ejecutarConsulta($sql_familiar) or $sw = false;

				$num_elementos=$num_elementos + 1;

			}


				//Insertamos en la tabla bitacora para llevar un registro de los movimiento en el sistema
			$sw_bi = true;
			$sql_bi = "INSERT INTO bitacora (id_usuario,fecha_b,accion,descripcion) VALUES ('$id_usuario','$fecha','Agrego','Solicitud')";
			
				//en caso de los datos no se hallan guardado $sw_us guardamos false 
			ejecutarConsulta($sql_bi) or $sw_bi = false;

			if ($sw_b && $sw_bi && $sw) {
					// Si todo los datos Fuero correctamente insertado retornamos Verdadero
				return true;
			}else{
					//En el caso que algún SQL no fue guardado con existo enviamos falso
				return false;
			}

		}

			//Cuando El beneficiario y el Solicitante Existen
		public function insertarbs($id_solicitante,$cedula,$nombre_apellido,$fecha_nacimiento,$sexo,$direccion,$telefono_1,$telefono_2,$email,$parroquia,$estado_civil,$ocupacion,$esterilizada,$beneficio_gubernamental,$num_hijo,$ingreso,$id_beneficiario,$cedula_b,$nombre_apellido_b,$fecha_nacimiento_b,$parentesco,$semana_embarazo,$talla_zapato,$talla_pantalon,$talla_franela,$id_tipo_solicitud,$id_usuario,$fecha,$medio_informacion,$tipo_vivienda,$tenencia,$construccion,$tipo_piso,$observacion,$id_familiar,$nombre_apellido_f,$fecha_nacimiento_f,$parentesco_f,$ocupacion_f,$ingreso_f,$peso_f,$talla_f){			

			//Ahora guardamos la tabla Solicitante
			$sw_s = true;
			
			$sql_s = "UPDATE solicitante SET cedula='$cedula',nombre_apellido='$nombre_apellido',fecha_nacimiento='$fecha_nacimiento',sexo='$sexo',direccion='$direccion',telefono_1='$telefono_1',telefono_2='$telefono_2',email='$email',parroquia='$parroquia',estado_civil='$estado_civil',ocupacion='$ocupacion',esterilizada='$esterilizada',beneficio_gubernamental='$beneficio_gubernamental',num_hijo='$num_hijo',ingreso='$ingreso' WHERE id_solicitante='$id_solicitante'";

				//En caso de los datos no se hallan guardado $sw_s guardamos false 
			ejecutarConsulta($sql_s) or $sw_s=false;

				//Solo el beneficiario
			$sw_b = true;
			
			$sql_b = "UPDATE beneficiario SET cedula_b='$cedula_b',nombre_apellido_b='$nombre_apellido_b',fecha_nacimiento_b='$fecha_nacimiento_b',parentesco='$parentesco',semana_embarazo='$semana_embarazo',talla_zapato='$talla_zapato',talla_pantalon='$talla_pantalon',talla_franela='$talla_franela' WHERE id_beneficiario='$id_beneficiario'";

				//En caso de los datos no se hallan guardado $sw_p guardamos false 
			ejecutarConsulta($sql_b) or $sw_b = false;

				//Insertamnos en la tabla solicitud
			$sql_so = "INSERT INTO solicitud (id_solicitante,id_tipo_solicitud,id_beneficiario,id_usuario,fecha,medio_informacion,tipo_vivienda,tenencia,construccion,tipo_piso,estado,observacion) VALUES ('$id_solicitante','$id_tipo_solicitud','$id_beneficiario','$id_usuario','$fecha','$medio_informacion','$tipo_vivienda','$tenencia','$construccion','$tipo_piso','En espera','$observacion')";
			
				// Guardamos el ultimo ID de los datos insertado
			$id_solicitud_new=ejecutarConsulta_retornarID($sql_so);


			//Guardams los Familiares -----------------------------------------------------
			$num_elementos=0;
			$sw=true;

			//Agregar familiar
			while ($num_elementos < count($id_familiar))
			{

				//Insertamos la tabla familiar
				$sql_f = "INSERT INTO familiar (nombre_apellido_f,fecha_nacimiento_f,parentesco_f,ocupacion_f,ingreso_f,peso_f,talla_f) VALUES ('$nombre_apellido_f[$num_elementos]','$fecha_nacimiento_f[$num_elementos]','$parentesco_f[$num_elementos]','$ocupacion_f[$num_elementos]','$ingreso_f[$num_elementos]','$peso_f[$num_elementos]','$talla_f[$num_elementos]')";
				$id_familiar_new=ejecutarConsulta_retornarID($sql_f);

				// Al mismo tiempo guardamos en la tabla relacion familiar_solicitud
				$sql_familiar = "INSERT INTO familiar_solicitud (id_familiar,id_solicitud) VALUES ('$id_familiar_new','$id_solicitud_new')";
				ejecutarConsulta($sql_familiar) or $sw = false;

				$num_elementos=$num_elementos + 1;

			}
				//------------------------------------------------------------------

				//Insertamos en la tabla bitacora para llevar un registro de los movimiento en el sistema
			$sw_bi = true;
			$sql_bi = "INSERT INTO bitacora (id_usuario,fecha_b,accion,descripcion) VALUES ('$id_usuario','$fecha','Agrego','Solicitud')";
			
				//en caso de los datos no se hallan guardado $sw_us guardamos false 
			ejecutarConsulta($sql_bi) or $sw_bi = false;

			if ($sw_s && $sw_b && $sw_bi && $sw) {
					// Si todo los datos Fuero correctamente insertado retornamos Verdadero
				return true;
			}else{
					//En el caso que algún SQL no fue guardado con existo enviamos falso
				return false;
			}

		}

			//Implementemos un método para mostrar los datos de un registro a modificar
		public function mostrar($id_solicitud){
			
			$sql = "SELECT b.id_beneficiario,b.cedula_b,b.nombre_apellido_b,b.fecha_nacimiento_b,b.parentesco,b.semana_embarazo,b.talla_zapato,b.talla_pantalon,b.talla_franela,o.id_solicitante,o.cedula,o.nombre_apellido,o.fecha_nacimiento,o.sexo,o.direccion,o.telefono_1,o.telefono_2,o.email,o.parroquia,o.estado_civil,o.ocupacion,o.esterilizada,o.beneficio_gubernamental,o.num_hijo,o.ingreso FROM solicitante o INNER JOIN solicitud s ON o.id_solicitante=s.id_solicitante INNER JOIN beneficiario b ON s.id_beneficiario=b.id_beneficiario WHERE id_solicitud='$id_solicitud'";
			
			return ejecutarConsultaSimpleFila($sql);
		}

			//Implementar un método para listar los solicitud
		public function listar(){

			$sql = "SELECT s.id_solicitud ,b.id_beneficiario,o.id_solicitante,o.nombre_apellido as solicitante,o.cedula as cedulas,b.nombre_apellido_b as beneficiario,b.cedula_b as cedulab,t.solicitud,t.descripcion,Date(s.fecha) as fecha FROM solicitud s INNER JOIN solicitante o ON s.id_solicitante=o.id_solicitante INNER JOIN tipo_solicitud t ON s.id_tipo_solicitud=t.id_tipo_solicitud INNER JOIN beneficiario b ON b.id_beneficiario=s.id_beneficiario";
			
			return ejecutarConsulta($sql);
		}

			// Seleccionar el Beneficiario según la visita Social
		public function select(){

			$sql = "SELECT s.id_solicitud,b.id_beneficiario,b.nombre_apellido_b,b.cedula_b FROM solicitud s INNER JOIN beneficiario b ON s.id_beneficiario=b.id_beneficiario INNER JOIN tipo_solicitud ts ON ts.id_tipo_solicitud=s.id_tipo_solicitud WHERE s.estado='En espera' AND ts.condicion='1'";
			
			return ejecutarConsulta($sql);
		}

	}

 ?>