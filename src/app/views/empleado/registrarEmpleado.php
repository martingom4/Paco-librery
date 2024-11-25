<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Empleado</title>
    <link rel="shortcut icon" href="../images/LOGO.PNG" alt="logo">
    <link rel="stylesheet" href="/css/registroEmpleado.css">
    <!-- Fuente Nunito de Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <main>
        <div class="registro-container">
            <div class="registro-box">
                <h2>Registrar Empleado</h2>
                <form method="POST" action="/empleados/registrar">
                    <!-- Nombre -->
                    <div class="input-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" name="nombre" required>
                    </div>
                    <!-- Apellido -->
                    <div class="input-group">
                        <label for="apellido">Apellido</label>
                        <input type="text" id="apellido" name="apellido" required>
                    </div>
                    <!-- CIP -->
                    <div class="input-group">
                        <label for="cip">CIP</label>
                        <input type="text" id="cip" name="cip" required>
                    </div>
                    <!-- Nacionalidad -->
                    <div class="input-group">
                        <label for="nacionalidad">Nacionalidad</label>
                        <input type="text" id="nacionalidad" name="nacionalidad" required>
                    </div>
                    <!-- Fecha de Contrato -->
                    <div class="input-group">
                        <label for="fecha_contrato">Fecha de Contrato</label>
                        <input type="date" id="fecha_contrato" name="fecha_contrato" required>
                    </div>
                    <!-- Fecha de Nacimiento -->
                    <div class="input-group">
                        <label for="fecha_nac">Fecha de Nacimiento</label>
                        <input type="date" id="fecha_nac" name="fecha_nac" required>
                    </div>
                    <!-- Edad -->
                    <div class="input-group">
                        <label for="edad">Edad</label>
                        <input type="number" id="edad" name="edad" required>
                    </div>
                    <!-- Sueldo -->
                    <div class="input-group">
                        <label for="sueldo">Sueldo</label>
                        <input type="number" step="0.01" id="sueldo" name="sueldo" required>
                    </div>
                    <!-- Cargo -->
                    <div class="input-group">
                        <label for="cargo">Cargo</label>
                        <input type="text" id="cargo" name="cargo" required>
                    </div>
                    <!-- Teléfono -->
                    <div class="input-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" id="telefono" name="telefono">
                    </div>
                    <!-- Correo -->
                    <div class="input-group">
                        <label for="correo">Correo</label>
                        <input type="email" id="correo" name="correo" required>
                    </div>
                    <!-- Contraseña -->
                    <div class="input-group">
                        <label for="contrasena">Contraseña</label>
                        <input type="password" id="contrasena" name="contrasena" required>
                    </div>
                    <!-- Librería -->
                    <div class="input-group">
                        <label for="id_libreria">ID Librería</label>
                        <input type="number" id="id_libreria" name="id_libreria">
                    </div>
                    <button type="submit" class="btn">Confirmar</button>
                </form>
            </div>
        </div>
    </main>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
