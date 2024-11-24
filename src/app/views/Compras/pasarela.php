<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasarela de Pago</title>
    <link rel="stylesheet" href="/css/pasarela.css">
    <link rel="shortcut icon" href="../images/LOGO.PNG" alt="logo">
    <!-- Fuente Nunito de Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="payment-gateway">
        <h1>Finalizar Compra</h1>
        <p>Total a pagar: <strong><?= htmlspecialchars($total) ?> USD</strong></p>
        <form id="payment-form" action="/procesar_pago" method="POST" aria-label="Formulario de pago">
            <div class="form-group">
                <label for="card-number">Número de Tarjeta</label>
                <input type="text" id="card-number" name="card_number" placeholder="1234 5678 9012 3456" required aria-required="true">
            </div>
            <div class="form-group">
                <label for="card-expiry">Fecha de Expiración</label>
                <input type="text" id="card-expiry" name="card_expiry" placeholder="MM/AA" required>
            </div>
            <div class="form-group">
                <label for="card-cvc">CVC</label>
                <input type="text" id="card-cvc" name="card_cvc" placeholder="123" required>
            </div>
            <div class="form-group">
                <label for="cardholder-name">Nombre del Titular</label>
                <input type="text" id="cardholder-name" name="cardholder_name" placeholder="Juan Pérez" required>
            </div>
            <button type="submit" class="btn-submit">Pagar</button>
        </form>
    </div>

    <?php include 'includes/footer.php'; ?>
    <script src="/scripts/pasarela.js"></script>
</body>
</html>
