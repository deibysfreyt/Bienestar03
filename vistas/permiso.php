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
    if ($_SESSION['Gestion de Usuario']==1){
        //Si tienes acceso se muestra la pagina al Usuario
?>
        <!-- Aquí comienza todo el contenido a mostrar -->
      <div class="content-wrapper">
          <!-- contenido del header del cuerpo -->
        <section class="content-header">
          <div class="box-header with-border">
            <h1 class="box-title">Permiso Existentes</h1>
            <div class="box-tools pull-right"></div>
          </div>
          <div>
            <label>Fecha Actual: </label>
            <input type="date" name="fecha_actual" style="border: 0px" id="fecha_actual" readonly=”readonly”>
          </div>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-users"></i> Gestión de Usuario</a></li>
            <li class="active">Permiso</li>
          </ol>
        </section>
          <!-- Data Table en donde mostramos los datos ya registrado -->
        <div class="panel-body table-responsive" id="listadoregistros">
          <table id="tbllistado" class="table table-striped table-borderd table-condensed table-hover">
            <thead>
              <th>Nombre</th>
            </thead>
            <tbody>
              <!-- Se muestra el contenido del Data Tabla mediante AJAX -->
            </tbody>
            <tfoot>
              <th>Nombre</th>
            </tfoot>
          </table>
        </div>
          <!-- Fin del Data Table -->
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
  <script type="text/javascript" src="scripts/permiso.js"></script>
<?php 
  } 
  ob_end_flush();
?>