<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Librería</title>
    <link rel="shortcut icon" href="../images/LOGO.PNG" alt="logo">
    <!-- Enlace a los estilos CSS -->
    <link rel="stylesheet" href="../css/formulariosLibreria.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+GB+S:wght@100..400&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main>
        <form method="POST" action="/formularioActualizar">
        <h1>Actualizar Librería</h1>
            <input type="hidden" name="id_libreria" value="<?= htmlspecialchars($libreria['ID_libreria']) ?>">

            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($libreria['nom_lib']) ?>" required>
            </div>

            <div class="form-group">
                <label for="corregimiento">Corregimiento:</label>
                <input type="text" id="corregimiento" name="corregimiento" value="<?= htmlspecialchars($libreria['corregimiento']) ?>" required>
            </div>

            <div class="form-group">
                <label for="calle">Calle:</label>
                <input type="text" id="calle" name="calle" value="<?= htmlspecialchars($libreria['calle']) ?>" required>
            </div>

            <div class="form-group">
                <label for="num_loc">Número de Local:</label>
                <input type="text" id="num_loc" name="num_loc" value="<?= htmlspecialchars($libreria['num_loc']) ?>" required>
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" value="<?= htmlspecialchars($libreria['telefono']) ?>">
            </div>

            <div class="form-group">
                <label for="correo">Correo:</label>
                <input type="email" id="correo" name="correo" value="<?= htmlspecialchars($libreria['correo']) ?>">
            </div>

            <button type="submit" class="btn">Actualizar</button>
        </form>
    </main>

    <?php include 'includes/footer.php'; ?>
    <script src="../scripts/home.js"></script>
</body>
</html>
