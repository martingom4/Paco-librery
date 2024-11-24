<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Cliente</title>
    <link rel="shortcut icon" href="../images/LOGO.PNG" alt="logo">
    <link rel="stylesheet" href="/css/registro.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <main>
        <div class="registro-container">
            <div class="registro-box">
                <h2>Actualizar Cliente</h2>
                    <form action="/actualizar" method="POST">
                        <input type="hidden" name="cliente_id" value="<?= $cliente['ID_cliente'] ?>">
                        <div>
                            <label for="nombre">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($cliente['nombre']) ?>" required>
                        </div>
                        <div>
                            <label for="apellido">Apellido:</label>
                            <input type="text" id="apellido" name="apellido" value="<?= htmlspecialchars($cliente['apellido']) ?>" required>
                        </div>
                        <div>
                            <label for="telefono">Teléfono:</label>
                            <input type="text" id="telefono" name="telefono" value="<?= htmlspecialchars($cliente['telefono']) ?>" required>
                        </div>
                        <div>
                            <label for="correo">Correo:</label>
                            <input type="email" id="correo" name="correo" value="<?= htmlspecialchars($cliente['correo']) ?>" required>
                        </div>
                        <button type="submit">Actualizar</button>
                    </form>
            </div>
        </div>
    </main>
    <?php include 'includes/footer.php'; ?>
</body>
</html>