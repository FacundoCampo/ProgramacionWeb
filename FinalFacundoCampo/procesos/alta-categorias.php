<?php
$nombre = $_REQUEST['nombre'];

if(empty($nombre)){
    $notificacion = 'Error: Debe completar todos los campos';
    $error = true;
}else{
    include_once('../includes/conexion.php');
    // crear una sentencia preparada 
           $stmt = $conexion->prepare("INSERT INTO categoria (nombre) VALUES (?)");
           // ligar parámetros para marcadores 
           $stmt->bind_param('s',$nombre);
           // ejecutar la consulta 
           $stmt->execute();
           
           // obtener la cantidad de filas afectadas en la inserción 
           $filasAfectadas = $stmt->affected_rows;

           if($filasAfectadas > 0){
               $notificacion = 'Éxito: La categoría se registro correctamente';
               $error = false;
           }else{
               $notificacion = "Error: Ha ocurrido un problema al intentar registar la categoría.";
               $error = true;
           }
}
$arrayRespuesta = ['notificacion' => $notificacion,'error'=>$error];

echo json_encode($arrayRespuesta);
?>