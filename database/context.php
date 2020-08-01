<?php


class context{
    public $db;
    private $filehandler;

    function __construct($directory)
    {   
        $this->filehandler = new Jsonfhandler($directory,"configuration");
        $configuration= $this->filehandler->ReadConfiguration();
        $this->db=new mysqli("127.0.0.1","root","","examenfinal");
        if($this->db->connect_error){
            exit('Fallo la coneccion a la Base de Datos');

    
    }
}

}



?>