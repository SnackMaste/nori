<?php 
require_once '../Solicitudes/UserSession.php';
require_once '../config/conexion.php';
$db = Database::getInstance();
$conn = $db->getConnection();

$userSession = new UserSession();
$currentUser = $userSession->getCurrentUser();
list($tipoPersona, $identificacion) = explode('_', $currentUser);

if($tipoPersona == "Empresa"){
    $result = $conn->prepare('SELECT Id_Cliente FROM empresa WHERE NIT = :identificacion');
    $result->execute(array(':identificacion'=>$identificacion));
    $idCliente = $result->fetch(PDO::FETCH_ASSOC)['Id_Cliente'];
}
if($tipoPersona == "Persona"){
    $result = $conn->prepare('SELECT Id_Cliente FROM persona WHERE Identificacion = :identificacion');
    $result->execute(array(':identificacion'=>$identificacion));
    $idCliente = $result->fetch(PDO::FETCH_ASSOC)['Id_Cliente'];
}

$restaurante = $_POST['Restaurante'];
$numPersonas = intval($_POST['numeroPersonas']);
$fecha = substr($_POST['Fecha'], 0, 10);
$hora = $_POST['Hora'];
$ocasion = $_POST['Ocasion'];
$comentario = $_POST['Comentario'];

$hora .= ":00";
$datetime = $fecha . " " . $hora;
$query = $conn->prepare('INSERT INTO reserva(FYH_Reserva, Motivo, Especificacion, Cantidad_Personas, Id_Cliente, Id_Restaurante, Estado)
VALUES (:fecha,:ocasion,:comentario,:numPersonas,:idCliente,:restaurante,:estado)');
try {
    $query->execute(array(':fecha'=>$datetime,':ocasion'=>$ocasion,':comentario'=>$comentario,':numPersonas'=>$numPersonas,':idCliente'=>$idCliente,':restaurante'=>$restaurante, ':estado'=>"ACTIVA"));
    echo "se_inserto";
}catch(PDOException $exp) {
    echo "Error: " . $exp->getMessage();
}