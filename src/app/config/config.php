<?php
// Definir la ruta raíz del proyecto
define('ROOT_PATH', dirname(__DIR__, 2));

// Función para cargar variables de entorno desde un archivo .env
function loadEnv($path) {
    if (!file_exists($path)) {
        die("El archivo .env no existe en la ruta: $path");
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) { // Ignorar comentarios
            continue;
        }
        list($name, $value) = explode('=', $line, 2);
        putenv(sprintf('%s=%s', trim($name), trim($value))); // Cargar la variable
    }
}

// Cargar las variables de entorno
loadEnv(ROOT_PATH . '/');

// Configuración de conexión a la base de datos
$host = getenv('DB_HOST');
$dbname = getenv('DB_DATABASE');
$user = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');
$port = getenv('DB_PORT') ?: 3306; // Usar el puerto predeterminado si no está definido

try {
    // DSN para MySQL
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";
    // Crear la conexión PDO
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}

function getDatabaseConnection() {
    global $pdo;
    return $pdo;
}
