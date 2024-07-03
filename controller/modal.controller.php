<?php
require_once __DIR__. '/../model/modal.modelos.php';

class Modal_Controller{
    static public function detalle($data){
        $estructura = Modal_Model::mdl_detalle($data);
        return $estructura;
    } 
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if($_POST['modal'] == "detalle"){
        $solicitud = Modal_Controller::detalle($_POST);
        echo $solicitud;
    }else{
        return;
    }
}