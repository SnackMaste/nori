<?php 
include_once("./controller/menu.controlador.php");
include_once("./controller/filtros.controlador.php");
$dataId = $_GET["id"];
?>
<div class="my-3 py-2 border-img-b d-flex flex-column align-items-center" >
    <h3 class="FontPrimary" >Filtrar los productos</h3>
    <div class="d-flex flex-wrap w-50 justify-content-center align-items-center" >
        <select name="tipo" id="tipo" class="m-2 bg-black text-warning FontParrafo border border-3 border-warning rounded-3" onchange="tipoFiltro()">
            <?php Filtros_Controlador::ctr_tipo_producto() ?>
        </select>
        <input class="m-2 FontParrafo bg-black border border-3 border-warning rounded-3 w-50" style="min-width: 139px;" type="text" id="searchInput" placeholder="Filtrar por nombre">
    </div>
</div>
<div class="d-flex justify-content-center flex-wrap px-5 my-3">
    <?php
    //SE CARGA TODAS LAS FICHAS DEL MENÚ
        $menu = Menu_Controlador::ctr_menu($dataId);
        echo $menu;
    ?>
</div>
<!-- INCLUSION DEL CARRITO DE COMPRAS -->
<?php 
include_once "./components/php/shop.php";
?>
<!-- Ventana Modal del detalle -->
<div class="modal fade " id="detalle">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-black border border-3 border-warning" id="modal-content" >
        </div>
    </div>
</div>
<script src="./components/js/filtro_text.js"></script>
<script src="./components/js/detalle_modal.js"></script>

