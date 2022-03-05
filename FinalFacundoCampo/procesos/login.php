<?php
$correo = $_REQUEST['correo'];
$pass = $_REQUEST['pass'];

if(empty($correo) || empty($pass)){
    $notificacion = 'Error: Debe completar todos los campos';
    $error = true;
}else{
    include_once('../includes/conexion.php');
     // crear una sentencia preparada 
     $consulta = $conexion->prepare("SELECT * FROM usuarios WHERE email = ?");
     // ligar parámetros para marcadores 
     $consulta->bind_param('s', $correo);
     // ejecutar la consulta 
     $consulta->execute();

     // OBTENER RESULTADOS
     $resultado = $consulta->get_result();

     if($resultado->num_rows > 0){

         // crear una sentencia preparada 
         $consulta = $conexion->prepare("SELECT * FROM usuarios WHERE email = ? AND password = ?");
         // ligar parámetros para marcadores 
         $consulta->bind_param('ss', $correo, $pass);
         // ejecutar la consulta 
         $consulta->execute();

         // OBTENER RESULTADOS
         $resultado = $consulta->get_result();

         $fila = $resultado->fetch_assoc();

         if($resultado->num_rows > 0){ 
             //De esta manera puedo dejar la sesion abierta hasta que la cierro
             session_start();

             $_SESSION['idUser'] = $fila['idUsuario'];
             $_SESSION['nombre'] = $fila['nombre'];
             $_SESSION['correo'] = $fila['email'];
             $_SESSION['idPerfil'] = $fila['idPerfil'];

             $error=false;
             $notificacion= 'Ingreso exitoso.';

         }else{
             $notificacion = "Error: La contraseña ingresada es incorrecta.";
             $error=true;
         }

     }else{
            $error=true;
            $notificacion = "Error: El usuario ingresado no existe en la base de datos.";
     }

    
}

$arrayRespuesta = ['notificacion' => $notificacion,'error'=>$error];

echo json_encode($arrayRespuesta);

?>