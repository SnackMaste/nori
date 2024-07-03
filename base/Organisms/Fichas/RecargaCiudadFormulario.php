<?php 
require_once '../../config/conexion.php';
$db = Database::getInstance();
$conn = $db->getConnection();

$paisSelecionadoRegistro =$_POST['paisSelecionadoRegistro'];

$ciudadRegistro = $conn->prepare('SELECT DISTINCT "Ciudad" FROM "Direccion" WHERE "Pais" = :paisSelecionadoRegistro ORDER BY "Ciudad" ASC');
$ciudadRegistro->execute(array(':paisSelecionadoRegistro'=>$paisSelecionadoRegistro));

$ciudadRespuesta = '<option value="" selected hidden>Ciudad</option>';

while($row = $ciudadRegistro->fetch(PDO::FETCH_ASSOC)) {
    $ciudad = htmlspecialchars($row['Ciudad']);
    $ciudadRespuesta .= '<option value="'.$ciudad.'">'.$ciudad.'</option>';
}
echo json_encode($ciudadRespuesta, JSON_UNESCAPED_UNICODE);