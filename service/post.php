<?php
class Post{

public $id;
public $titulo;
public $contenido;
public $fecha;
public $user;

public function __construct(){

}

public function InitData($id,$titulo,$contenido,$fecha,$user){

    $this->id=$id;
    $this->titulo=$titulo;
    $this->contenido=$contenido;
    $this->fecha=$fecha;
    $this->user=$user;


}


}


?>