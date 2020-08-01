<?php

interface IServiceBase{
    public function GetbyId($id);
    public function Getlist($username);
    public function add($entity);
    public function update($id,$entity);
    public function delete($id);
    
}


?>