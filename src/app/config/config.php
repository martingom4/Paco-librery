<?php
// config.php
define ('APP_PATH', __DIR__); # que tengo una nueva path llamada app_path que apunta a src/app
define ('ROOT_PATH', dirname(__DIR__,2)); # que tengo una nueva path llamada root_path que apunta a src

function loadEnv($path) {
    if (!file_exists($path)) {
        die("El archivo .env no existe");
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        list($name, $value) = explode('=', $line, 2);
        putenv(sprintf('%s=%s', trim($name), trim($value)));
    }
}

// Cargar el archivo .env
loadEnv(ROOT_PATH . '/');

// Configuración de la conexión a la base de datos
$host = getenv('DB_HOST');
$dbname = getenv('DB_DATABASE');
$user = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');
$port = getenv('DB_PORT');

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa a la base de datos.";
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}
