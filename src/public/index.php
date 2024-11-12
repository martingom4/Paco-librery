<?php
// Incluir la configuración de conexión a la base de datos
require_once __DIR__ . '/../config/config.php'; // Ajusta esta ruta si es necesario

// Prueba de consulta simple para verificar la conexión
try {
    $query = $pdo->query("SELECT 1");
    if ($query) {
        echo "Conexión exitosa a la base de datos.";
    }
} catch (PDOException $e) {
    die("Error en la consulta: " . $e->getMessage());
}
