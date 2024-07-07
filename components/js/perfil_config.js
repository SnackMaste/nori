//CONSTANTES INICIALES
const inputImagen = document.getElementById("inputImagen");
const imagenPrevia = document.getElementById("imagenPrevia");
const buttonDrop =document.getElementById("buttonDrop");
const buttonSave = document.getElementById("buttonGuardar");
const imagenUser =document.getElementById("imagenUser");
const url = 'controller/perfil.controlador.php';
//---------------------- sección de cambio de imagen --------------------------------//

//EVENTO QUE SE EJECUTA CADA VEZ QUE SE CAMBIA EL VALOR DEL INPUT DE IMÁGENES
inputImagen.addEventListener("change", function () {
  //TOMAMOS EL ARCHIVO SUBIDO PARA VALIDACIONES
    const archivo = inputImagen.files[0];
  //SI EL ARCHIVO NO ESTA VACÍO SE EJECUTA LO SIGUIENTE
    if (archivo) {
    // se toma la extension del archivo
        const extension = archivo.name.split('.').pop().toLowerCase();
        //VALIDAMOS QUE LA EXTENSION SEA UNA IMAGEN
        if (['jpg', 'jpeg', 'png', 'webp'].includes(extension)) {
      //SI ES UNA IMAGEN ASIGNAMOS LA IMAGEN AL CONTENEDOR QUE NOS PERMITIRÁ HACER UNA PREVISUALIZACIÓN Y RECORTAR LA IMAGEN
            imagenPrevia.src = URL.createObjectURL(archivo);
            imagenPrevia.classList.remove('d-none');
            imagenUser.classList.add('d-none');
            var reader = new FileReader();
            reader.onload = (e) =>{
                cropper = new Cropper(imagenPrevia,{
                    aspectRatio: 1,
                    viewMode: 1
                })
            buttonDrop.classList.remove('d-none');
        };
        reader.readAsDataURL(archivo);
        } else {
          // si el archivo esta en formato no valido se limpia el input y se manda una alerta
            inputImagen.value="";
            imagenPrevia.src = "";
            alert('Por favor, selecciona un archivo de imagen válido (JPEG, PNG o WebP).');
        };
        //SI EL ARCHIVO ESTA VACÍO SE LE ASIGNA EL VALOR VACÍO Y SE RETORNA
    }else{
        inputImagen.value="";
        imagenPrevia.src = "";
        return;
    }
});
//FUNCIÓN QUE CORTA LA IMAGEN SUBIDA Y LA ALMACENA EN imagenUser
buttonDrop.addEventListener('click', function(){
    const croppedDataUrl = cropper.getCroppedCanvas().toDataURL();
    imagenUser.src = croppedDataUrl;
    imagenUser.classList.remove('d-none');
    imagenPrevia.classList.add('d-none');
    buttonDrop.classList.add('d-none');
    buttonSave.classList.remove('d-none');
    cropper.destroy();
    cropper = null;
})
//FUNCIÓN QUE MANDA LA INFORMACIÓN Y LA SOLICITUD AL CONTROLADOR PARA ALMACENAR LA IMAGEN
function saveImage(){
    let image =imagenUser.getAttribute('src');
    var formData = new FormData();
    formData.append('solicitud', 'imagen');
    formData.append('imagen', image);
    fetch(url,{
        method: 'POST',
        body: formData,
        mode: 'cors'
    })
    .then(response => response.text())
    .then(data => {
        if(data == 'error'){
            alert('Error al almacenar la imagen');
        }else if(data == 'error db'){
            alert('Error al obtener datos de la base de datos, inténtelo en otro momento');
        }else if('almacenada'){
            window.location.href= "?ruta=perfil";
        }
    })
    .catch(err => {
        console.log('Error al analizar la respuesta JSON:', err);
        console.log('Respuesta completa:', err.response); // Imprime la respuesta completa
    });
}

//------------ FUNCIÓN PARA LIMITAR SOLO LA ENTRADA NUMÉRICA DEL INPUT TELÉFONO ------------//

function limitarEntradaNumerica(event) {
    const teclaPresionada = event.key;
    const esNumero = /^[0-9]$/.test(teclaPresionada);

    if (!esNumero) {
        event.preventDefault();
    }
    const valorActual = event.target.value;
    if (valorActual.length >= 10) {
        event.preventDefault();
    }
}

