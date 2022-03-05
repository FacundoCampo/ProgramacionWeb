<?php
$nombre = $_REQUEST['nombre'];
$precio = $_REQUEST['precio'];
$idEstado = $_REQUEST['estado'];
$fecha = $_REQUEST['fecha'];
$hora = $_REQUEST['hora'];
$idCategoria = $_REQUEST['idCategoria'];
$descripcion = $_REQUEST['descripcion'];
$idObra = $_REQUEST['idObra'];


if(empty($nombre) || empty($precio) || empty($idCategoria) || empty($descripcion)){
    $notificacion = 'Error: Debe completar todos los campos';
    $error = true;
}else{
    include_once('../includes/conexion.php');

     // crear una sentencia preparada 
			$stmt = $conexion->prepare("UPDATE obras SET idCategoria = ?,nombre = ?,descripcion = ?,precio = ?,fecha = ?,hora = ?, activa = ? WHERE idObra = ?");
			// ligar parámetros para marcadores 
			$stmt->bind_param('ssssssss', $idCategoria,$nombre,$descripcion,$precio,$fecha,$hora,$idEstado,$idObra);
			// ejecutar la consulta 
			$stmt->execute();
			
			// obtener la cantidad de filas afectadas en la inserción 
			$filasAfectadas = $stmt->affected_rows;

			if($filasAfectadas > 0){
				$notificacion = 'Éxito: La obra se modifico correctamente';
                $error = false;
			}else{
				$notificacion = "Error: Ha ocurrido un problema al intentar modificar la obra. Debe cambiar almenos un campo";
                $error = true;
			}
}

$arrayRespuesta = ['notificacion' => $notificacion,'error'=>$error];

echo json_encode($arrayRespuesta);


?>