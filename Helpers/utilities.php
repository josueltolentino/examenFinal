<?php

require_once '../service/IServiceBase.php';
require_once '../FIlehandler/Ifilehandler.php';
require_once '../FIlehandler/Jsonfhandler.php';
require_once '../database/context.php';
require_once '../service/PserviceDB.php';

class Utilities{

    private $context;
    

    public function Verificar($username,$directory){

        $this->context= new context($directory);
        $stmt=$this->context->db->prepare("Select * from user where username=?");
        $stmt->bind_param("s",$username);
        $stmt->execute();
        $result=$stmt->get_result(); 

        if($result->num_rows > 0){
            return true;
        }else{
            return false;
        }
  
    }

    public function Status($username,$directory){
        
        $this->context= new context($directory);
        $stmt=$this->context->db->prepare("Select * from user where username=?");
        $stmt->bind_param("s",$username);
        $stmt->execute();
        $result=$stmt->get_result(); 
        $re = $result->fetch_object();

        if($re->status == 2){
            return true;
        }else{
            return false;
        }

    }

    public function Actualizar($username,$directory){
        $num = 2;
        $this->context= new context($directory);
        $stmt=$this->context->db->prepare("update user set status = ? where username = ?");
        $stmt->bind_param("is",$num,$username);
        $stmt->execute();
        $stmt->close();
  
    }
    

    public function uploadImage($directory,$name,$tmpFile,$type,$size){

        $isSuccess = false;

        if( ($type == "image/gif") 
         || ($type == "image/jpeg") 
         || ($type == "image/jpg") 
         || ($type == "image/JPG") 
         || ($type == "image/pjpeg") && ($size < 1000000) ){

            if(!file_exists($directory)){

                mkdir($directory,0777,true);

                if(!file_exists($directory)){

                    $this->uploadFile($directory . $name, $tmpFile);

                    $isSuccess = true;
                }

            }else{

                    $this->uploadFile($directory .$name,$tmpFile);
                    $isSuccess = true;
            }

            

        }else{
            $isSuccess = false;
        }

        return $isSuccess;

    }

    private function uploadFile($name,$tmpFile){

        if(file_exists($name)){
            unlink($name);
            }

            move_uploaded_file($tmpFile,$name);
       
    }
}

?>