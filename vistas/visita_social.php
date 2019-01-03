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
            <h1 class="box-title"> Visita Social 
                <!-- Bonton para mostrar el formulario -->
              <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Nueva Visita</button>
            </h1>
            <div class="box-tools pull-right"></div>
          </div>
          <div>
            <label>Fecha Actual: </label>
            <input type="date" name="fecha_actual" style="border: 0px" id="fecha_actual" readonly=”readonly”>
          </div>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-pencil-square-o"></i> Gestión de Solicitud</a></li>
            <li class="active">Visita Social</li>
          </ol>
        </section>
          <!-- Data Table en donde mostramos los datos ya registrado -->
        <div class="panel-body table-responsive" id="listadoregistros">
          <table id="tbllistado" class="table table-striped table-borderd table-condensed table-hover">
            <thead>
              <th>Opciones</th>
              <th>Beneficiario - .CI.</th>
              <th>fecha de la Visita</th>
              <th>Observaciones</th>
              <th>Trabajador Social</th>
            </thead>
            <tbody>
              <!-- Se muestra el contenido del Data Tabla mediante AJAX -->
            </tbody>
            <tfoot>
              <th>Opciones</th>
              <th>Beneficiario - .CI.</th>
              <th>fecha de la Visita</th>
              <th>Observaciones</th>
              <th>Trabajador Social</th>
            </tfoot>
          </table>
        </div>
          <!-- Fin del Data Table -->          
        <div class="panel-body" id="formularioregistros">
            <!-- Es el formulario de la Visita Social -->
          <form action="" method="POST" id="formulario" name="formulario" >
            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <label>N° Contl. - Benef. - .CI. (*):</label>
              <select name="id_solicitud" id="id_solicitud" class="form-control selectpicker" data-live-search="true" title="Seleccione un Beneficiario" required>
              </select>
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <input type="hidden" name="id_visita_social" id="id_visita_social">
              <input type="hidden" name="fecha_a" id="fecha_a" readonly=”readonly”>
              <label>Fecha(*):</label>
              <input type="date" class="form-control" name="fecha_v" id="fecha_v" placeholder="fecha" required>
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <label>observaciones(*):</label>
              <input type="text" class="form-control" maxlength="300" name="observaciones" id="observaciones" placeholder="observaciones" required>
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <label>Trabajador Social(*):</label>
              <input type="text" class="form-control" name="trabajador_social" id="trabajador_social" maxlength="45" placeholder="Trabajado Social con el solicitante" required>
            </div>
            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
              <button class="btn btn-primary" type="submit" id="btnGuardar" ><i class="fa fa-save"></i> Guardar</button>
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
    <!-- Aquí llamamos a los Script de Validación del Formulario  -->
  <script type="text/javascript" src="scripts/validacionV.js"></script>
    <!-- Aquí llamamos a los Script que controla toda la pagina  -->
  <script type="text/javascript" src="scripts/visita_social.js"></script>
<?php 
  } // Se Cierra el Else
  ob_end_flush();
 ?>