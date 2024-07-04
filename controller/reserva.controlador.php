<?php 
require_once __DIR__. '/../model/reserva.modelos.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if($_POST['solicitud'] == 'disponibilidad'){
        $solicitud = Reserva_Controller::ctr_disponibilidad($_POST['id'],$_POST['fecha']);
        $data = json_decode($solicitud,true);
        $options = '<option class="FontParrafo">Seleccione una hora</option>';
        for ($i=0; $i<count($data["results"]['comment']); $i++){
            $options .= '<option>'.$data["results"]['comment'][$i]['Hora'].'</option>';
        }
        echo $options;
    }
}

class Reserva_Controller{

    static public function ctr_disponibilidad($id, $fecha){
        $solicitud = Reserva_Modelo::mdl_disponibilidad($id,$fecha);
        return $solicitud;
    }
}