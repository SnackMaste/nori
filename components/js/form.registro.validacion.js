//FUNCIÓN QUE SE CARGA CON LA PAGINA, RESET EL FORMULARIO CADA VEZ QUE SE RECARGA LA PAGINA
window.addEventListener('load', function () {
    document.getElementById('registro').reset();
});

//FUNCIÓN ANÓNIMA QUE EVITA QUE CUANDO SE LE DE CLICK AL FORMULARIO NO SE RECARGUE LA PAGINA Y QUE TOME LOS DATOS
document.getElementById('registro').addEventListener('submit', function (e) {
    e.preventDefault();
    //ESTILOS DEL BOTÓN DE CARGA
    var btnRegistro = document.getElementById('btnRegistrar');
    var spinner = document.getElementById('spinner');
    var cargando = document.getElementById('cargando');
    var registrarme = document.getElementById('registrarme');
    btnRegistro.disabled = true;
    spinner.classList.remove('d-none');
    cargando.classList.remove('d-none');
    registrarme.classList.add('d-none');
    //DATOS DEL FORMULARIO
    var procedure = document.getElementById('procedure');
    var usuario = document.getElementById('usuario').value;
    var nombre1 = "";
    var nombre2 = "";
    var apellido1 = "";
    var apellido2 = "";
    if(usuario == "persona"){
        nombre1 = document.getElementById('nombre1').value;
        nombre2 = document.getElementById('nombre2').value;
        apellido1 = document.getElementById('apellido1').value;
        apellido2 = document.getElementById('apellido2').value;
    }else if(usuario == "empresa"){
        nombre1 = document.getElementById('nombre1').value;
    }
    var identificacion = document.getElementById('identificacion').value;
    var pais = document.getElementById('pais').value;
    var ciudad = document.getElementById('ciudad').value;
    var barrio = document.getElementById('barrio').value;
    var tipo_calle = document.getElementById('tipo_calle').value;
    var name_calle = document.getElementById('name_calle').value;
    var number_calle = document.getElementById('number_calle').value;
    var torre = document.getElementById('torre').value;
    var piso = document.getElementById('piso').value;
    var puerta = document.getElementById('puerta').value;
    var code_country = document.getElementById('country_code').value;
    var telefono = document.getElementById('telefono').value;
    //elementos que se modificaran si hay algún error
    var email = document.getElementById('email');
    var password = document.getElementById('password');
    var confirmPassword = document.getElementById('confirmPassword');
    //valores de los elementos que se modificaran si hay algún error
    var vPass = password.value;
    var vConPass = confirmPassword.value;
    var vEmail = email.value;
    //Validaciones de requisitos mínimos de la contraseña
    let mayuscula = /[A-Z]/.test(vPass);
    let minuscula = /[a-z]/.test(vPass);
    let numero = /[0-9]/.test(vPass);
    if(vPass.length < 8 || !mayuscula || !minuscula || !numero){
        document.getElementById('alertPassMin').classList.remove('d-none');
        password.classList.add('border-danger', 'text-danger');
        btnRegistro.disabled = false;
        spinner.classList.add('d-none');
        cargando.classList.add('d-none');
        registrarme.classList.remove('d-none');
        return;
    }else{
        password.classList.remove('border-danger', 'text-danger');
        document.getElementById('alertPassMin').classList.add('d-none');
    }
    //reset de estilos para aplicar los de defecto para cuando se hace el intento mas de una vez
    document.getElementById('alertEmail').classList.add('d-none');
    document.getElementById('alertEmail').classList.remove('d-block');
    email.classList.remove('border-danger', 'text-danger');
    //comienzo de validaciones y aplicación de estilos dependiendo de los resultados
    if(vPass === vConPass){
        document.getElementById('alertPass').classList.add('d-none');
        document.getElementById('alertPass').classList.remove('d-block');
        password.classList.remove('border-danger', 'text-danger');
        confirmPassword.classList.remove('border-danger', 'text-danger');
    //ELSE DE LA VALIDACIÓN DE LA CONTRASEÑA
    }else{
        document.getElementById('alertPass').classList.remove('d-none');
        document.getElementById('alertPass').classList.add('d-block');
        password.classList.add('border-danger', 'text-danger');
        confirmPassword.classList.add('border-danger', 'text-danger');
        btnRegistro.disabled = false;
        spinner.classList.add('d-none');
        cargando.classList.add('d-none');
        registrarme.classList.remove('d-none');
        return;
    }
    //validación del correo, que no este registrado
    var url = 'controller/formulario.controlador.php';
    let validarEmail = new FormData();
    validarEmail.append('action', 'validate');
    validarEmail.append('table', 'clients')
    validarEmail.append('field','email_client');
    validarEmail.append('value', vEmail);
    fetch(url, {
        method: "POST", 
        body: validarEmail, 
        mode: 'cors'
    })
    .then(response => response.text())
    .then(data => {
        if (data === "No existe"){
            document.getElementById('alertEmail').classList.add('d-none');
            document.getElementById('alertEmail').classList.remove('d-block');
            email.classList.remove('border-danger', 'text-danger');
            registro();
        //ELSE DE LA VALIDACIÓN DEL CORREO ELECTRÓNICO
        }else if(data === "Existe"){
            document.getElementById('alertEmail').classList.remove('d-none');
            document.getElementById('alertEmail').classList.add('d-block');
            email.classList.add('border-danger', 'text-danger');
            btnRegistro.disabled = false;
            spinner.classList.add('d-none');
            cargando.classList.add('d-none');
            registrarme.classList.remove('d-none');
            return;
        }else{console.log(data)}
    })
    //catch de la validación del correo electrónico
    .catch(err => {
        console.log('Error al analizar la respuesta JSON:', err);
        console.log('Respuesta completa:', err.response); // Imprime la respuesta completa
    });
    //envío al controlador para el ingreso de los datos
    function registro(){
        let registro = new FormData();
        registro.append('action', 'registro');
        registro.append('procedure',procedure);
        registro.append('usuario',usuario);
        registro.append('nombre1',nombre1);
        registro.append('nombre2',nombre2);
        registro.append('apellido1',apellido1);
        registro.append('apellido2',apellido2);
        registro.append('identificacion',identificacion);
        registro.append('pais',pais);
        registro.append('ciudad',ciudad);
        registro.append('barrio',barrio);
        registro.append('tipo_calle',tipo_calle);
        registro.append('name_calle',name_calle);
        registro.append('number_calle',number_calle);
        registro.append('torre',torre);
        registro.append('piso',piso);
        registro.append('puerta',puerta);
        registro.append('code_country',code_country);
        registro.append('telefono',telefono);
        registro.append('vPass',vPass);
        registro.append('vEmail',vEmail);
        fetch(url, {
            method: "POST", 
            body: registro, 
            mode: 'cors'
        })
        .then(response => response.text())
        .then(data => {
            if (data === "Registrado"){
                iniciarLaSesion(usuario,vEmail);
            }else{
                btnRegistro.disabled = false;
                spinner.classList.add('d-none');
                cargando.classList.add('d-none');
                registrarme.classList.remove('d-none');
                alert('Error al hacer el registro, inténtelo mas tarde');
                return;
            };
        })
        //catch del registro
        .catch(err => {
            console.log('Error al analizar la respuesta JSON:', err);
            console.log('Respuesta completa:', err.response); // Imprime la respuesta completa
        });
    }
});
//Función para ver la contraseña
function showpassworld() {
    const campoPassword = document.getElementById("password");
    const campoConfirmPassword = document.getElementById("confirmPassword");
    const tipo = campoPassword.type === "password" ? "text" : "password";
    campoPassword.type = tipo;
    campoConfirmPassword.type = tipo;
}
//Función para limitar a solo entrada numérica el input teléfono
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

//FUNCIÓN QUE INICIA LA SESIÓN CUANDO SE REALIZA EL REGISTRO
function iniciarLaSesion(user,email){
    formData = new FormData();
    formData.append('request', 'start')
    formData.append('usuario', user);
    formData.append('email', email);
    let url = 'controller/session.controlador.php';
    fetch(url, {
        method: "POST", 
        body: formData, 
        mode: 'cors'
    })
    .then(response => response.text())
    .then(data => {
        alert('Registro satisfactorio');
        //RECUPERAMOS LA URL DESDE EL ALMACENAMIENTO DEL NAVEGADOR
        let location = localStorage.getItem('location');
        localStorage.removeItem('location');
        if (location !== null) {
            window.location.href= location;
        } else {
            window.location.href= "?ruta=inicio";
        }
    })
    .catch(err => {
        console.log('Error al analizar la respuesta JSON:', err);
        console.log('Respuesta completa:', err.response); // Imprime la respuesta completa
    });
}