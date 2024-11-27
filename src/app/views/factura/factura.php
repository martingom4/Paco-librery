<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width-device-width">
        <title>Gestionar Ventas</title>
        <link rel="shortcut icon" href="../images/LOGO.png" alt="logo">
        <!--Documentos CSS utilizados-->
        <link rel="stylesheet" href="../css/VerDetalles.css">
        <!---Fuente Nunito de Google Fonts-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
        <!---Fuente Playwrite England SemiJoined de Google Fonts-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playwrite+GB+S:wght@100..400&display=swap" rel="stylesheet">
    </head>


    <body>


        <main>
            <h1>Detalles de venta</h1>
            <section class="Detalles">
                <div class="tablascontenedor">
                    <div class="DetallesGenerales">
                        <table>
                            <tr>
                                <th colspan="2">Datos generales</th>
                            </tr>
                            <tr id="fila-data">
                                <td class="columna1">Numero de Factura</td>
                                <td><strong><?= htmlspecialchars($factura['numero_factura']) ?></strong></td>
                            </tr>
                            <!--CARGAR INVENTARIO AQUÍ-->
                            <tr id="fila-data">
                                <td class="columna1">Metodo de Pago</td>
                                <td><strong><?= htmlspecialchars($factura['metodo_pago']) ?></td>
                            </tr>

                            <tr id="fila-data">
                                <td class="columna1">Fecha</td>
                                <td><strong><?= htmlspecialchars($factura['fecha_emision']) ?></strong></td>
                            </tr>
                            <tr id="fila-data">
                                <td class="columna1">Correo del cliente</td>
                                <td> <strong><?= htmlspecialchars($factura['correo_cliente']) ?></strong></td>
                            </tr>
                            <tr id="ultimafila">
                                <td class="columna1">Nombre del cliente</td>
                                <td><strong><?= htmlspecialchars($factura['nombre_cliente']) ?></strong></td>
                            </tr>
                        </table>
                    </div>
                    <div class="ArticulosComprados">
                    <?php foreach ($detallesVenta as $detalle): ?>
                        <table>
                            <tr>
                                <th>Artículo comprados</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                            </tr>
                            <!--CARGAR INVENTARIO AQUÍ-->

                            <tr id="fila-data">
                                <td><?= htmlspecialchars($detalle['titulo']) ?></td>
                                <td><?= htmlspecialchars($detalle['cantidad']) ?></td>
                                <td>$<?= htmlspecialchars($detalle['precio']) ?></td>
                            </tr>
                            <tr id="ultimafila">
                                <td class ="columna1">Costo total</td>
                                <td> </td>
                                <td class ="columna1" ><strong><?= htmlspecialchars($factura['monto_total']) ?> USD</strong></td>
                            </tr>
                        </table>
                        <?php endforeach; ?>
                        <br><br>
                        <div class="contenedorboton">
                            <button class="print-button" onclick="window.print()">
                                Imprimir
                                <img src="../images/imprimir.png" alt="imprimir" id="logoimprimir">
                            </button>
                        </div>
                    </div>
                </div>
                <!--Es un boton que imprimirá la pantalla con los datos-->


            </section>
        </main>


        <?php include 'includes/footer.php'; ?>

    		<script src="../scripts/home.js"></script>
    </body>
</html>
<?php
// Mostrar los datos de la factura y los detalles de la venta
?>
