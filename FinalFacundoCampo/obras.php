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

            <h2 class="titulo-seccion">Obras</h2>
            <a class="link-nuevo" href="#" id="btnNuevaObra">Nueva Obra</a>

            <!-- NOTIFICACION -->

            <div class="notificacion d-none" id="notificacionContenedor">
                <p class="msg" id="notificacion"></p>
            </div>

            <form action="#" id="formObras">
                <div class="form-group">
                    <label for="inputNombre" class="d-block">Nombre</label>
                    <input type="text" name="nombre" id="inputNombre" required>
                </div>
                <div class="form-group">
                    <label for="inputPrecio" class="d-block">Precio</label>
                    <input type="numeric" name="precio" id="inputPrecio" required>
                </div>
                <div class="form-group">
                    <label for="inputImagen" class="d-block">Nombre de la imagen</label>
                    <input type="text" name="imagen" id="inputImagen" required>
                </div>
                <div class="form-group">
                    <label for="inputFecha" class="d-block">Días de programación</label>
                    <input type="text" name="fecha" id="inputFecha" required>
                </div>
                <div class="form-group">
                    <label for="inputIHora" class="d-block">Hora</label>
                    <input type="time" name="hora" id="inputHora" required>
                </div>
                <div class="form-group">
                    <label for="selectCategoria" class="d-block">Categoria</label>
                    <select name="categoria" id="selectCategoria" required>
                        <?php
                                while ($fila = $categorias->fetch_assoc()) {
                                    echo '
                                    <option value="'.$fila['idCategoria'].'">'.$fila['nombre'].'</option>
                                    ';
                                }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="inputDescripcion" class="d-block">Descripción</label>
                    <textarea name="descripcion" id="inputDescripcion" rows="5" required></textarea>
                </div>
                <button type="submit">Guardar</button>
                <button type="reset">Cancelar</button>
            </form>

            <h2 class="titulo-seccion text-center">Listado Obras</h2>
            <div class="listado" id='listadoObras'>
              
            </div>
        </div>
    </section>

    <?php include('includes/footer.php'); ?>
    <script src="js/validaciones.js"></script>
    <script src="js/obras.js"></script>
</body>

</html>