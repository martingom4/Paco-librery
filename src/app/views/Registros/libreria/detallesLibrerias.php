<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Librería</title>
    <link rel="shortcut icon" href="../images/LOGO.PNG" alt="logo">
    <!-- Documentos CSS utilizados -->
    <link rel="stylesheet" href="../css/formulariosLibreria.css">
    <!-- Fuente Nunito de Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <!-- Fuente Playwrite England SemiJoined de Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+GB+S:wght@100..400&display=swap" rel="stylesheet">
</head>
<body>

    <main>
        <div class="main-content">
            <section class="library-details">
                <h1>Detalles de la Librería</h1>
                <hr>
                <?php if ($libreria): ?>
                    <ul>
                        <li><strong>ID:</strong> <?= htmlspecialchars($libreria['ID_libreria']) ?></li>
                        <li><strong>Nombre:</strong> <?= htmlspecialchars($libreria['nom_lib']) ?></li>
                        <li><strong>Corregimiento:</strong> <?= htmlspecialchars($libreria['corregimiento']) ?></li>
                        <li><strong>Calle:</strong> <?= htmlspecialchars($libreria['calle']) ?></li>
                        <li><strong>Número de Local:</strong> <?= htmlspecialchars($libreria['num_loc']) ?></li>
                        <li><strong>Teléfono:</strong> <?= htmlspecialchars($libreria['telefono'] ?? 'No disponible') ?></li>
                        <li><strong>Correo:</strong> <?= htmlspecialchars($libreria['correo'] ?? 'No disponible') ?></li>
                    </ul>
                <?php else: ?>
                    <p>Librería no encontrada.</p>
                <?php endif; ?>
                
                <button class="btn-action" onclick="window.location.href='/Librerias.php'">Regresar</button>
            </section>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
    <script src="../scripts/home.js"></script>
</body>
</html>
