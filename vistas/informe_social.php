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
              <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar Nuevo Informe</button></h1>
            <div class="box-tools pull-right"></div>
          </div>
          <div>
            <label>Fecha Actual: </label>
            <input type="date" name="fecha_actual" style="border: 0px" id="fecha_actual" readonly=”readonly”>
          </div>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-slideshare"></i> Solicitantes </a></li>
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
            <div class="row setup-content" id="step-1">
              <div class="col-xs-12">
                <div class="col-md-12">
                  <h3> Step 1 - Datos del Solicitante</h3>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Cedula(*):</label>
                    <input type="text" class="form-control" name="cedula" id="cedula" minlength="4" maxlength="8" placeholder="12345678" pattern="[0-9]{4,8}" title="Solo numeros" required>
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <input type="hidden" name="id_solicitante" id="id_solicitante">
                    <label>Nombre y Apellido(*):</label>
                    <input type="text" class="form-control" name="nombre_apellido" id="nombre_apellido" placeholder="Nombre y Apellido" maxlength="30" required>
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Fecha de Nacimiento(*):</label>
                    <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" required>
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Sexo(*):</label>
                    <select name="sexo" id="sexo" class="form-control selectpicker" data-live-search="true" title="Seleccione el sexo" required>
                      <option value="Femenino">Femenino</option>
                      <option value="Masculino">Masculino</option>                                 
                    </select>
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Numeros de Hijos(*):</label>
                    <select name="num_hijo" id="num_hijo" class="form-control select-picker" data-live-search="true" title="Numeros de Hijos" required>
                      <?php
                        for ($i=0; $i <= 15; $i++) { 
                          echo "<option value=$i>". $i."</option>";
                        }
                      ?>
                    </select>
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Ingreso Bs(*):</label>
                    <input type="text" class="form-control" name="ingreso" id="ingreso" maxlength="7" placeholder="Ingreso Monetario" title="dinero" required>
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Dirección de Habitación(*):</label>
                    <input type="text" class="form-control" name="direccion" id="direccion" maxlength="100" placeholder="direccion de habitacion"  required>
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Teléfono Principal(*):</label>
                    <input type="text" class="form-control" name="telefono_1" id="telefono_1" maxlength="12" placeholder="04xx-1234455" title="Telefono Celular" required>
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Teléfono Secundario:</label>
                    <input type="text" class="form-control" name="telefono_2" id="telefono_2" maxlength="12" placeholder="0416-1234455 Ó 0251-1234455">
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Email:</label>
                    <input type="email" class="form-control" name="email" id="email" maxlength="30" placeholder="ejemplo@dominio.com" title="Correo Electronico">
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Parroquia(*):</label>
                    <select name="parroquia" id="parroquia" class="form-control selectpicker" data-live-search="true" title="Seleccione una Parroquia" required>
                      <option value="Buena Vista">Buena Vista</option>
                      <option value="Catedral">Catedral</option>
                      <option value="Concepció">Concepción</option>
                      <option value="Felipe Alvarado">Felipe Alvarado</option>
                      <option value="Juan de Villegas">Juan de Villegas</option>
                      <option value="El Cuji">El Cuji</option>
                      <option value="Juárez">Juárez</option>
                      <option value="Santa Rosa">Santa Rosa</option>
                      <option value="Tamaca">Tamaca</option>
                      <option value="Unión">Unión</option>
                      <option value="Otros">Otros</option>            
                    </select>
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Estado Civil:</label>
                    <select name="estado_civil" id="estado_civil" class="form-control selectpicker" data-live-search="true" title="Seleccione su Estado civil" required>
                      <option value="Soltera(o)">Soltera(o)</option>
                      <option value="Casada(o)">Casada(o)</option>
                      <option value="Divorciada(o)">Divorciada(o)</option>
                      <option value="Separada(o)">Separada(o)</option>
                      <option value="Conviviente">Conviviente</option>
                      <option value="Viuda">Viuda</option>         
                    </select>                      
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Ocupación(*):</label>
                    <input type="text" class="form-control" name="ocupacion" id="ocupacion" maxlength="50" placeholder="Su funte de trabajo u oficio" title="A que se dedica" required>
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Beneficio Gubernamental:</label>
                    <input type="text" class="form-control" name="beneficio_gubernamental" id="beneficio_gubernamental" maxlength="50" placeholder="Algun beneficio gubernamental que posea actualmente">
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Esterilizada(o)(*): </label>
                    <select name="esterilizada" id="esterilizada" class="form-control selectpicker" data-live-search="true" title="Seleccione una opcion" required>
                      <option value="Si">Si</option>
                      <option value="No">No</option>                                 
                    </select>
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
                    <input type="hidden" name="id_persona" id="id_persona">
                    <label>Cedula:</label>
                    <input type="text" class="form-control" name="cedula_b" id="cedula_b" maxlength="8" placeholder="12345678">
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Nombre y Apellido(*):</label>
                    <input type="text" class="form-control" name="nombre_apellido_b" id="nombre_apellido_b" maxlength="50" placeholder="Nombre y Apellido" required>
                  </div>                        
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Fecha de Nacimiento(*):</label>
                    <input type="date" class="form-control" name="fecha_nacimiento_b" id="fecha_nacimiento_b" required>
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Parentesco(*):</label>
                    <select name="parentesco_b" id="parentesco_b" class="form-control selectpicker" data-live-search="true" title="Seleccione un parentesco" required>
                      <option value="Padre">Padre</option>
                        <option value="Madre">Madre</option>
                        <option value="Suegra(o)">Suegra(o)</option>
                        <option value="Hija(o)">Hija(o)</option>
                        <option value="Hermana(o)">Hermana(o)</option>
                        <option value="Cuñada(o)">Cuñada(o)</option>
                        <option value="Abuela(o)">Abuela(o)</option>
                        <option value="Yerna(o)">Yerna(o)</option>
                        <option value="Nieta(o)">Nieta(o)</option>
                        <option value="Tia(o)">Tía(o)</option>
                        <option value="Sobrina(o)">Sobrina(o)</option>
                        <option value="Prima(o)">Prima(o)</option>
                    </select>
                  </div>                  
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Tipo de Solicitud(*):</label>
                    <select name="id_tipo_solicitud" id="id_tipo_solicitud" class="form-control selectpicker" title="Seleccione una Solicitud" data-live-search="true" required>
                    </select>
                  </div>
                  <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">                        
                    <label>Semana de Embarazo: </label>                                  
                    <select name="semana_embarazo_b" id="semana_embarazo_b" class="form-control select-picker" title="En caso de Canastilla" data-live-search="true">
                      <?php
                        for ($i=0; $i <= 42; $i++) { 
                          echo "<option value=$i>". $i."</option>";
                        }
                      ?>
                    </select>
                  </div>
                  <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <label>Talla de Zapato:</label>
                    <select name="talla_zapato" id="talla_zapato" class="form-control select-picker" title="?" data-live-search="true" required>
                      <?php
                        for ($i=18; $i <= 45; $i++) { 
                          echo "<option value=$i>". $i. "</option>";
                        }
                      ?>
                    </select>
                  </div>
                  <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <label>Talla de Pantalón:</label>
                    <select name="talla_pantalon" id="talla_pantalon" class="form-control select-picker" title="?" data-live-search="true" required>
                      <?php
                        for ($i=2; $i <= 36; $i+=2) { 
                          echo "<option value=$i>". $i. "</option>";
                        }
                      ?>
                    </select>
                  </div>
                  <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <label>Talla de Franela:</label>
                    <select name="talla_franela" id="talla_franela" class="form-control select-picker" title="?" data-live-search="true" required>
                      <?php
                        for ($i=2; $i <= 16; $i+=2) { 
                          echo "<option value=$i>". $i. "</option>";
                        }
                      ?>
                      <option value="S">SS</option>
                      <option value="S">S</option>
                      <option value="M">M</option>
                      <option value="M">G</option>
                      <option value="L">L</option>
                      <option value="XL">XL</option>
                      <option value="2XL">2XL</option>
                      <option value="3XL">3XL</option>
                    </select>
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
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Medio de Información(*):</label>
                    <input type="hidden" name="id_solicitud" id="id_solicitud">
                    <input type="text" class="form-control" name="medio_informacion" id="medio_informacion" maxlength="30" placeholder="Mdio en que se entero de la Fundacion" required>
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Fecha de Solicitud(*):</label>
                    <input type="date" class="form-control" name="fecha" id="fecha" readonly=”readonly” required>
                  </div>
                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h4><strong>Área Física Ambiental</strong></h4>
                  </div>
                  <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label>Tipo de Vivienda(*):</label>
                    <select name="tipo_vivienda" id="tipo_vivienda" class="form-control selectpicker" title="Seleccione el tipo" required>
                      <option value="Quinta">Quinta</option>
                      <option value="Apartamento">Apartamento</option>
                      <option value="Casa">Casa</option>
                      <option value="Rancho">Rancho</option>           
                    </select>
                  </div>
                  <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label>Tenencia(*):</label>
                    <select name="tenencia" id="tenencia" class="form-control selectpicker" title="Seleccione el tipo" required>
                      <option value="Propia">Propia</option>
                      <option value="Alquilada">Alquilada</option>
                      <option value="Alojada">Alojada</option>
                      <option value="Otros">Otros</option>           
                    </select>
                  </div>
                  <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label>Construcción(*):</label>
                    <select name="construccion" id="construccion" class="form-control selectpicker" title="Seleccione el tipo" required>
                      <option value="Bloque">Bloque</option>
                      <option value="Bahareque">Bahareque</option>
                      <option value="Zinc">Zinc</option>
                      <option value="Otros">Otros</option>           
                    </select>
                  </div>
                  <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label>Piso(*):</label>
                    <select name="tipo_piso" id="tipo_piso" class="form-control selectpicker" title="Seleccione el tipo" required>
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
                        <button class="btn btn-primary btn-lg pull-right" type="submit" id="btnGuardar" style="margin: 2px" onmouseover="validacion()" ><i class="fa fa-save"></i> Guardar</button> 
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
  <script type="text/javascript" src="scripts/validacion.js"></script>
<?php 
  } // Se Cierra el Else
  ob_end_flush();
?>