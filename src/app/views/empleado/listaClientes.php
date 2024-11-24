<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editoriales</title>
    <link rel="shortcut icon" href="../images/LOGO.PNG" alt="logo">
    <!-- Documentos CSS utilizados -->
    <link rel="stylesheet" href="/css/editorial.css">
    <!-- Fuente Nunito de Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <main>
        <!-- Contenedor de la tabla -->
        <div class="tabla-container">
            <div class="editorial-header">
                <p>Clientes</p>

            <?php if (!empty($clienteExistente)): ?>
                <table class="editorial-table">
                    <thead>
                        <tr>
                            <th>ID Cliente</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Contraseña</th>
                            <th>Telefono</th>
                            <th>Correo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($clienteExistente as $data): ?>
                        <tr>
                            <td><?= htmlspecialchars($data['ID_cliente']) ?></td>
                            <td><?= htmlspecialchars($data['nombre']) ?></td>
                            <td><?= htmlspecialchars($data['apellido']) ?></td>
                            <td><?= htmlspecialchars($data['contrasena']) ?></td>
                            <td><?= htmlspecialchars($data['telefono']) ?></td>
                            <td><?= htmlspecialchars($data['correo']) ?></td>
                            <td>
                                <form action="/formsActualizar" method="POST">
                                    <input type="hidden" name="cliente_id" value="<?= $data['ID_cliente'] ?>">
                                    <button type="submit" class="btn-registrar">Actualizar</button>

                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
                <p>No hay clientes registrados.</p>
            <?php endif; ?>
        </div>
    </main>
<?php include 'includes/footer.php'; ?>
</body>
</html>