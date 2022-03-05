<?php
$nombre = $_REQUEST['nombre'];
$correo = $_REQUEST['correo'];
$pass = $_REQUEST['pass'];
$passConfirm = $_REQUEST['passConfirm'];


if(empty($correo) || empty($pass) || empty($passConfirm) || empty($nombre) ){
	//Quiero todos los casilleros completos
    $notificacion = 'Error: Debe completar todos los campos';
    $error = true;
}else if($pass != $passConfirm){
	//chequeo que las contraseñas sean iguales
    $notificacion = 'Error: Las contraseñas no coinciden';
    $error = true;
}else{
    include_once('../includes/conexion.php');
    	// crear una sentencia preparada 
        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE email = ?");
        // ligar parámetros para marcadores 
        $stmt->bind_param('s', $correo);
        // ejecutar la consulta 
        $stmt->execute();

		/* OBTENER FILAS AFECTADAS A PARTIR DE UNA CONSULTA SELECT */
		$resultado = $stmt->get_result();
        if($conexion->affected_rows > 0){ //No puedo tener dos mails iguales
			$notificacion = 'Error: El mail ingresado ya existe en nuestra base de datos.';
            $error = true;
		}else{
            // crear una sentencia preparada 
			$stmt = $conexion->prepare("INSERT INTO usuarios (email,nombre, password, idPerfil) VALUES (?, ?, ?, '2')");
			// ligar parámetros para marcadores 
			$stmt->bind_param('sss', $correo,$nombre,$pass);
			// ejecutar la consulta 
			$stmt->execute();
			
			// obtener la cantidad de filas afectadas en la inserción 
			$filasAfectadas = $stmt->affected_rows;

			if($filasAfectadas > 0){ //Esto es para que si no agarra por lo menos una fila, hay problemas
				$notificacion = 'Éxito: Registro realizado éxitosamente';
                $error = false;
			}else{
				$notificacion = "Error: Ha ocurrido un problema al intentar registarse.";
                $error = true;
			}

            
        }
    
}

$arrayRespuesta = ['notificacion' => $notificacion,'error'=>$error];

echo json_encode($arrayRespuesta);

?>