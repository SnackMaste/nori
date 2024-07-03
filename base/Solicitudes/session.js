var ventana;
fetch('/Solicitudes/sesion.php', {
    method: 'POST'
})
.then(response => response.text())
.then(response => {
    if (response === 'Sesion_Iniciada') {
        $("#header").load("/Organisms/Header/headerLogin.html");
    } else {
        
        var contenedorFormularios;
        var formularioLogin;
        var formularioRegistro;
        var fondoLogin;
        var fondoRegistro;
        var cerrar;
        $("#header").load("/Organisms/Header/header.html", function() {
            $("#ventanaModalLogin").load("/Organisms/Fichas/VentanaModalLogin.html",function(){
                ventana = document.getElementById("VentanaModalL");
                contenedorFormularios = document.querySelector(".ContenedorFormularios");
                formularioLogin = document.querySelector(".FormularioLogin");
                formularioRegistro = document.querySelector(".FormularioRegistro");
                fondoLogin = document.querySelector(".FondoLogin");
                fondoRegistro = document.querySelector(".FondoRegistro");
                cerrar = document.getElementById("CerrarModalL");
                cerrar.addEventListener("click", CerrarLogin);
                document.getElementById("IniciarSesion").addEventListener("click", iniciarSesion);
                document.getElementById("Registrarse").addEventListener("click", registro);
                document.getElementById("Login").addEventListener("click", mostrarLogin);
                function mostrarLogin(){
                    ventana.style.display = "block";
                    iniciarSesion();
                    clearLogin ();
                }
                function CerrarLogin(){
                    ventana.style.display = "none";
                    clearLogin ();
                }
                function registro() {
                    formularioRegistro.style.display = "block";
                    contenedorFormularios.style.left = "470px";
                    formularioLogin.style.display = "none";
                    fondoRegistro.style.opacity = "0";
                    fondoLogin.style.opacity = "1";
                    cerrar.style.left = "3%";
                    btnSelectP();
                    fieldsetPersona.style.display = "block";
                    fieldsetPersona.disabled = false;
                    fieldsetEmpresa.style.display = "none";
                    fieldsetEmpresa.disabled = true;
                    fieldsetDomicilio.style.display = "none";
                    fieldsetDomicilio.disabled = true;
                    fieldsetContacto.style.display = "none";
                    fieldsetContacto.disabled = true;
                }
                function iniciarSesion() {
                    formularioRegistro.style.display = "none";
                    contenedorFormularios.style.left = "15px";
                    formularioLogin.style.display = "block";
                    fondoRegistro.style.opacity = "1";
                    fondoLogin.style.opacity = "0";
                    cerrar.style.left = "96%"
                }
            })
        })

        function iniciarSesion() {
            formularioRegistro.style.display = "none";
            contenedorFormularios.style.left = "15px";
            formularioLogin.style.display = "block";
            fondoRegistro.style.opacity = "1";
            fondoLogin.style.opacity = "0";
            cerrar.style.left = "96%"
        }
    }
    $("#footer").load("/Organisms/Footer/Footer.html");
})
.catch(error => console.error('Error:', error));