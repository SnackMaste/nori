<?php 
require_once '../Solicitudes/UserSession.php';
require_once '../config/conexion.php';
$db = Database::getInstance();
$conn = $db->getConnection();

$userSession = new UserSession();
$currentUser = $userSession->getCurrentUser();
list($tipoPersona, $identificacion) = explode('_', $currentUser);
$puntos = $conn->prepare('SELECT Cantidad_Puntos FROM puntos WHERE Id_Cliente = :idcliente');
$respuesta = "";
if ($tipoPersona == "Empresa") {
    $stmt = $conn->prepare('SELECT Razon_Social, Imagen_Usuario, Id_Cliente FROM empresa 
    WHERE NIT = :identificacion');
    $stmt->execute(array(':identificacion'=>$identificacion));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $nombre =  $row['Razon_Social'];
    $imagen =  $row['Imagen_Usuario'];
    $idCliente = $row['Id_Cliente'];
    $idCliente = intval($idCliente);
    $puntos->execute(array(':idcliente'=>$idCliente));
    $puntos = $puntos->fetch(PDO::FETCH_ASSOC)['Cantidad_Puntos'];
    $respuesta .='<div class="contenedorMenuLogin OcultarMenu" id="contenedorMenuLogin">
    <img src="/Atoms/Icons/cerrar.png" class="CerrarMenu" id="CerrarMenu">
    <div class="contenedorImgUsuario">
        <img src="'.$imagen.'" alt="" class="usuarioMenu">
    </div>
    <div class="contenedorNombre">
        <div class="nombreUsuario"><span class="FontPrimary">BIENVENID@ '.$nombre.'</span></div>
    </div>
    <div class="contenedorConfiguracion">
        <div class="configuracionCuenta"><span class="FontPrimary">Configuración</span></div>
    </div>
    <div class="contenedorHistorial">
        <div class="historialDePedidos"><span class="FontPrimary">Historial de Pedidos</span></div>
    </div>
    <div class="contenedorHistorial">
        <div class="historialDePedidos"><span class="FontPrimary">Historial de Reservas</span></div>
    </div>
    <div class="contenedorPuntos">
        <div class="puntos"><span class="FontPrimary">Putos: '.$puntos.'</span></div>
    </div>
    <div class="contenedorCerrarSesion" id="CerrarSesion">
        <div class="cerrarSesion"><span class="FontPrimary">Cerrar Sesión</span></div>
    </div>
</div>';
} 
elseif ($tipoPersona == "Persona"){
    $stmt = $conn->prepare('SELECT Primer_Nombre, Primer_Apellido, Imagen_Usuario, Id_Cliente FROM persona 
    WHERE Identificacion = :identificacion');
    $stmt->execute(array(':identificacion'=>$identificacion));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $nombre = $row['Primer_Nombre'];
    $apellido = $row['Primer_Apellido'];
    $imagen =  $row['Imagen_Usuario'];
    $idCliente = $row['Id_Cliente'];
    $idCliente = intval($idCliente);
    $puntos->execute(array(':idcliente'=>$idCliente));
    $puntos = $puntos->fetch(PDO::FETCH_ASSOC)['Cantidad_Puntos'];
    $respuesta .= '<div class="contenedorMenuLogin OcultarMenu" id="contenedorMenuLogin">
    <img src="/Atoms/Icons/cerrar.png" class="CerrarMenu" id="CerrarMenu">
    <div class="contenedorImgUsuario">
        <img src="'.$imagen.'" alt="" class="usuarioMenu">
    </div>
    <div class="contenedorNombre">
        <div class="nombreUsuario"><span class="FontPrimary">BIENVENID@ '.$nombre." ".$apellido.'</span></div>
    </div>
    <div class="contenedorConfiguracion">
        <div class="configuracionCuenta"><span class="FontPrimary">Configuración</span></div>
    </div>
    <div class="contenedorHistorial">
        <div class="historialDePedidos"><span class="FontPrimary">Historial de pedidos</span></div>
    </div>
    <div class="contenedorHistorial">
        <div class="historialDePedidos"><span class="FontPrimary">Historial de Reservas</span></div>
    </div>
    <div class="contenedorPuntos">
        <div class="puntos"><span class="FontPrimary">Putos: '.$puntos.'</span></div>
    </div>
    <div class="contenedorCerrarSesion" id="CerrarSesion">
        <div class="cerrarSesion"><span class="FontPrimary">Cerrar Sesión</span></div>
    </div>
</div>';
}
echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);