//----------------- FUNCIÓN PARA VER LA CONTRASEÑA ------------------------//

function showPassword(input,input2,input3) {
    if(input2 == null && input3 == null){
        let campoPassword = document.getElementById(input);
        let tipo = campoPassword.type === "password" ? "text" : "password";
        campoPassword.type = tipo;
    }else{
        if(input3 == null){
            let campoPassword = document.getElementById(input);
            let campoPassword2 = document.getElementById(input2);
            let tipo = campoPassword.type === "password" ? "text" : "password";
            let tipo2 = campoPassword2.type === "password" ? "text" : "password";
            campoPassword.type = tipo;
            campoPassword2.type = tipo2;
        }else{
            let campoPassword = document.getElementById(input);
            let campoPassword2 = document.getElementById(input2);
            let campoPassword3 = document.getElementById(input3);
            let tipo = campoPassword.type === "password" ? "text" : "password";
            let tipo2 = campoPassword2.type === "password" ? "text" : "password";
            let tipo3 = campoPassword3.type === "password" ? "text" : "password";
            campoPassword.type = tipo;
            campoPassword2.type = tipo2;
            campoPassword3.type = tipo3;
        }
    };
}

//-------------------- SECCIÓN DE ACTUALIZACIÓN DE DATOS PERSONALES -------------------//

