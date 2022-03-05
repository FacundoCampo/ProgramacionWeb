<?php

session_start();

unset($_SESSION['idUser'] );
unset($_SESSION['correo']);
unset($_SESSION['idPerfil']);

session_destroy();

header('location:index.php');

?>