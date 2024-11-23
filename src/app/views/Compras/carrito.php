<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="shortcut icon" href="../images/LOGO.PNG" alt="logo">
    <link rel="stylesheet" href="/css/carrito.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <section class="carrito-contenedor">
        <h2 class="carrito-titulo" aria-label="Carrito de Compras">Tu Carrito de Compras</h2>
        <table class="carrito-tabla">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="carrito-items">
                <?php if (empty($carrito)): ?>
                    <tr id="empty-message">
                        <td colspan="5" style="text-align: center;">Tu carrito está vacío.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($carrito as $item): ?>
                        <tr>
                            <td><span><?= htmlspecialchars($item['titulo']) ?></span></td>
                            <td><span><?= htmlspecialchars($item['precio']) ?></span></td>
                            <td>
                                <form method="POST" action="/carrito/actualizar-cantidad">
                                    <input type="number" name="cantidad" value="<?= htmlspecialchars($item['cantidad']) ?>" min="1">
                                    <input type="hidden" name="isbn" value="<?= htmlspecialchars($item['ISBN']) ?>">
                                    <button type="submit">Actualizar</button>
                                </form>
                            </td>
                            <td><span><?= htmlspecialchars($item['precio'] * $item['cantidad']) ?></span></td>
                            <td>
                                <form method="POST" action="/carrito/eliminar">
                                    <input type="hidden" name="isbn" value="<?= htmlspecialchars($item['ISBN']) ?>">
                                    <button type="submit">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="carrito-total">
            <p>Total: <span id="total-amount">
                <?php
                $total = 0;
                foreach ($carrito as $item) {
                    $total += $item['precio'] * $item['cantidad'];
                }
                echo htmlspecialchars($total);
                ?>
            </span> USD</p>
            <form method="GET" action="/carrito/factura">
                <button id="checkout-button" class="btn-finalizar" <?= empty($carrito) ? 'disabled' : '' ?> aria-label="Finalizar la compra">Finalizar Compra</button>
            </form>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
