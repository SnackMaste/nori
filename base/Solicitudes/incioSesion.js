/**FIELDSET DEL FORMULARIO */
var comoE = document.getElementById('ComoE');
var fieldsetLoginP = document.getElementById('LoginPersona');
var fieldsetLoginE = document.getElementById('LoginEmpresa');
/**BOTONES DEL FORMULARIO */
var btnPersonaL = document.getElementById('BtnPersonaLogin');
var btnEmpresaL = document.getElementById('BtnEmpresaLogin');
var btnIngresarP = document.getElementById('IngresarP');
var btnIngresarE = document.getElementById('IngresarE');
/**DATOS DEL FORMULARIO TIPO PERSONA*/
var identiPL = document.getElementById('IdentificacionLogin');
var errorPL = document.getElementById('ErrorPLogin');
var contraseñaP = document.getElementById('ContraseñaP');
var noExistP = document.getElementById('ErrorPNoExist');
/**DATOS DEL FORMULARIO TIPO EMPRESA */
var identiEL = document.getElementById('IdentificacionFiscalLogin');
var contraseñaE = document.getElementById('ContraseñaE');
var errorEL = document.getElementById('ErrorELogin');
var noExistE = document.getElementById('ErrorENoExist');

btnSelectPL();

function btnSelectPL(){
    btnPersonaL.style.backgroundColor = "#000";
    btnEmpresaL.style.backgroundColor = "#e98f25";
    btnPersonaL.style.color = "#e98f25";
    btnEmpresaL.style.color = "#000";
    btnPersonaL.style.border = "2px solid #e98f25";
    btnEmpresaL.style.border = "none";
    errorPL.style.display =  'none';
    errorEL.style.display =  'none';
    noExistP.style.display =  'none';
    noExistE.style.display =  'none';
    fieldsetLoginE.style.display = 'none';
    fieldsetLoginE.disabled = true;
    fieldsetLoginP.style.display = 'block';
    fieldsetLoginP.disabled = false;
    comoE.style.display = 'none';
    clearLogin();
};

function btnSelectEL(){
    btnPersonaL.style.backgroundColor = "#e98f25";
    btnEmpresaL.style.backgroundColor = "#000";
    btnPersonaL.style.color = "#000";
    btnEmpresaL.style.color = "#e98f25";
    btnPersonaL.style.border = "none";
    btnEmpresaL.style.border = "2px solid #e98f25";
    errorPL.style.display =  'none';
    errorEL.style.display =  'none';
    noExistP.style.display =  'none';
    noExistE.style.display =  'none';
    fieldsetLoginE.style.display = 'block';
    fieldsetLoginE.disabled = false;
    fieldsetLoginP.style.display = 'none';
    fieldsetLoginP.disabled = true;
    comoE.style.display = 'block';
    clearLogin()
};

btnPersonaL.addEventListener("click", btnSelectPL);
btnEmpresaL.addEventListener("click", btnSelectEL);

document.getElementById("IngresarP").addEventListener("click", function() {
    var xhrI = new XMLHttpRequest();
    var xhrL = new XMLHttpRequest();
    var identiPL_local = document.getElementById("IdentificacionLogin");
    var contraseñaP_local = document.getElementById("ContraseñaP");
    var errorPL_local = document.getElementById("ErrorPLogin");
    var noExistP_local = document.getElementById('ErrorPNoExist');
    xhrI.open("POST", "/Solicitudes/ValidacionUsuario.php", true);
    xhrI.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhrI.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            if (this.responseText === "usuario_no_existente") {
                noExistP_local.style.display = "block";
                errorPL_local.style.display = "none";
                return;
            } else {
                xhrL.open("POST", "/Solicitudes/Login.php", true);
                xhrL.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhrL.onreadystatechange = function() {
                    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                        if (this.responseText === "contraseña_incorrecta") {
                            errorPL_local.style.display = "block";
                            noExistP_local.style.display = "none";
                        } else {
                            $("#header").load("/Organisms/Header/headerLogin.html");
                            CerrarLogin();
                            function CerrarLogin(){
                                ventana.style.display = "none";
                                clearLogin ();
                            }
                        }
                    }
                }
                var iniciar = "Identificacion=" + identiPL_local.value + "&Contraseña=" + contraseñaP_local.value + "&TipoPersona=Persona";
                xhrL.send(iniciar);
            }
        }
    }
    var data = "Identificacion=" + identiPL_local.value + "&TipoPersona=Persona";
    xhrI.send(data);
});

document.getElementById("IngresarE").addEventListener("click", function() {
    var xhrIE = new XMLHttpRequest();
    var xhrE = new XMLHttpRequest();
    var identiEL_local = document.getElementById("IdentificacionFiscalLogin");
    var contraseñaE_local = document.getElementById("ContraseñaE");
    var errorEL_local = document.getElementById("ErrorELogin");
    var noExistE_local = document.getElementById('ErrorENoExist');
    xhrIE.open("POST", "/Solicitudes/ValidacionUsuario.php", true);
    xhrIE.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhrIE.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            if (this.responseText === "usuario_no_existente") {
                noExistE_local.style.display = "block";
                errorEL_local.style.display = "none";
                return;
            } else {
                xhrE.open("POST", "/Solicitudes/Login.php", true);
                xhrE.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhrE.onreadystatechange = function() {
                    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                        if (this.responseText === "contraseña_incorrecta") {
                            errorEL_local.style.display = "block";
                            noExistE_local.style.display = "none";
                        } else {
                            $("#header").load("/Organisms/Header/headerLogin.html");
                            CerrarLogin();
                            function CerrarLogin(){
                                ventana.style.display = "none";
                                clearLogin ();
                            }
                        }
                    }
                }
                var iniciarE = "Identificacion=" + identiEL_local.value + "&Contraseña=" + contraseñaE_local.value + "&TipoPersona=Empresa";
                xhrE.send(iniciarE);
            }
        }
    }
    var dataE = "Identificacion=" + identiEL_local.value + "&TipoPersona=Empresa";
    xhrIE.send(dataE);
});

function clearLogin () {
    identiPL.value = "";
    identiEL.value = "";
    contraseñaP.value = "";
    contraseñaE.value = "";
}