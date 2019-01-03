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
    if ($_SESSION['Gestion de Solicitud']==1){
?>
        <!-- Aquí comienza todo el contenido a mostrar -->
      <div class="content-wrapper">
        <!-- contenido del header del cuerpo -->
        <section class="content-header">
          <div class="box-header with-border">
            <h1 class="box-title">Consultas de Solicitud por Fecha</h1>
            <div class="box-tools pull-right"></div>
          </div>
          <div>
            <label>Fecha Actual: </label>
            <input type="date" name="fecha_actual" style="border: 0px" id="fecha_actual" readonly=”readonly”>
          </div>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-pencil-square-o"></i> Gestión de Solicitud</a></li>
            <li class="active">Consulta por Fecha</li>
          </ol>
        </section>
          <!-- El rango de búsqueda -->
        <div class="panel-body table-responsive" id="listadoregistros">
          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <label>Fecha Inicio</label>
            <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" value="<?php echo date("Y-m-d"); ?>">
          </div>
          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <label>Fecha Fin</label>
            <input type="date" class="form-control" name="fecha_fin" id="fecha_fin" value="<?php echo date("Y-m-d"); ?>">
          </div>
            <!-- Data Table en donde mostramos los datos ya registrado -->
          <table id="tbllistado" class="table table-striped table-borderd table-condensed table-hover">
            <thead>
              <th>Opciones</th>
              <th>N° Control</th>
              <th>Fecha de Solicitud</th>              
              <th>Solicitante - .CI.</th>
              <th>Beneficiario - .CI.</th>
              <th>Solicitud - Descripción</th>
              <th>Parroquia</th>
              <th>Estado</th>          
            </thead>
            <tbody>
              <!-- Se muestra el contenido del Data Tabla mediante AJAX -->
            </tbody>
            <tfoot>
              <th>Opciones</th>
              <th>N° Control</th>
              <th>Fecha de Solicitud</th>              
              <th>Solicitante - .CI.</th>
              <th>Beneficiario - .CI.</th>
              <th>Solicitud - Descripción</th>
              <th>Parroquia</th>
              <th>Estado</th>
            </tfoot>
          </table>
        </div>
          <!-- Fin del Data Table -->
        <div id="formularioregistros" class="container col-lg-12 col-md-12 col-sm-12 col-xs-12" >
          <div class="stepwizard">
            <div class="stepwizard-row setup-panel">
              <div class="stepwizard-step">
                <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                <p>Step 1</p>
              </div>
              <div class="stepwizard-step">
                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                <p>Step 2</p>
              </div>
              <div class="stepwizard-step">
                <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                <p>Step 3</p>
              </div>
            </div>
          </div>
          <form method="POST" id="formulario" name="formulario">
            <label>N° de Control:</label>
              <input type="text" name="id_solicitud" id="id_solicitud" style="border: 0px; color: red; font-weight: bold;" readonly=”readonly”>
            <div class="row setup-content" id="step-1">
              <div class="col-xs-12">
                <div class="col-md-12">
                  <h3> Step 1 - Datos del Solicitante</h3>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Cedula(*):</label>
                    <input type="text" class="form-control" name="cedula" id="cedula" minlength="4" maxlength="8" readonly=”readonly”>
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <input type="hidden" name="id_solicitante" id="id_solicitante">
                    <label>Nombre y Apellido(*):</label>
                    <input type="text" class="form-control" name="nombre_apellido" id="nombre_apellido" maxlength="30" readonly=”readonly”>
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Fecha de Nacimiento(*):</label>
                    <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" readonly=”readonly”>
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Sexo(*):</label>
                    <input type="text" class="form-control" name="sexo" id="sexo" readonly=”readonly”>
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Numeros de Hijos(*):</label>
                    <input type="text" class="form-control" name="num_hijo" id="num_hijo" readonly="readonly">
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Ingreso Bs(*):</label>
                    <input type="text" class="form-control" name="ingreso" id="ingreso" readonly="readonly">
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Dirección de Habitación(*):</label>
                    <input type="text" class="form-control" name="direccion" id="direccion" maxlength="100" readonly=”readonly”>
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Teléfono Principal(*):</label>
                    <input type="text" class="form-control" name="telefono_1" id="telefono_1" maxlength="12" readonly=”readonly”>
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Teléfono Secundario:</label>
                    <input type="text" class="form-control" name="telefono_2" id="telefono_2" maxlength="12" readonly=”readonly”>
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Email:</label>
                    <input type="email" class="form-control" name="email" id="email" maxlength="30" readonly=”readonly”>
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Parroquia(*):</label>
                    <input type="text" class="form-control" name="parroquia" id="parroquia" readonly=”readonly”>
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Estado Civil:</label>
                    <input type="text" class="form-control" name="estado_civil" id="estado_civil" readonly=”readonly”>     
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Ocupación(*):</label>
                    <input type="text" class="form-control" name="ocupacion" id="ocupacion" maxlength="50" readonly=”readonly”>
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Beneficio Gubernamental:</label>
                    <input type="text" class="form-control" name="beneficio_gubernamental" id="beneficio_gubernamental" maxlength="50" readonly=”readonly”>
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Esterilizada(o)(*): </label>
                    <input type="text" class="form-control" name="esterilizada" id="esterilizada" readonly=”readonly”>
                  </div>
                  <div class="setup-panel">
                    <div>
                      <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" style="margin: 2px">Siguiente</button>
                      <button class="btn btn-danger btn-lg pull-right" onclick="cancelarform()" type="button" style="margin: 2px"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                    </div>                
                  </div>                    
                </div>
              </div>
            </div>
            <div class="row setup-content" id="step-2">
              <div class="col-xs-12">
                <div class="col-md-12">
                  <h3> Step 2 - Datos del Beneficiario</h3>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Cedula:</label>
                    <input type="text" class="form-control" name="cedula_b" id="cedula_b" maxlength="8" readonly=”readonly”>
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Nombre y Apellido(*):</label>
                    <input type="text" class="form-control" name="nombre_apellido_b" id="nombre_apellido_b" maxlength="50" readonly=”readonly”>
                  </div>                        
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Fecha de Nacimiento(*):</label>
                    <input type="date" class="form-control" name="fecha_nacimiento_b" id="fecha_nacimiento_b" readonly=”readonly”>
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Parentesco(*):</label>
                    <input type="text" class="form-control" name="parentesco" id="parentesco" readonly=”readonly”>
                  </div>                  
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Tipo de Solicitud(*):</label>
                    <input type="text" class="form-control" name="solicitud" id="solicitud" readonly=”readonly”>
                    <input type="text" class="form-control" name="descripcion" id="descripcion" readonly=”readonly”>
                  </div>
                  <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">                        
                    <label>Semana de Embarazo: </label>
                    <input type="text" class="form-control" name="semana_embarazo" id="semana_embarazo" readonly=”readonly”>
                  </div>
                  <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <label>Talla de Zapato:</label>
                    <input type="text" class="form-control" name="talla_zapato" id="talla_zapato" readonly=”readonly”>
                  </div>
                  <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <label>Talla de Pantalón:</label>
                    <input type="text" class="form-control" name="talla_pantalon" id="talla_pantalon" readonly=”readonly”>
                  </div>
                  <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <label>Talla de Franela:</label>
                    <input type="text" class="form-control" name="talla_franela" id="talla_franela" readonly=”readonly”>
                  </div>                                                     
                  <div class="setup-panel">
                    <div>
                      <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" style="margin: 2px">Siguiente</button>
                      <a href="#step-1"><button class=" btn btn-previous btn-lg pull-right" type="button" style="margin: 2px"><strong>Anterior</strong></button></a>
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
                    <label>Medio de Información(*):</label>
                    <input type="text" class="form-control" name="medio_informacion" id="medio_informacion" readonly=”readonly”>
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Observación:</label>
                    <input type="text" class="form-control" name="observacion" id="observacion" readonly=”readonly”>
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Fecha de Solicitud(*):</label>
                    <input type="date" class="form-control" name="fecha" id="fecha" readonly=”readonly” required>
                  </div>
                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h4 style="text-align: center;"><strong>Área Física Ambiental</strong></h4>
                  </div>
                  <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label>Tipo de Vivienda(*):</label>
                    <input type="text" class="form-control" name="tipo_vivienda" id="tipo_vivienda" readonly=”readonly”>     
                  </div>
                  <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label>Tenencia(*):</label>
                    <input type="text" class="form-control" name="tenencia" id="tenencia" readonly=”readonly”>
                  </div>
                  <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label>Construcción(*):</label>
                    <input type="text" class="form-control" name="construccion" id="construccion" readonly=”readonly”>
                  </div>
                  <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label>Piso(*):</label>
                    <input type="text" class="form-control" name="tipo_piso" id="tipo_piso" readonly=”readonly”>
                  </div>
                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h4 style="text-align: center;"><strong>Grupo Familiar</strong></h4>
                  </div>
                  <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                      <thead style="background-color:#A9D0F5">
                        <th>Opciones</th>
                        <th>Nombre y Apellido</th>
                        <th>Fech. de Naci.</th>
                        <th>Parentesco</th>
                        <th>Ocupacion</th>
                        <th>Ingreso Bs</th>
                        <th>Peso Kg</th>
                        <th>Talla cm</th>
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
                        <th></th>
                        <th></th> 
                      </tfoot>                      
                    </table>
                  </div>
                  <div class="form-group pull-right col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="setup-panel">
                      <div>
                        <a href="#step-2"><button class=" btn btn-previous btn-lg pull-right" type="button" style="margin: 2px"><strong>Anterior</strong></button></a> 
                      </div>                
                    </div>                          
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
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
  <script type="text/javascript" src="scripts/consultas_solicitud.js"></script>
<?php 
  } // Se Cierra el Else
  ob_end_flush();
?>