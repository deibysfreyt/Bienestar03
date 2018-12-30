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
?>
        <!-- Aquí comienza todo el contenido a mostrar -->
      <div class="content-wrapper">
          <!-- contenido del header del cuerpo -->
        <section class="content-header">
          <div class="box-header with-border">
            <h1 class="box-title">Historial de Usuario por Fecha</h1>
            <div class="box-tools pull-right"></div>
          </div>
          <div>
            <label>Fecha Actual: </label>
              <input type="date" name="fecha_actual" style="border: 0px" id="fecha_actual" readonly=”readonly”>
          </div>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-users"></i> Gestión de Usuario</a></li>
            <li class="active">Historial de Usuario</li>
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
              <th>Fecha</th>
              <th>N° de Control</th>
              <th>Usuario</th>
              <th>Cargo</th> 
              <th>Actividad</th>        
            </thead>
            <tbody>
              <!-- Se muestra el contenido del Data Tabla mediante AJAX -->
            </tbody>
            <tfoot>
              <th>Fecha</th>
              <th>N° de Control</th>
              <th>Usuario</th>
              <th>Cargo</th> 
              <th>Actividad</th>
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
  <script type="text/javascript" src="scripts/consultas_sistema.js"></script>
<?php 
  } // Se Cierra el Else
  ob_end_flush();
?>