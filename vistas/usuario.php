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
            <h1 class="box-title"> Usuario
                <!-- Bonton para mostrar el formulario -->
              <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar nuevo Usuario</button>
            </h1>
            <div class="box-tools pull-right"></div>            
          </div>
          <div>
            <label>Fecha Actual: </label>
            <input type="date" name="fecha_actual" style="border: 0px" id="fecha_actual" readonly=”readonly”>
          </div>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-users"></i> Gestión de Usuario</a></li>
            <li class="active">Usuario</li>
          </ol>
        </section>
          <!-- Data Table en donde mostramos los datos ya registrado -->
        <div class="panel-body table-responsive" id="listadoregistros">
          <table id="tbllistado" class="table table-striped table-borderd table-condensed table-hover">
            <thead>
              <th>Opciones</th>
              <th>Nombre y Apellido</th>
              <th>Cedula</th>
              <th>Teléfono</th>
              <th>Email</th>
              <th>Cargo</th>
              <th>Login</th>
              <th>Foto</th>
              <th>Estado</th>
            </thead>
            <tbody>
              <!-- Se muestra el contenido del Data Tabla mediante AJAX -->
            </tbody>
            <tfoot>
              <th>Opciones</th>
              <th>Nombre y Apellido</th>
              <th>Cedula</th>
              <th>Teléfono</th>
              <th>Email</th>
              <th>Cargo</th>
              <th>Login</th>
              <th>Foto</th>
              <th>Estado</th>
            </tfoot>
          </table>
        </div>
          <!-- Fin del Data Table -->
        <div class="panel-body" id="formularioregistros">
            <!-- Es el formulario del Usuario -->
          <form name="formulario" id="formulario" method="POST">
            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <label>Nombre y Apellido(*):</label>
              <input type="hidden" name="id_usuario" id="id_usuario">
              <input type="text" class="form-control" name="nombre_apellido" id="nombre_apellido" maxlength="30" placeholder="Nombre y Apellido" required>
            </div>        
            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <label>Cedula(*):</label>
              <input type="text" class="form-control" name="cedula" id="cedula" maxlength="8" placeholder="Cedula de Identidad" pattern="[0-9]{4,8}" title="Solo numeros" required>
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <label>Teléfono:</label>
              <input type="text" class="form-control" name="telefono" id="telefono" maxlength="12" placeholder="Teléfono" placeholder="0416-1234455" required>
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <label>Email:</label>
              <input type="email" class="form-control" name="email" id="email" maxlength="30" placeholder="ejemplo@dominio.com">
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <label>Cargo(*):</label>
              <input type="text" class="form-control" name="cargo" id="cargo" maxlength="20" placeholder="Cargo" required>
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <label>Login (*):</label>
              <input type="text" class="form-control" name="login" id="login" maxlength="20" placeholder="Login" required>
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <label>Clave (*):</label>
              <input type="password" class="form-control" name="clave" id="clave" maxlength="64" placeholder="Neva Contraseña de Acceso" required>
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <label>Permisos(*):</label>
              <ul style="list-style: none;" id="permisos">

              </ul>
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <label>Imagen(*):</label>
              <input type="file" class="form-control" name="imagen" id="imagen" required>
              <input type="hidden" name="imagenactual" id="imagenactual">
              <img src="" width="150px" height="120px" id="imagenmuestra">
            </div>
            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">          
              <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
              <button class="btn btn-primary" type="submit" id="btnGuardar" onmouseover="validacionU()"><i class="fa fa-save"></i> Guardar</button>    
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
  <script type="text/javascript" src="scripts/validacionU.js"></script>
    <!-- Aquí llamamos a los Script que controla toda la pagina  -->
  <script type="text/javascript" src="scripts/usuario.js"></script>
<?php 
  } // Se Cierra el Else
  ob_end_flush();
?>