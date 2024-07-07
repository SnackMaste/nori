<?php
require_once __DIR__. '/../model/perfil.modelos.php';
require_once __DIR__.'/../auth/session.php';

if($_SERVER['REQUEST_METHOD'] == "POST") {
    if($_POST['solicitud'] == 'imagen'){
        $respuesta = Perfil_Controlador::ctr_imagen($_POST['imagen']);
        echo $respuesta;
    }else if($_POST['solicitud'] == 'ActualizarCliente'){
        $respuesta = Perfil_Controlador::ctr_datosCliente();
        echo $respuesta;
    }else if($_POST['solicitud'] == 'ActualizarEmail'){
        $respuesta = Perfil_Controlador::ctr_newEmail($_POST['email']);
        echo $respuesta;
    }else if($_POST['solicitud'] == 'ActualizarPass'){
        $respuesta = Perfil_Controlador::ctr_newPass($_POST['pass']);
        echo $respuesta;
    }else if($_POST['solicitud'] == 'ActualizarDire'){
        $respuesta = Perfil_Controlador::ctr_newDire($_POST);
        echo $respuesta;
    }else if($_POST['solicitud'] == 'Eliminar'){
        $respuesta = Perfil_Controlador::ctr_eliminar();
        echo $respuesta;
    }
}

class Perfil_Controlador{

    //CONTROLADOR QUE ACTUALIZA LA IMAGEN DE USUARIO
    static public function ctr_imagen($img) {
        $userSession = new SessionUser();
        $user = $userSession->getCurrentUser();
        $dataImg = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $img));
        $extenImg ="";
        if (preg_match('/^data:image\/(jpeg|jpg|png|webp);base64,/', $img, $matches)) {
            $extenImg = $matches[1];
        }
        $idUser = $user['id'];
        $nombreBase = 'imagen_user_' . $idUser;
        $rutaBase = "../images/users/$nombreBase";
        $extensiones = ['.png', '.jpg', '.jpeg'];
        // Buscar archivos con el nombre base (sin extensión)
        foreach ($extensiones as $extension) {
            $rutaArchivo = $rutaBase . $extension;
            if (file_exists($rutaArchivo)) {
            // Eliminar el archivo existente
            unlink($rutaArchivo);
            break;
            } // Salir del bucle después de borrar el primer archivo
        }
        $nombreImg = $nombreBase.'.'.$extenImg;
        $pathImg = $rutaBase.'.'.$extenImg;
        file_put_contents($pathImg, $dataImg);
        if(file_exists($pathImg)) {
            $respuesta = Perfil_Modelos::mdl_Imagen($nombreImg, $idUser);
            if($respuesta == 'Error al obtener datos de la API.'){
                unlink($pathImg);
                return "error db";
            }else if($respuesta == 'The process was successful'){
                $user['image'] = $nombreImg;
                $userSession->setCurrentUser($user);
                return "almacenada";
            }
        }else{
            return "error";
        }
    }

    //CONTROLADOR QUE ACTUALIZA LOS DATOS PERSONALES O DE LA EMPRESA DEL CLIENTE
    static public function ctr_datosCliente(){
        $userSession = new SessionUser();
        $user = $userSession->getCurrentUser();
        $response1="";
        if($_POST['client'] == 'persons'){
            $response1 = Perfil_Modelos::mdl_persons($user['id'],$_POST['name1'],$_POST['name2'],$_POST['apellido1'],$_POST['apellido2'],$_POST['identificacion']);
        }else if($_POST['client'] == 'companies'){
            $response1 = Perfil_Modelos::mdl_companies($user['id'],$_POST['name'],$_POST['identificacion']);
        }
        $response2 = Perfil_Modelos::mdl_datosCliente($user['id'],$_POST['telefono']);
        if($response1 == "ok" && $response2 == "ok"){
            if($_POST['client'] == "companies"){
                $user['name'] = $_POST['name'];
                $user['phone'] = $_POST['telefono'];
                $user['identification'] = $_POST['identificacion'];
                $userSession->setCurrentUser($user);
                return "ok";
            }else if($_POST['client'] == "persons"){};
                $user['name'] = $_POST['name1']." ".$_POST['name2']." ".$_POST['apellido1']." ".$_POST['apellido2'];
                $user['phone'] = $_POST['telefono'];
                $user['identification'] = $_POST['identificacion'];
                $userSession->setCurrentUser($user);
                return "ok";
        }else{
            return $response1." ".$response2;
        };
    }

    //------------ CONTROLADOR DE ACTUALIZACIÓN DE EMAIL -------------//
    static public function ctr_newEmail($email){
        $userSession = new SessionUser();
        $user = $userSession->getCurrentUser();
        $response = Perfil_Modelos::mdl_newEmail($user["id"],$email);
        if($response == "ok"){
            $user['email'] = $_POST['email'];
            $userSession->setCurrentUser($user);
            return "ok";
        }else{
            return $response;
        };
    }
    
    //------------ CONTROLADOR DE ACTUALIZACIÓN DE CONTRASEÑA -------------//
    static public function ctr_newPass($pass){
        $userSession = new SessionUser();
        $user = $userSession->getCurrentUser();
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        $response = Perfil_Modelos::mdl_newPass($user["id"],$pass);
        if($response == "ok"){
            return "ok";
        }else{
            return $response;
        };
    }

    //------------ CONTROLADOR DE ACTUALIZACIÓN DE DIRECCIÓN -------------//
    static public function ctr_newDire($data){
        $userSession = new SessionUser();
        $user = $userSession->getCurrentUser();
        $response = Perfil_Modelos::mdl_newDire($user["id"],$data);
        $tipo_calle = Perfil_Modelos::mdl_TipoCalle($_POST['tipo_calle']);
        if($response == "ok"){
            $user["street_type_address"] = $tipo_calle;
            $user["name_address"] = $_POST['name_calle'];
            $user["number_address"] = $_POST['number_calle'];
            $user["neighborhood_address"] = $_POST['barrio'];
            $user["tower_address"] = $_POST['torre'];
            $user["apartment_address"] = $_POST['piso'];
            $user["gate_address"] = $_POST['puerta'];
            $user["city_address"] = $_POST['ciudad'];
            $user["country_address"] = $_POST['pais'];
            $userSession->setCurrentUser($user);
            return "ok";
        }else{
            return $response;
        };
    }

    //------------- CONTROLADOR PARA ELIMINAR LA CUENTA ------------//
    static public function ctr_eliminar(){
        $userSession = new SessionUser();
        $user = $userSession->getCurrentUser();
        $response = Perfil_Modelos::mdl_eliminar($user['id'],$user['client']);
        if($response == "ok"){
            if($user['image'] == "default.avif"){
                $userSession->closeSession();
                return "ok";
            }else{
                unlink("../images/users/".$user['image']);
                $userSession->closeSession();
                return "ok";
            }
        }else{
            return $response;
        }
    }
}