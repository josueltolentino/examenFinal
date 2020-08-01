<?php

require_once 'Helpers/authIndex.php';
require_once 'service/post.php';
require_once 'service/IServiceBase.php';
require_once 'FIlehandler/Ifilehandler.php';
require_once 'FIlehandler/Jsonfhandler.php';
require_once 'database/context.php';
require_once 'service/PserviceDB.php';
require_once 'user/User.php';




$service= New PserviceDB("../database");
$PE= new Post();

if(isset($_SESSION['user']) && $_SESSION['user']!=null){
  
  $usuario = json_decode($_SESSION['user']);
  $listPE=$service->Getlist($usuario->username);
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
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <link href="assets/css/index.css" rel="stylesheet">

  </head>

  <body>

    <div class="container">
      <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-4 text-center">
            <a class="blog-header-logo text-dark" href="#">Fenix </a>
          </div>
          <div class="col-4 d-flex justify-content-end align-items-center">
              <?php if(isset($_SESSION['user']) && $_SESSION['user'] != null): ?>
            <a class="btn btn-sm btn-outline-secondary" href="user/logout.php">Cerrar sesion</a>
              <?php else: ?>
            <a class="btn btn-sm btn-outline-secondary" href="user/login.php">Iniciar sesion</a>
              <?php endif; ?>
          </div>
          <li><?php 
          $user =json_decode($_SESSION['user']);
          echo $user->username 
          ?></li>
        </div>
      </header>
      <?php if(!isset($_SESSION['user']) || $_SESSION['user'] == null): ?>
        <div class="album py-5">
       <div class="container">
        <h2>Debe iniciar sesion</h2>
      </div>
      </div>
     <?php else: ?>
      <div class="nav-scroller py-1 mb-2">
      <a class="btn btn-primary" href="post/post.php">Publicar</a>
      </div>


        <?php if(empty($listPE)): ?>
        <div class="album py-5">
       <div class="container">

            <h2>No hay Publicaciones </h2>
        </div>
      </div>
        <?php else: ?>
        <div class="row mb-2">
        <div class="col-md-6">
        
            <?php foreach($listPE as $Post) :?>
                <div class="card flex-md-row mb-4 box-shadow h-md-250">
                <div class="card-body d-flex flex-column align-items-start">
                <div class="mb-1 text-muted"><?php echo $Post->fecha; ?></div>
              <h3 class="mb-0"><?php echo $Post->titulo; ?></h3>
              <p class="card-text mb-auto"><?php echo $Post->contenido; ?></p>
              <a href="post/postDelete.php?id= <?php echo $Post->id; ?>">Borrar</a> 
              <a href="post/postEdit.php?id=<?php echo $Post->id; ?>">Editar</a>
              </div>
              </div>
            <?php endforeach ;?>
            
          
        </div>
        </div>
        <?php endif; ?>

    </div>
    <?php endif; ?>
    <footer class="blog-footer">
      <p>Fenix &copy; 2017-2020</p>
      <p>
        <a href="#">Back to top</a>
      </p>
    </footer>
  </body>
</html>