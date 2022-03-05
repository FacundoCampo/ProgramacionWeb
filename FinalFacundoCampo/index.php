<?php 
session_start();
if(isset($_SESSION['idUser'])){
    header('Location:home.php');
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
<header class="encabezado">
        <div class="contenedor">
            <div class="logo"> <!-- Pulso la imagen del teatro para ir al index -->
                <a href="index.php"><img src="img/logo.jpg" alt="logo-sitio" class="img-width"></a>
            </div>
        </div>
</header>

    <!-- NOTIFICACION -->
    <div class="notificacion d-none" id="notificacionContenedor">
        <p class="msg" id="notificacion"></p>
    </div>

    <section class="login">

        <div class="contenedor">
            <!-- Cuando le doy a ingresar los datos me los pasa al login.js para validarlos, 
            luego de ahí los pasa a login.php que es el encargado de cheequear la info con la base -->
            <form action="#" id="formLogin">
                <h1 class="text-center">Inicio de sesión</h1>
                <div class="form-group">
                    <label for="inputCorreo">Correo</label>
                    <input type="email" name="mail" id="inputCorreo" required>
                </div>

                <div class="form-group">
                    <label for="inputPass">Contraseña</label>
                    <input type="password" name="pass" id="inputPass" required>
                </div>

                <div class="botonera">
                    <button type="submit" class="btn-login">Ingresar</button>
                    <a href="registro.php" class="btn-registro">Registro</a>
                </div>

            </form>
        </div>
    </section>



    <?php include('includes/footer.php'); ?>
    <script src="js/validaciones.js"></script>
    <script src="js/login.js"></script>
</body>

</html>