function datosClient(){
    var cliente = document.getElementById('client').value;
    var formData = new FormData();
    //------ CONDICIONAL DE CLIENTE TIPO PERSONA ------//
    if(cliente == 'persons'){
        var name1 = document.getElementById('name1');
        var name2 = document.getElementById('name2');
        var apellido1 = document.getElementById('apellido1');
        var apellido2 = document.getElementById('apellido2');
        var identificacion = document.getElementById('identificacion');
        var code = document.getElementById('country_code');
        var telefono = document.getElementById('telefono');
        var password = document.getElementById('ActualizarDatosPass');
        //---- RESTABLECE ESTILOS BASE ----//
        name1.classList.remove('border-danger','text-danger');
        apellido1.classList.remove('border-danger','text-danger');
        code.classList.remove('border-danger','text-danger');
        identificacion.classList.remove('border-danger','text-danger');
        telefono.classList.remove('border-danger','text-danger');
        password.classList.remove('border-danger','text-danger');
        document.getElementById('ActualizarDatosAlertPass').classList.add('d-none');
        //------ VALIDACIÓN DE CAMPOS VACÍOS ------//
        if(name1.value == "" || apellido1.value == "" || identificacion.value == "" || code.value == "" || telefono.value == "" || password.value == ""){
            if(name1.value == ""){
                name1.classList.add('border-danger','text-danger');
            };
            if(apellido1.value == ""){
                apellido1.classList.add('border-danger','text-danger');
            };
            if(code.value == ""){
                code.classList.add('border-danger','text-danger');
            };
            if(identificacion.value == ""){
                identificacion.classList.add('border-danger','text-danger');
            };
            if(telefono.value == ""){
                telefono.classList.add('border-danger','text-danger');
            };
            if(password.value == ""){
                password.classList.add('border-danger','text-danger');
            };
            alert('Por favor llene todos los campos obligatorios');
            return;
        } else {
            //---- SI NO ESTÁN VACÍOS LOS ALMACENAMOS EN LOS DATOS QUE SE VAN A ENVIAR AL CONTROLADOR -----//
            var telefonoCompleto = code.value+telefono.value;
            formData.append('client', cliente);
            formData.append('name1', name1.value);
            formData.append('name2', name2.value);
            formData.append('apellido1', apellido1.value);
            formData.append('apellido2', apellido2.value);
            formData.append('identificacion', identificacion.value);
            formData.append('telefono', telefonoCompleto);
        }
    }//------ CONDICIONAL DE CLIENTE TIPO EMPRESA------//
    else if(cliente == 'companies'){
        var name = document.getElementById('name');
        var identificacion = document.getElementById('identificacion');
        var code = document.getElementById('country_code');
        var telefono = document.getElementById('telefono');
        var password = document.getElementById('ActualizarDatosPass');
        //---- RESTABLECE ESTILOS BASE ----//
        name.classList.remove('border-danger','text-danger');
        code.classList.remove('border-danger','text-danger');
        identificacion.classList.remove('border-danger','text-danger');
        telefono.classList.remove('border-danger','text-danger');
        //------ VALIDACIÓN DE CAMPOS VACÍOS ------//
        if(name.value == "" || identificacion.value == "" || code.value == "" || telefono.value == "" || password.value == ""){
            if(name.value == ""){
                name.classList.add('border-danger','text-danger');
            };
            if(code.value == ""){
                code.classList.add('border-danger','text-danger');
            };
            if(identificacion.value == ""){
                identificacion.classList.add('border-danger','text-danger');
            };
            if(telefono.value == ""){
                telefono.classList.add('border-danger','text-danger');
            };
            if(password.value == ""){
                password.classList.add('border-danger','text-danger');
            };
            alert('Por favor llene todos los campos obligatorios');
            return;
        } else {
            //---- SI NO ESTÁN VACÍOS LOS ALMACENAMOS EN LOS DATOS QUE SE VAN A ENVIAR AL CONTROLADOR -----//
            var telefonoCompleto = code.value+telefono.value;
            formData.append('client', cliente);
            formData.append('name', name.value);
            formData.append('identificacion', identificacion.value);
            formData.append('telefono', telefonoCompleto);
        }
    };
    //-------- VALIDACIÓN DE CONTRASEÑA ------//
    let email = document.getElementById('ActualizarDatosEmail').value;
    var validatePass = new FormData();
    validatePass.append('action', 'contraseña');
    validatePass.append('value', password.value);
    validatePass.append('email', email);
    fetch('./controller/formulario.controlador.php',{
        method: 'POST',
        body: validatePass,
        mode: 'cors'
    })
    .then(response => response.text())
    .then(data => {
        //-------- SI COINCIDE PROCEDEMOS A GUARDAR LOS NUEVOS DATOS LLAMANDO LA FUNCIÓN -----------//
        if(data == 'Coincide'){
            almacenarNewDatos();
        }
        //-------- ALERTA DE NO COINCIDE LA CONTRASEÑA -----------//
        else if(data == 'No coincide'){
            password.classList.add('border-danger','text-danger');
            document.getElementById('ActualizarDatosAlertPass').classList.remove('d-none');
            return;
        }
        //-------- MOSTRAR EN CONSOLA SI LA INFO RECIBIDA NO ES LA ESPERADA -----------//
        else{
            console.log(data);
        }
    })
    .catch(err => {
        console.log('Error al analizar la respuesta JSON:', err);
        console.log('Respuesta completa:', err.response);
    });
    //------- FUNCIÓN QUE ALMACENA LOS NUEVOS DATOS PERSONALES DEL USUARIO ------//
    function almacenarNewDatos(){
        formData.append('solicitud', 'ActualizarCliente');
        fetch(url,{
            method: 'POST',
            body: formData,
            mode: 'cors'
        })
        .then(response => response.text())
        .then(data => {
            if(data == "ok"){
                alert('Datos Actualizados Satisfactoriamente');
                window.location.href= "?ruta=perfil";
            }else{
                alert('Ocurrió un error al almacenar los datos, inténtelo en otro momento');
                console.log(data);
            }
        })
        .catch(err => {
            console.log('Error al analizar la respuesta JSON:', err);
            console.log('Respuesta completa:', err.response); // Imprime la respuesta completa
        });
    }
}

//-------------- ACTUALIZACIÓN DE EMAIL ------------------//

