<?php

session_start();

if(isset($_SESSION['user'])){

    if(isset($_SESSION['user']) == null){

        $_SESSION['messageAuth'] = "Debe iniciar sesion";
        header("Location: user/login.php");
        exit();

    }

}else{
    $_SESSION['messageAuth'] = "Debe iniciar sesion";
    header("Location: user/login.php"); 
    exit();
}

?>