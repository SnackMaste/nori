<?php 
require_once '../Solicitudes/UserSession.php';
require_once '../config/conexion.php';
$db = Database::getInstance();
$conn = $db->getConnection();
$userSession = new UserSession();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $identificacion = $_POST["Identificacion"];
    $contraseña = $_POST["Contraseña"];
    $tipoPersona = $_POST["TipoPersona"];
    if ($tipoPersona === "Persona"){
        $columna = "Identificacion";
        $tabla = "persona";
    } else if ($tipoPersona === "Empresa") {
        $columna = "NIT";
        $tabla = "empresa";
    }
    $stmt = $conn->prepare('SELECT Contraseña_Cliente FROM cliente 
    JOIN '.$tabla.' ON '.$tabla.'.Id_Cliente = cliente.Id_Cliente 
    WHERE '.$columna.' = :identificacion');
    $stmt->execute(array(':identificacion'=>$identificacion));
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($contraseña, $row['Contraseña_Cliente'])) {
            $userSession->setCurrentUser($tipoPersona . '_' . $identificacion);
            echo "Login_Exitoso";
        } else {
            echo "contraseña_incorrecta";
        }
    } else {
        echo "usuario_no_existe";
    }
}
