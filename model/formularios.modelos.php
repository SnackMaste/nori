<?php
require_once __DIR__. '/../vendor/autoload.php';
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
$uri = $_ENV['API_URI'];
$key = $_ENV['KEY_API'];
class Formularios_Modelos{
    static public function mdlValidar($table, $field, $value){
        global $uri,$key;
        $url = $uri."CALL?procedure=sp_validar";
        $datos = [
            'tabla' => $table,
            'campo' => $field,
            'valor'=> $value
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

    static public function mdlCorreo($email, $table){
        global $uri,$key;
        $url = $uri."CALL?procedure=verificar_cliente";
        $datos = [
            'email' => $email,
            'tabla' => $table
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

    static public function mdlRegistro($data){
        global $uri,$key;
        $url = $uri."CALL?procedure=SpIngresoCliente";
        $datos = [
            'cliente' => $data['usuario'],
            'nombre1' => $data['nombre1'],
            'nombre2' => $data['nombre2'],
            'apellido1' => $data['apellido1'],
            'apellido2' => $data['apellido2'],
            'identificacion' => $data['identificacion'],
            'telefono' => $data['telefono'],
            'vEmail' => $data['vEmail'],
            'vPass' => $data['vPass'],
            'tipo_calle' => $data['tipo_calle'],
            'name_calle' => $data['name_calle'],
            'number_calle' => $data['number_calle'],
            'barrio' => $data['barrio'],
            'torre' => $data['torre'],
            'piso' => $data['piso'],
            'puerta' => $data['puerta'],
            'ciudad' => $data['ciudad'],
            'pais' => $data['pais']
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

    static public function mdlContraseña($value, $email){
        global $uri,$key;
        $url = $uri."CALL?procedure=VerificarContrasena";
        $datos = [
            'email' => $email
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
            $data = json_decode($response, true);
            $respuesta = $data['results']['comment'][0]['response'];
            if (password_verify($value, $respuesta)) {
                // Las contraseñas coinciden
                return 'Coincide';
            } else {
                // Las contraseñas no coinciden
                return 'No coincide';
            }
        } else {
            return 'Error al obtener datos de la API.';
        }
    }
}