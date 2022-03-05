<?php
$nombre = $_REQUEST['nombre'];
$precio = $_REQUEST['precio'];
$imagen = $_REQUEST['imagen'];
$fecha = $_REQUEST['fecha'];
$hora = $_REQUEST['hora'];
$idCategoria = $_REQUEST['idCategoria'];
$descripcion = $_REQUEST['descripcion'];


if(empty($nombre) || empty($precio) || empty($imagen) || empty($idCategoria) || empty($descripcion)){
    $notificacion = 'Error: Debe completar todos los campos';
    $error = true;
}else{
    include_once('../includes/conexion.php');
     // crear una sentencia preparada 
			$stmt = $conexion->prepare("INSERT INTO obras (idCategoria,nombre, descripcion, precio, img, fecha,hora, activa) VALUES (?, ?, ?, ?, ?, ?, ?,'1')");
			// ligar parámetros para marcadores 
			$stmt->bind_param('sssssss', $idCategoria,$nombre,$descripcion,$precio,$imagen,$fecha,$hora);
			// ejecutar la consulta 
			$stmt->execute();
			
			// obtener la cantidad de filas afectadas en la inserción 
			$filasAfectadas = $stmt->affected_rows;

			if($filasAfectadas > 0){
				$notificacion = 'Éxito: La obra se registro correctamente';
                $error = false;
			}else{
				$notificacion = "Error: Ha ocurrido un problema al intentar registar la obra.";
                $error = true;
			}
}

$arrayRespuesta = ['notificacion' => $notificacion,'error'=>$error];

echo json_encode($arrayRespuesta);


?>