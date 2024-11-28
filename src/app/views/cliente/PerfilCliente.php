<?php
session_start();
if(!isset($_SESSION['cliente_id'])){
        header("Location: /cliente/login");
        exit();
}
include 'includes/header.php'
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi cuenta</title>
    <link rel="shortcut icon" href="../images/LOGO.png" alt="logo">
    <link rel="stylesheet" href="/css/PerfilCliente.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+GB+S:wght@100..400&display=swap" rel="stylesheet">
</head>
<body>
    <main>
        <section class="titulo">
            <h1>Mi cuenta</h1>
        </section>
        <section class="Container-infoper">
            <div class="campoizquierdo">
                <div class="fotoperfil">
                    <img src="../images/sinfotoperfil.png" alt="FotoPerfil" title="Foto de Perfil">
                </div>
                <div class="boton">
                    <button id="boton-editar"><a href="/cliente/actualizar">Actualizar perfil</a></button><br>
                        <form method="POST" action="/cliente/eliminar">
                        <button id="boton-eliminar" type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer.');">
                                Eliminar cuenta
                        </button>
                        </form>
                </div>
            </div>
            <div class="infop">
                <h4>Nombre: <?php echo $_SESSION['nombre']; ?></h4>
                <h4>Apellido: <?php echo $_SESSION['apellido']; ?></h4>
                <h4>Email: <?php echo $_SESSION['email']; ?></h4>
                <h4>Teléfono: <?php echo $_SESSION['telefono']; ?></h4>
                <br>
                <h4>Último acceso: <?php echo $_COOKIE['ultimo_acceso'] ?? 'Es tu primer acceso o la cookie ha expirado'?> </h4>
            </div>
        </section>

        <section class="titulo">
            <h1>Historial de Compras</h1>
        </section>
        <?php if (empty($historialCompras)): ?>
            <p>No has realizado ninguna compra.</p>
        <?php else: ?>
            <?php foreach ($historialCompras as $compra): ?>
                <section class="Container-historial">
                    <div class="imagenlibro">
                        <img src="/images/<?= htmlspecialchars($compra['imagen']) ?>" alt="Imagen del libro">
                    </div>
                    <div class="infolibro">
                        <h2><?= htmlspecialchars($compra['titulo']) ?></h2>
                        <h4>Cantidad: <?= htmlspecialchars($compra['cantidad']) ?></h4>
                        <h4>Fecha compra: <?= htmlspecialchars($compra['fecha']) ?></h4>
                        <h4>Precio: $<?= htmlspecialchars($compra['precio']) ?></h4>
                    </div>
                        <a href="/factura?venta_id=<?= htmlspecialchars($compra['ID_venta']) ?>">
                            <button id="boton-editar">Ver Factura</button>
                        </a>
                    </div>
                </section>
            <?php endforeach; ?>
        <?php endif; ?>
    </main>
<?php include 'includes/footer.php';?>
</body>
</html>
