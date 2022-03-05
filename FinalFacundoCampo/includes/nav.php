<header class="encabezado">
        <div class="contenedor">
            <div class="logo">
                <a href="index.php"><img src="img/logo.jpg" alt="logo-sitio" class="img-width"></a>
            </div>

            <nav class="nav-menu">
                <ul class="menu">
                    <li><a href="home.php" class="nav-link <?php echo ($title == 'home') ? 'nav-active' : '' ?>">Home</a></li>

                    <!-- Si es admin muestro el panel -->
                    <?php if(isset($_SESSION['idPerfil']) && $_SESSION['idPerfil'] == '1' ):  ?>
                    <li><a href="panel-admin.php" class="nav-link <?php echo ($title == 'panel') ? 'nav-active' : '' ?>">Panel</a></li>
                    <?php endif; ?>

                    
                    <li><a href="tickets-cliente.php" class="nav-link <?php echo ($title == 'mis-tickets') ? 'nav-active' : '' ?>">Mis tickets</a></li>
                    

                    <?php if(isset($_SESSION['idUser'])): ?>
                    <li><a href="cerrar-sesion.php" class="nav-link">Cerrar Sesión</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
</header>