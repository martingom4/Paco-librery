<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprar</title>
    <link rel="shortcut icon" href="../images/LOGO.PNG" alt="logo">
    <!--Documentos CSS utilizados-->
    <link rel="stylesheet" href="../css/comprar.css">
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
    <?php include 'includes/header.php'; ?>

    <main>
        <div class="header-volver">
            <a href="/catalogo" class="volver">Volver</a>
        </div>

        <div class="producto-detalle">
            <div class="imagen">
                <img src="../images/<?= htmlspecialchars($Libro['imagen']) ?>" alt="Imagen del producto">
            </div>
            <div class="informacion">
                <h1><?= htmlspecialchars($Libro['nombre']) ?></h1> <!-- Nombre del libro -->
                <form method="POST" action="/carrito/agregar">
                    <div class="input-group">
                        <label for="precio">Precio:</label>
                        <span><?= htmlspecialchars($Libro['precio']) ?> USD</span>
                    </div>

                    <div class="quantity-wrapper">
                                    <button type="button" class="quantity-btn minus">-</button>
                                    <input type="number" name="cantidad" id="input-number" min="1" value="1" class="quantity-input">
                                    <button type="button" class="quantity-btn plus">+</button>
                                </div>
                    <input type="hidden" name="isbn" value="<?= htmlspecialchars($Libro['ISBN']) ?>">
                    <button type="submit">Agregar al Carrito</button>
                </form>
            </div>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
    <script src="../scripts/catalogo.js"></script>
</body>
</html>
