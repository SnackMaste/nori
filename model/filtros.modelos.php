<?php
require_once __DIR__. '/../vendor/autoload.php';
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
$uri = $_ENV['API_URI'];
$key = $_ENV['KEY_API'];
class Filtros_Modelos{
    //País restaurantes
    static public function mdl_pais(){
        global $uri,$key;
        $url = $uri."addresses,restaurants?select=country_address&&linkTo=id_address_restaurant&&equalTo=id_address&&orderBy=country_address&&orderMode=ASC&&join=1&&distinc=1&&where=0";
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
    //país direcciones
    static public function mdl_pais_address(){
        global $uri,$key;
        $url = $uri."addresses?select=country_address&&distinc=1&&orderBy=country_address&&orderMode=ASC&&where=0";
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
    //ciudades de restaurantes
    static public function mdl_ciudad($pais){
        global $uri,$key;
        $pais = urlencode($pais);
        $url = $uri."addresses,restaurants?select=city_address&&linkTo=id_address_restaurant,country_address&&equalTo=id_address|$pais&&orderBy=city_address&&orderMode=ASC&&join=1&&distinc=1&&where=0";
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
    }
    //Ciudades de direcciones
    static public function mdl_ciudad_address($pais){
        global $uri,$key;
        $pais = urlencode($pais);
        $url = $uri."addresses?select=city_address&&linkTo=country_address&&equalTo=$pais&&orderBy=city_address&&orderMode=ASC&&distinc=1&&where=0";
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
    }
    //Nombres de tipos de calles
    static public function mdl_tipo_calle(){
        global $uri,$key;
        $url = $uri."street_types?select=name_street_type,id_street_type";
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
    }
    static public function mdl_tipo_producto(){
        global $uri,$key;
        $url = $uri."type_products?select=name_type_product,id_type_product&&orderBy=name_type_product&&orderMode=ASC";
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
    }
    static public function mdl_restaurante($ciudad){
        global $uri,$key;
        $ciudad = urlencode($ciudad);
        $url = $uri."addresses,restaurants,street_types?select=*,restaurants.*,street_types.name_street_type&&linkTo=id_address_restaurant,city_address,id_street_type_address&&equalTo=id_address|$ciudad|id_street_type&&join=2";
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
    }
}