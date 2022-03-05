<?php
$tarjeta = $_REQUEST['tarjeta'];
$cantidad = $_REQUEST['cantidad'];
$idUser = $_REQUEST['idUser'];
$idObra = $_REQUEST['idObra'];
$total = $_REQUEST['total'];


if(empty($tarjeta) || empty($cantidad) || empty($idUser) || empty($idObra) || empty($total) ){
    $notificacion = 'Error: Debe completar todos los campos';
    $error = true;
}else{
    include_once('../includes/conexion.php');
     // crear una sentencia preparada 
			$stmt = $conexion->prepare("INSERT INTO ventas(cantidad,total, tarjeta, idUsuario, idObra) VALUES (?, ?, ?, ?, ?)");
			// ligar parámetros para marcadores 
			$stmt->bind_param('sssss', $cantidad,$total,$tarjeta,$idUser,$idObra);
			// ejecutar la consulta 
			$stmt->execute();
			
			// obtener la cantidad de filas afectadas en la inserción 
			$filasAfectadas = $stmt->affected_rows;

			if($filasAfectadas > 0){
				$notificacion = 'Éxito: Su compra ha sido procesada con éxito.';
                $error = false;
			}else{
				$notificacion = "Error: Ha ocurrido un problema al intentar registar su compra.";
                $error = true;
                echo $conexion->error;
			}
}

$arrayRespuesta = ['notificacion' => $notificacion,'error'=>$error];

echo json_encode($arrayRespuesta);


?>