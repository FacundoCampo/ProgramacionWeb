<?php 
$title = 'home';
session_start();
if(!isset($_SESSION['idUser'])){
    header('Location:index.php');
}
include_once('includes/conexion.php');

if(isset($_GET['id']) && !empty($_GET['id'])){
    //Me agarra los datos de la obra para imprimirlo al lado del formulario de compra 
    $idObra = $_GET['id'];
    $consulta = $conexion->prepare("SELECT * FROM obras WHERE idObra = ?");
    $consulta->bind_param('s',$idObra);
    $consulta->execute();
    $resultado = $consulta->get_result();
    $obra = $resultado->fetch_assoc();
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ICONOS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&family=Roboto:wght@400;700&display=swap"
        rel="stylesheet">

    <!-- ESTILOS PERSONALIZADOS  -->
    <link rel="stylesheet" href="css/style.css">

    <title>Souco Theater</title>
</head>

<body>

    <?php include('includes/nav.php'); ?>


    <!-- NOTIFICACION -->
    <div class="notificacion d-none" id="notificacionContenedor">
        <p class="msg" id="notificacion"></p>
    </div>

    <section class="login compra">
        <div class="contenedor">
            <h2 class="titulo-seccion">Finalizando su compra</h2>
            <div class="fila d-flex">

                <div class="obra-compra"> <!-- info de obra que me traje con el id -->
                    <h3>Obra</h3>
                    <div class="form-group">
                        <img src="img/<?php echo $obra['img'] ?>" class="img-width" alt="">
                    </div>
                        <?php 
                        $hora = substr($obra['hora'],0,5);
                        echo '
                            <h3>'.$obra['nombre'].'</h3>
                            <p>Precio: $'.$obra['precio'].'</p>
                            <p>'.$obra['fecha'].'</p>
                            <p>'.$hora.'hs.</p>
                            <p>'.$obra['descripcion'].'</p>
                                ';
                    ?>
                   
                </div>

                <form action="#" id="formCompra">
                    <h3>Datos cliente</h3>
                    <input type="hidden" id="idObra" value="<?php echo (isset($idObra)) ? $idObra : '' ?>">
                    <input type="hidden" id="idCliente" value="<?php echo $_SESSION['idUser'] ?>">
                    <div class="form-group">
                        <label for="inputNombre">Nombre</label>
                        <input type="text" name="nombre" id="inputNombre" value="<?php echo $_SESSION['nombre'] ?>"
                            required disabled>
                    </div>

                    <div class="form-group">
                        <label for="inputCorreo">Correo</label>
                        <input type="email" name="mail" id="inputCorreo" value="<?php echo $_SESSION['correo'] ?>"
                            disabled required>
                    </div>

                    <div class="form-group">
                        <label for="inputCantidad">Cantidad de tickets</label>
                        <input type="number" name="tarjeta" id="inputCantidad" min='1' value='1' required>
                    </div>

                    <div class="form-group">
                        <label for="inputTarjeta">Nº de tarjeta</label>
                        <input type="numeric" name="tarjeta" id="inputTarjeta" required>
                    </div>
                        <!-- con un js pude hacer que se multiplique el precio de la obra por los lugares -->
                        <p id="precioObra" class="d-none"><?php echo $obra['precio'] ?></p> 
                        <p><b>Subtotal:</b> $<span id="subtotal"><?php echo $obra['precio'] ?></span></p>
                    <div class="botonera">
                        <button type="submit" class="btn-registro" id="btnComprar">Finalizar compra</button>
                        <!-- Mando toda la informacion a compra.js para poder validar los datos -->
                    </div>
                </form>

            </div>
        </div>
    </section>

    <?php include('includes/footer.php'); ?>
    <script src="js/validaciones.js"></script>
    <script src="js/compra.js"></script>
</body>

</html>