<?php
require_once __DIR__. '/../model/formularios.modelos.php';

class FormController{
    static public function ctrRegistro(){
        $_POST['vPass'] = password_hash($_POST['vPass'], PASSWORD_DEFAULT);
        $_POST['telefono'] = $_POST['code_country'].$_POST['telefono'];
        $registro  = Formularios_Modelos::mdlRegistro($_POST);
        $response = new FormController();
        $return = $response->ctr_response($registro);
        return $return;
    }

    static public function ctrValidar($table, $field, $value){
        $validate  = Formularios_Modelos::mdlValidar($table, $field, $value);
        $response = new FormController();
        $return = $response->ctr_response($validate);
        return $return;
    }

    static public function ctrCorreo($value, $table){
        $validate  = Formularios_Modelos::mdlCorreo( $value,$table);
        $response = new FormController();
        $return = $response->ctr_response($validate);
        return $return;
    }

    static public function ctrContraseña($value, $email){
        $validate  = Formularios_Modelos::mdlContraseña($value, $email);
        return $validate;
    }

    static public function ctr_response($response){
        if ($response !== false) {
            $data = json_decode($response, true);
            $respuesta = $data['results']['comment'][0]['response'];
            return $respuesta;
        }else {
            echo 'Error al obtener datos de la API.';
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if($_POST['action'] == 'validate'){
            $solicitud = new FormController();
            $respuesta = $solicitud -> ctrValidar($_POST['table'],$_POST['field'],$_POST['value']);
            echo $respuesta;
        }else if($_POST['action'] == 'registro'){
            $solicitud = new FormController();
            $respuesta = $solicitud -> ctrRegistro();
            echo $respuesta;
        }else if($_POST['action'] == 'contraseña'){
            $solicitud = new FormController();
            $respuesta = $solicitud -> ctrContraseña($_POST['value'], $_POST['email']);
            echo $respuesta;
        }else if($_POST['action'] == 'correo'){
            $solicitud = new FormController();
            $respuesta = $solicitud -> ctrCorreo($_POST['value'],$_POST['table']);
            echo $respuesta;
        }
}