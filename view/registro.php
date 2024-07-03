<div class="bg-black w-fill d-flex justify-content-center flex-column align-items-center">
    <div class="d-flex flex-wrap justify-content-center w-100" >
        <button id="BtnPersona" class="border border-3 border-warning rounded-3 px-3 py-1 mx-2 mt-4 bg-gradient-img" onclick="cargarRegistro('persona')"><span id="BtnspanP" class="FontSecundary fs-5">Persona</span></button>
        <button id="BtnEmpresa" class="border border-3 border-warning rounded-3 px-3 py-1 mx-2 mt-4 bg-black" onclick="cargarRegistro('empresa')"><span id="BtnspanE" class="FontAni fs-5" >Empresa</span></button>
    </div>
    <div class="d-flex w-100 justify-content-center mb-3">
        <form name="registro" id="registro" method="post" class="w-100 d-flex flex-column justify-content-center mb-3 mt-4">
            <h4 class="text-center" ><span class="FontPrimary">Registro Como Persona</span></h4>
            <input type="hidden" name="procedure" id="procedure" value="SpIngresoCliente">
            <div class="container-fluid d-flex flex-wrap d-block justify-content-center my-3 py-2" >
                <!-- DATOS PERSONALES PERSONA -->
                <div id="divFormRegistro" class="w-25 my-3 mx-3 border border-3 border-warning rounded-4 bg-black d-flex justify-content-center flex-column align-items-center" style="min-height: 470px; min-width: 240px;" >
                </div>
                <!-- DIRECCIÓN -->
                <div class="w-25 my-3 mx-3 border border-3 border-warning rounded-4 bg-black d-flex justify-content-center flex-column align-items-center" style="min-height: 470px; min-width: 240px;" >
                    <div class="w-100 text-center">
                        <legend><span class="FontPrimary" >Datos Del Domicilio</span></legend>
                    </div>
                    <div class="d-flex w-100 justify-content-center" >
                        <select name="pais" id="pais" class="w-50 border rounded-2 border-3 border-warning FontParrafo bg-black my-2 mx-2 p-1 ps-3" onchange="cargar_ciudad('registro')" required >
                            <?php $pais = Filtros_Controlador::ctr_pais('address') ?>
                        </select>
                        <select name="ciudad" id="ciudad" class="w-50 border rounded-2 border-3 border-warning FontParrafo bg-black my-2 mx-2 p-1 ps-3" required>
                            <option value="" selected hidden>Ciudad</option>
                        </select>
                    </div>
                    <input type="text" placeholder="Nombre del Barrio" name="barrio" id="barrio" class="mb-3 mt-2 w-75 border border-3 border-warning rounded-3 bg-black FontParrafo fs-5 text-center" required>
                    <select name="tipo_calle" id="tipo_calle" class="w-75 border rounded-2 border-3 border-warning FontParrafo bg-black my-2 mx-5 p-1 ps-3" required>
                        <?php $pais = Filtros_Controlador::ctr_tipo_calle() ?>
                    </select>
                    <input type="text" placeholder="Nombre de la Calle" name="name_calle" id="name_calle" class="mb-3 mt-2 w-75 border border-3 border-warning rounded-3 bg-black FontParrafo fs-5 text-center" required>
                    <input type="text" placeholder="Numero de la Calle" name="number_calle" id="number_calle" class="mb-3 mt-2 w-75 border border-3 border-warning rounded-3 bg-black FontParrafo fs-5 text-center" required>
                    <div class="d-flex justify-content-center w-100" >
                        <input type="text" placeholder="Torre" class="mb-3 mx-2 mt-2 w-25 border border-3 border-warning rounded-3 bg-black FontParrafo fs-5 text-center" name="torre" id="torre" >
                        <input type="text" placeholder="Piso" class="mb-3 mx-2 mt-2 w-25 border border-3 border-warning rounded-3 bg-black FontParrafo fs-5 text-center" name="piso" id="piso" >
                        <input type="text" placeholder="Puerta" class="mb-3 mx-2 mt-2 w-25 border border-3 border-warning rounded-3 bg-black FontParrafo fs-5 text-center" name="puerta" id="puerta" >
                    </div>
                    <div class="FontParrafo text-center w-75 mx-auto">Tenga en cuenta que esta Información es la que se utilizara para envío a Domicilio.</div>
                </div>
                <!-- DATOS DE CONTACTO -->
                <div class="w-25 my-3 mx-3 border border-3 border-warning rounded-4 bg-black d-flex justify-content-center flex-column align-items-center" style="min-height: 470px; min-width: 240px;">
                    <div class="w-100 text-center">
                        <legend><span class="FontPrimary" >Datos Del Usuario</span></legend>
                    </div>
                    <div class="d-flex justify-content-center align-items-center w-100 my-3">
                        <div class="w-25">
                            <select name="country_code" id="country_code" class="w-75 border rounded-2 border-3 border-warning FontParrafo bg-black p-1" required>
                                <option value="" selected hidden>codigo</option>
                                <option value="+56" class="FontParrafo">+56 Chile</option>
                                <option value="+57" class="FontParrafo">+57 Colombia</option>
                                <option value="+593" class="FontParrafo">+593 Ecuador </option>
                                <option value="+51" class="FontParrafo">+51 Perú</option>
                                <option value="+58" class="FontParrafo">+58 Venezuela </option>
                            </select>
                        </div>
                        <input type="number" min="10000000" max="99999999999" onkeypress="limitarEntradaNumerica(event)" inputmode="numeric" placeholder="Celular" name="telefono" id="telefono" class="w-50 border border-3 border-warning rounded-3 bg-black FontParrafo fs-5 text-center" required>
                    </div>
                    <input type="email" placeholder="Correo Electrónico" name="email" id="email" class="mb-3 mt-2 w-75 border border-3 border-warning rounded-3 bg-black FontParrafo fs-5 text-center" required>
                    <span id="alertEmail" class="FontParrafo text-danger fs-6 text-center mb-2 d-none">Este correo ya esta registrado</span>
                    <input type="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[\w!@#$%^&*_-]{8,}$" title="Debe contener al menos 8 caracteres, una letra mayúscula, una letra minúscula y un número" placeholder="Contraseña" name="password" id="password" class="mb-3 mt-2 w-75 border border-3 border-warning rounded-3 bg-black FontParrafo fs-5 text-center" required>
                    <input type="password" placeholder="Confirme la Contraseña" name="confirmPassword" id="confirmPassword" class="mb-3 mt-2 w-75 border border-3 border-warning rounded-3 bg-black FontParrafo fs-5 text-center" required>
                    <span id="alertPass" class="FontParrafo text-danger fs-6 text-center mb-2 d-none">Las contraseñas no coinciden</span>
                    <span id="alertPassMin" class="FontParrafo text-danger fs-6 text-center mb-2 d-none">La contraseña debe tener mínimo 8 caracteres, una mayúscula, una minúscula y un número</span>
                    <div class="d-flex">
                        <input type="checkbox" onclick="showpassworld()">
                        <span class="FontParrafo mx-3" >Mostrar las Contraseñas</span>
                    </div>
                </div>
            </div>
            <div class="d-flex w-100 justify-content-center">
                <a href="?ruta=ingresar" class="FontParrafo text-center mb-5">Ya tienes cuenta?</a>
            </div>
            <div class="d-flex w-100 justify-content-center">
                <button type="submit" id="btnRegistrar" class="border border-3 border-warning rounded-3 px-3 py-1 mt-2 mx-auto bg-black d-flex justify-content-center align-items-center"><span id="spinner" class="spinner-border spinner-border-sm text-warning d-none"></span><span id="cargando" class="FontAni fs-5 mx-2 d-none">Cargando . . .</span><span id="registrarme" class="FontAni fs-5 mx-2">Registrarme</span></button>
            </div>
        </form>
    </div>
</div>
<!-- BOTONES SUPERIORES DE PERSONA Y EMPRESA -->
<script src="./components/js/botones_radio.js"></script>
<!-- CARGA DE LA SECCIÓN DE DATOS PERSONALES DEPENDIENDO SI ES PERSONA O EMPRESA -->
<script>cargarRegistro('persona');</script>
<!-- A DONDE SE ENVÍAN LOS DATOS DEL FORMULARIO PARA SER VALIDADOS -->
<script src="./components/js/form.registro.validacion.js"></script>
<!-- FUNCIONALIDAD DE LOS FILTROS QUE SON DEPENDIENTES -->
<script src="./components/js/filtros_dependientes.js"></script>