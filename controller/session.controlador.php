<?php
require_once __DIR__. '/../model/session.modelos.php';
require_once __DIR__. '/../auth/session.php';
class Session_Controlador{

    static public function ctr_session_start(){
        //ENVIAMOS LA INFORMACIÓN AL MODELO PARA QUE ME TRAIGA TODOS LOS DATOS DEL USUARIO
        $response = Session_Modelo::mdl_session($_POST['usuario'], $_POST['email']);
        //DECODIFICAMOS LA INFORMACIÓN Y LA ALMACENAMOS EN UNA VARIABLE
        $datos = json_decode($response, true);
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
                "image" => $datos['results'][0]['image_client']
            ];
        }else if($_POST['usuario'] == "persons"){};
        $user = [
            "client" => $_POST['usuario'],
            "name_1" => $datos['results'][0]['first_name_person'],
            "name_2" => $datos['results'][0]['second_name_person'],
            "surname_1" => $datos['results'][0]['first_surname_person'],
            "surname_2" => $datos['results'][0]['second_surname_person'],
            "identification" => $datos['results'][0]['identification_person'],
            "id" => $datos['results'][0]['id_client_person'],
            "address" => $datos['results'][0]['id_address_client'],
            "phone" => $datos['results'][0]['phone_client'],
            "email" => $datos['results'][0]['email_client'],
            "image" => $datos['results'][0]['image_client']
        ];
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

    //FUNCIÓN DE CONSULTA
    static public function ctr_session_consult(){
        $userSession = new SessionUser();
        $user = $userSession -> getCurrentUser();
    }
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if($_POST['request'] == 'start'){
        $respuesta = Session_Controlador::ctr_session_start();
        echo $respuesta;
    }else if($_POST['request'] == 'finish'){
        $respuesta = Session_Controlador::ctr_session_finish();
        echo $respuesta;
    };
}