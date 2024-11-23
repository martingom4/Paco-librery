<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cátalogo</title>
    <link rel="shortcut icon" href="../images/LOGO.PNG" alt="logo">
    <!--Documentos CSS utilizados-->
    <link rel="stylesheet" href="/css/catalogo.css">
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
        <div class="main-content">
            <aside class="filter-section">
                <h3>Filtrar</h3>
                <form method="post" action="catalogo.jsp">
                    <div class="filter-group">
                        <label for="autor">Por autor</label>
                        <input type="text" id="autor" name="autor" title="Escriba el Autor" placeholder="Gabriel García Márquez">
                    </div>
                    <div class="filter-group">
                        <label for="editorial">Por editorial</label>
                        <select id="editorial" name="editorial">
                            <option value="" selected>Seleccione una editorial</option>
                            <option value="Oceano">Oceano</option>
                            <option value="Sudamericana">Sudamericana</option>
                            <option value="Universitaria">Universitaria</option>
                        </select>
                    </div>
                    <button type="submit" class="btn-filtrar">Filtrar</button>
                </form>
            </aside>
            <section class="catalog-section">
                <?php foreach ($catalogo as $libro): ?>
                    <div class="product-card">
                        <img src="../images/<?= htmlspecialchars($libro['imagen']) ?>" alt="Imagen del producto">
                        <h4>
                            <a href="/comprar/<?= htmlspecialchars($libro['ISBN']) ?>">
                                <?= htmlspecialchars($libro['nombre']) ?>
                            </a>
                        </h4>
                        <p>Precio: <?= htmlspecialchars($libro['precio']) ?> USD</p>
                        <form method="POST" action="/carrito/agregar" class="cart-form">
                            <input type="hidden" name="isbn" value="<?= htmlspecialchars($libro['ISBN']) ?>">
                            <div class="quantity-container">
                                <label id="cantidad">Cantidad:</label>
                                <div class="quantity-wrapper">
                                    <button type="button" class="quantity-btn minus">-</button>
                                    <input type="number" name="cantidad" id="input-number" min="1" value="1" class="quantity-input">
                                    <button type="button" class="quantity-btn plus">+</button>
                                </div>

                            </div>
                            <button type="submit" class="add-to-cart-btn">Añadir al carrito</button>
                        </form>

                    </div>
                <?php endforeach; ?>
            </section>
        </div>
    </main>
    <script src="scripts/catalogo.js"></script>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
