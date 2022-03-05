<?php 
$title = 'mis-tickets';
session_start();
if(!isset($_SESSION['idUser'])){
    header('Location:index.php');
}
include_once('includes/conexion.php');

// LISTADO DE OBRAS PARA ARMAR CARTELERA
// consulto la informacion de la base de datos y lo imprimo en la pagina
$consulta = $conexion->prepare("SELECT * FROM ventas INNER JOIN obras ON obras.idObra = ventas.idObra WHERE idUsuario = ? ORDER BY ventas.idVenta");
$consulta->bind_param('s',$_SESSION['idUser']);
$consulta->execute();
$tickets = $consulta->get_result();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ICONOS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <!-- ESTILOS PERSONALIZADOS  -->
    <link rel="stylesheet" href="css/style.css">

    <title>Souco Theater</title>
</head>
<body>
    
    <?php include('includes/nav.php'); ?>

    <section class="bienvenida">
        <div class="contenedor">
            <h1>Mis tickets</h1>
            <p>A través de la siguiente sección podra visualizar sus tickets adquiridos</p>
        </div>
    </section>

    <section class="listado-cartelera-home">
        <div class="contenedor">
            <h2 class="titulo-seccion">Cartelera</h2>
            <div class="fila">

                <?php 
                
                while ($fila = $tickets->fetch_assoc()) { //Muestro las obras compradas
                    $hora = substr($fila['hora'],0,5);
                    echo '
                                <div class="columna">
                                    <img src="img/'.$fila['img'].'"  alt="" class="img-width">
                                    <h3>'.$fila['nombre'].'</h3>
                                    <p>Cantidad disponibles: '.$fila['cantidad'].'</p>
                                    
                                    <p>Programación:<br>'.$fila['fecha'].'</p>
                                    <p>'.$hora.'hs.</p>
                                    <p>'.$fila['descripcion'].'</p>
                                </div>
                        ';
                }
                
                ?>
                
            </div>
        </div>
    </section>

  <?php include('includes/footer.php'); ?>
    
</body>
</html>