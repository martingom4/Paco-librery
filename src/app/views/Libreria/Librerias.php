<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librerías</title>
    <link rel="shortcut icon" href="../images/LOGO.PNG" alt="logo">
    <link rel="stylesheet" href="/css/visualizar.css">
    <!-- Fuente Nunito de Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <!-- Fuente Playwrite England SemiJoined de Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+GB+S:wght@100..400&display=swap" rel="stylesheet">
    <!-- Iconos de Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <header>
        <h1 class="titulo" style="margin-left: 20px;">Librerías</h1>
    </header>
    <main class="main-content">
        <div class="container">
            <?php if (isset($_SESSION['mensaje'])): ?>
                <p><?= htmlspecialchars($_SESSION['mensaje']) ?></p>
                <?php unset($_SESSION['mensaje']); ?>
            <?php endif; ?>
            <div class="tabla-container">
                <div style="margin-bottom: 20px;">
                    <a href="/libreria/registrar" class="btn registrar">Registrar Librería</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Corregimiento</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($librerias)): ?>
                            <?php foreach ($librerias as $libreria): ?>
                                <tr>
                                    <td><?= htmlspecialchars($libreria['ID_libreria']); ?></td>
                                    <td><?= htmlspecialchars($libreria['nom_lib']); ?></td>
                                    <td><?= htmlspecialchars($libreria['corregimiento']); ?></td>
                                    <td><?= htmlspecialchars($libreria['calle'] . ' ' . $libreria['num_loc']); ?></td>
                                    <td><?= htmlspecialchars($libreria['telefono'] ?? 'No disponible'); ?></td>
                                    <td><?= htmlspecialchars($libreria['correo'] ?? 'No disponible'); ?></td>
                                    <td>
                                        <a class="btn actualizar" href="/libreria/detalles/<?= htmlspecialchars($libreria['ID_libreria']); ?>"><i class="fas fa-eye"></i> Ver Detalles</a>
                                        <a class="btn actualizar" href="/libreria/actualizar/<?= htmlspecialchars($libreria['ID_libreria']); ?>"><i class="fas fa-edit"></i> Actualizar</a>
                                        <form method="POST" action="/libreria/eliminar" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta librería?');" style="display:inline; margin:0;">
                                            <input type="hidden" name="id_libreria" value="<?= htmlspecialchars($libreria['ID_libreria']); ?>">
                                            <button type="submit" class="btn eliminar"><i class="fas fa-trash-alt"></i> Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7">No hay librerías por el momento.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <?php include 'includes/footer.php'; ?>
    <script src="../scripts/home.js"></script>
</body>
</html>
