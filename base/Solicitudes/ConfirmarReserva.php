<?php 
require_once '../Solicitudes/UserSession.php';
require_once '../config/conexion.php';
$db = Database::getInstance();
$conn = $db->getConnection();

$userSession = new UserSession();
$currentUser = $userSession->getCurrentUser();
list($tipoPersona, $identificacion) = explode('_', $currentUser);

$data = json_decode(file_get_contents('php://input'), true);

$idRestaurante = $data['idRestaurante'];
$numPersonas = $data['numeroPersonas'];
$fecha = substr($data['fecha'], 0, 10);
$hora = $data['horaSelect'];
$ocasion = $data['Ocasion'];
$infoAdicional = $data['infoAdicion'];


$infoRestaurante = $conn->prepare('SELECT restaurante.Imagen_Restaurante, direccion.Nombre_Calle, direccion.Numero_Calle, direccion.Barrio, direccion.Ciudad, direccion.Pais, tipo_calle.Nombre_Tipo_Calle 
    FROM restaurante 
    JOIN direccion ON restaurante.Direccion_Restaurante = direccion.Id_Direccion 
    JOIN tipo_calle ON direccion.Id_Tipo_Calle = tipo_calle.Id_Tipo_Calle
    WHERE restaurante.Id_Restaurante = :idRestaurante
');
$infoRestaurante->execute(array(':idRestaurante'=> $idRestaurante));
$row = $infoRestaurante->fetch(PDO::FETCH_ASSOC);
$pais = $row["Pais"];
$ciudad = $row["Ciudad"];
$imagen = $row["Imagen_Restaurante"];
$nombreCalle = $row["Nombre_Calle"];
$numeroCalle =  $row["Numero_Calle"];
$barrio = $row["Barrio"];
$nombreTipoCalle = $row["Nombre_Tipo_Calle"];

if ($tipoPersona == "Empresa") {
    $nombre = $conn->prepare('SELECT Razon_Social FROM empresa WHERE Id_Cliente = :identificacion');
    $nombre->execute(array(':identificacion'=> $identificacion));
}
elseif ($tipoPersona == "Persona"){
    $nombre = $conn->prepare('SELECT Primer_Nombre, Segundo_Nombre, Primer_Apellido, Segundo_Apellido FROM persona WHERE Identificacion = :identificacion');
    $nombre->execute(array(':identificacion'=> $identificacion));
    $row = $nombre ->fetch(PDO::FETCH_ASSOC);
    $primerNombre = $row["Primer_Nombre"];
    $segundoNombre = $row["Segundo_Nombre"];
    $primerApellido = $row["Primer_Apellido"];
    $segundoApellido =  $row["Segundo_Apellido"];
    
    $nombre = $primerNombre . " " . $segundoNombre . " " . $primerApellido . " " . $segundoApellido;
}

$respuesta = '<div class="tituloConfirmar"><span class="FontPrimary FontSize9">Confirmar Reserva</span></div>
<div class="ConfirmarInformacionRestaurante">
    <div class="ConfirmarNombre"><span class="FontPrimary">Reserva A Nombre DE: </span><span class="FontParrafo">'.$nombre.'</span></div>
    <div class="ConfirmarPaisCiudad">
        <div class="ConfirmarPais"><span class="FontPrimary">Pais: </span><span class="FontParrafo">'.$pais.'</span></div>
        <div class="ConfirmarCiudad"><span class="FontPrimary">Ciudad: </span><span class="FontParrafo">'.$ciudad.'</span></div>
    </div>
    <div class="ConfirmarDireccion"><span class="FontPrimary">Direccion: </span><span class="FontParrafo">'.$tipoCalle.' '.$nombreCalle.' '.$numeroCalle.' '.$barrio.'</span></div>
</div>
<div class="ConfirmarImagen">
    <img src="'.$imagen.'" class="imgRestauranteConfirmar">
</div>
<div class="ConfirmarInfpReserva">
    <div class="ConfirmarNumPersonas"><span class="FontPrimary">Numero de Personas: </span><span class="FontParrafo">'.$numPersonas.'</span></div>
    <div class="ConfirmarFecha"><span class="FontPrimary">Fecha: </span><span class="FontParrafo">'.$fecha.'</span></div>
    <div class="ConfirmarHora"><span class="FontPrimary">Hora de la Reserva: </span><span class="FontParrafo">'.$hora.'</span></div>
</div>
<div class="ConfirmarInfoAdicional">
    <div class="ConfirmarOcasion"><span class="FontPrimary">Ocasion o Evento: </span><span class="FontParrafo">'.$ocasion.'</span></div>
    <div class="ConfirmarEspecificacion"><span class="FontPrimary">Comentario: </span><span class="FontParrafo">'.$infoAdicional.'</span></div>
</div>
<div class="ConfirmarBotones">
    <button class="ConfirmarCancelarButon" id="ConfirmarCancelarButon">Cancelar</button>
    <button class="ConfirmarAceptarButton" id="ConfirmarAceptarButton">Aceptar</button>
</div>';

echo $respuesta;
