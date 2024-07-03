<?php 
require_once '../config/conexion.php';
$db = Database::getInstance();
$conn = $db->getConnection();

$ciudad = $_POST['ciudad'];

$consultaRestaurante = $conn->prepare('SELECT restaurante.Id_Restaurante, direccion.Nombre_Calle, direccion.Numero_Calle, direccion.Barrio, tipo_calle.Nombre_Tipo_Calle
FROM restaurante
JOIN direccion ON restaurante.Direccion_Restaurante = direccion.Id_Direccion AND direccion.Ciudad = :ciudad
JOIN tipo_calle ON direccion.Id_Tipo_Calle = tipo_calle.Id_Tipo_Calle');
$consultaRestaurante->execute(array(':ciudad'=>$ciudad));
$respuesta = "";
$respuesta .= '<option value="" hidden selected>Restaurantes</option>';
while ($row = $consultaRestaurante->fetch(PDO::FETCH_ASSOC)) {
    $respuesta .= '<option value="'. $row['Id_Restaurante'] .'" >'. $row['Nombre_Tipo_Calle'] . ' '.$row['Nombre_Calle']. ' '.$row['Numero_Calle']. ' '.$row['Barrio'].'</option>';
}

echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);