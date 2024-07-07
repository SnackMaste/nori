<?php
$registro = '<!-- DATOS PERSONALES PERSONA -->
            <div class="w-100 text-center">
                <legend><span class="FontPrimary" >Datos Personales</span></legend>
            </div>
            <input type="hidden" name="usuario" id="usuario" value="persons">
            <input type="text" placeholder="Identificación" name="identificacion" id="identificacion" class="mb-3 mt-2 w-75 border border-3 border-warning rounded-3 bg-black FontParrafo fs-5 text-center" required>
            <input type="text" placeholder="Primer Nombre" name="nombre1" id="nombre1" class="mb-3 mt-2 w-75 border border-3 border-warning rounded-3 bg-black FontParrafo fs-5 text-center" required>
            <input type="text" placeholder="Segundo Nombre (Opcional)" name="nombre2" id="nombre2" class="mb-3 mt-2 w-75 border border-3 border-warning rounded-3 bg-black FontParrafo fs-5 text-center">
            <input type="text" placeholder="Primer Apellido" name="apellido1" id="apellido1" class="mb-3 mt-2 w-75 border border-3 border-warning rounded-3 bg-black FontParrafo fs-5 text-center" required>
            <input type="text" placeholder="Segundo Apellido (Opcional)" name="apellido2" id="apellido2" class="mb-3 mt-2 w-75 border border-3 border-warning rounded-3 bg-black FontParrafo fs-5 text-center">
            <div class="FontParrafo text-center w-75 mx-auto">Tenga en cuenta que esta Información es la que saldrá en su factura,
            si es empresa, Realice el registro por empresa.</div>';
echo $registro;