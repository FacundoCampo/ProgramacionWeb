<?php
$nombre = $_REQUEST['nombre'];
$idCategoria = $_REQUEST['idCategoria'];

if(empty($nombre)){
    $notificacion = 'Error: Debe completar todos los campos';
    $error = true;
}else{
    include_once('../includes/conexion.php');

     // crear una sentencia preparada 
			$stmt = $conexion->prepare("UPDATE categoria SET nombre = ? WHERE idCategoria = ?");
			// ligar parámetros para marcadores 
			$stmt->bind_param('ss', $nombre,$idCategoria);
			// ejecutar la consulta 
			$stmt->execute();
			
			// obtener la cantidad de filas afectadas en la inserción 
			$filasAfectadas = $stmt->affected_rows;

			if($filasAfectadas > 0){
				$notificacion = 'Éxito: La categoria se modifico correctamente';
                $error = false;
			}else{
				$notificacion = "Error: Ha ocurrido un problema al intentar modificar la categoria. Debe cambiar almenos un campo";
                $error = true;
			}
}

$arrayRespuesta = ['notificacion' => $notificacion,'error'=>$error];

echo json_encode($arrayRespuesta);