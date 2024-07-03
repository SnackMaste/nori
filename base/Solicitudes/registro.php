<?php 
require_once '../config/conexion.php';
$db = Database::getInstance();
$conn = $db->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $identificacion = $_POST["Identificacion"];
    $tipoPersona = $_POST["TipoPersona"];
    $nombre1 = $_POST["Nombre1"];
    $nombre2 = $_POST["Nombre2"];
    $apellido1 = $_POST["Apellido1"];
    $apellido2 = $_POST["Apellido2"];
    $pais =  $_POST["Pais"];
    $ciudad =  $_POST["Ciudad"];
    $barrio =   $_POST["Barrio"];
    $tipoCalle = $_POST["TipoCalle"];
    $nombreCalle = $_POST["NombreCalle"];
    $numeroCalle = $_POST["NumeroCalle"];
    $torre = $_POST["Torre"];
    $piso = $_POST["Piso"];
    $puerta = $_POST["Puerta"];
    $codigo = $_POST["Codigo"];
    $numeroTelefono = $_POST["NumeroTelefono"];
    $correo = $_POST["Correo"];
    $contraseña = $_POST["Contraseña"];
    $telefonoCompleto = "+".$codigo.$numeroTelefono;
    $contraseña = password_hash($contraseña, PASSWORD_DEFAULT);

    try {
        $stmt = $conn->prepare('SELECT * FROM SpIngresoCliente(:tipoPersona, :nombre1, :nombre2, :apellido1, :apellido2, :identificacion, :telefonoCompleto, :correo, :contrasena, :tipoCalle, :nombreCalle, :numeroCalle, :barrio, :torre, :piso, :puerta, :ciudad, :pais)');
        $stmt->execute(array(':tipoPersona'=>$tipoPersona, ':nombre1'=>$nombre1, ':nombre2'=>$nombre2, ':apellido1'=>$apellido1, ':apellido2'=>$apellido2, ':identificacion'=>$identificacion, ':telefonoCompleto'=>$telefonoCompleto, ':correo'=>$correo, ':contrasena'=>$contraseña, ':tipoCalle'=>$tipoCalle, ':nombreCalle'=>$nombreCalle, ':numeroCalle'=>$numeroCalle, ':barrio'=>$barrio, ':torre'=>$torre, ':piso'=>$piso, ':puerta'=>$puerta, ':ciudad'=>$ciudad, ':pais'=>$pais));
        echo 'registro_exitoso';
    } catch (PDOException $exp) {
        echo "Error: " . $exp->getMessage();
    }
    
}

