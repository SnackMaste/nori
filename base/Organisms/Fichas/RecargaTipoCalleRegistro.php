<?php 
require_once '../../config/conexion.php';
$db = Database::getInstance();
$conn = $db->getConnection();

$tipoCalleRegistro = $conn->query('SELECT DISTINCT "Nombre_Tipo_Calle" FROM "Tipo_Calle" ORDER BY "Nombre_Tipo_Calle" ASC');

$tipoCalleRespuesta = '<option value="" selected hidden>Tipo de Calle</option>';

while($row = $tipoCalleRegistro->fetch(PDO::FETCH_ASSOC)) {
    $tipoCalle = $row['Nombre_Tipo_Calle'];
    $tipoCalleRespuesta .= '<option value="'.$tipoCalle.'">'.$tipoCalle.'</option>';
}
echo json_encode($tipoCalleRespuesta, JSON_UNESCAPED_UNICODE);