<?php 
require_once '../config/conexion.php';
$db = Database::getInstance();
$conn = $db->getConnection();

$paisReserva = $conn->query('SELECT DISTINCT direccion.Pais
FROM restaurante
JOIN direccion ON restaurante.Direccion_Restaurante = direccion.Id_Direccion
ORDER BY direccion.Pais ASC;');
$paisRespuesta = '<option value="" selected hidden>Pais</option>';
while ($row = $paisReserva->fetch(PDO::FETCH_ASSOC)) {
    $pais = $row['Pais'];
    $paisRespuesta .= '<option value="'.$pais.'">'.$pais.'</option>';
}
echo $paisRespuesta;
