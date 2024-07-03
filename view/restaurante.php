<script src="./components/js/filtros_dependientes.js"></script>
<div class="container-fluid">
    <div class="d-flex flex-column border-img-b py-3">
        <span class="FontPrimary text-center m-auto fs-4">Buscar Restaurante</span>
        <!-- Pantallas pequeñas hacia arriba -->
        <div class="d-sm-flex d-none mx-auto my-3" >
            <!-- SELECT PAÍS -->
            <select name="pais" id="pais" class="border rounded-2 border-3 border-warning FontParrafo bg-black my-2 mx-5 p-1 ps-3" onchange="cargar_ciudad('restaurante')">
                <!-- SOLICITUD AL CONTROLADOR LA INFORMACIÓN PARA RELLENAR EL SELECT CON LOS PAÍSES -->
                <?php $pais = Filtros_Controlador::ctr_pais('restaurant') ?>
            </select>
            <!-- SELECT CIUDAD -->
            <select name="ciudad" id="ciudad" class="border rounded-2 border-3 border-warning FontParrafo bg-black my-2 mx-5 p-1 ps-3" onchange="cargar_restaurantes()">
                <option value="" disabled selected><span class="FontParrafo" >selecciona una ciudad</span></option>
            </select>
        </div>
        <!-- Pantallas extra pequeñas -->
        <div class="d-sm-none d-flex flex-column mx-auto my-3" >
            <!-- SELECT PAÍS -->
            <select name="pais" id="pais_ep" class="border rounded-2 border-3 border-warning FontParrafo bg-black my-2 mx-5 p-1 ps-3" onchange="cargar_ciudad_ep('restaurante')">
                <!-- SOLICITUD AL CONTROLADOR LA INFORMACIÓN PARA RELLENAR EL SELECT CON LOS PAÍSES -->
                <?php $pais = Filtros_Controlador::ctr_pais('restaurant') ?>
            </select>
            <!-- SELECT CIUDAD -->
            <select name="ciudad" id="ciudad_ep" class="border rounded-2 border-3 border-warning FontParrafo bg-black my-2 mx-5 p-1 ps-3" onchange="cargar_restaurantes_ep()">
                <option value="" disabled selected>selecciona una ciudad</option>
            </select>
        </div>
    </div>
    <div id="fichas_restaurante" style="min-height: 400px; ">
    </div>
</div>
<!-- FUNCIONALIDAD DE LOS BOTONES DE LOS RESTAURANTES -->
<script src="./components/js/botones.restaurantes.js"></script>