function cambioEmail(){
    var contEmail = document.getElementById('ActualEmail');
    var contPass = document.getElementById('ActualizarEmailPass');
    var contNewEmail = document.getElementById('ActualizarEmail');
    var alerta = document.getElementById('alertCambioEmail');
    //---- RESTABLECE ESTILOS BASE ----//
    document.getElementById('alertNewEmail').classList.add('d-none');
    document.getElementById('alertEmail').classList.add('d-none');
    document.getElementById('alertPass').classList.add('d-none');
    contEmail.classList.remove('border-danger','text-danger');
    contNewEmail.classList.remove('border-danger','text-danger');
    contPass.classList.remove('border-danger','text-danger');
    alerta.classList.add('d-none');
    //-------- VALIDACIÓN QUE LOS CAMPOS NO VENGAN VACÍOS -----------//
    if(contEmail.value == "" || contPass.value == "" || contNewEmail.value == ""){
        if(contEmail.value == ""){
            contEmail.classList.add('border-danger','text-danger');
        }
        if(contNewEmail.value == ""){
            contNewEmail.classList.add('border-danger','text-danger');
        }
        if(contPass.value == ""){
            contPass.classList.add('border-danger','text-danger');
        }
        alerta.classList.remove('d-none');
        return;
    //-------- ELSE DE LA VALIDACIÓN CAMPOS -----------//
    }else{
        //-------- VALIDACIÓN DE CORREOS QUE VENGAN EN FORMATO ADECUADO -----------//
        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(contNewEmail.value) && /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(contEmail.value)) {
            let formData = new FormData();
            formData.append('action', 'contraseña');
            formData.append('value', contPass.value);
            formData.append('email', contEmail.value);
            //-------- VALIDACIÓN QUE LA CONTRASEÑA COINCIDA CON LA INGRESADA -----------//
            fetch('./controller/formulario.controlador.php',{
                method: 'POST',
                body: formData,
                mode: 'cors'
            })
            .then(response => response.text())
            .then(data => {
                //-------- SI COINCIDE PROCEDEMOS A GUARDAR EL NUEVO EMAIL LLAMANDO LA FUNCIÓN -----------//
                if(data == 'Coincide'){
                    almacenarNewEmail();
                }
                //-------- ALERTA DE NO COINCIDE LA CONTRASEÑA -----------//
                else if(data == 'No coincide'){
                    contPass.classList.add('border-danger','text-danger');
                    document.getElementById('alertPass').classList.remove('d-none');
                    return;
                }
                //-------- MOSTRAR EN CONSOLA SI LA INFO RECIBIDA NO ES LA ESPERADA -----------//
                else{
                    console.log(data);
                    return;
                }
            })
            .catch(err => {
                console.log('Error al analizar la respuesta JSON:', err);
                console.log('Respuesta completa:', err.response);
            });

            //---------- FUNCIÓN DE ALMACENADO ---------//
            function almacenarNewEmail(){
                let formData = new FormData();
                formData.append('solicitud', 'ActualizarEmail');
                formData.append('email', contNewEmail.value);
                fetch(url,{
                    method: 'POST',
                    body: formData,
                    mode: 'cors'
                })
                .then(response => response.text())
                .then(data => {
                    if(data == 'ok'){
                        alert('Datos Actualizados Satisfactoriamente');
                        window.location.href= "?ruta=perfil";
                    }
                    else{
                        console.log(data);
                    };
                })
                .catch(err => {
                    console.log('Error al analizar la respuesta JSON:', err);
                    console.log('Respuesta completa:', err.response);
                });
            }
        //-------- ELSE DE LA VALIDACIÓN DE CORREOS -----------//
        }else{
            if(!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(contNewEmail.value)){
                contNewEmail.classList.add('border-danger','text-danger');
                document.getElementById('alertNewEmail').classList.remove('d-none');
            }
            if(!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(contEmail.value)){
                contEmail.classList.add('border-danger','text-danger');
                document.getElementById('alertEmail').classList.remove('d-none');
            }
            return;
        }
    }
};

//--------------------------- ACTUALIZACIÓN DE CONTRASEÑA -------------------------------//

