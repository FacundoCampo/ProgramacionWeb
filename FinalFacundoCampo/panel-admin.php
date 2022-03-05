<?php 
$title = 'panel';
session_start();
if(!isset($_SESSION['idPerfil']) || $_SESSION['idPerfil'] != '1'){
    header('Location:index.php');
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

    <section class="bienvenida bienvenida-admin">
        <div class="contenedor">
            <h1>Bienvenid@ al panel de administración del sitio</h1>
            <p>Usted podra gestionar obras y carteleras desde este sistema</p>
        </div>
    </section>

    <section class="abm py-4">

        <div class="contenedor">
            <div class="fila d-flex justify-beetwen">
                <div class="columna">
                    <h2 class="titulo-seccion">Obras</h2>
                    <a class="link-nuevo" href="obras.php">ABM Obras</a> 
                    <!-- Me manda a obras.php para agregar nuevas obras -->
                </div>
                <div class="columna">
                    <h2 class="titulo-seccion">Categorías</h2>
                    <a class="link-nuevo" href="categorias.php">ABM Categorías</a>
                    <!-- Me manda a categorias.php para agregar nuevas categorias -->
                </div>
            </div>
        </div>
    </section>
    <?php include('includes/footer.php'); ?>

</body>

</html>