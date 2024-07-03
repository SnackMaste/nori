<?php 
require_once "./controller/filtros.controlador.php";
require_once "./controller/plantillas.controlador.php";
$plantilla = new Plantillas_Controlador();
$plantilla -> cargarPlantillas();