function actualizarPass(){
    var passAct = document.getElementById('ActualizarPassAct');
    var passNew = document.getElementById('ActualizarPassNew');
    var passNewConf = document.getElementById('ActualizarPassConfirmaNew');
    //---- RESTABLECE ESTILOS BASE ----//
    passNew.classList.remove('border-danger','text-danger');
    passNewConf.classList.remove('border-danger','text-danger');
    passAct.classList.remove('border-danger','text-danger');
    document.getElementById('alertNewPassNoValida').classList.add('d-none');
    document.getElementById('alertNewPassNoIgual').classList.add('d-none');
    document.getElementById('alertNewPassAct').classList.add('d-none');
    //----- VALIDACIÓN DE REQUISITOS MÍNIMOS DE LA CONTRASEÑA -----//
    let mayuscula = /[A-Z]/.test(passNew.value);
    let minuscula = /[a-z]/.test(passNew.value);
    let numero = /[0-9]/.test(passNew.value);
    if(passNew.value.length < 8 || !mayuscula || !minuscula || !numero){
        passNew.classList.add('border-danger','text-danger');
        document.getElementById('alertNewPassNoValida').classList.remove('d-none');
        return;
    }else{
        if(passNew.value === passNewConf.value){
            //-------- VALIDACIÓN DE CONTRASEÑA ------//
            var email = document.getElementById('ActualizarDatosEmail').value;
            var validatePass = new FormData();
            validatePass.append('action', 'contraseña');
            validatePass.append('value', passAct.value);
            validatePass.append('email', email);
            fetch('./controller/formulario.controlador.php',{
                method: 'POST',
                body: validatePass,
                mode: 'cors'
            })
            .then(response => response.text())
            .then(data => {
                //-------- SI COINCIDE PROCEDEMOS A GUARDAR LOS NUEVOS DATOS LLAMANDO LA FUNCIÓN -----------//
                if(data == 'Coincide'){
                    almacenarNewPass();
                }
                //-------- ALERTA DE NO COINCIDE LA CONTRASEÑA -----------//
                else if(data == 'No coincide'){
                    passAct.classList.add('border-danger','text-danger');
                    document.getElementById('alertNewPassAct').classList.remove('d-none');
                    return;
                }
                //-------- MOSTRAR EN CONSOLA SI LA INFO RECIBIDA NO ES LA ESPERADA -----------//
                else{
                    console.log(data);
                }
            })
            .catch(err => {
                console.log('Error al analizar la respuesta JSON:', err);
                console.log('Respuesta completa:', err.response);
            });
            //------- FUNCIÓN QUE ALMACENA LOS NUEVOS DATOS PERSONALES DEL USUARIO ------//
            function almacenarNewPass(){
                let formData = new FormData();
                formData.append('solicitud', 'ActualizarPass');
                formData.append('pass', passNew.value);
                fetch(url,{
                    method: 'POST',
                    body: formData,
                    mode: 'cors'
                })
                .then(response => response.text())
                .then(data => {
                    if(data == "ok"){
                        alert('Contraseña Actualizada Satisfactoriamente');
                        window.location.href= "?ruta=perfil";
                    }else{
                        alert('Ocurrió un error al almacenar los datos, inténtelo en otro momento')
                    }
                })
                .catch(err => {
                    console.log('Error al analizar la respuesta JSON:', err);
                    console.log('Respuesta completa:', err.response); // Imprime la respuesta completa
                });
            }
        }else{
            passNew.classList.add('border-danger');
            passNewConf.classList.add('border-danger','text-danger');
            document.getElementById('alertNewPassNoIgual').classList.remove('d-none');
            return;
        }
    }
}

//---------------- ACTUALIZACIÓN DE DIRECCIÓN DE DOMICILIO -----------------//

