<?php 
  if (strlen(session_id()) < 1 ) {
    session_start();
  }

 ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Fund. del Niño | Dpt. Bient.</title>
      <!-- responsivo -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../public/bootstrap/dist/css/bootstrap.min.css">
      <!-- Font Awesome para los Iconos-->
    <link rel="stylesheet" href="../public/font-awesome/css/font-awesome.min.css">
      <!-- Theme style de la plantilla -->
    <link rel="stylesheet" href="../public/dist/css/AdminLTE.min.css">
      <!--
        AdminLTE Skins. Elige un skin desde el css / skins
         carpeta en lugar de descargarlos todos para reducir la carga.
      -->
    <link rel="stylesheet" href="../public/dist/css/skins/_all-skins.min.css">

      <!-- DATATABLES -->
    <link rel="stylesheet" href="../public/datatables/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../public/datatables/buttons.dataTables.min.css">
    <link rel="stylesheet" href="../public/datatables/responsive.dataTables.min.css">

      <!-- Google Font 
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->
    <link rel="stylesheet" href="../public/font/family.css">
  
      <!-- css del Bootstrap Select de las tablas relacionada -->
    <link rel="stylesheet" href="../public/css/bootstrap-select.css">

      <!-- css del formulario Informe Social -->
    <link rel="stylesheet" href="../public/css/stilos.css">
  </head>
  <body class="hold-transition skin-yellow-light sidebar-mini">
    <div class="wrapper">
    	<header class="main-header">
          		<!-- Logo -->
        	<a href="#" class="logo">
            		<!-- Mini logo para barra lateral mini 50x50 pixeles-->
          		<span class="logo-mini"><b>Bient.</b></span>
            		<!-- Logo para estado regular y dispositivos móviles. -->
          		<span class="logo-lg"><b>Dpto. de Bienestar</b></span>
        	</a>
          		<!-- Barra de navegación de encabezado: el estilo se puede encontrar en header.less -->
        	<nav class="navbar navbar-static-top">
            		<!-- Sidebar botón de activación-->
          		<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            		<span class="sr-only">Toggle navigation</span>
          		</a>
            		<!-- Menú derecho de la barra de navegación -->
          		<div class="navbar-custom-menu">
            		<ul class="nav navbar-nav">
                			<!-- Cuenta de usuario: el estilo se puede encontrar en el menú desplegable. -->
              			<li class="dropdown user user-menu">
                			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  				<img src="../files/usuario/<?php echo $_SESSION['imagen']; ?>" class="user-image" alt="Usuario">
                  				<span class="hidden-xs"><?php echo $_SESSION['nombre_apellido']; ?></span>
                			</a>
                			<ul class="dropdown-menu">
                    				<!-- Imanen del Usuario -->
                  				<li class="user-header">
                    				<img src="../files/usuario/<?php echo $_SESSION['imagen']; ?>" class="img-circle" alt="Usuario">
                    				<p><?php echo $_SESSION['nombre_apellido']; ?></p>
                    				<a href="../ajax/usuario.php?op=salir" class="btn btn-default btn-flat">Cerrar Sesión</a>
                  				</li>
                			</ul>
              			</li>
                			<!-- Botón de alternancia de barra lateral de control -->
            		</ul>
          		</div>
        	</nav>
      	</header>
        	<!-- Columna lateral izquierda. contiene el logo y la barra lateral -->
    	<aside class="main-sidebar">
        		<!-- sidebar: el estilo se puede encontrar en sidebar.less -->
        	<section class="sidebar">            
            		<!-- sidebar menu:: style se puede encontrar en sidebar.less -->
          		<ul class="sidebar-menu" data-widget="tree">
            		<li class="header">MENU DE NAVEGACION</li>
            			<?php 
              			if ($_SESSION['Gestion de Usuario']==1){
                			echo '<li class="treeview">
                        			<a href="">
                          			<i class="fa fa-users"></i> <span>Gestión de Usuario</span>
                          			<i class="fa fa-angle-left pull-right"></i>
                        			</a>
                        			<ul class="treeview-menu">
                          			<li><a href="consultas_sistema.php"><i class="fa fa-circle-o"></i> Historial de Usuario</a></li>
                          			<li><a href="usuario.php"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                          			<li><a href="permiso.php"><i class="fa fa-circle-o"></i>Permisos</a></li>    
                        			</ul>
                      			</li>';
              			}
            			?>
            			<?php 
              			if ($_SESSION['Solicitante']==1){
                			echo '<li>                      
                        			<a href="informe_social.php">
                          			<i class="fa fa-slideshare"></i>
                          			<span>Solicitantes</span>                          
                        			</a>                        
                      			</li>';
              			}
            			?>
            			<?php 
              			if ($_SESSION['Gestion de Solicitud']==1){
                			echo '<li class="treeview">
                        			<a href="">
                          			<i class="fa fa-pencil-square-o"></i> <span>Gestión de Solicitud</span>
                          			<i class="fa fa-angle-left pull-right"></i>
                        			</a>
                        			<ul class="treeview-menu">
                          			<li><a href="consultas_solicitud.php"><i class="fa fa-circle-o"></i> Consultas por Fechas</a></li>
                          			<li><a href="visita_social.php"><i class="fa fa-circle-o"></i> Visita Social</a></li>
                          			<li><a href="tipo_solicitud.php"><i class="fa fa-circle-o"></i>Solicitudes</a></li>   
                        			</ul>
                      			</li>';
              			}
            			?>       
          		</ul>
        	</section>
          	<!-- /.sidebar -->
      	</aside>