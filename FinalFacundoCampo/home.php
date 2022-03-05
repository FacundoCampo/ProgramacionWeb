<?php 
$title = 'home';
session_start();
if(!isset($_SESSION['idUser'])){ //Me fioj si esta la sesion abierta para mostrar la pagina
    header('Location:index.php'); // sino lo manda al index 
}
include_once('includes/conexion.php');





// SELECCIONAR CATEGORIAS PARA RELLENAR EL SELECT
// OBTENER CATEGORIAS PARA RELLENAR EL SELECT
$consulta = $conexion->prepare("SELECT * FROM categoria ORDER BY nombre");
$consulta->execute();
$categorias = $consulta->get_result();

// LISTADO DE OBRAS PARA ARMAR CARTELERA
if(isset($_GET['filtro']) && !empty($_GET['filtro'])){
    
    $filtro = $_GET['filtro'];
    $consulta = $conexion->prepare("SELECT * FROM obras WHERE activa = 1 AND idCategoria = ? ORDER BY nombre");
    $consulta->bind_param('s',$filtro);
    $consulta->execute();
    $cartelera = $consulta->get_result();
}else{ //Pregunto a la base de datos sobre las obras activas y me las muestra
    $consulta = $conexion->prepare("SELECT * FROM obras WHERE activa = 1 ORDER BY nombre");
    $consulta->execute();
    $cartelera = $consulta->get_result();
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

    <section class="bienvenida">
        <div class="contenedor">
            <h1>Bienvenidos a nuestro teatro</h1>
            <p>A través de nuestra web vas a poder conocer nuestras carteleras</p>
            <p>Adquiri tus tickets!</p>
        </div>
    </section>

    <section class="listado-cartelera-home">
        <div class="contenedor">
            <h2 class="titulo-seccion" style="color:#000;">Cartelera</h2>
            <div>
                <form action="home.php" method='get' class="form-filtrar">
                    <!-- Filtro para las obras -->
                    <label for="selectCategoria" class="d-block">Categoria</label>
                    <select name="filtro" id="selectCategoria">
                        <option value="" selected>Todas las obras</option>
                        <?php
                        // MUESTRO LAS CATEGORIAS A TRAVES DEL SELECT
                                while ($fila = $categorias->fetch_assoc()) {
                                    // Busco que obra tiene el mismo id de categoria para imprimirla
                                    if(isset($filtro) && $fila['idCategoria'] == $filtro){
                                        echo '
                                        <option value="'.$fila['idCategoria'].'" selected>'.$fila['nombre'].'</option>
                                        ';
                                    }else{
                                        echo '
                                        <option value="'.$fila['idCategoria'].'">'.$fila['nombre'].'</option>
                                        ';
                                    }
                                   
                                }
                        ?>
                    </select>
                    <button type="submit">Filtrar</button>
                </form>
            </div>
            <div class="fila">

                <?php 
                //ARMADO DE LA CARTELERA
                while ($fila = $cartelera->fetch_assoc()) { 
                    //Voy fila por fila imprimiendo la informacion que me dio la base de datos
                    $hora = substr($fila['hora'],0,5);
                    echo '
                                <div class="columna">
                                    <img src="img/'.$fila['img'].'"  alt="" class="img-width">
                                    <h3>'.$fila['nombre'].'</h3>
                                    <p>Precio: $'.$fila['precio'].'</p>
                                    <p>'.$fila['fecha'].'</p>
                                    <p>'.$hora.'hs.</p>
                                    <p>'.$fila['descripcion'].'</p>
                                    <a href="compra.php?id='.$fila['idObra'].'" class="btn-ver">Comprar entrada</a>
                                </div>
                        '; //Cuando le doy al boton de compra, me lleva a compra.php y le manda el id de la obra
                }
                
                ?>

            </div>
        </div>
    </section>

    <?php include('includes/footer.php'); ?>

</body>

</html>