function actualizarDomicilio(){
    var pais = document.getElementById('pais');
    var ciudad = document.getElementById('ciudad');
    var barrio = document.getElementById('barrio');
    var tipo_calle = document.getElementById('tipo_calle');
    var name_calle = document.getElementById('name_calle');
    var number_calle = document.getElementById('number_calle');
    var torre = document.getElementById('torre');
    var piso = document.getElementById('piso');
    var puerta = document.getElementById('puerta');
    var pass = document.getElementById('ActualizarDirePass');
    //---- RESTABLECE ESTILOS BASE ----//
    pais.classList.remove('border-danger','text-danger');
    ciudad.classList.remove('border-danger','text-danger');
    barrio.classList.remove('border-danger','text-danger');
    tipo_calle.classList.remove('border-danger','text-danger');
    name_calle.classList.remove('border-danger','text-danger');
    number_calle.classList.remove('border-danger','text-danger');
    pass.classList.remove('border-danger','text-danger');
    document.getElementById('ActualizarDireAlertPass').classList.add('d-none');
    if(pais.value == "" || ciudad.value == "" || barrio.value == "" || tipo_calle.value == "" || name_calle.value == "" || number_calle.value == "" || pass.value == ""){
        if(pais.value == ""){
            pais.classList.add('border-danger','text-danger');
        }
        if(ciudad.value == ""){
            ciudad.classList.add('border-danger','text-danger');
        }
        if(barrio.value == ""){
            barrio.classList.add('border-danger','text-danger');
        }
        if(tipo_calle.value == ""){
            tipo_calle.classList.add('border-danger','text-danger');
        }
        if(name_calle.value == ""){
            name_calle.classList.add('border-danger','text-danger');
        }
        if(number_calle.value == ""){
            number_calle.classList.add('border-danger','text-danger');
        }
        if(pass.value == ""){
            pass.classList.add('border-danger','text-danger');
        }
        alert('Pos favor rellene los campos obligatorios')
        return;
    }else{
        var validatePass = new FormData();
        var email = document.getElementById('ActualizarDatosEmail').value;
        validatePass.append('action', 'contraseña');
        validatePass.append('value', pass.value);
        validatePass.append('email', email);
        fetch('./controller/formulario.controlador.php',{
            method: 'POST',
            body: validatePass,
            mode: 'cors'
        })
        .then(response => response.text())
        .then(data => {
            //-------- SI COINCIDE PROCEDEMOS A GUARDAR LOS NUEVOS DATOS LLAMANDO LA FUNCIÓN -----------//
            if(data == 'Coincide'){
                almacenarNewDire();
            }
            //-------- ALERTA DE NO COINCIDE LA CONTRASEÑA -----------//
            else if(data == 'No coincide'){
                pass.classList.add('border-danger','text-danger');
                document.getElementById('ActualizarDireAlertPass').classList.remove('d-none');
                return;
            }
            //-------- MOSTRAR EN CONSOLA SI LA INFO RECIBIDA NO ES LA ESPERADA -----------//
            else{
                console.log(data);
            }
        })
        .catch(err => {
            console.log('Error al analizar la respuesta JSON:', err);
            console.log('Respuesta completa:', err.response);
        });
        //------- FUNCIÓN QUE ENVÍA AL CONTROLADOR PARA ALMACENAR LA NUEVA DIRECCIÓN ---------//
        function almacenarNewDire(){
            let formData = new FormData();
            formData.append('solicitud', 'ActualizarDire');
            formData.append('pais',pais.value);
            formData.append('ciudad',ciudad.value);
            formData.append('barrio',barrio.value);
            formData.append('tipo_calle',tipo_calle.value);
            formData.append('name_calle',name_calle.value);
            formData.append('number_calle',number_calle.value);
            formData.append('torre',torre.value);
            formData.append('piso',piso.value);
            formData.append('puerta',puerta.value);
            fetch(url,{
                method: 'POST',
                body: formData,
                mode: 'cors'
            })
            .then(response => response.text())
            .then(data => {
                if(data == "ok"){
                    alert('Dirección Actualizada Satisfactoriamente');
                    window.location.href= "?ruta=perfil";
                }else{
                    alert('Ocurrió un error al almacenar los datos, inténtelo en otro momento');
                    console.log(data);
                }
            })
            .catch(err => {
                console.log('Error al analizar la respuesta JSON:', err);
                console.log('Respuesta completa:', err.response); // Imprime la respuesta completa
            });
        }
    }
}

//-------------------- FUNCIÓN QUE CARGA EL SELECT DE CIUDAD ------------------------//

function cargar_ciudad(lugar){
    //SELECCIONAMOS Y ALMACENAMOS EN UNA VARIABLE EL PRIMER SELECT QUE ES PARA PANTALLAS PEQUEÑAS A GRANDES
    let pais = document.getElementById('pais').value;
    if(pais == ""){
        return;
    }else{
        //CREAMOS UN NUEVO form-data
        let formData = new FormData()
        //LE COLOCAMOS LA VARIABLE PAÍS QUE CONTIENE EL PAÍS CON EL NOMBRE PAÍS
        formData.append('pais', pais);
        formData.append('lugar', lugar);
        //SELECCIONAMOS Y ALMACENAMOS EN UNA VARIABLE EL PRIMER SELECT QUE ES PARA PANTALLAS PEQUEÑAS A GRANDES
        let targetElement = document.getElementById('ciudad');
        //URL DE DONDE SE HARÁ LA SOLICITUD
        let url = 'controller/filtros.controlador.php';
        //REALIZACIÓN DE LA SOLICITUD
        fetch(url, {
            method: "POST", 
            body: formData, 
            mode: 'cors'
        })
        .then(response => response.text())
        .then(data => {
            //PONEMOS LA RESPUESTA EN EL SELECT
            targetElement.innerHTML=data
        })
        .catch(err => console.log(err))
    }
}

