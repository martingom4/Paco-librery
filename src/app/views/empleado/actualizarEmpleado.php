<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Empleado</title>
    <link rel="stylesheet" href="/css/registroLibroStyle.css">
    <link rel="shortcut icon" href="../images/LOGO.PNG" alt="logo">
    <!-- Fuente Nunito de Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <!-- Fuente Playwrite England SemiJoined de Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+GB+S:wght@100..400&display=swap" rel="stylesheet">
</head>
<body>

<main>
    <div class="registro-container">
        <div class="registro-box">
            <h2>Actualizar Empleado</h2>
            <hr>
            <form action="/empleados/actualizar" method="POST">
                <input type="hidden" name="id" value="<?= htmlspecialchars($empleado['ID_empleado']) ?>">
                <div class="input-group">
                    <input type="email" placeholder="Correo" id="correo" name="correo" value="<?= htmlspecialchars($empleado['correo']) ?>" required>
                    <input type="text" placeholder="Teléfono" id="telefono" name="telefono" value="<?= htmlspecialchars($empleado['telefono']) ?>" required>
                </div>
                <div class="input-group">
                    <input type="password" placeholder="Contraseña" id="contrasena" name="contrasena">
                    <input type="number" placeholder="Sueldo" id="sueldo" name="sueldo" value="<?= htmlspecialchars($empleado['sueldo']) ?>" required>
                </div>
                <button type="submit" class="btn">Actualizar</button>
            </form>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
</body>
</html>
