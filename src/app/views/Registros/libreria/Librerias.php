<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librerías</title>
    <link rel="shortcut icon" href="../images/LOGO.PNG" alt="logo">
    <!-- Documentos CSS utilizados -->
    <link rel="stylesheet" href="../css/libreria.css"> 
    <!-- Fuente Nunito de Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    

    <main>
        <div class="main-content">
            <section class="library-list">
                <h1>Librerías</h1>
                <section class="action-buttons">
                    <button class="btn-action" onclick="window.location.href='/registrarLibrerias'">Registrar Librería</button>
                </section>
                <hr>

                <div id="lista-librerias">
                    <!-- Mostrar tabla de librerías -->
                    <?php if (!empty($librerias)): ?>
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
                                <?php foreach ($librerias as $libreria): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($libreria['ID_libreria']); ?></td>
                                        <td><?= htmlspecialchars($libreria['nom_lib']); ?></td>
                                        <td><?= htmlspecialchars($libreria['corregimiento']); ?></td>
                                        <td><?= htmlspecialchars($libreria['calle'] . ' ' . $libreria['num_loc']); ?></td>
                                        <td><?= htmlspecialchars($libreria['telefono'] ?? 'No disponible'); ?></td>
                                        <td><?= htmlspecialchars($libreria['correo'] ?? 'No disponible'); ?></td>
                                        <td>
                                            <div class="action-buttons-group">
                                                <a class="btn-action" href="/detallesLibrerias/<?= htmlspecialchars($libreria['ID_libreria']); ?>">Ver Detalles</a>
                                                <button class="btn-action" onclick="window.location.href='/formularioActualizar/<?= htmlspecialchars($libreria['ID_libreria']); ?>'">Actualizar</button>
                                                <!-- Nuevo formulario para eliminar -->
                                                <form method="POST" action="/libreria/eliminar" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta librería?');" style="display:inline; margin:0;">
                                                    <input type="hidden" name="id_libreria" value="<?= htmlspecialchars($libreria['ID_libreria']); ?>">
                                                    <button type="submit" class="btn-action" style="display:inline-block;">Eliminar</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>No hay librerías por el momento.</p>
                    <?php endif; ?>
                </div>
            </section>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
    <script src="../scripts/home.js"></script>
</body>
</html>
