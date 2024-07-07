<?php
require_once __DIR__. '/../vendor/autoload.php';
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
$uri = $_ENV['API_URI'];
$key = $_ENV['KEY_API'];

class Perfil_Modelos {
    //MODELO DE ACTUALIZACIÓN DE IMAGEN DE PERFIL
    static public function mdl_Imagen($img, $id){
        global $uri, $key;
        $url = $uri."clients?id=$id&nameid=id_client";
        $datos = [
            "image_client" => $img
        ];
        $data = [
            'http' => [
                'method' => 'PUT',
                'header' => "Content-type: application/x-www-form-urlencoded\r\n" .
                            "Authorization: Bearer $key",
                'content' => http_build_query($datos),
            ],
        ];
        $context = stream_context_create($data);
        $response = file_get_contents($url, false, $context);
        if ($response !== false) {
            $respuesta = json_decode($response, true);
            $respuesta = $respuesta['results']['comment'];
            return $respuesta;
        }else {
            return 'Error al obtener datos de la API.';
        }
    }

    //MODELO DE ACTUALIZACIÓN DE DATOS DE LOS CLIENTES TIPO PERSONS
    static public function mdl_persons($id,$name1,$name2,$apellido1,$apellido2,$identificacion){
        global $uri, $key;
        $url = $uri."persons?id=$id&nameid=id_client_person";
        $datos = [
            "first_name_person"=> $name1,
            "second_name_person"=> $name2,
            "first_surname_person"=> $apellido1,
            "second_surname_person"=> $apellido2,
            "identification_person"=> $identificacion
        ];
        $data = [
            'http' => [
                'method' => 'PUT',
                'header' => "Content-type: application/x-www-form-urlencoded\r\n" .
                            "Authorization: Bearer $key",
                'content' => http_build_query($datos),
            ],
        ];
        $context = stream_context_create($data);
        $response = file_get_contents($url, false, $context);
        if ($response !== false) {
            $respuesta = json_decode($response, true);
            $respuesta = $respuesta['results']['comment'];
            if($respuesta == "The process was successful"){
                return "ok";
            }else{
            return $respuesta;
            }
        }else {
            return 'Error al obtener datos de la API.';
        }
    }

    //MODELO DE ACTUALIZACIÓN DE DATOS DE LOS CLIENTES TIPO PERSONS
    static public function mdl_companies($id,$name,$identificacion){
        global $uri, $key;
        $url = $uri."companies?id=$id&nameid=id_client_company";
        $datos = [
            "name_company"=> $name,
            "nit_company"=> $identificacion
        ];
        $data = [
            'http' => [
                'method' => 'PUT',
                'header' => "Content-type: application/x-www-form-urlencoded\r\n" .
                            "Authorization: Bearer $key",
                'content' => http_build_query($datos),
            ],
        ];
        $context = stream_context_create($data);
        $response = file_get_contents($url, false, $context);
        if ($response !== false) {
            $respuesta = json_decode($response, true);
            $respuesta = $respuesta['results']['comment'];
            if($respuesta == "The process was successful"){
                return "ok";
            }else{
            return $respuesta;
            }
        }else {
            return 'Error al obtener datos de la API.';
        }
    }

    //MODELO DE ACTUALIZACIÓN DE DATOS DE LOS CLIENTES TIPO PERSONS
    static public function mdl_datosCliente($id,$telefono){
        global $uri, $key;
        $url = $uri."clients?id=$id&nameid=id_client";
        $datos = [
            "phone_client"=> $telefono
        ];
        $data = [
            'http' => [
                'method' => 'PUT',
                'header' => "Content-type: application/x-www-form-urlencoded\r\n" .
                            "Authorization: Bearer $key",
                'content' => http_build_query($datos),
            ],
        ];
        $context = stream_context_create($data);
        $response = file_get_contents($url, false, $context);
        if ($response !== false) {
            $respuesta = json_decode($response, true);
            $respuesta = $respuesta['results']['comment'];
            if($respuesta == "The process was successful"){
                return "ok";
            }else{
                return $respuesta;
            }
        }else {
            return 'Error al obtener datos de la API.';
        }
    }

    //----------- MODELO DE ACTUALIZACIÓN DE EMAIL ----------//
    static public function mdl_newEmail($id,$email){
        global $uri, $key;
        $url = $uri."clients?id=$id&nameid=id_client";
        $datos = [
            "email_client"=> $email
        ];
        $data = [
            'http' => [
                'method' => 'PUT',
                'header' => "Content-type: application/x-www-form-urlencoded\r\n" .
                            "Authorization: Bearer $key",
                'content' => http_build_query($datos),
            ],
        ];
        $context = stream_context_create($data);
        $response = file_get_contents($url, false, $context);
        if ($response !== false) {
            $respuesta = json_decode($response, true);
            $respuesta = $respuesta['results']['comment'];
            if($respuesta == "The process was successful"){
                return "ok";
            }else{
                return $respuesta;
            }
        }else {
            return 'Error al obtener datos de la API.';
        }
    }

