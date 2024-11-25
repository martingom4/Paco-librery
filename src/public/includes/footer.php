<?php
session_start();
//detectar sesion para determinar pefil
$perfilCliente= isset($_SESSION['cliente_id']) && isset($_SESSION['email']);
//aqui debe ir  los parametros de la sesion de admin admin_id  email
$perfilAdmin= isset($_SESSION['admin_id']) && isset($_SESSION['correo']);
?>
<link rel="stylesheet" href="/css/header_footerEmpleado.css">
<body>
    <footer>
        <!--MENU-->
        <div class="Menu-footer">
            <!--HEADER PARA VISITANTE-->
            <?php if (!$perfilCliente && !$perfilAdmin): ?>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/sobrenosotros">Sobre Nosotros</a></li>
                    <li><a href="/contacto">Contacto</a></li>
                </ul>
                <div class="Usuario-footer">
                    <a href="/perfiles"><img src="../images/Usuario.png" alt="Usuario"></a>
                    <a href="/perfiles">Iniciar Sesión</a>
                </div>

            <!--FOOTER PARA EMPLEADO-->
            <?php elseif ($perfilAdmin): ?>
                <ul>
                    <li><a href="/home.php">Home</a></li>
                    <li><a href="/inventario">Inventario</a></li>
                    <li><a href="/sobrenosotros">Sobre Nosotros</a></li>
                    <li><a href="/contacto">Contacto</a></li>
                </ul>
                <div class="Usuario-footer">
                    <a href="/admin/perfil"><img src="../images/Usuario.png" alt="Usuario"></a>
                    <a href="/admin/perfil">Mi cuenta</a>
                </div>
                <ul>
                    <li><a href="/admin/cerrarSesion">Cerrar Sesión</a></li>
                </ul>

            <!--FOOTER PARA CLIENTE-->
            <?php elseif ($perfilCliente): ?>
                <ul>
                    <li><a href="/home.php">Home</a></li>
                    <li><a href="/catalogo">Catálogo</a></li>
                    <li><a href="/sobrenosotros">Sobre Nosotros</a></li>
                    <li><a href="/contacto">Contacto</a></li>
                </ul>
                <div class="Usuario-footer">
                    <a href="/cliente/perfil"><img src="../images/Usuario.png" alt="Usuario"></a>
                    <a href="/cliente/perfil">Mi cuenta</a>
                </div>
                <ul>
                    <li><a href="/logout">Cerrar Sesión</a></li>
                </ul>
            <?php endif; ?>
        </div>
        <!--COPYRIGHT-->
        <div class="Copyright">
            <p>© 2024, Libreria ¡Donde Paco!</p>
        </div>
    </footer>
</body>
