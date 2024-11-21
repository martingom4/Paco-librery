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
            <a href="../pages/catalogo.html" class="volver">Volver</a>
        </div>

        <div class="producto-detalle">
            <div class="imagen">
                <img src="../images/<?= htmlspecialchars($Libro['imagen']) ?>" alt="Imagen del producto">
            </div>
            <div class="informacion">
                <h1><?= htmlspecialchars($Libro['nombre']) ?></h1> <!-- Nombre del libro -->
                <form action="comprar.php" method="POST">
                    <div class="input-group">
                        <label for="precio">Precio:</label>
                        <span><?= htmlspecialchars($Libro['precio']) ?> USD</span>
                    </div>
                    <div class="input-group">
                        <label for="sucursal">Sucursal donde retira</label>
                        <select id="sucursal" name="sucursal">
                            <option value="sucursal1">Panamá</option>
                            <option value="sucursal2">Arraiján</option>
                            <option value="sucursal3">Chiriquí</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label for="cantidad">Cantidad</label>
                        <input type="number" id="cantidad" name="cantidad" min="1" value="1">
                    </div>
                    <input type="hidden" name="producto_id" value="<?= htmlspecialchars($producto['id']) ?>">
                    <button type="submit">Comprar</button>
                </form>
            </div>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
    <script src="../scripts/home.js"></script>
</body>
</html>