    //----------- MODELO DE ACTUALIZACIÓN DE CONTRASEÑA ----------//
    static public function mdl_newPass($id,$pass){
        global $uri, $key;
        $url = $uri."clients?id=$id&nameid=id_client";
        $datos = [
            "password_client"=> $pass
        ];
        $data = [
            'http' => [
                'method' => 'PUT',
                'header' => "Content-type: application/x-www-form-urlencoded\r\n" .
                            "Authorization: Bearer $key",
                'content' => http_build_query($datos),
            ],
        ];
        $context = stream_context_create($data);
        $response = file_get_contents($url, false, $context);
        if ($response !== false) {
            $respuesta = json_decode($response, true);
            $respuesta = $respuesta['results']['comment'];
            if($respuesta == "The process was successful"){
                return "ok";
            }else{
                return $respuesta;
            }
        }else {
            return 'Error al obtener datos de la API.';
        }
    }

    //----------- MODELO DE ACTUALIZACIÓN DE DIRECCIÓN ----------//
    static public function mdl_newDire($id,$data){
        global $uri, $key;
        $url = $uri."CALL?procedure=UpdateAddress";
        $datos = [
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
                            "Authorization: Bearer $key",
                'content' => http_build_query($datos),
            ],
        ];
        $context = stream_context_create($data);
        $response = file_get_contents($url, false, $context);
        if ($response !== false) {
            $respuesta = json_decode($response, true);
            $idAddress = $respuesta['results']['comment'][0]['id_direccion'];
            $url2 = $uri."clients?id=$id&nameid=id_client";
            $datos2 = [
                'id_address_client' => $idAddress
            ];
            $data2 = [
                'http' => [
                    'method' => 'PUT',
                    'header' => "Content-type: application/x-www-form-urlencoded\r\n" .
                                "Authorization: Bearer $key",
                    'content' => http_build_query($datos2),
                ],
            ];
            $context2 = stream_context_create($data2);
            $response2 = file_get_contents($url2, false, $context2);
            if ($response2 !== false) {
                $respuesta2 = json_decode($response2, true);
                $respuesta2 = $respuesta2['results']['comment'];
                if($respuesta2 == "The process was successful"){
                    return "ok";
                }else{
                    return $respuesta2;
                }
            }else {
                return 'Error al obtener datos de la API.';
            }
        }else {
            return 'Error al obtener datos de la API.';
        }
    }

    //--------- modelo para obtener el nombre de tipo de calle -----------//
    static public function mdl_TipoCalle($id){
        global $uri, $key;
        $url= $uri."street_types?select=name_street_type&linkTo=id_street_type&equalTo=$id";
        $data = [
            'http' => [
                'method' => 'GET',
                'header' => "Authorization: Bearer $key", // Agrega la clave al encabezado
            ],
        ];
        $context = stream_context_create($data);
        $response = file_get_contents($url, false, $context);
        if ($response !== false) {
            $response = json_decode($response, true);
            $response = $response['results'][0]['name_street_type'];
            return $response;
        }else {
            return 'Error al obtener datos de la API.';
        }
    }

    //--------- modelo para obtener el nombre de tipo de calle
    static public function mdl_eliminar($id,$user){
        global $uri, $key;
        if($user == 'persons'){
            $url = $uri."persons?id=$id&nameid=id_client_person";
        }else if($user == 'companies'){
            $url = $uri."companies?id=$id&nameid=id_client_company";
        }
        $data = [
            'http' => [
                'method' => 'DELETE',
                'header' => "Authorization: Bearer $key", // Agrega la clave al encabezado
            ],
        ];
        $context = stream_context_create($data);
        $response = file_get_contents($url, false, $context);
        if ($response !== false) {
            $respuesta = json_decode($response, true);
            $respuesta = $respuesta['results']['comment'];
            if($respuesta == "The process was successful"){
                $url2 = $uri."clients?id=$id&nameid=id_client";
                $data2 = [
                    'http' => [
                        'method' => 'DELETE',
                        'header' => "Authorization: Bearer $key", // Agrega la clave al encabezado
                    ],
                ];
                $context2 = stream_context_create($data2);
                $response2 = file_get_contents($url2, false, $context2);
                if ($response2 !== false) {
                    $respuesta2 = json_decode($response2, true);
                    $respuesta2 = $respuesta2['results']['comment'];
                    if($respuesta2 == "The process was successful"){
                        return "ok";
                    }else{
                        return $respuesta2;
                    }
                }else{
                    return 'Error al obtener datos de la API. Sección 2';
                }
            }else{
                return $respuesta;
            }
        }else {
            return 'Error al obtener datos de la API.';
        }
    }
}