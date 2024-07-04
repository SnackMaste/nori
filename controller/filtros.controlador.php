<?php 
require_once __DIR__. '/../model/filtros.modelos.php';
class Filtros_Controlador{

    static public function ctr_pais($tipo){
        if($tipo == 'restaurant'){
            $pais = Filtros_Modelos::mdl_pais();
            $response = new Filtros_Controlador();
            $response->ctr_response($pais, "country_address", "Seleccione un país", "no", null);
        }else if($tipo == 'address'){
            $pais = Filtros_Modelos::mdl_pais_address();
            $response = new Filtros_Controlador();
            $response->ctr_response($pais, "country_address", "País", "no", null);
        }
    }
    static public function ctr_ciudad(){
        if($_POST['lugar'] == 'restaurante'){
            $ciudad = Filtros_Modelos::mdl_ciudad($_POST['pais']);
            $response = new Filtros_Controlador();
            $response->ctr_response($ciudad, "city_address", "Seleccione una ciudad", "no", null);
        }else if($_POST['lugar'] == 'registro'){
            $ciudad = Filtros_Modelos::mdl_ciudad_address($_POST['pais']);
            $response = new Filtros_Controlador();
            $response->ctr_response($ciudad, "city_address", "Ciudad", "no", null);
        }
    }
    static public function ctr_tipo_calle(){
        $calle = Filtros_Modelos::mdl_tipo_calle();
        $response = new Filtros_Controlador();
        $response->ctr_response($calle, "name_street_type","Seleccione una tipo de calle","si","id_street_type");
    }
    static public function ctr_restaurante($ciudad){
        $restaurante = Filtros_Modelos::mdl_restaurante($ciudad);
        return $restaurante;
    }
    static public function ctr_tipo_producto(){
        $tipo = Filtros_Modelos::mdl_tipo_producto();
        $response = new Filtros_Controlador();
        $response->ctr_response($tipo, "name_type_product","Tipo de producto","si","id_type_product");
    }

    static public function ctr_response($response, $columna, $default, $id, $columna2){

        if ($response !== false) {
            $data = json_decode($response, true);
            $opciones='<option value="" selected ><span class="FontParrafo">'.$default.'</span></option>';
            if($id == "si"){
                foreach($data["results"] as $result){
                    //CONCATENAMOS CADA ARRAY CON SUS VALORES
                    $ids = $result[$columna2];
                    $valor = $result[$columna];
                    $opciones .= '<option value="' . $ids . '" class="FontParrafo">' . $valor . '</option>';
                }
                echo $opciones;
            }else if($id == "no"){
                foreach($data["results"] as $result){
                    //CONCATENAMOS CADA ARRAY CON SUS VALORES
                    $valor = $result[$columna];
                    $opciones .= '<option value="' . $valor . '" class="FontParrafo">' . $valor . '</option>';
                }
                echo $opciones;
            }else {
                echo 'Error al obtener datos de la API.';
            }
        }
    }
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_POST['pais'])) {
        $solicitud = new Filtros_Controlador();
        $solicitud -> ctr_ciudad();
        return $solicitud;
    };
    if($_POST['local'] == "reserva") {
        $solicitud = new Filtros_Controlador();
        $response = $solicitud -> ctr_restaurante($_POST['ciudad']);
        $data = json_decode($response, true);
        $opciones='<option value="" selected ><span class="FontParrafo">Seleccione un restaurante</span></option>';
        foreach($data["results"] as $result){
            //CONCATENAMOS CADA ARRAY CON SUS VALORES
            $opciones .= '<option value="' . $result['id_restaurant'] . '" class="FontParrafo">'.$result['name_street_type'].' '.$result['name_address'].' # '.$result['number_address'].' '.$result['neighborhood_address'].'</option>';
        };
        echo $opciones;
    };
}