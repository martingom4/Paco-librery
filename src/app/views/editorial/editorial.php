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
    <?php include 'includes/header.php'; ?>

    <main>


        <!-- Contenedor de la tabla -->
        <div class="tabla-container">
            <div class="editorial-header">
                <p>Editoriales</p>
                <form action="/editorial/agregar" method="GET">
                <button type="submit" class="btn-registrar">Registrar Editorial</button>
                </form>
            </div>

            <table class="editorial-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Corregimiento</th>
                        <th>Calle</th>
                        <th>Numero de local</th>
                        <th>Telefono</th>
                        <th>Correo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($editorial as $data): ?>
                        <tr>

                            <td><?= htmlspecialchars($data['nombre']) ?></td>
                            <td><?= htmlspecialchars($data['corregimiento']) ?></td>
                            <td><?= htmlspecialchars($data['calle']) ?></td>
                            <td><?= htmlspecialchars($data['num_loc']) ?></td>
                            <td><?= htmlspecialchars($data['telefono']) ?></td>
                            <td><?= htmlspecialchars($data['correo']) ?></td>
                            <td>
                                <form action="/editorial/eliminar" method="POST">
                                    <input type="hidden" name="id" value="<?= $data['ID_editorial'] ?>">
                                    <button type="submit" class="btn-registrar">Eliminar</button>

                                </form>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
