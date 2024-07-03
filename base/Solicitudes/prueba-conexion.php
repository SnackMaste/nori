<?php 
require_once '../config/conexion.php';
$db = Database::getInstance();
$conn = $db->getConnection();

try {
    $stmt = $conn->query('SELECT 1');
    $result = $stmt->fetch();
    if ($result) {
        echo 'Conexión exitosa a la base de datos.';
    } else {
        echo 'No se pudo conectar a la base de datos.';
    }
} catch (PDOException $e) {
    echo 'Error de conexión: ' . $e->getMessage();
}
