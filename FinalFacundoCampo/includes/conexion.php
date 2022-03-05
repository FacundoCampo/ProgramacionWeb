<?php 
    try{
        
        $conexion = new mysqli('localhost','root','','finalweb');
        $conexion->set_charset("utf8");
        return $conexion;
    }
    catch (PDOException $e){
        die('ERROR:'. $e->getMessage());
    }

?>