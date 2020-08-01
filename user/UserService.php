<?php

require_once "../Helpers/utilities.php";

class UserService{

    private $utilities;
    private $context;
  

    public function __construct($directory){

        $this->context = new context($directory);
        $this->utilities = new Utilities;

    }

    

    public function Login($username,$contrasena){

        $stmt = $this->context->db->prepare("select * from user where username = ? and contrasena = ?");
        $stmt->bind_param("ss",$username,$contrasena);
        $result = $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows === 0){
            return null;
        }else{
            $user = new User;

            while($row = $result->fetch_object()){

                $user->id = $row->id;
                $user->foto = $row->foto;
                $user->username = $row->username;
                $user->contrasena = $row->contrasena;
                $user->nombre = $row->nombre;
                $user->apellido = $row->apellido;
                $user->correo = $row->correo; 
                $user->status = $row->status;

            }

            $stmt->close();
            return $user;
        }
    }

    public function add($entity){

        $stmt=$this->context->db->prepare("insert into user (username,contrasena,nombre,apellido,correo,status) Values(?,?,?,?,?,?)");
        $stmt->bind_param("sssssi",$entity->username,$entity->contrasena,$entity->nombre,$entity->apellido,$entity->correo,$entity->status);
        $stmt->execute();
        $stmt->close();

        
        $Id = $this->context->db->insert_id;

        if(isset($_FILES['foto'])){

            $foto = $_FILES['foto'];

            if($foto['error'] == 4){ 

                $entity->foto = "";

            }else{

                $typereplace = str_replace("image/","",$_FILES['foto']['type']);
                $type = $foto['type'];
                $size = $foto['size'];
                $name = $Id . '.' . $typereplace;
                $tmpname =  $foto['tmp_name'];
    
                $success = $this->utilities->uploadImage('../assets/img/usuarios/', $name, $tmpname, $type, $size); 
    
                if($success){
    
                    $stmt = $this->context->db->prepare("update user set foto = ? where id = ?");
                    $stmt->bind_param("si",$name,$Id);
                    $stmt->execute();
                    $stmt->close();
                }
            }
        }

        
    }

}

?>