<?php 
$title = 'panel';
session_start();
if(!isset($_SESSION['idPerfil']) || $_SESSION['idPerfil'] != '1'){
    header('Location:index.php');
}

include_once('includes/conexion.php');

// SELECCIONAR CATEGORIAS PARA RELLENAR EL SELECT
// OBTENER CATEGORIAS PARA RELLENAR EL SELECT
$consulta = $conexion->prepare("SELECT * FROM categoria ORDER BY nombre");
$consulta->execute();
$categorias = $consulta->get_result();
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
            <h1>ABM de Obras</h1>
            <p>Gestión de altas, bajas y modificaciones de las obras</p>
        </div>
    </section>

    <section class="abm py-4">
        <div class="contenedor">

            <h2 class="titulo-seccion">Categorías</h2>
            <a class="link-nuevo" href="#" id="btnNuevaCategoria">Nueva Categoría</a>

            <!-- NOTIFICACION -->

            <div class="notificacion d-none" id="notificacionContenedor">
                <p class="msg" id="notificacion"></p>
            </div>

            <form action="#" id="formCategorias">

                <div class="form-group">
                    <label for="inputNombre" class="d-block">Nombre</label>
                    <input type="text" name="nombre" id="inputNombre" required>
                </div>

                <button type="submit">Guardar</button>
                <button type="reset">Cancelar</button>
            </form>

            <h2 class="titulo-seccion text-center">Listado Categorias</h2>
            <div class="listado" id='listadoCategorias'>
              
            </div>
        </div>
    </section>

    <?php include('includes/footer.php'); ?>
    <script src="js/validaciones.js"></script>
    <script src="js/categorias.js"></script>
</body>

</html>