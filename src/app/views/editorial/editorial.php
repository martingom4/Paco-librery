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
                <button class="btn-registrar" onclick="window.location.href='registro_editorial.php'">Registrar Editorial</button>
            </div>

            <table class="editorial-table">
                <thead>
                    <tr>
                        <th>CIP</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Nacionalidad</th>
                        <th>Fecha de contrato</th>
                        <th>Fecha nacimiento</th>
                        <th>Sueldo</th>
                        <th>Cargo</th>
                        <th>Contraseña</th>
                        <th>ID librería</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    include '';
                    $query = "SELECT * FROM Editorial";
                    $result = $conn->query($query);

                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>{$row['cip']}</td>
                                <td>{$row['nombre']}</td>
                                <td>{$row['apellido']}</td>
                                <td>{$row['nacionalidad']}</td>
                                <td>{$row['fecha_contrato']}</td>
                                <td>{$row['fecha_nacimiento']}</td>
                                <td>\${$row['sueldo']}</td>
                                <td>{$row['cargo']}</td>
                                <td>###</td>
                                <td>{$row['id_libreria']}</td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='10'>No hay datos disponibles</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
