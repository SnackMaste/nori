<?php
require_once __DIR__. '/../vendor/autoload.php';
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
$uri = $_ENV['API_URI'];
$key = $_ENV['KEY_API'];
class Session_Modelo {

    static public function mdl_session($user, $email){
        if($user == "companies"){
            $datos = "id_client_company,$user.nit_company,$user.name_company";
            $columna = "id_client_company";
        }else if($user == "persons"){
            $datos = "id_client_person,$user.identification_person,$user.first_name_person,$user.second_name_person,$user.first_surname_person,$user.second_surname_person";
            $columna = "id_client_person";
        }
        global $uri,$key;
        $url= $uri."$user,clients?select=$datos,clients.id_address_client,clients.phone_client,clients.email_client,clients.image_client&&linkTo=id_client,email_client&&equalTo=$columna|'$email'&join=1&where=1";
        $data = [
            'http' => [
                'method' => 'GET',
                'header' => "Authorization: Bearer $key", // Agrega la clave al encabezado
            ],
        ];
        $context = stream_context_create($data);
        $response = file_get_contents($url, false, $context);
        if ($response !== false) {
            return $response;
        }else {
            echo 'Error al obtener datos de la API.';
        }
        return $response;
    }
}