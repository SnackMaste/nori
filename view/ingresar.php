<div class="bg-black w-fill d-flex justify-content-center flex-column align-items-center">
    <div class="d-flex flex-wrap justify-content-center w-100" >
        <button id="BtnPersona" class="border border-3 border-warning rounded-3 px-3 py-1 mx-2 mt-4 bg-gradient-img" onclick="cargarLogin('persona')"><span id="BtnspanP" class="FontSecundary fs-5">Persona</span></button>
        <button id="BtnEmpresa" class="border border-3 border-warning rounded-3 px-3 py-1 mx-2 mt-4 bg-black" onclick="cargarLogin('empresa')"><span id="BtnspanE" class="FontAni fs-5" >Empresa</span></button>
    </div>
    <div id="formIngresar" class="w-100 d-flex justify-content-center flex-column align-items-center" ></div>
    <script>
    function showpassworld(input) {
        const campoPassword = document.getElementById(input);
        const tipo = campoPassword.type === "password" ? "text" : "password";
        campoPassword.type = tipo;
    }
    </script>
    <script src="./components/js/botones_radio.js"></script>
    <!-- A DONDE SE ENVÍAN LOS DATOS DEL FORMULARIO PARA SER VALIDADOS -->
    <script src="./components/js/form.ingreso.validacion.js"></script>
    <script>cargarLogin('persona');</script>
</div>
