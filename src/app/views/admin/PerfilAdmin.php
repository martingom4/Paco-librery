<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil del Administrador</title>
    <link rel="stylesheet" href="/css/PerfilAdmin.css">
</head>
<body>
    <main>
        <section class="titulo">
            <h1>Perfil del Administrador</h1>
        </section>
        <section class="Container-infoper">
            <div class="campoizquierdo">
                <div class="fotoperfil">
                    <img src="../images/sinfotoperfil.png" alt="FotoPerfil" title="Foto de Perfil">
                </div>
            </div>
            <div class="infop">
                <h4>Email: <?php echo htmlspecialchars($admin['correo']); ?></h4>
                <h4>Último acceso: <?php echo $_COOKIE['ultimo_acceso'] ?? 'Es tu primer acceso o la cookie ha expirado'?> </h4>
            </div>
        </section>
    </main>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
