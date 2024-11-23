<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="shortcut icon" href="../images/LOGO.PNG" alt="logo">
    <!--Documentos CSS utilizados-->
    <link rel="stylesheet" href="/css/login.css">
    <!---Fuente Nunito de Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <!---Fuente Playwrite England SemiJoined de Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+GB+S:wght@100..400&display=swap" rel="stylesheet">
</head>
<body>
    <jsp:include page="header.jsp" />

    <main>
        <div class="login-contenedor">
            <div class="login">
                <h2>Inicio de sesión</h2>
                <hr>
                <form action="logincliente.jsp" method="post">
                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="input-group">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <button type="submit">Acceder</button>
                </form>
                <div class="registrar">
                    <p>¿No tienes cuenta? <a href="registrocliente1.jsp">registrate aquí</a></p>
                </div>
            </div>
        </div>
    </main>

     <jsp:include page="footer.jsp" />
    <script src="../scripts/home.js"></script>
</body>
</html>
