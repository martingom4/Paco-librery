<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Inventario</title>
    <!--Documentos CSS utilizados-->
    <link rel="stylesheet" href="../css/style_inventario.css">
    <link rel="shortcut icon" href="../images/LOGO.PNG" alt="logo">

    <!---Fuente Nunito de Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <!---Fuente Playwrite England SemiJoined de Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+GB+S:wght@100..400&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main>
        <!-- Contenedor para la consulta o registro -->
        <section id="Container-consulta">
            <div class="titulo-suc1">
                <h1>Gestión de Inventario</h1>
            </div>
            <form method="post" action="InventarioController.php?action=filter">
                <div class="Consulta-sucursal">
                    <div>
                        <label for="isbn">ISBN:</label>
                        <input type="number" id="isbn" name="isbn" placeholder="Ingrese el ISBN" required>
                    </div>
                    <div>
                        <label for="Sucursal">Sucursal:</label>
                        <select name="Sucursal" id="Sucursal" title="Seleccione una sucursal" required>
                            <option value="">Seleccione una sucursal</option>
                            <option value="Sucursal 1">Sucursal 1</option>
                            <option value="Sucursal 2">Sucursal 2</option>
                            <option value="Sucursal 3">Sucursal 3</option>
                        </select>
                    </div>
                    <div>
                        <input type="submit" value="Enviar Consulta" id="boton-enviar" style="margin-right: 10px">
                        <button type="submit" formaction="InventarioController.php?action=add" class="btn" id="boton-enviar">Registrar Libro</button>
                    </div>
                </div>
            </form>
        </section>

        <!-- Contenedor para la tabla de inventario -->
        <section class="Container-inventario">
            <div class="Inventario1">
                <table>
                    <thead>
                        <tr>
                            <th>ISBN</th>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Editorial</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productos as $producto): ?>
                            <tr>
                                <td><?= htmlspecialchars($producto['isbn']) ?></td>
                                <td><?= htmlspecialchars($producto['titulo']) ?></td>
                                <td><?= htmlspecialchars($producto['autor']) ?></td>
                                <td><?= htmlspecialchars($producto['editorial']) ?></td>
                                <td>$<?= htmlspecialchars($producto['precio']) ?></td>
                                <td><?= htmlspecialchars($producto['cantidad']) ?></td>
                                <td>
                                    <form method="post" action="InventarioController.php?action=delete" style="display:inline;">
                                        <input type="hidden" name="isbn" value="<?= htmlspecialchars($producto['isbn']) ?>">
                                        <button type="submit" class="btn-delete">Eliminar</button>
                                    </form>
                                    <form method="post" action="InventarioController.php?action=edit" style="display:inline;">
                                        <input type="hidden" name="isbn" value="<?= htmlspecialchars($producto['isbn']) ?>">
                                        <button type="submit" class="btn-edit">Editar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>


    <?php include 'includes/footer.php'; ?>
</body>
</html>
