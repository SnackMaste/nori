<?php
require_once __DIR__. '/../model/session.modelos.php';
require_once __DIR__. '/../auth/session.php';
class Session_Controlador{

    static public function ctr_session_start(){
        //ENVIAMOS LA INFORMACIÓN AL MODELO PARA QUE ME TRAIGA TODOS LOS DATOS DEL USUARIO
        $response = Session_Modelo::mdl_session($_POST['usuario'], $_POST['email']);
        //DECODIFICAMOS LA INFORMACIÓN Y LA ALMACENAMOS EN UNA VARIABLE
        $datos = json_decode($response, true);
        $id_address = $datos['results'][0]['id_address_client'];
        $address = Session_Modelo::mdl_address($id_address);
        $direccion = json_decode($address, true);
        //AHORA VALIDAMOS SI EL TIPO DE USUARIO ES PERSONA O EMPRESA Y CREAMOS UN OBJECTO CON LOS DATOS DEL USUARIO
        if($_POST['usuario'] == "companies"){
            $user = [
                "client" => $_POST['usuario'],
                "name" => $datos['results'][0]['name_company'],
                "identification" => $datos['results'][0]['nit_company'],
                "id" => $datos['results'][0]['id_client_company'],
                "address" => $datos['results'][0]['id_address_client'],
                "phone" => $datos['results'][0]['phone_client'],
                "email" => $datos['results'][0]['email_client'],
                "image" => $datos['results'][0]['image_client'],
                "street_type_address" => $direccion['results'][0]['name_street_type'],
                "name_address" => $direccion['results'][0]['name_address'],
                "number_address" => $direccion['results'][0]['number_address'],
                "neighborhood_address" => $direccion['results'][0]['neighborhood_address'],
                "tower_address" => $direccion['results'][0]['tower_address'],
                "apartment_address" => $direccion['results'][0]['apartment_address'],
                "gate_address" => $direccion['results'][0]['gate_address'],
                "city_address" => $direccion['results'][0]['city_address'],
                "country_address" => $direccion['results'][0]['country_address']
            ];
        }else if($_POST['usuario'] == "persons"){
            $user = [
                "client" => $_POST['usuario'],
                "name" => $datos['results'][0]['first_name_person']." ".$datos['results'][0]['second_name_person']." ".$datos['results'][0]['first_surname_person']." ".$datos['results'][0]['second_surname_person'],
                "identification" => $datos['results'][0]['identification_person'],
                "id" => $datos['results'][0]['id_client_person'],
                "address" => $datos['results'][0]['id_address_client'],
                "phone" => $datos['results'][0]['phone_client'],
                "email" => $datos['results'][0]['email_client'],
                "image" => $datos['results'][0]['image_client'],
                "street_type_address" => $direccion['results'][0]['name_street_type'],
                "name_address" => $direccion['results'][0]['name_address'],
                "number_address" => $direccion['results'][0]['number_address'],
                "neighborhood_address" => $direccion['results'][0]['neighborhood_address'],
                "tower_address" => $direccion['results'][0]['tower_address'],
                "apartment_address" => $direccion['results'][0]['apartment_address'],
                "gate_address" => $direccion['results'][0]['gate_address'],
                "city_address" => $direccion['results'][0]['city_address'],
                "country_address" => $direccion['results'][0]['country_address']
            ];
        };
        //CREAMOS UNA INSTANCIA DE SessionUser Y CREAMOS LA SESIÓN CON LA INFORMACIÓN DE ESE USUARIO 
        $userSession = new SessionUser();
        $userSession->setCurrentUser($user);
        //FINALMENTE DEVOLVEMOS UN ESTADO DE RESPUESTA A LA SOLICITUD
        return "session_start";
    }

    //FUNCIÓN QUE CIERRA LA SESIÓN
    static public function ctr_session_finish(){
        $userSession = new SessionUser();
        $userSession->closeSession();
        return "session_finish";
    }
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if($_POST['request'] == 'start'){
        $respuesta = Session_Controlador::ctr_session_start();
        print_r($respuesta); 
        //$respuesta;
    }else if($_POST['request'] == 'finish'){
        $respuesta = Session_Controlador::ctr_session_finish();
        echo $respuesta;
    };
}