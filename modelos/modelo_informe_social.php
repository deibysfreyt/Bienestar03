<?php 
		//Incluimos icinicalmente la conexion a la base de datos
	require_once("../controlador/conexion.php");
	
	class Informe_social{
		
		function __construct(){
		
		}

			//Implementamos un metodo para registrar
		public function insertar($cedula,$nombre_apellido,$fecha_nacimiento,$direccion,$telefono_1,$telefono_2,$parroquia,$ocupacion,$ingreso,$cedula_b,$nombre_apellido_b,$fecha_nacimiento_b,$semana_embarazo,$id_tipo_solicitud,$id_usuario,$fecha,$tipo_vivienda,$tenencia,$construccion,$tipo_piso,$id_familiar,$nombre_apellido_f,$edad_f,$parentesco_f,$ocupacion_f,$observacion_f,$estado_civil,$diagnostico,$observacion,$edad_s,$edad_b,$recaudos,$estado){

				//Guardamos al beneficiario
			$sql_b = "INSERT INTO beneficiario (cedula_b,nombre_apellido_b,fecha_nacimiento_b,semana_embarazo,edad_b) VALUES ('$cedula_b','$nombre_apellido_b','$fecha_nacimiento_b','$semana_embarazo','$edad_b')";
			
				// Guardamos el ultimo ID de los datos insertado
			$id_beneficiario_b_new=ejecutarConsulta_retornarID($sql_b);


			if (isset($id_beneficiario_b_new)) {
				//Ahora guardamos al Solicitante
				$sql_s = "INSERT INTO solicitante (cedula,nombre_apellido,fecha_nacimiento,direccion,telefono_1,telefono_2,parroquia,ocupacion,ingreso,estado_civil,edad_s) VALUES ('$cedula','$nombre_apellido','$fecha_nacimiento','$direccion','$telefono_1','$telefono_2','$parroquia','$ocupacion','$ingreso','$estado_civil','$edad_s')";
			
				// Guardamos el ultimo ID de los datos insertado
				$id_solicitante_new=ejecutarConsulta_retornarID($sql_s);

			}

			if (isset($id_solicitante_new)) {
				# code...
				//Insertamnos en la tabla solicitud
				$sql_so = "INSERT INTO solicitud (id_solicitante,id_tipo_solicitud,id_beneficiario,id_usuario,fecha,tipo_vivienda,tenencia,construccion,tipo_piso,estado,diagnostico,observacion,recaudos) VALUES ('$id_solicitante_new','$id_tipo_solicitud','$id_beneficiario_b_new','$id_usuario','$fecha','$tipo_vivienda','$tenencia','$construccion','$tipo_piso','$estado','$diagnostico','$observacion','$recaudos')";
			
				// Guardamos el ultimo ID de los datos insertado
				$id_solicitud_new=ejecutarConsulta_retornarID($sql_so);

			}

			if (isset($id_solicitud_new)) {

				//Insertamos en la tabla bitacora para llevar un registro de los movimiento en el sistema
				$sql_bi = "INSERT INTO bitacora (id_usuario,fecha_b,accion,descripcion) VALUES ('$id_usuario','$fecha','Agrego','Solicitud N° $id_solicitud_new en un estado $estado')";
			
				//en caso de los datos no se hallan guardado $sw_us guardamos false 
				ejecutarConsulta($sql_bi);

				//Guardams los Familiares -----------------------------------------------------
				$num_elementos=0;
				if (!empty($id_familiar)) {
				
					//Agregar familiar
					while ($num_elementos < count($id_familiar))
					{

						//Insertamos la tabla familiares
						$sql_f = "INSERT INTO familiar (nombre_apellido_f,edad_f,parentesco_f,ocupacion_f,observacion_f) VALUES ('$nombre_apellido_f[$num_elementos]','$edad_f[$num_elementos]','$parentesco_f[$num_elementos]','$ocupacion_f[$num_elementos]','$observacion_f[$num_elementos]')";
						$id_familiar_new=ejecutarConsulta_retornarID($sql_f);

						// Al mismo tiempo guardamos en la tabla relacion familiar_solicitud
						$sql_familiar = "INSERT INTO familiar_solicitud (id_familiar,id_solicitud) VALUES ('$id_familiar_new','$id_solicitud_new')";
						ejecutarConsulta($sql_familiar);

						$num_elementos=$num_elementos + 1;

					}

				}

				echo "la Solicitud <b style='color: red;'>N° $id_solicitud_new</b> esta es estado <b>$estado</b>, y fue registrado bajo el nombre de <b>$nombre_apellido</b> con <b>.CI. $cedula</b>";

			}else{

				echo "Error de Solicitud codigo: <b style='color: red;'>x $id_solicitante_new x - x $id_beneficiario_b_new x</b>";
			}
				
				//------------------------------------------------------------------
			
		}

			//Implementamos un metodo para editar solicitud
		public function editars($id_solicitante,$cedula,$nombre_apellido,$fecha_nacimiento,$direccion,$telefono_1,$telefono_2,$parroquia,$ocupacion,$ingreso,$cedula_b,$nombre_apellido_b,$fecha_nacimiento_b,$semana_embarazo,$id_tipo_solicitud,$id_usuario,$fecha,$tipo_vivienda,$tenencia,$construccion,$tipo_piso,$id_familiar,$nombre_apellido_f,$edad_f,$parentesco_f,$ocupacion_f,$observacion_f,$estado_civil,$diagnostico,$observacion,$edad_s,$edad_b,$recaudos,$estado){

			
				//Solo el beneficiario
			$sql_b = "INSERT INTO beneficiario (cedula_b,nombre_apellido_b,fecha_nacimiento_b,semana_embarazo,edad_b) VALUES ('$cedula_b','$nombre_apellido_b','$fecha_nacimiento_b','$semana_embarazo','$edad_b')";
			
				// Guardamos el ultimo ID de los datos insertado
			$id_beneficiario_b_new=ejecutarConsulta_retornarID($sql_b);

			if (isset($id_beneficiario_b_new)) {
					//Ahora guardamos la tabla Solicitante
				$sw_s = true;
				$sql_s = "UPDATE solicitante SET cedula='$cedula',nombre_apellido='$nombre_apellido',fecha_nacimiento='$fecha_nacimiento',direccion='$direccion',telefono_1='$telefono_1',telefono_2='$telefono_2',parroquia='$parroquia',ocupacion='$ocupacion',ingreso='$ingreso',estado_civil='$estado_civil',edad_s='$edad_s' WHERE id_solicitante='$id_solicitante'";
				
					//En caso de los datos no se hallan guardado $sw_s guardamos false 	
				ejecutarConsulta($sql_s) or $sw_s=false;

			}

			if ($sw_s) {

				//Insertamnos en la tabla solicitud
				$sql_so = "INSERT INTO solicitud (id_solicitante,id_tipo_solicitud,id_beneficiario,id_usuario,fecha,tipo_vivienda,tenencia,construccion,tipo_piso,estado,diagnostico,observacion,recaudos) VALUES ('$id_solicitante','$id_tipo_solicitud','$id_beneficiario_b_new','$id_usuario','$fecha','$tipo_vivienda','$tenencia','$construccion','$tipo_piso','$estado','$diagnostico','$observacion','$recaudos')";
				
					// Guardamos el ultimo ID de los datos insertado
				$id_solicitud_new=ejecutarConsulta_retornarID($sql_so);

			}
				

			if (isset($id_solicitud_new)) {

				//Insertamos en la tabla bitacora para llevar un registro de los movimiento en el sistema
				$sql_bi = "INSERT INTO bitacora (id_usuario,fecha_b,accion,descripcion) VALUES ('$id_usuario','$fecha','Agrego','Solicitud N° $id_solicitud_new en un estado $estado')";
			
				//en caso de los datos no se hallan guardado $sw_us guardamos false 
				ejecutarConsulta($sql_bi);

				//Guardams los Familiares -----------------------------------------------------
				$num_elementos=0;
				if (!empty($id_familiar)) {
				
					//Agregar familiar
					while ($num_elementos < count($id_familiar))
					{

						//Insertamos la tabla familiares
						$sql_f = "INSERT INTO familiar (nombre_apellido_f,edad_f,parentesco_f,ocupacion_f,observacion_f) VALUES ('$nombre_apellido_f[$num_elementos]','$edad_f[$num_elementos]','$parentesco_f[$num_elementos]','$ocupacion_f[$num_elementos]','$observacion_f[$num_elementos]')";
						$id_familiar_new=ejecutarConsulta_retornarID($sql_f);

						// Al mismo tiempo guardamos en la tabla relacion familiar_solicitud
						$sql_familiar = "INSERT INTO familiar_solicitud (id_familiar,id_solicitud) VALUES ('$id_familiar_new','$id_solicitud_new')";
						ejecutarConsulta($sql_familiar);

						$num_elementos=$num_elementos + 1;

					}

				}

				echo "la Solicitud <b style='color: red;'>N° $id_solicitud_new</b> esta es estado <b>$estado</b>, y fue registrado bajo el nombre de <b>$nombre_apellido</b> con <b>.CI. $cedula</b>";

			}else{

				echo "Error de Solicitud codigo: <b style='color: red;'>x $id_solicitante x - x $id_beneficiario_b_new x</b>";
			}
			

		}

			//Cuando El beneficiario y el Solicitante Existen
		public function insertarbs($id_solicitante,$cedula,$nombre_apellido,$fecha_nacimiento,$direccion,$telefono_1,$telefono_2,$parroquia,$ocupacion,$ingreso,$id_beneficiario,$cedula_b,$nombre_apellido_b,$fecha_nacimiento_b,$semana_embarazo,$id_tipo_solicitud,$id_usuario,$fecha,$tipo_vivienda,$tenencia,$construccion,$tipo_piso,$id_familiar,$nombre_apellido_f,$edad_f,$parentesco_f,$ocupacion_f,$observacion_f,$estado_civil,$diagnostico,$observacion,$edad_s,$edad_b,$recaudos,$estado){			

			//Solo el beneficiario
			$sw_b = true;
			
			$sql_b = "UPDATE beneficiario SET cedula_b='$cedula_b',nombre_apellido_b='$nombre_apellido_b',fecha_nacimiento_b='$fecha_nacimiento_b',semana_embarazo='$semana_embarazo',edad_b='$edad_b' WHERE id_beneficiario='$id_beneficiario'";

				//En caso de los datos no se hallan guardado $sw_p guardamos false 
			ejecutarConsulta($sql_b) or $sw_b = false;

			if ($sw_b) {
				//Ahora guardamos la tabla Solicitante
				$sw_s = true;
				
				$sql_s = "UPDATE solicitante SET cedula='$cedula',nombre_apellido='$nombre_apellido',fecha_nacimiento='$fecha_nacimiento',direccion='$direccion',telefono_1='$telefono_1',telefono_2='$telefono_2',parroquia='$parroquia',ocupacion='$ocupacion',ingreso='$ingreso',estado_civil='$estado_civil',edad_s='$edad_s' WHERE id_solicitante='$id_solicitante'";

					//En caso de los datos no se hallan guardado $sw_s guardamos false 
				ejecutarConsulta($sql_s) or $sw_s=false;
			}

				
			if ($sw_s) {
				
				//Insertamnos en la tabla solicitud
				$sql_so = "INSERT INTO solicitud (id_solicitante,id_tipo_solicitud,id_beneficiario,id_usuario,fecha,tipo_vivienda,tenencia,construccion,tipo_piso,estado,diagnostico,observacion,recaudos) VALUES ('$id_solicitante','$id_tipo_solicitud','$id_beneficiario','$id_usuario','$fecha','$tipo_vivienda','$tenencia','$construccion','$tipo_piso','$estado','$diagnostico','$observacion','$recaudos')";
				
					// Guardamos el ultimo ID de los datos insertado
				$id_solicitud_new=ejecutarConsulta_retornarID($sql_so);
			}
				
			if (isset($id_solicitud_new)) {

				//Insertamos en la tabla bitacora para llevar un registro de los movimiento en el sistema
				$sql_bi = "INSERT INTO bitacora (id_usuario,fecha_b,accion,descripcion) VALUES ('$id_usuario','$fecha','Agrego','Solicitud N° $id_solicitud_new en un estado $estado')";
			
				//en caso de los datos no se hallan guardado $sw_us guardamos false 
				ejecutarConsulta($sql_bi);

				//Guardams los Familiares -----------------------------------------------------
				$num_elementos=0;
				if (!empty($id_familiar)) {
				
					//Agregar familiar
					while ($num_elementos < count($id_familiar))
					{

						//Insertamos la tabla familiares
						$sql_f = "INSERT INTO familiar (nombre_apellido_f,edad_f,parentesco_f,ocupacion_f,observacion_f) VALUES ('$nombre_apellido_f[$num_elementos]','$edad_f[$num_elementos]','$parentesco_f[$num_elementos]','$ocupacion_f[$num_elementos]','$observacion_f[$num_elementos]')";
						$id_familiar_new=ejecutarConsulta_retornarID($sql_f);

						// Al mismo tiempo guardamos en la tabla relacion familiar_solicitud
						$sql_familiar = "INSERT INTO familiar_solicitud (id_familiar,id_solicitud) VALUES ('$id_familiar_new','$id_solicitud_new')";
						ejecutarConsulta($sql_familiar);

						$num_elementos=$num_elementos + 1;

					}

				}

				echo "la Solicitud <b style='color: red;'>N° $id_solicitud_new</b> esta es estado <b>$estado</b>, y fue registrado bajo el nombre de <b>$nombre_apellido</b> con <b>.CI. $cedula</b>";

			}else{

				echo "Error de Solicitud codigo: <b style='color: red;'>x $id_solicitante x - x $id_beneficiario_b x</b>";
			}

		}

			//Implementemos un método para mostrar los datos de un registro a modificar
		public function mostrar($id_solicitud){
			
			$sql = "SELECT b.id_beneficiario,b.cedula_b,b.nombre_apellido_b,b.fecha_nacimiento_b,b.edad_b,b.semana_embarazo,o.id_solicitante,o.cedula,o.nombre_apellido,o.fecha_nacimiento,o.edad_s,o.direccion,o.telefono_1,o.telefono_2,o.parroquia,o.estado_civil,o.ocupacion,o.ingreso FROM solicitante o INNER JOIN solicitud s ON o.id_solicitante=s.id_solicitante INNER JOIN beneficiario b ON s.id_beneficiario=b.id_beneficiario WHERE id_solicitud='$id_solicitud'";
			
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