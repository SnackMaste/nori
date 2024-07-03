<?php 
require_once '../config/conexion.php';
$db = Database::getInstance();
$conn = $db->getConnection();

$data = json_decode(file_get_contents('php://input'), true);
$fecha = substr($data['fecha'], 0, 10);
$restaurante = $data['restaurante'];

$horasDisponibles = $conn->prepare('SELECT * FROM SpVerificarDisponibilidad(:restaurante, :fecha)');
$horasDisponibles->execute(array(':restaurante'=>$restaurante, ':fecha'=>$fecha));
$respuesta ="";
$respuesta .= '<option value="" hidden selected>Disponible</option>';
while ($row = $horasDisponibles->fetch(PDO::FETCH_ASSOC)) {
    $disp = $row['Hora'];
    $respuesta .=  '<option value="'.$disp.'">'.$disp.'</option>';
}

echo $respuesta ;
