<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editoriales</title>
    <link rel="shortcut icon" href="../images/LOGO.PNG" alt="logo">
    <link rel="stylesheet" href="/css/visualizar.css">
    <!-- Fuente Nunito de Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <!-- Iconos de Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <header>
        <h1 class="titulo" style="margin-left: 20px;">Editoriales</h1>
    </header>
    <main class="main-content">
        <div class="container">
            <div class="tabla-container">
                <div style="margin-bottom: 20px;">
                    <a href="editorial/registrar" class="btn registrar">Registrar Editorial</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Corregimiento</th>
                            <th>Calle</th>
                            <th>Número de local</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($editorial)): ?>
                            <?php foreach ($editorial as $data): ?>
                                <tr>
                                    <td><?= htmlspecialchars($data['nombre'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($data['corregimiento'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($data['calle'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($data['num_loc'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($data['telefono'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($data['correo'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td>
                                        <form action="/editorial/eliminar" method="POST" style="display:inline;">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($data['ID_editorial'], ENT_QUOTES, 'UTF-8') ?>">
                                            <button type="submit" class="btn eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar a <?= htmlspecialchars($data['nombre'], ENT_QUOTES, 'UTF-8') ?>?')"><i class="fas fa-trash-alt"></i> Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7">No hay editoriales registradas.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <?php include 'includes/footer.php'; ?>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
