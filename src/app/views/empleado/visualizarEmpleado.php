<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Empleado</title>
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
        <h1 class="titulo" style="margin-left: 20px;">Empleados Registrados</h1>
    </header>
    <main class="main-content">
        <div class="container">
            <div class="tabla-container">
                <div style="margin-bottom: 20px;">
                    <a href="empleados/registrar" class="btn registrar">Registrar Empleado</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Correo</th>
                            <th>Sueldo</th>
                            <th>Id libreria</th>
                            <th>Cargo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($empleados)): ?>
                            <?php foreach ($empleados as $row): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['ID_empleado'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($row['nombre'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($row['apellido'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($row['correo'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($row['sueldo'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($row['ID_libreria_e'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($row['cargo'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td>
                                        <a class="btn actualizar" href="/empleados/actualizar/<?= htmlspecialchars($row['ID_empleado'], ENT_QUOTES, 'UTF-8') ?>"><i class="fas fa-edit"></i> Actualizar</a>
                                        <form action="/empleados/eliminar" method="POST" style="display:inline;">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($row['ID_empleado'], ENT_QUOTES, 'UTF-8') ?>">
                                            <button type="submit" class="btn eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar a <?= htmlspecialchars($row['nombre'], ENT_QUOTES, 'UTF-8') ?> <?= htmlspecialchars($row['apellido'], ENT_QUOTES, 'UTF-8') ?>?')"><i class="fas fa-trash-alt"></i> Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8">No hay empleados registrados.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <?php include 'includes/footer.php'; ?>
</body>
</html>



