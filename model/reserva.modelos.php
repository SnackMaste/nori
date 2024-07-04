<?php
require_once __DIR__. '/../vendor/autoload.php';
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
$uri = $_ENV['API_URI'];
$key = $_ENV['KEY_API'];
class Reserva_Modelo{

    public static function mdl_disponibilidad($id, $fecha){
        global $uri,$key;
        $url = $uri."CALL?procedure=SpVerificarDisponibilidad";
        $datos = [
            'id' => $id,
            'fecha' => $fecha
        ];
        $data = [
            'http' => [
                'method' => 'POST',
                'header' => "Content-type: application/x-www-form-urlencoded\r\n" .
                            "Authorization: Bearer $key", // Agrega la clave al encabezado
                'content' => http_build_query($datos),
            ],
        ];
        $contexto = stream_context_create($data);
        // Realiza la solicitud POST
        $response = file_get_contents($url, false, $contexto);
        if ($response !== false) {
            // Almacena la respuesta en una variable
            $resultado = $response;
            return $resultado;
        } else {
            return 'Error al obtener datos de la API.';
        }
    }
}