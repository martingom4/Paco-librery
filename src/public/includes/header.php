<?php
session_start();
//detectar sesion para determinar pefil
$perfilCliente= isset($_SESSION['cliente_id']) && isset($_SESSION['email']);
//aqui debe ir  los parametros de la sesion de admin admin_id  email
?>
<link rel="stylesheet" href="/css/header_footerEmpleado.css">
<body>
    <header>
        <!--LOGO Y REDES-->
        <div class="LogoRedes">
            <div class="logo">
                <img src="../images/LOGO.png" alt="Librerí­a ¡Donde Paco!">
            </div>
        </div>

        <div class="Menu">
<<<<<<< HEAD
            <!--HEADER PARA VISITANTE-->
            <?php if (!$perfilCliente && !$perfilAdmin): ?>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/catalogo">Catálogo</a></li>
                    <li><a href="/sobrenosotros">Sobre Nosotros</a></li>
                    <li><a href="/contacto">Contacto</a></li>
                </ul>
=======
            <ul>
                <li><a href="/home.php">Home</a></li>
                <li><a href="Inventario.html">Inventario</a></li>
                <li><a href="HistorialVentas.html">Ventas</a></li>
                <li><a href="/Librerias.php">Registros</a></li>
                <li><a href="sobrenosotros.html">Sobre Nosotros</a></li>
                <li><a href="sucursal.html">Contacto</a></li>
            </ul>
>>>>>>> c166dff234933cf0ad470393e7eeb3ece783c567
            <div class="Usuario">
                <a href="/perfiles"><img src="../images/Usuario.png" alt="Usuario"></a>
                <a href="/perfiles">Iniciar Sesión</a>
            </div>

            <!--HEADER PARA EMPLEADO-->
            <?php elseif ($perfilAdmin): ?>
                <ul>
                    <li><a href="/home.php">Home</a></li>
                    <li><a href="/inventario">Inventario</a></li>
                    <li><a href="HistorialVentas.html">Ventas</a></li>
                    <li><a href="/sobrenosotros">Sobre Nosotros</a></li>
                    <li><a href="/contacto">Contacto</a></li>
                </ul>
                <div class="Usuario">
                    <a href="PerfilEmpleado.html"><img src="../images/Usuario.png" alt="Usuario"></a>
                    <a href="PerfilEmpleado.html">Mi cuenta</a>
                </div>

            <!--HEADER PARA CLIENTE-->
            <?php elseif ($perfilCliente): ?>
                <ul>
                    <li><a href="/perfil">¿Qué buscas hoy?, <?php echo htmlspecialchars($_SESSION['nombre']); ?></a></li>
                    <li><a href="/home.php">Home</a></li>
                    <li><a href="/catalogo">Catálogo</a></li>
                    <li><a href="/sobrenosotros">Sobre Nosotros</a></li>
                    <li><a href="/contacto">Contacto</a></li>
                </ul>
                <div class="Usuario">
                    <a href="/cliente/perfil"><img src="../images/Usuario.png" alt="Usuario"></a>
                    <a href="/cliente/perfil">Mi cuenta</a>
                </div>
            <?php endif; ?>
        </div>
    </header>
</body>
