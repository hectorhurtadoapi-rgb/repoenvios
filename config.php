<?php
$host = "mysql-hectorapi.alwaysdata.net";
$db   = "hectorapi_repoenvios";
$user = "hectorapi";
$pass = "clase1234";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8mb4",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );

    // Crea la tabla automáticamente si no existe.
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS envios (
            id INT AUTO_INCREMENT PRIMARY KEY,
            destinatario VARCHAR(150) NOT NULL,
            direccion VARCHAR(255) NOT NULL,
            descripcion TEXT NOT NULL,
            creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");
} catch (PDOException $e) {
    http_response_code(500);
    die("Error de conexión a la base de datos: " . htmlspecialchars($e->getMessage()));
}
?>
