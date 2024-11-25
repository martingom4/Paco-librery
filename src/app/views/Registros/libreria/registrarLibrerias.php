<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Librería</title>
    <link rel="shortcut icon" href="../images/LOGO.PNG" alt="logo">
    <link rel="stylesheet" href="../css/formulariosLibreria.css">
    <!-- Fuente Nunito de Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <!-- Fuente Playwrite England SemiJoined de Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+GB+S:wght@100..400&display=swap" rel="stylesheet">
</head>
<body>
    
    <main>
        <div class="main-content">
            <section class="form-section">
                <form action="/registrarLibrerias" method="POST" class="form-register">
                <h1>Registrar Librería</h1>
                <hr>
                    <label for="ID_libreria">ID Librería:</label>
                    <input type="text" name="id_libreria" id="ID_libreria" required>

                    <label for="nom_lib">Nombre:</label>
                    <input type="text" name="nom_lib" id="nom_lib" required>

                    <label for="corregimiento">Corregimiento:</label>
                    <input type="text" name="corregimiento" id="corregimiento" required>

                    <label for="calle">Calle:</label>
                    <input type="text" name="calle" id="calle" required>

                    <label for="num_loc">Número de Local:</label>
                    <input type="text" name="num_loc" id="num_loc">

                    <label for="telefono">Teléfono:</label>
                    <input type="text" name="telefono" id="telefono">

                    <label for="correo">Correo Electrónico:</label>
                    <input type="email" name="correo" id="correo">

                    <button type="submit" class="btn">Registrar</button>
                </form>
            </section>
        </div>
    </main>
    
    <?php include 'includes/footer.php'; ?>
</body>
</html>
