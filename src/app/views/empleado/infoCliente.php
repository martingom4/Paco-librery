<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información de Clientes</title>
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
        <h1 class="titulo" style="margin-left: 20px;">Información de Clientes</h1>
    </header>
    <main class="main-content">
        <div class="container">
            <div class="tabla-container">
                <div style="margin-bottom: 20px;">
                    <a href="clientes/registrar" class="btn registrar">Registrar Cliente</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($clientes)): ?>
                            <?php foreach ($clientes as $cliente): ?>
                                <tr>
                                    <td><?= htmlspecialchars($cliente['ID_cliente'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($cliente['nombre'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($cliente['apellido'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($cliente['correo'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($cliente['telefono'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td>
                                        <a class="btn actualizar" href="/empleados/cliente-actualizar/<?= htmlspecialchars($cliente['ID_cliente'], ENT_QUOTES, 'UTF-8') ?>"><i class="fas fa-edit"></i> Actualizar</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">No hay clientes registrados.</td>
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
