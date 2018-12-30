<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dpt. Bienestar</title>
  <!-- responsive -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../public/bootstrap/dist/css/bootstrap.min.css">
  <!-- Theme personal -->
  <link rel="stylesheet" href="../public/css/personal.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../public/dist/css/AdminLTE.css">
</head>
<body class="" id="fondo">
  <div class="login-box">
    <div class="login-logo">
      <b>Fundación del Niño</b>
      <h4>Municipio Iribarren</h4>
    </div>
    <div class="login-box-body" id="caja">
      <p class="login-box-msg"><strong>Inicio de sesión</strong></p>
      <form method="post" id="frmAcceso">
        <div class="form-group has-feedback">
          <input type="txt" id="logina" name="logina" class="form-control" placeholder="Usuario" required>
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" id="clavea" name="clavea" class="form-control" placeholder="Contraseña" required>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row" >
          <div class="col-xs-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Iniciar Sesión</button>
          </div>
        </div>
      </form>
    </div>
  </div>
    <!-- JQuery -->
  <script src="../public/js/jquery-3.1.1.min.js"></script> 

    <!-- Bootstrap 3.3.5 -->
  <script src="../public/js/bootstrap.min.js"></script> 

    <!-- js del Alerta Bootbox -->
  <script src="../public/js/bootbox.min.js"></script>

    <!-- js del del login donde ace las validaciones -->
  <script type="text/javascript" src="scripts/login.js"></script>
</body>
</html>
