<?php 
require_once '../config/conexion.php';
$db = Database::getInstance();
$conn = $db->getConnection();


$ciudad = $_POST['ciudad'];

$consultaDireccion = $conn->prepare('SELECT *, 
TO_CHAR(restaurante.Horario_Apertura, \'HH24:MI\') as Horario_Apertura_Formateado, 
TO_CHAR(restaurante.Horario_Cierre, \'HH24:MI\') as Horario_Cierre_Formateado,
tipo_calle.Nombre_Tipo_Calle
FROM restaurante
JOIN direccion ON restaurante.Direccion_Restaurante = direccion.Id_Direccion AND direccion.Ciudad = :ciudad
JOIN tipo_calle ON direccion.Id_Tipo_Calle = tipo_calle.Id_Tipo_Calle');
$consultaDireccion->execute(array(':ciudad'=>$ciudad));
$respuestaFichaR = "";

while ($row = $consultaDireccion->fetch(PDO::FETCH_ASSOC)) {
    $idRestaurante = $row['Id_Restaurante'];
    $idDireccion = $row["Id_Direccion"];
    $tipoCalle =  $row['Nombre_Tipo_Calle'];
    $calle = $row['Nombre_Calle'];
    $nCalle = $row['Numero_Calle'];
    $barrio =  $row['Barrio'];
    $ciudadR = $row['Ciudad'];
    $paisR =  $row['Pais'];
    $telefonoR =  $row['Telefono_Restaurante'];
    $aperturaR = $row['Horario_Apertura_Formateado'];
    $cierreR = $row['Horario_Cierre_Formateado'];
    $imagenR =  $row['Imagen_Restaurante'];
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
    } else {
        $estado ='CERRADO';
    }
    $respuestaFichaR .= '<div class="Restaurantes">
    <img src="'.$imagenR.'" alt="" class="ImgRestaurante">
    <div class="InfoRestaurante FontPrimary">
        <h1 class="FontSize8">'. $tipoCalle .' '.$calle.' # '.$nCalle.' '.$barrio.', '.$ciudadR.', '.$paisR.'<!--, '. $hora_actual->format('Y-m-d H:i:s').'--></h1>
        <div class="TelefonoRestaurante">
            <img src="../Atoms/Icons/telefono.png" alt="" class="IconTelefonoR">
            <h2 class="FontSize5">'.$telefonoR.'</h2>
        </div>
        <div class="HorarioContenedor">
            <h2 class="FontSize6">Horario De Atencion</h2>
            <h2 class="FontSize5">'.$aperturaR.' - '.$cierreR.'</h2>
        </div>
    </div>
    <div class="BtnRestaurante">
        <button class="BtnMenu" data-id="'.$idRestaurante.'"><span class="FontAni">Ver Menú</span></button>
        <div class="'.$estado.'">'.$estado.'</div>
        <button class="BtnEstrellasRestaurante">
            <svg id="estrella1" xmlns="http://www.w3.org/2000/svg" viewBox="0 -40 200 200">
                <path class="cls-1" d="m88.06,3.92l20.42,41.38c.64,1.31,1.89,2.21,3.33,2.42l45.66,6.64c5.77.84,8.07,7.93,3.9,12l-33.04,32.21c-1.04,1.02-1.52,2.48-1.27,3.92l7.8,45.48c.99,5.75-5.05,10.13-10.21,7.41l-40.84-21.47c-1.29-.68-2.83-.68-4.12,0l-40.84,21.47c-5.16,2.71-11.19-1.67-10.21-7.41l7.8-45.48c.25-1.43-.23-2.9-1.27-3.92L2.13,66.35c-4.17-4.07-1.87-11.16,3.9-12l45.66-6.64c1.44-.21,2.69-1.11,3.33-2.42L75.45,3.92c2.58-5.23,10.03-5.23,12.61,0Z"/>
            </svg>
            <svg id="estrella2" xmlns="http://www.w3.org/2000/svg" viewBox="0 -40 200 200">
                <path class="cls-1" d="m88.06,3.92l20.42,41.38c.64,1.31,1.89,2.21,3.33,2.42l45.66,6.64c5.77.84,8.07,7.93,3.9,12l-33.04,32.21c-1.04,1.02-1.52,2.48-1.27,3.92l7.8,45.48c.99,5.75-5.05,10.13-10.21,7.41l-40.84-21.47c-1.29-.68-2.83-.68-4.12,0l-40.84,21.47c-5.16,2.71-11.19-1.67-10.21-7.41l7.8-45.48c.25-1.43-.23-2.9-1.27-3.92L2.13,66.35c-4.17-4.07-1.87-11.16,3.9-12l45.66-6.64c1.44-.21,2.69-1.11,3.33-2.42L75.45,3.92c2.58-5.23,10.03-5.23,12.61,0Z"/>
            </svg>
            <svg id="estrella3" xmlns="http://www.w3.org/2000/svg" viewBox="0 -40 200 200">
                <path class="cls-1" d="m88.06,3.92l20.42,41.38c.64,1.31,1.89,2.21,3.33,2.42l45.66,6.64c5.77.84,8.07,7.93,3.9,12l-33.04,32.21c-1.04,1.02-1.52,2.48-1.27,3.92l7.8,45.48c.99,5.75-5.05,10.13-10.21,7.41l-40.84-21.47c-1.29-.68-2.83-.68-4.12,0l-40.84,21.47c-5.16,2.71-11.19-1.67-10.21-7.41l7.8-45.48c.25-1.43-.23-2.9-1.27-3.92L2.13,66.35c-4.17-4.07-1.87-11.16,3.9-12l45.66-6.64c1.44-.21,2.69-1.11,3.33-2.42L75.45,3.92c2.58-5.23,10.03-5.23,12.61,0Z"/>
            </svg>
            <svg id="estrella4" xmlns="http://www.w3.org/2000/svg" viewBox="0 -40 200 200">
                <path class="cls-1" d="m88.06,3.92l20.42,41.38c.64,1.31,1.89,2.21,3.33,2.42l45.66,6.64c5.77.84,8.07,7.93,3.9,12l-33.04,32.21c-1.04,1.02-1.52,2.48-1.27,3.92l7.8,45.48c.99,5.75-5.05,10.13-10.21,7.41l-40.84-21.47c-1.29-.68-2.83-.68-4.12,0l-40.84,21.47c-5.16,2.71-11.19-1.67-10.21-7.41l7.8-45.48c.25-1.43-.23-2.9-1.27-3.92L2.13,66.35c-4.17-4.07-1.87-11.16,3.9-12l45.66-6.64c1.44-.21,2.69-1.11,3.33-2.42L75.45,3.92c2.58-5.23,10.03-5.23,12.61,0Z"/>
            </svg>
            <svg id="estrella5" xmlns="http://www.w3.org/2000/svg" viewBox="0 -40 200 200">
                <path class="cls-1" d="m88.06,3.92l20.42,41.38c.64,1.31,1.89,2.21,3.33,2.42l45.66,6.64c5.77.84,8.07,7.93,3.9,12l-33.04,32.21c-1.04,1.02-1.52,2.48-1.27,3.92l7.8,45.48c.99,5.75-5.05,10.13-10.21,7.41l-40.84-21.47c-1.29-.68-2.83-.68-4.12,0l-40.84,21.47c-5.16,2.71-11.19-1.67-10.21-7.41l7.8-45.48c.25-1.43-.23-2.9-1.27-3.92L2.13,66.35c-4.17-4.07-1.87-11.16,3.9-12l45.66-6.64c1.44-.21,2.69-1.11,3.33-2.42L75.45,3.92c2.58-5.23,10.03-5.23,12.61,0Z"/>
            </svg>
        </button>
    </div>
</div>';
}

echo json_encode($respuestaFichaR, JSON_UNESCAPED_UNICODE);
date_default_timezone_set('America/Bogota');

