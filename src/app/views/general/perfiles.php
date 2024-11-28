<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="es">
    <head> 
        <meta charset="UTF-8">
        <meta name="viewport" content="width-device-width">
        <title>Perfiles</title>
        <link rel="shortcut icon" href="../images/LOGO.png" alt="logo"> 
        <!--Documentos CSS utilizados-->
        <link rel="stylesheet" href="../css/perfiles.css">
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
        <!--MAIN-->
        <main>
            <div class="acceso-container">
                <div class="acceso-box">
                    <h1>Acceso</h1>
                    <hr>
                    <p>Selecciona el tipo de acceso</p>
                    <div class="buttons">
                        <a href="/cliente/login" class="text-content button">
                            <button class="btn">Cliente</button>
                        </a>
                        <a href="/admin/login" class="text-content button">
                            <button class="btn">Administrador</button>
                        </a>
                    </div>
                </div>
            </div>
        </main>
<?php include 'includes/footer.php';?>
    </body>
</html>
