<?php include 'includes/header.php'; ?>
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
    <main>
        <!-- Contenedor para la consulta o registro -->
        <section id="Container-consulta">
            <div class="titulo-suc1">
                <h1>Gestión de Inventario</h1>
            </div>
            <div class="Control-sucursal">
                <form method="GET" action="/inventario/filtro">
                    <div class="Consulta-sucursal">
                        <div>
                            <label for="isbn">ISBN:</label>
                            <input type="number" id="isbn" name="isbn" placeholder="Ingrese el ISBN">
                        </div>
                        <div>
                            <label for="Sucursal">Sucursal:</label>
                            <input type="number" id="Sucursal" name="Sucursal" placeholder="Ingrese el ID de Sucursal">
                        </div>
                        <div>
                            <input type="submit" value="Enviar Consulta" id="boton-enviar" style="margin-right: 70px">                    
                        </div>
                    </div>
                </form>
                <form method = "GET" action = "/inventario/registrarLibro">
                    <input type="submit" value="Registrar Libro" id="boton-enviar" style="margin-right: 70px">                    
                </form>
            </div>
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
                            <th>Sucursal</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($inventario) && is_array($inventario)): ?>
                            <?php foreach ($inventario as $producto): ?>
                                <tr>
                                    <td><?= htmlspecialchars($producto['ISBN']) ?></td>
                                    <td><?= htmlspecialchars($producto['Titulo']) ?></td>
                                    <td><?= htmlspecialchars($producto['Autor']) ?></td>
                                    <td><?= htmlspecialchars($producto['Sucursal']) ?></td>
                                    <td>$<?= htmlspecialchars($producto['Precio']) ?></td>
                                    <td><?= htmlspecialchars($producto['Cantidad']) ?></td>
                                    <td>
                                        <form method="post" action="InventarioController.php?action=eliminarLibro" style="display:inline;">
                                            <input type="hidden" name="isbn" value="<?= htmlspecialchars($producto['ISBN']) ?>">
                                            <button type="submit" id="boton-eliminar">Eliminar</button>
                                        </form>
                                        <form method="post" action="/inventario/editarLibro" style="display:inline;">
                                            <input type="hidden" name="isbn" value="<?= htmlspecialchars($producto['ISBN']) ?>">
                                            <button type="submit" id="boton-editar">Editar</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" style="text-align: center;">No hay libros disponibles en el inventario.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
