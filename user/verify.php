<?php

require_once 'User.php';
require_once "../Helpers/utilities.php";
require_once "../Filehandler/Ifilehandler.php";
require_once "../Filehandler/Jsonfhandler.php";
require_once "../database/context.php";
require_once "User.php";
require_once "UserService.php";

$utilities = new Utilities();
$message = "";
$message1 = "";

if(isset($_POST['codigo']) && isset($_POST['username'])){

    if($_POST['codigo'] == "0405"){

      $verificar = $utilities->Verificar($_POST['username'],"../database");

      if($verificar == true){

        $utilities->Actualizar($_POST['username'],"../database");

        header("Location: login.php");
        exit();

      }else{
        $message1 = "Nombre de usuario incorrecto";
      }

    }else{
        $message = "Codigo incorrecto!";
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
    <title>Verificacion</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">

<link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../assets/css/login.css" rel="stylesheet" type="text/css">
  </head>
  <body class="text-center">

    <form class="form-signin" action="verify.php" method="POST">

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

  <label for="username" class="sr-only">Nombre de usuario</label>
  <input type="text" id="username" class="form-control" placeholder="Nombre de usuario" name="username" required>

  <label for="codigo" class="sr-only">Codigo de verificacion</label>
  <input type="number" id="codigo" class="form-control" placeholder="Codigo de verificacion" name="codigo" required>
  

  <button class="btn btn-lg btn-primary btn-block" type="submit">Verificar codigo</button>
  <p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p>
</form>
</body>
</html>