<?php
require_once '../config/conexion.php';
$db = Database::getInstance();
$conn = $db->getConnection();

$pais = $_POST['paisSelecionado'];

$consultaCiudad = $conn->prepare('SELECT DISTINCT direccion.Ciudad
FROM restaurante
JOIN direccion ON restaurante.Direccion_Restaurante = direccion.Id_Direccion AND  direccion.Pais = :pais
ORDER BY direccion.Ciudad ASC;');
$consultaCiudad->execute(array(':pais' => $pais));
$respuesta = '<option value="" hidden selected>Ciudad</option>';
while ($row = $consultaCiudad->fetch(PDO::FETCH_ASSOC)) {
    $ciudad = htmlspecialchars($row['Ciudad']);
    $respuesta .= '<option value="'.$ciudad.'" >'.$ciudad.'</option>';
}

echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);