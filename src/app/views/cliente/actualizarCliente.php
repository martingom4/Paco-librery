<?php 
     session_start();

     if (!isset($_SESSION['cliente_id'])) {
         header('Location: /cliente/login');
         exit;
     }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar</title>
    <link rel="shortcut icon" href="../images/LOGO.png" alt="logo">
    <link rel="stylesheet" href="/css/PerfilCliente.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+GB+S:wght@100..400&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="LogoRedes">
            <div class="logo">
                <img src="../images/LOGO.png" alt="Librería ¡Donde Paco!">
            </div>
            <div class="Redes">
                <ul>
                    <li><a href="https://www.instagram.com"><img src="../images/Instagram.png" alt="Instagram"></a></li>
                    <li><a href="https://www.facebook.com"><img src="../images/Facebook.png" alt="Facebook"></a></li>
                    <li><a href="https://www.google.com/webhp?hl=es&sa=X&ved=0ahUKEwjdofSloIGHAxVQmYQIHetICooQPAgI"><img src="../images/Buscar.png" alt="Buscar"></a></li>
                </ul>
            </div>
        </div>
        <div class="Menu">
            <ul>
                <li><a href="home.html">Home</a></li>
                <li><a href="catalogo.html">Catálogo</a></li>
                <li><a href="sobrenosotros.html">Sobre Nosotros</a></li>
                <li><a href="sucursal.html">Contacto</a></li>
            </ul>
            <div class="Usuario">
                <a href="PerfilCliente.jsp"><img src="../images/Usuario.png" alt="Usuario"></a>
                <a href="PerfilCliente.jsp">Mi cuenta</a>
            </div>
        </div>
    </header>

    <main>
        <section class="titulo">
            <h1>Actualizar mis datos</h1>
        </section>
        <section class="Container-infoper">
            <div class="campoizquierdo">
                <div class="fotoperfil">
                    <img src="../images/sinfotoperfil.png" alt="FotoPerfil" title="Foto de Perfil">
                </div>
            </div>
            <div class="infop">
                <form action="/cliente/actualizar" method="POST">
                    <input type="text" name="nombre" id="nombre" placeholder="Nuevo nombre" value="<?php echo htmlspecialchars($_SESSION['nombre']); ?>" required><br>
                    <input type="text" name="apellido" id="apellido" placeholder="Nuevo apellido" value="<?php echo htmlspecialchars($_SESSION['apellido']); ?>" required><br>
                    <input type="text" name="correo" id="correo" placeholder="Nuevo correo electrónico" value="<?php echo htmlspecialchars($_SESSION['email']); ?>" required><br>
                    <input type="text" name="telefono" id="telefono" placeholder="Nuevo teléfono" value="<?php echo htmlspecialchars($_SESSION['telefono']); ?>" required>
                    <br>
                    <button type="submit">Guardar Cambios</button>
                </form>
            </div>
        </section>
    </main>
    <jsp:include page="footer.jsp" />