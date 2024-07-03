//Archivo de validación e inicio de sesión 

function idform(value){
    var id = 'ingreso_'+value;
    var bIngreso = 'btnIngreso_'+value;
    var spin = 'spinner_'+value;
    var carga = 'cargando_'+value;
    var ingresa = 'ingresar_'+value;
    var ema = 'email_'+value;
    var pas = 'password_'+value;
    var alertEma = 'alertEmail_'+value;
    var alertPas = 'alertPass_'+value;
    var usuario = 'usuario_'+value;

    document.getElementById(id).addEventListener('submit', function (e) {
        e.preventDefault();
        //ESTILOS DEL BOTÓN DE CARGA
        var btnIngreso = document.getElementById(bIngreso);
        var spinner = document.getElementById(spin);
        var cargando = document.getElementById(carga);
        var ingresar = document.getElementById(ingresa);
        btnIngreso.disabled = true;
        spinner.classList.remove('d-none');
        cargando.classList.remove('d-none');
        ingresar.classList.add('d-none');
        //Datos del formulario
        var email = document.getElementById(ema);
        var pass = document.getElementById(pas);
        var user = document.getElementById(usuario).value;
        var vEmail = email.value;
        var vPass = pass.value;
        //Validación del correo
        var url = 'controller/formulario.controlador.php';
        let validarEmail = new FormData();
        validarEmail.append('action', 'correo');
        validarEmail.append('table', user);
        validarEmail.append('value', vEmail);
        fetch(url, {
            method: "POST", 
            body: validarEmail, 
            mode: "cors"
        })
        .then(response => response.text())
        .then(data => {
            if (data === "No existe"){
                document.getElementById(alertEma).classList.remove('d-none');
                email.classList.add('border-danger', 'text-danger');
                btnIngreso.disabled = false;
                spinner.classList.add('d-none');
                cargando.classList.add('d-none');
                ingresar.classList.remove('d-none');
                return;
            //ELSE DE LA VALIDACIÓN DEL CORREO ELECTRÓNICO
            }else if(data === "Existe"){
                validaContraseña();
            }else{console.log(data)}
        })
        //catch de la validación del correo electrónico
        .catch(err => {
            console.log('Error al analizar la respuesta JSON:', err);
            console.log('Respuesta completa:', err.response); // Imprime la respuesta completa
        });
        //función para validar la contraseña
        function validaContraseña(){
            contraseña = new FormData();
            contraseña.append('action', 'contraseña');
            contraseña.append('value', vPass);
            contraseña.append('email',vEmail);
            fetch(url,{
                method: "POST",
                body: contraseña,
                mode: "cors"
            })
            .then(response => response.text())
            .then(data => {
                if (data === "No coincide"){
                    document.getElementById(alertEma).classList.add('d-none');
                    email.classList.remove('border-danger', 'text-danger');
                    document.getElementById(alertPas).classList.remove('d-none');
                    pass.classList.add('border-danger', 'text-danger');
                    btnIngreso.disabled = false;
                    spinner.classList.add('d-none');
                    cargando.classList.add('d-none');
                    ingresar.classList.remove('d-none');
                    return;
                //ELSE DE LA VALIDACIÓN DE LA SESIÓN
                }else if(data === "Coincide"){
                    session();
                }else{console.log(data)}
            })
            //catch de la validación del correo electrónico
            .catch(err => {
                console.log('Error al analizar la respuesta JSON:', err);
                console.log('Respuesta completa:', err.response); // Imprime la respuesta completa
            });
        }
        //FUNCIÓN QUE HACE LA PETICIÓN DE CREAR LA SESIÓN
        function session(){
            let url = "controller/session.controlador.php";
            formData = new FormData();
            formData.append('usuario', user);
            formData.append('email', vEmail);
            formData.append('request', 'start');
            fetch(url,{
                method: "POST",
                body: formData,
                mode: "cors"
            })
            .then(response => response.text())
            .then(data => {
                alert("Sesión iniciada satisfactoriamente");
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
    })
}