//--------------------- SECCIÓN PARA ELIMINAR LA CUENTA ------------------//

function eliminaCuenta(){
    var eEmail = document.getElementById('eliminaEmail');
    var pass = document.getElementById('eliminaPass');
    //---- RESTABLECE ESTILOS BASE ----//
    eEmail.classList.remove('border-danger','text-danger');
    pass.classList.remove('border-danger','text-danger');
    document.getElementById('alertEliminaEmail').classList.add('d-none');
    document.getElementById('alertEliminaCuentaObliga').classList.add('d-none');
    document.getElementById('alertEliminaPass').classList.add('d-none');
    //---- VALIDACIÓN DE DATOS VACÍOS -----//
    if(eEmail.value == "" || pass.value == ""){
        if(eEmail.value == ""){
            eEmail.classList.add('border-danger','text-danger');
        };
        if(pass.value == ""){
            pass.classList.add('border-danger','text-danger');
        };
        document.getElementById('alertEliminaCuentaObliga').classList.remove('d-none');
        return;
    }else{
        var vEmail = document.getElementById('ActualizarDatosEmail').value;
        //----- VALIDACIÓN DE EMAIL -------//
        if(eEmail.value == vEmail){
            //----- VALIDACIÓN DE PASSWORD ------//
            var validatePass = new FormData();
            validatePass.append('action', 'contraseña');
            validatePass.append('value', pass.value);
            validatePass.append('email', vEmail);
            fetch('./controller/formulario.controlador.php',{
                method: 'POST',
                body: validatePass,
                mode: 'cors'
            })
            .then(response => response.text())
            .then(data => {
                //-------- SI COINCIDE PROCEDEMOS A GUARDAR LOS NUEVOS DATOS LLAMANDO LA FUNCIÓN -----------//
                if(data == 'Coincide'){
                    let condirmacion = window.confirm("Al realizar esta acción de eliminar la cuenta no abra forma de recuperar sus datos, ¿desea seguir con la eliminación de la cuenta?")
                    if(condirmacion === true){
                        eliminar();
                    }else{
                        return;
                    }
                }
                //-------- ALERTA DE NO COINCIDE LA CONTRASEÑA -----------//
                else if(data == 'No coincide'){
                    pass.classList.add('border-danger','text-danger');
                    document.getElementById('alertEliminaPass').classList.remove('d-none');
                    return;
                }
                //-------- MOSTRAR EN CONSOLA SI LA INFO RECIBIDA NO ES LA ESPERADA -----------//
                else{
                    console.log(data);
                }
            })
            .catch(err => {
                console.log('Error al analizar la respuesta JSON:', err);
                console.log('Respuesta completa:', err.response);
            });
            //------ función que realiza la petición de eliminar la cuenta
            function eliminar(){
                let formData = new FormData();
                formData.append('solicitud', 'Eliminar');
                fetch(url,{
                    method: "POST",
                    body: formData,
                    mode: "cors"
                })
                .then(response => response.text())
                .then(data => {
                    if(data == "ok"){
                        alert('Su cuenta a sido eliminada satisfactoriamente');
                        window.location.href = "?ruta=inicio";
                    }else{
                        alert('Ocurrió un error al eliminar la cuenta, inténtelo en otro momento');
                        console.log(data);
                    }
                })
                .catch(err => {
                    console.log('Error al analizar la respuesta JSON:', err);
                    console.log('Respuesta completa:', err.response);
                });
            }
        }else{
            eEmail.classList.add('border-danger','text-danger');
            document.getElementById('alertEliminaEmail').classList.remove('d-none');
            return;
        }
    }
};