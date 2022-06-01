<!DOCTYPE html>
<html lang="es">

<head>
  <title>IOSET</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="Shortcut icon"  href="assets/icons/logo.png"/>
  <script src="js/sweet-alert.min.js"></script>
  <link rel="stylesheet" href="css/sweet-alert.css">
  <link rel="stylesheet" href="css/material-design-iconic-font.min.css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/login.css" />
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script>
    window.jQuery || document.write('<script src="js/jquery-1.11.2.min.js"><\/script>')
  </script>
  <script src="js/modernizr.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
  <script src="js/main.js"></script>
</head>

<body class="full-cover-background" style="background-image:url(assets/img/imagen1.jpg);">
  <div class="form-container">
    <p class="text-center" style="margin-top: 17px;">
      <h4 class="text-center all-tittles" style="margin-bottom: 30px;">
        <font size="6" face="roboto">IOSET</font>
      </h4>
      <center>
        <img src="assets/img/3.png" alt="user" class="img-responsive center-box" style="max-width: 200px;">
      </center>
    </p>
    <h4 class="text-center all-tittles" style="margin-bottom: 30px;">
      <font size="6" face="roboto">Iniciar sesión</font>
    </h4>
    <form action="validar.php" method="POST">

      <div class="group-material-login">
        <input type="text" class="material-login-control" name="mail" required="" maxlength="70">
        <span class="highlight-login"></span>
        <span class="bar-login"></span>
        <label><i class="zmdi zmdi-account"></i> &nbsp; Correo</label>
      </div><br>
      <div class="group-material-login">
        <input type="password" class="material-login-control" name="pass" required="" maxlength="70">
        <span class="highlight-login"></span>
        <span class="bar-login"></span>
        <label><i class="zmdi zmdi-lock"></i> &nbsp; Contraseña</label>
      </div>
      <br>
      <br>

      <button class="btn-login" type="submit">Ingresar &nbsp; <i class="zmdi zmdi-arrow-right"></i></button>
    </form>

  </div>
</body>

</html>