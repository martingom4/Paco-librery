<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Cliente</title>
    <link rel="shortcut icon" href="../images/LOGO.png" alt="logo">
    <link rel="stylesheet" href="/css/registrocliente.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+GB+S:wght@100..400&display=swap" rel="stylesheet">
</head>
<body>
    <main>
        <div class="registro-container">
            <div class="registro-box">
                <h2>Registro de Cliente</h2>
                <hr>

                <?php if (isset($error)): ?>
                    <p style="color: red;"><?php echo $error; ?></p>
                <?php endif; ?>

                <!--<div class="mensaje-exito">
                    <h2>REGISTRO EXITOSO</h2>
                    <p>Su registro se ha completado exitosamente.</p>
                    <a href="home.html">Volver a la página principal</a>
                </div>-->

                <form action="/cliente/registro" method="POST">
                    <div class="input-group">
                        <input type="text" placeholder="Nombre" name="nombre" required>
                        <input type="text" placeholder="Apellido" name="apellido">
                    </div>
                    <div class="input-group">
                        <input type="text" placeholder="Correo Electrónico" name="correo" required>
                        <input type="password" placeholder="Contraseña" name="contrasena">
                    </div>
                    <input type="text" placeholder="Télefono" name="telefono" required>
                    <button type="submit" class="btn">Confirmar</button>
                </form>

            </div>
        </div>
    </main>
<?php include 'includes/footer.php';?>
</body>
</html>

