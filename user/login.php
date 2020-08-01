<?php

require_once "../Filehandler/Ifilehandler.php";
require_once "../Filehandler/Jsonfhandler.php";
require_once "../database/context.php";
require_once "User.php";
require_once "UserService.php";
require_once "../Helpers/utilities.php";



$result = null;
$message = "";
$message1 = "";

session_start();

$service = new UserService("../database");
$utilities = new Utilities();

if(isset($_POST['userName']) && isset($_POST['contrasena'])){

  $result = $service->Login($_POST['userName'],$_POST['contrasena']);

  if($result != null){

    $verificar = $utilities->Status($_POST['userName'],"../database");

    if($verificar == true){

      $_SESSION['user'] = json_encode($result);
      header("Location: ../index.php");
      exit();

    }else{
      $message1 = "Tu cuenta no esta activada. Te enviamos un email con un link para activar tu cuenta.";
    }

  }else{
      $message = "Usuario o contraseña incorrect@s";
  }


}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="generator" content="Jekyll v4.0.1">
    <title>Inicio de sesion</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">

<link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../assets/css/login.css" rel="stylesheet" type="text/css">
  </head>
  <body class="text-center">

    <form class="form-signin" action="login.php" method="POST">

    <?php if($message!=""): ?>
  <div class="alert alert-danger" role="alert">
      <?= $message ?>
  </div>
<?php endif; ?>

<?php if($message1!=""): ?>
  <div class="alert alert-danger" role="alert">
      <?= $message1 ?>
  </div>
<?php endif; ?>

  <img class="mb-4" src="/docs/4.5/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
  <h1 class="h3 mb-3 font-weight-normal">Fenix</h1>
  <label for="userName" class="sr-only">Nombre de usuario</label>
  <input type="text" id="userName" class="form-control" placeholder="Nombre de usuario" name="userName" required autofocus>
  <label for="contrasena" class="sr-only">Contraseña</label>
  <input type="password" id="contrasena" class="form-control" placeholder="Contraseña" name="contrasena" required>

  <button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar sesion</button>
  <a href="registro.php">Registrarse /</a>
  <a href="../index.php">Volver a inicio</a>
  <p class="mt-5 mb-3 text-muted">Fenix &copy; 2017-2020</p>
</form>
</body>
</html>