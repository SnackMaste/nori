<?php 
require_once '../../config/conexion.php';
$db = Database::getInstance();
$conn = $db->getConnection();

$paisRegistro = $conn->query('SELECT DISTINCT "Pais" FROM "Direccion" ORDER BY "Pais" ASC');

$paisRespuesta = '<option value="" selected hidden>Pais</option>';

while($row = $paisRegistro->fetch(PDO::FETCH_ASSOC)) {
    $pais = htmlspecialchars($row['Pais']);
    $paisRespuesta .= '<option value="'.$pais.'">'.$pais.'</option>';
}
echo json_encode($paisRespuesta, JSON_UNESCAPED_UNICODE);

