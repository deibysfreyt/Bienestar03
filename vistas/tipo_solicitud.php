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
        //Si tienes acceso se muestra la pagina al Usuario
?>
        <!-- Aquí comienza todo el contenido a mostrar -->
      <div class="content-wrapper">
          <!-- contenido del header del cuerpo -->
        <section class="content-header">
          <div class="box-header with-border">
            <h1 class="box-title">Tipo Solicitudes
                <!-- Bonton para mostrar el formulario -->
              <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Nueva Solicitud</button>
            </h1>
            <div class="box-tools pull-right"></div>
          </div>
          <div>
            <label>Fecha Actual: </label>
            <input type="date" name="fecha_actual" style="border: 0px" id="fecha_actual" readonly=”readonly”>
          </div>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-pencil-square-o"></i> Gestión de Solicitud</a></li>
            <li class="active">Tipos de Solicitud</li>
          </ol>
        </section>
          <!-- Data Table en donde mostramos los datos ya registrado -->
        <div class="panel-body table-responsive" id="listadoregistros">
          <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
            <thead>
              <th>Opciones</th>
              <th>Nombre</th>
              <th>Descripción</th>
              <th>Estado</th>
            </thead>
            <tbody>  
              <!-- Se muestra el contenido del Data Tabla mediante AJAX -->
            </tbody>
            <tfoot>
              <th>Opciones</th>
              <th>Nombre</th>
              <th>Descripción</th>
              <th>Estado</th>
            </tfoot>
          </table>
        </div>
          <!-- Fin del Data Table -->
        <div class="panel-body" style="height: 400px;" id="formularioregistros">
            <!-- Es el formulario del Usuario -->
          <form name="formulario" id="formulario" method="POST">
            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <label>Solicitud(*):</label>
              <input type="hidden" name="id_tipo_solicitud" id="id_tipo_solicitud">
              <input type="text" class="form-control" name="solicitud" id="solicitud" maxlength="45" placeholder="Categoria de la Solicitud" required>
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <label>Descripción:</label>
              <input type="text" class="form-control" name="descripcion" id="descripcion" maxlength="45" placeholder="Descripción">
            </div>
            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
              <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
            </div>
          </form>
        </div>
        <!-- Fin del Formulario -->
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
    <!-- Aquí llamamos a los Script que controla toda la pagina  -->
  <script type="text/javascript" src="scripts/tipo_solicitud.js"></script>

<?php 
  } // Se Cierra el Else 
  ob_end_flush();
?>