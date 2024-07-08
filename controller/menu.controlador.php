<?php
require_once __DIR__. '/../model/menu.modelos.php';

class Menu_Controlador {

    public static function ctr_menu($id) {
        $solicitud = new Menu_Modelos();
        $menu = $solicitud -> mdl_menu($id);
        $pais = $solicitud -> mdl_pais($id);
        $estructura = new Menu_Controlador();
        $respuesta = $estructura -> ctr_respuesta($menu, $pais);
        return $respuesta;
    }

    public static function ctr_respuesta($menu, $pais) {
        $respuesta = "";
        $data = json_decode($menu, true);
        $dataPais = json_decode($pais, true);
        $pais = $dataPais['results'][0]['country_address'];
        if($pais == "COLOMBIA"){$moneda = "COP";};
        if($pais == "VENEZUELA"){$moneda = "VES";};
        if($pais == "ECUADOR"){$moneda = "USD";};
        if($pais == "CHILE"){$moneda = "CLP";};
        if($pais == "PERÚ"){$moneda = "PEN";};
        foreach($data["results"] as $result){
            if($moneda == "CLP"){$pecioFormateado = number_format($result['price_product_chile'], 0, '', '.');$precio=$result['price_product_chile'];};
            if($moneda == "COP"){$pecioFormateado = number_format($result['price_product_colombia'], 0, '', '.');$precio=$result['price_product_colombia'];};
            if($moneda == "USD"){$pecioFormateado = number_format($result['price_product_ecuador'],2,',','.');$precio=$result['price_product_ecuador'];};
            if($moneda == "VES"){$pecioFormateado = number_format($result['price_product_venezuela'],2,',','.');$precio=$result['price_product_venezuela'];};
            if($moneda == "PEN"){$pecioFormateado = number_format($result['price_product_peru'],2,',','.');$precio=$result['price_product_peru'];};
            $respuesta .= '<div class="d-flex flex-column border border-3 border-warning rounded-3 my-2 mx-4 align-items-center justify-content-around" style="width: 200px;" data-name="'.$result["name_product"].'" data-tipo="'.$result["id_type_product_product"].'">
                <img src="./images/products/'.strtolower($result["image_product"]).'" alt="" class="p-2 rounded-5 " style="width: 190px;" >
                <div class="w-100 text-center border-img-t" id="1">
                    <div class="d-flex justify-content-around">
                        <div class="w-50 py-1" style="border-right: solid 0.25vh;border-image: linear-gradient(90deg, rgba(188,87,47,1) 0%, #e98f25 26%, rgba(227,207,127,1) 48%, rgba(233,143,37,1) 80%, rgba(188,87,47,1) 100%)1;">
                            <button class="bg-black border-0" data-bs-toggle="modal" data-bs-target="#detalle" data-name-m="'.$result["name_product"].'" data-description-m="'.$result["description_product"].'" data-img-m="'.$result["image_product"].'" onclick="detalle(this)">
                                <span class="FontAni Detalle">DETALLE</span>
                            </button>
                        </div>
                        <div class="w-50 py-1" style="border-left: solid 0.25vh;border-image: linear-gradient(90deg, rgba(188,87,47,1) 0%, #e98f25 26%, rgba(227,207,127,1) 48%, rgba(233,143,37,1) 80%, rgba(188,87,47,1) 100%)1;">
                            <button class="bg-black border-0" data-añadir="'.$result["id_product"].'" data-precio="'.$precio.'" data-moneda="'.$moneda.'" data-id="'.$result["id_product"].'">
                                <span class="FontAni">AÑADIR</span>
                            </button>
                        </div>
                    </div>
                    <div class="border-img-t ">
                        <div class="py-1">
                            <span class="FontPrimary fs-6">'.$result["name_product"].'</span>
                        </div>
                    </div>
                    <div class="border-img-t ">
                        <div class="py-1">
                            <span class="FontPrimary">$ '.$pecioFormateado.' '.$moneda.'</span>
                        </div>
                    </div>
                </div>
            </div>';
        }
        return $respuesta;
    }
}