<?php 
  
   //Activamos el almacenamiento en el buffer
  ob_start();
  session_start();
    //Comprobamos si el Usuario a iniciado sesión para entrar al sistema
  if (!isset($_SESSION["nombre_apellido"])) {
      //Si el Usuario no iniciado sesión pues es diseccionado al inicio
    header("location: login.html");
  }else{
      // Una ves de tener acceso al sistema Aquí llamamos la Cabecera de la pagina
    require_once("header.php"); 
      //Aquí preguntamos si el Usuario tiene acceso al la pagina
    if ($_SESSION['Solicitante']==1){
        //Si tienes acceso se muestra la pagina al Usuario
  ?>
        <!-- Aquí comienza todo el contenido a mostrar -->
      <div class="content-wrapper">
        <!-- contenido del header del cuerpo -->
        <section class="content-header">
          <div class="box-header with-border">
            <h1 class="box-title">Solicitantes
              <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Nuevo Solicitud</button></h1>
            <div class="box-tools pull-right"></div>
          </div>
          <div>
            <label>Fecha Actual: </label>
            <input type="date" name="fecha_actual" style="border: 0px" id="fecha_actual" readonly=”readonly”>
          </div>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-slideshare"></i> Solicitudes </a></li>
          </ol>
        </section>
          <!-- Data Table en donde mostramos los datos ya registrado -->
        <div class="panel-body table-responsive" id="listadoregistros">
          <table id="tbllistado" class="table table-striped table-borderd table-condensed table-hover">
            <thead>
              <th>Opciones</th>
              <th>Solicitante - .CI.</th>
              <th>Beneficiario - .CI.</th>
              <th>N° Contrl.</th>
              <th>Tipo de Solicitud</th>
              <th>Fecha de la Solicitud</th>
            </thead>
            <tbody>
              <!-- Se muestra el contenido del Data Tabla mediante AJAX -->
            </tbody>
            <tfoot>
              <th>Opciones</th>
              <th>Solicitante - .CI.</th>
              <th>Beneficiario - .CI.</th>
              <th>N° Contrl.</th>
              <th>Tipo de Solicitud</th>
              <th>Fecha de la Solicitud</th>
            </tfoot>
          </table>
        </div>
          <!-- Fin del Data Table -->
          <!-- Formulario de múltiple pasos -->
        <div id="formularioregistros" class="container col-lg-12 col-md-12 col-sm-12 col-xs-12" >
          <div class="stepwizard">
            <div class="stepwizard-row setup-panel">
              <div class="stepwizard-step">
                <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                <p>Solicitante</p>
              </div>
              <div class="stepwizard-step">
                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                <p>Beneficiario</p>
              </div>
              <div class="stepwizard-step">
                <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                <p>Información</p>
              </div>
            </div>
          </div>
          <form method="POST" id="formulario" name="formulario">
            <div class="row setup-content" id="step-1">
              <div class="col-xs-12">
                <div class="col-md-12">
                  <h3> Step 1 - Datos del Solicitante</h3>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Cedula(*):</label>
                    <input type="text" class="form-control" name="cedula" id="cedula" minlength="4" maxlength="8" placeholder="12345678" title="Solo numeros" required>
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <input type="hidden" name="id_solicitante" id="id_solicitante">
                    <label>Nombre y Apellido(*):</label>
                    <input type="text" class="form-control" name="nombre_apellido" id="nombre_apellido" placeholder="Nombre y Apellido" maxlength="50" required>
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Edad:</label>
                    <input type="text" class="form-control" name="edad_s" id="edad_s" maxlength="2" placeholder="xx">
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Fecha de Nacimiento(*):</label>
                    <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" required>
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Ingresos Bs:</label>
                    <input type="text" class="form-control" name="ingreso" id="ingreso" maxlength="7" placeholder="1234567">
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Dirección de Habitación(*):</label>
                    <input type="text" class="form-control" name="direccion" id="direccion" maxlength="100" placeholder="direccion de habitacion"  required>
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Teléfono Celular(*):</label>
                    <input type="text" class="form-control" name="telefono_1" id="telefono_1" maxlength="11" placeholder="04xx1234455" title="Telefono Celular" required>
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Teléfono Fijo:</label>
                    <input type="text" class="form-control" name="telefono_2" id="telefono_2" maxlength="11" placeholder="02511234455" title="Telefono Fijo">
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Parroquia(*):</label>
                    <select name="parroquia" id="parroquia" class="form-control selectpicker" data-live-search="true" required>
                      <option disabled="" selected="">-------</option>
                      <option value="Buena Vista">Buena Vista</option>
                      <option value="Catedral">Catedral</option>
                      <option value="Concepció">Concepción</option>
                      <option value="Aguedo Felipe Alvarado">Aguedo Felipe Alvarado</option>
                      <option value="Ana Soto">Ana Soto</option>
                      <option value="El Cuji">El Cuji</option>
                      <option value="Juárez">Juárez</option>
                      <option value="Santa Rosa">Santa Rosa</option>
                      <option value="Tamaca">Tamaca</option>
                      <option value="Unión">Unión</option>
                      <option value="Otros">Otros</option>            
                    </select>
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Estado Civil(*):</label>
                    <select name="estado_civil" id="estado_civil" class="form-control selectpicker" data-live-search="true" required>
                      <option disabled="" selected="">-------</option>
                      <option value="Soltera(o)">Soltera(o)</option>
                      <option value="Casada(o)">Casada(o)</option>
                      <option value="Divorciada(o)">Divorciada(o)</option>
                      <option value="Separada(o)">Separada(o)</option>
                      <option value="Conviviente">Conviviente</option>
                      <option value="Viuda(o)">Viuda(o)</option>         
                    </select>                      
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Ocupación:</label>
                    <input type="text" class="form-control" name="ocupacion" id="ocupacion" maxlength="50" placeholder="Su funte de trabajo u oficio" title="A que se dedica">
                  </div>
                  <div class="setup-panel">
                    <div>
                      <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" style="margin: 2px">Siguiente</button>
                      <button class="btn btn-danger btn-lg pull-right" onclick="cancelarform()" type="button" style="margin: 2px"> Cancelar</button>
                    </div>                
                  </div>                    
                </div>
              </div>
            </div>
            <div class="row setup-content" id="step-2">
              <div class="col-xs-12">
                <div class="col-md-12">
                  <h3> Step 2 - Datos del Beneficiario</h3>
                  <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <input type="hidden" name="id_beneficiario" id="id_beneficiario">
                    <label>Cedula:</label>
                    <input type="text" class="form-control" name="cedula_b" id="cedula_b" maxlength="8" placeholder="12345678">
                  </div>
                  <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <label>Nombre y Apellido(*):</label>
                    <input type="text" class="form-control" name="nombre_apellido_b" id="nombre_apellido_b" maxlength="50" placeholder="Nombre y Apellido" required>
                  </div>
                  <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <label>Edad(*):</label>
                    <input type="text" class="form-control" name="edad_b" id="edad_b" maxlength="2" placeholder="xx">
                  </div>                         
                  <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <label>Fecha de Nacimiento(*):</label>
                    <input type="date" class="form-control" name="fecha_nacimiento_b" id="fecha_nacimiento_b">
                  </div>                
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Tipo de Solicitud(*):</label>
                    <select name="id_tipo_solicitud" id="id_tipo_solicitud" class="form-control selectpicker" data-live-search="true" title="----------------" required>

                    </select>
                  </div>
                  <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <label>Semana de Embarazo(*): </label>
                    <input type="text" class="form-control" name="semana_embarazo" id="semana_embarazo" title="Semana de Embarazo" placeholder="Semana de Embarazo" maxlength="2">
                  </div>
                  <?php 
                    if ($_SESSION['Gestion de Solicitud']==1){
                      echo '<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                              <label style="color: orange;">Estado de Solicitud(*): </label>
                              <select name="estado" id="estado" class="form-control" style="color: orange;">
                                <option value="En espera" selected="selected" style="color: red;">En espera</option>
                                <option value="Aprobado" style="color: green;">Aprobado</option>
                              </select> 
                            </div>';
                    }
                  ?> 
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Diagnostico:</label>
                    <input type="text" class="form-control" name="diagnostico" id="diagnostico" maxlength="45" placeholder="Diagnostico">
                  </div>
                  <div class="form-group col-lg-8 col-md-8 col-sm-6 col-xs-12">
                    <label>Observacion:</label>
                    <input type="text" class="form-control" name="observacion" id="observacion" maxlength="100" placeholder="Observacion">
                  </div>
                  <div class="setup-panel">
               			<div>
                      <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" style="margin: 2px">Siguiente</button>
                      <a href="#step-1"><button class=" btn btn-previous btn-lg pull-right" type="button" style="margin: 2px"><i class="fa fa-arrow-circle-left"></i><strong>Anterior</strong></button></a>
                		</div>                
            			</div>
                </div>
              </div>
            </div>
            <div class="row setup-content" id="step-3">
              <div class="col-xs-12">
                <div class="col-md-12">
                  <h3> Step 3 - Información de Solicitud</h3>
                  <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Fecha de Solicitud(*):</label>
                    <input type="hidden" name="id_solicitud" id="id_solicitud">
                    <input type="date" class="form-control" name="fecha" id="fecha" required>
                  </div>
                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h4><strong>Área Física Ambiental</strong></h4>
                  </div>
                  <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label>Tipo de Vivienda:</label>
                    <select name="tipo_vivienda" id="tipo_vivienda" data-live-search="true" class="form-control" title="Seleccione el tipo">
                      <option value="">-----</option>
                      <option value="Quinta">Quinta</option>
                      <option value="Apartamento">Apartamento</option>
                      <option value="Casa">Casa</option>
                      <option value="Rancho">Rancho</option>           
                    </select>
                  </div>
                  <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label>Tenencia:</label>
                    <select name="tenencia" id="tenencia" class="form-control" data-live-search="true" title="Seleccione el tipo">
                      <option value="">-----</option>
                      <option value="Propia">Propia</option>
                      <option value="Alquilada">Alquilada</option>
                      <option value="Alojada">Alojada</option>
                      <option value="Otros">Otros</option>           
                    </select>
                  </div>
                  <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label>Construcción:</label>
                    <select name="construccion" id="construccion" data-live-search="true" class="form-control" title="Seleccione el tipo">
                      <option value="">-----</option>
                      <option value="Bloque">Bloque</option>
                      <option value="Bahareque">Bahareque</option>
                      <option value="Zinc">Zinc</option>
                      <option value="Otros">Otros</option>           
                    </select>
                  </div>
                  <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label>Piso:</label>
                    <select name="tipo_piso" id="tipo_piso" data-live-search="true" class="form-control" title="Seleccione el tipo">
                      <option value="">-----</option>
                      <option value="Granito">Granito</option>
                      <option value="Cerámica">Cerámica</option>
                      <option value="Cemento">Cemento</option>
                      <option value="Tierra">Tierra</option>           
                    </select>
                  </div>
                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <a>           
                      <button id="" type="button" class="btn btn-primary" onclick="agregarDetalle()"> <span class="fa fa-plus"></span> Agregar Familiar</button>
                    </a>
                  </div>
                  <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                      <thead style="background-color:#A9D0F5; text-align: left;">
                        <th style="text-align: left;">Opciones</th>
                        <th style="text-align: left;">Nombre y Apellido</th>
                        <th style="text-align: left;">Edad</th>
                        <th style="text-align: left;">Parentesco</th>
                        <th style="text-align: left;">Ocupacion</th>
                        <th style="text-align: left;">Observacion</th>                           
                      </thead>
                      <tbody>
                                  
                      </tbody>
                      <tfoot>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th> 
                      </tfoot>                      
                    </table>
                  </div>
                  <div class="form-group pull-right col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="setup-panel">
               				<div>
                        <button class="btn btn-primary btn-lg pull-right" type="submit" id="btnGuardar" style="margin: 2px" ><i class="fa fa-save"></i> Guardar</button>
                        <button class="btn btn-danger btn-lg pull-right" onclick="cancelarform()" type="button" style="margin: 2px"> Cancelar</button>
                        <a href="#step-2"><button class=" btn btn-previous btn-lg pull-right" type="button" style="margin: 2px"><i class="fa fa-arrow-circle-left"></i> <strong> Anterior</strong></button></a>
                			</div>                
            				</div>                          
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
          <!-- Fin del Formulario Múltiple -->
      </div>
        <!-- Este es todo el contenido a mostrar -->
<?php
    }else{
        //Si no tiene acceso a la pagina le diseccionara a una pagina de no acceso
      require_once("noacceso.php");
    }
    //Aquí llamamos al pie de la pagina
  require_once("footer.php");
?>
     <!-- Aquí llamamos a los Script que controla el Formulario Múltiple  -->
  <script type="text/javascript" src="scripts/funciones.js"></script>
    <!-- Aquí llamamos a los Script que controla toda la pagina  -->
  <script type="text/javascript" src="scripts/informe_social.js"></script>
     <!-- Aquí llamamos a los Script de Validación del Formulario  -->
<?php 
  } // Se Cierra el Else
  ob_end_flush();
?>