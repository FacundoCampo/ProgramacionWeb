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


    <!-- NOTIFICACION -->
    <div class="notificacion d-none" id="notificacionContenedor">
            <p class="msg" id="notificacion"></p>
        </div>

    <section class="login">

        <div class="contenedor">
            <!-- Muestro el mismo form pero para el registro -->
            <form action="#" id="formRegistro"> 
                <!-- Mando los datos al registro.js para validar los datos -->
                <h1 class="text-center">Registro</h1>
                <div class="form-group">
                    <label for="inputNombre">Nombre</label>
                    <input type="text" name="nombre" id="inputNombre" required>
                </div>

                <div class="form-group">
                    <label for="inputCorreo">Correo</label>
                    <input type="email" name="mail" id="inputCorreo" required>
                </div>
                <div class="form-group">
                    <label for="inputPass">Contraseña</label>
                    <input type="password" name="password" id="inputPass" required>
                </div>
                <div class="form-group">
                    <label for="inputPassConfirm">Repita su contraseña</label>
                    <input type="password" name="password2" id="inputPassConfirm" required>
                </div>


                <div class="botonera">
                    <button type="submit" class="btn-registro">Registrarme</button>
                    <a href="index.php" class="btn-login">Ingresar</a>
                </div>
            </form>
        </div>
    </section>



    <?php include('includes/footer.php'); ?>
    <script src="js/validaciones.js"></script>
    <script src="js/registro.js"></script>
</body>

</html>