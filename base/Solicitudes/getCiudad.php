<?php 
require_once '../config/conexion.php';
$db = Database::getInstance();
$conn = $db->getConnection();

$pais = $_POST['pais'];

$consultaCiudad = $conn->prepare('SELECT DISTINCT direccion.Ciudad
FROM restaurante
JOIN direccion ON restaurante.Direccion_Restaurante = direccion.Id_Direccion AND  direccion.Pais = :pais
ORDER BY direccion.Ciudad ASC');
$consultaCiudad->execute(array(':pais' => $pais));
$respuesta = "";

while ($row = $consultaCiudad->fetch(PDO::FETCH_ASSOC)) {
    $ciudad = $row['Ciudad'];
    $respuesta .= '<div class="optionCiudad" value="'. $ciudad .'" ><span class="FontPrimary FontSize5">'. $ciudad .'</span></div>';
}

echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);

