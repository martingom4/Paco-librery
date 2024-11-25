<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Datos de Libro</title>
    <!--Documentos CSS utilizados-->
    <link rel="stylesheet" href="../css/registroLibroStyle.css">
    <link rel="shortcut icon" href="../images/LOGO.PNG" alt="logo">

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

<main>
        <div class="registro-container">
            <div class="registro-box">
                <h2>Editar Datos de Libro</h2>
                <hr>

                <?php if (isset($error)): ?>
                    <p style="color: red;"><?php echo $error; ?></p>
                <?php endif; ?>

                <!--<div class="mensaje-exito">
                    <h2>REGISTRO EXITOSO</h2>
                    <p>Su registro se ha completado exitosamente.</p>
                    <a href="home.html">Volver a la página principal</a>
                </div>-->

                <form action="/inventario/editarLibro" method="POST">
                    <div class="input-group">
                        <input type="text" placeholder="ISBN libro" name="isbn" required>
                        <input type="text" placeholder="Nombre" name="nombre" required>
                    </div>
                    <div class="input-group">
                        <input type="text" placeholder="Titulo" name="titulo" required>
                        <input type="text" placeholder="Edicion" name="edicion" required>                        
                    </div>
                    <div class="input-group">
                        <input type="number" placeholder="Precio" name="precio" required>
                        <input type="number" placeholder="ID Librería" name="id_libreria" required>                        
                    </div>
                    <div class="input-group">
                        <input type="number" placeholder="ID de editorial" name="id_edit" required>
                        <input type="number" placeholder="ID Autor" name="id_autor" required>
                    </div>
                    <div class="input-group">
                        <input type="number" placeholder="Cantidad" name="cantidad" required>
                        <input type="text" placeholder="Enlace de foto de libro" name="imagen" required>
                    </div>
                    <div class="input-group">
                        <input type="date" placeholder="Fecha de Publicacion" name="fecha_publi" id="last_input" required>
                        <input type="number" placeholder="ID de genero" name="id_genero" required>
                    </div>
                    <button type="submit" class="btn">Confirmar</button>
                </form>

            </div>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html>