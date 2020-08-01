<?php

class User{

    public $id;
    public $username;
    public $contrasena;
    public $nombre;
    public $apellido;
    public $correo;
    public $foto;
    public $status;

    public function __construct(){

    }
    
    public function InitData($id,$username,$contrasena,$nombre,$apellido,$correo,$status){
    
        $this->id=$id;
        $this->username=$username;
        $this->contrasena=$contrasena;
        $this->nombre=$nombre; 
        $this->apellido=$apellido;
        $this->correo=$correo;
        $this->status=$status;
    
    }

}

?>