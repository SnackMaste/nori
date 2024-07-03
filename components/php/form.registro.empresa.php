<?php 
$registro = '<!-- DATOS PERSONALES PERSONA -->
                <div class="w-100 text-center">
                    <legend><span class="FontPrimary" >Datos De La Empresa</span></legend>
                </div>
                <input type="hidden" name="usuario" id="usuario" value="empresa">
                <input type="text" min="0" placeholder="Identificación Fiscal" name="identificacion" id="identificacion" class="mb-3 mt-2 w-75 border border-3 border-warning rounded-3 bg-black FontParrafo fs-5 text-center" required>
                <input type="text" placeholder="Razón Social" name="nombre1" id="nombre1" class="mb-3 mt-2 w-75 border border-3 border-warning rounded-3 bg-black FontParrafo fs-5 text-center" required>
                <div class="FontParrafo text-center w-75 mx-auto">Tenga en cuenta que esta Información es la que saldrá en su factura,
                si es empresa, Realice el registro por empresa.</div>';
echo $registro;