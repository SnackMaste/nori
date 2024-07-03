<?php 
require_once '../config/conexion.php';
$db = Database::getInstance();
$conn = $db->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $identificacion = $_POST["Identificacion"];
    $tipoPersona = $_POST["TipoPersona"];
    if ($tipoPersona === "Persona"){
        $columna = "Identificacion";
        $tabla = "persona";
    } else if ($tipoPersona === "Empresa") {
        $columna = "NIT";
        $tabla = "empresa";
    }
    $result = $conn->prepare('SELECT COUNT (*) FROM "'.$tabla.'" WHERE "'.$columna.'" = :identificacion');
    $result->execute(array(':identificacion'=>$identificacion));
    $count = $result->fetchColumn();
    if ($count > 0) {
        echo "usuario_existente";
    } else {
        echo "usuario_no_existente";
    }
}