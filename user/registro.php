<?php

require_once '../service/post.php';
require_once '../user/UserService.php';
require_once '../service/IServiceBase.php';
require_once '../FIlehandler/Ifilehandler.php';
require_once '../FIlehandler/Jsonfhandler.php';
require_once '../database/context.php';
require_once '../service/PserviceDB.php';
require_once 'User.php';


$utilities = new Utilities();
$service= New UserService("../database");
$message = "";
$message1 = "";


if( isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['correo']) && isset($_POST['username'])
&& isset($_POST['contrasena']) ){

  $verificar = $utilities->Verificar($_POST['username'],"../database");

  if($verificar==true){
    $message = "El nombre de usuario que a elegido no esta disponible";
  }else{

  $PE= new User();
  $PE->InitData(0,$_POST['username'],$_POST['contrasena'],$_POST['nombre'],$_POST['apellido'],$_POST['correo'],1);
  $service->add($PE);
  
  $subject = "Fenix";
  $messege = "Estimad@ ". $_POST['username'] ." su codigo de activacion es 0405 para activar su cuanta debe de hacer click en el link
  que se encuentra abajo e introducir su codigo de activacion y nombre de usuario, si no puede hacer click en el link, favor copiarlo y 
  pegarlo en su navegador.

   http://localhost/examenFinal/user/verify.php";
        
   mail($_POST['correo'],$subject,$messege);
   $message1 = "Se ha eviando un email al correo proporcionado para verificar su cuenta"; 
  }

}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Fenix</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/blog/">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <link href="../assets/css/index.css" rel="stylesheet">

  </head>

  <body>

    <div class="container">
      <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-4 text-center">
            <a class="blog-header-logo text-dark" href="../index.php">Fenix </a>
          </div>
        </div>
      </header>
      

      <div class="nav-scroller py-1 mb-2">
      </div>

  <?php if($message!=""): ?>
  <div class="alert alert-danger" role="alert">
      <?= $message ?>
  </div>
  <?php endif; ?>

  <?php if($message1!=""): ?>
  <div class="alert alert-primary" role="alert">
      <?= $message1 ?>
  </div>
  <?php endif; ?>

 <h2 class="re" >Registrarse</h2>
<form enctype="multipart/form-data"  action="registro.php" method="POST">
    <div class="forma card bg-white">
        

    <label for="foto">Foto de perfil</label>
    <input type="file" name="foto"  id="foto">

    <div class="py-2">
    </div>

      <label for="nombre">Nombre</label>
      <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">

      <div class="py-2">
    </div>

    <label for="apellido">Apellido</label>
    <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido">

    <div class="py-2">
    </div>

    <label for="correo">Correo</label>
      <input type="text" class="form-control" id="correo" name="correo" placeholder="Correo">

      <div class="py-2">
    </div>

    <label for="username">Nombre de usuario</label>
    <input type="text" class="form-control" id="username" name="username" placeholder="Nombre de usuario">

    <div class="py-2">
    </div>

    <label for="contrasena">Contraseña</label>
    <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Contraseña">

    <div class="py-2">
    </div>

    <div class="nav-scroller py-1 mb-2">
    <button type="submit" class="btn btn-primary" id="sendForm">Registrarse</button>
 </div>

 <a href="login.php">Volver atras</a>

    </div>

  <div class="nav-scroller py-1 mb-2">
 </div>

</form>
        



    <footer class="blog-footer">
      <p>Blog template built for by</p>
      <p>
        <a href="#">Back to top</a>
      </p>
    </footer>
  </body>
</html>