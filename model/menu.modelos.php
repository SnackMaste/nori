<?php
require_once __DIR__. '/../vendor/autoload.php';
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
$uri = $_ENV['API_URI'];
$key = $_ENV['KEY_API'];
class Menu_modelos{
    static public function mdl_menu($id){
        global $uri,$key;
        $url= $uri."products,menus?select=*&&linkTo=id_product_menu,id_restaurant_menu&&equalTo=id_product|$id&join=1&where=1";
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

    static public function mdl_pais($id){
        global $uri,$key;
        $url = $uri."addresses,restaurants?select=country_address&&linkTo=id_address_restaurant,id_address_restaurant&&equalTo=id_address|$id&join=1&where=1";
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