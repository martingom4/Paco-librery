<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Librería</title>
    <link rel="shortcut icon" href="../images/LOGO.PNG" alt="logo">
    <link rel="stylesheet" href="/css/registro.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main>
        <div class="registro-container">
            <div class="registro-box">
                <h2>Registrar Librería</h2>
                <form action="/editorial/registrar" method="POST">
                    <div class="form-group">
                        <label for="nom_lib">Nombre:</label>
                        <input type="text" id="nom_lib" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="corregimiento">Corregimiento:</label>
                        <input type="text" id="corregimiento" name="corregimiento" required>
                    </div>
                    <div class="form-group">
                        <label for="calle">Calle:</label>
                        <input type="text" id="calle" name="calle" required>
                    </div>
                    <div class="form-group">
                        <label for="num_loc">Número de Local:</label>
                        <input type="text" id="num_loc" name="num_loc" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <input type="text" id="telefono" name="telefono" required>
                    </div>
                    <div class="form-group">
                        <label for="correo">Correo:</label>
                        <input type="email" id="correo" name="correo" required>
                    </div>
                    <button type="submit" class="btn">Registrar</button>
                </form>
            </div>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
