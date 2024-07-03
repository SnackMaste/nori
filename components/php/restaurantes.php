<?php
require_once __DIR__. '/../../controller/filtros.controlador.php';

if (isset($_POST['ciudad'])){
    $solicitud = new Filtros_Controlador();
    $response = $solicitud -> ctr_restaurante($_POST['ciudad']);
    if ($response !== false) {
        $data = json_decode($response, true);
        $fichas = "";
        foreach ($data["results"] as $row) {
            $idRestaurante = $row['id_restaurant'];
            $tipoCalle =  $row['name_street_type'];
            $calle = $row['name_address'];
            $nCalle = $row['number_address'];
            $barrio =  $row['neighborhood_address'];
            $ciudadR = $row['city_address'];
            $paisR =  $row['country_address'];
            $telefonoR =  $row['phone_restaurant'];
            $aperturaR = substr($row['opening_restaurant'], 0, 5);
            $cierreR = substr($row['closing_restaurant'], 0, 5);
            $imagenR = strtolower($row['image_restaurant']);
            if ($paisR == 'CHILE') {
                date_default_timezone_set('America/Santiago');
            };
            if ($paisR == 'COLOMBIA') {
                date_default_timezone_set('America/Bogota');
            };
            if ($paisR == 'ECUADOR') {
                date_default_timezone_set('America/Guayaquil');
            };
            if ($paisR == 'PERÚ') {
                date_default_timezone_set('America/Lima');
            };
            if ($paisR == 'VENEZUELA') {
                date_default_timezone_set('America/Caracas');
            };
            $hora_actual = new DateTime();
            $hora_apertura = DateTime::createFromFormat('H:i', $aperturaR);
            $hora_cierre = DateTime::createFromFormat('H:i', $cierreR);
            if ($hora_actual >= $hora_apertura && $hora_actual <= $hora_cierre) {
                $estado ='ABIERTO';
                $estado_bg = 'bg-info';
            } else {
                $estado ='CERRADO';
                $estado_bg = 'bg-danger';
            }
            $fichas .= '<!-- pantalla grandes hacia arriba -->
        <div class="container-fluid w-75 bg-black my-5 rounded-4 border border-3 border-warning d-none d-lg-flex align-items-center" style="height: 200px;" >
            <img src="images/restaurants/'.strtolower($imagenR).'" alt="imagen del restaurante" style="width: 10vw; max-width: 170px;" class="rounded-4 border border-3 border-warning">
            <div class="text-center mx-auto" >
                <span class="FontPrimary fs-4">'. $tipoCalle .' '.$calle.' # '.$nCalle.' '.$barrio.', '.$ciudadR.', '.$paisR.'</span>
                <div class="d-flex align-items-center justify-content-center">
                    <img src="images/icons/telefono.avif" alt="teléfono" style="width: 20px;" >
                    <span class="FontPrimary fs-5">'.$telefonoR.'</span>
                </div>
                <div class="d-flex flex-column">
                    <span class="FontPrimary fs-5">Horario De Atención</span>
                    <span class="FontPrimary fs-5">'.$aperturaR.' - '.$cierreR.'</span>
                </div>
            </div>
            <div class="d-flex flex-column mx-5" >
            <button class="rounded-4 border border-3 border-warning bg-success my-2 px-4 mx-auto" data-id="'.$idRestaurante.'" onclick="getMenu(this)" ><span class="FontAni" style="white-space: nowrap;">Ver Menú</span</button>
            <button class="rounded-4 border border-3 border-warning '.$estado_bg.' my-2 px-3 mx-auto" ><span class="FontSecundary">'.$estado.'</span></button>
            </div>
        </div>
        <!-- pantalla mediana -->
        <div class="container-fluid w-75 bg-black my-5 rounded-4 border border-3 border-warning d-none d-md-flex d-lg-none align-items-center" style="height: 200px;" >
            <img src="images/restaurants/'.strtolower($imagenR).'" alt="imagen del restaurante" style="width: 15vw;" class="rounded-4 border border-3 border-warning">
            <div class="text-center mx-auto" >
                <span class="FontPrimary fs-5">'. $tipoCalle .' '.$calle.' # '.$nCalle.' '.$barrio.', '.$ciudadR.', '.$paisR.'</span>
                <div class="d-flex align-items-center justify-content-center">
                    <img src="images/icons/telefono.avif" alt="teléfono"style="width: 20px;" >
                    <span class="FontPrimary fs-6">'.$telefonoR.'</span>
                </div>
                <div class="d-flex flex-column">
                    <span class="FontPrimary fs-6">Horario De Atención</span>
                    <span class="FontPrimary fs-6">'.$aperturaR.' - '.$cierreR.'</span>
                </div>
            </div>
            <div class="d-flex flex-column mx-3" >
            <button class="rounded-4 border border-2 border-warning bg-success my-1 px-4 mx-auto" data-id="'.$idRestaurante.'" onclick="getMenu(this)" ><span class="FontAni fs-6" style="white-space: nowrap;">Ver Menú</span</button>
            <button class="rounded-4 border border-2 border-warning '.$estado_bg.' my-1 px-2 mx-auto" ><span class="FontSecundary fs-6">'.$estado.'</span></button>
            </div>
        </div>
        <!-- pantalla pequeña hacia abajo -->
        <div class="container-fluid bg-black my-5 rounded-4 border border-3 border-warning d-flex d-md-none align-items-center" style="min-height: 200px;width: 95vw;" >
            <img src="images/restaurants/'.strtolower($imagenR).'" alt="imagen del restaurante" style="width: 25vw;" class="rounded-4 border border-3 border-warning">
            <div>
                <div class="text-center mx-auto" >
                    <span class="FontPrimary fs-6">'. $tipoCalle .' '.$calle.' # '.$nCalle.' '.$barrio.', '.$ciudadR.', '.$paisR.'</span>
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="images/icons/telefono.avif" alt="telefono" style="width: 20px;" >
                        <span class="FontPrimary fs-6">'.$telefonoR.'</span>
                    </div>
                    <div class="d-flex flex-column">
                        <span class="FontPrimary fs-6">Horario De Atención</span>
                        <span class="FontPrimary fs-6">'.$aperturaR.' - '.$cierreR.'</span>
                    </div>
                </div>
                <div class="d-flex mx-1" >
                    <button class="rounded-4 border border-2 border-warning bg-success my-1 px-2 mx-auto" data-id="'.$idRestaurante.'" onclick="getMenu(this)" ><span class="FontAni fs-6">Ver Menú</span</button>
                    <button class="rounded-4 border border-2 border-warning '.$estado_bg.' my-1 px-1 mx-auto" ><span class="FontSecundary fs-6">'.$estado.'</span></button>
                </div>
            </div>
        </div>';
        }
        echo $fichas;
    }else {
        echo 'Error al obtener datos de la API.';
    }
}