<?php 
include_once "../Solicitudes/UserSession.php";
$userSession = new UserSession();
$userSession ->closeSession();
$respuesta = "Sesion_Cerrada";
echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
