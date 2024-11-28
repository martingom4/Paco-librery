<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link rel="shortcut icon" href="../images/LOGO.PNG" alt="logo">
    <!--Documentos CSS utilizados-->
    <link rel="stylesheet" href="css/home.css">
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
        <div class="welcome-message">
            <h1>¡Bienvenidos a Librería ¡Donde Paco!</h1>
            <p>Explora nuestras selecciones más vendidas, las últimas novedades y mucho más.
                 ¡Tu próxima aventura literaria te espera!</p>
        </div>
        <div class="slider">
            <div class="slide active">
                <div class="image-container">
                    <img src="https://phantom-elmundo.unidadeditorial.es/4d8fa71e3a4416412aff3c30b71ed93e/resize/646/f/webp/assets/multimedia/imagenes/2024/04/18/17133960148060.jpg" alt="Placeholder Image 1">
                </div>
                <div class="text-content">
                    <h2>Los 10 libros más vendidos de la semana</h2>
                    <p>Estas son las novelas y libros de no ficción más vendidos de esta semana</p>
                    <a href="https://www.elmundo.es/la-lectura/2024/06/28/66799f36fc6c8360018b458b.html" class="text-content button">
                        <button>Click aquí para ver más</button>
                    </a>
                </div>
            </div>
            <div class="slide">
                <div class="image-container">
                    <img src="https://www.laestrella.com.pa/binrepository/700x1063/0c337/700d390/none/199516884/LHKB/vienen-de-panama_181-7218634_20240608121309.jpg" alt="Placeholder Image 2">
                </div>
                <div class="text-content">
                    <h2>Nueva antología de poesía panameña</h2>
                    <p>La escritora panameña Consuelo Tomás Fitzgerald presentó hace unos días,
                        en el marco del Festival Centroamérica Cuenta, la última de las antologías
                        de poesía centroamericana publicadas por Ediciones Perro Azul y titulada Vienen de Panamá.</p>
                    <a href="https://www.laestrella.com.pa/vida-y-cultura/nueva-antologia-de-poesia-panamena-GD7621558" class="text-content button">
                        <button>Click aquí para ver más</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="recuadro-slider-controls">
            <script src="scripts/home.js"></script>
            <div class="slider-controls">
                <button id="prev">◀</button>
                <button id="next">▶</button>
            </div>
        </div>
    </main>
    <?php include 'includes/footer.php';?>
</body>
</html>
