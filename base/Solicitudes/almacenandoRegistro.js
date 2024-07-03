/**FIELDSET DEL FORMULARIO DE REGISTRO */
let fieldsetPersona = document.getElementById('Persona');
let fieldsetEmpresa = document.getElementById('Empresa');
let fieldsetDomicilio = document.getElementById('Direccion');
let fieldsetContacto = document.getElementById('Contacto');
/**BOTONES DEL FORMULARIO DE REGISTRO */
let contenedorBtnPE = document.getElementById('BotonPersonaEmpresa');
let contenedorFormR = document.getElementById('FormularioRegistro');
let btnPersona = document.getElementById('BtnPersona');
let btnEmpresa = document.getElementById('BtnEmpresa');
let btnSiguienteP = document.getElementById('SiguienteDireccionPersona');
let btnSiguienteE = document.getElementById('SiguienteDireccionEmpresa');
let btnSiguienteD = document.getElementById('SiguienteContacto');
let btnAtrasDireccion = document.getElementById('AtrasDireccion');
let btnAtrasContacto = document.getElementById('AtrasContacto');
let btnEnvio = document.getElementById('EnviarRegistro');
/**DATOS DE TIPO PERSONA */
let identiPersona = document.getElementById('Identificacion');
let nombre1 = document.getElementById('Nombre1');
let nombre2 = document.getElementById('Nombre2');
let apellido1 = document.getElementById('Apellido1');
let apellido2 = document.getElementById('Apellido2');
let errorP = document.getElementById('ErrorP');
/**DATOS DE TIPO EMPRESA */
let identiEmpresa = document.getElementById('IdentificacionFiscal');
let razonSocial = document.getElementById('RazonSocial');
let errorE = document.getElementById('ErrorE');
/**DATOS DE TIPO DIRECCION */
let paisR = document.getElementById('PaisRegistro');
let ciudadR = document.getElementById('CiudadRegistro');
let barrioR = document.getElementById('Barrio');
let tipoCalleR = document.getElementById('TipoCalleRegistro');
let nombreCalleR = document.getElementById('CalleRegistro');
let numCalleR = document.getElementById('NumCalleRegistro');
let torreR = document.getElementById('Torre');
let pisoR = document.getElementById('Piso');
let puertaR = document.getElementById('Puerta');
/**DATOS DE TIPO CONTACTO */
let codigoPiasR = document.getElementById('countryCode');
let numeroTelR = document.getElementById('Telefono');
let correoR = document.getElementById('EmailR');
let contraseñaR = document.getElementById('ContraseñaR');
let confirContraseñaR = document.getElementById('ConfirContraseñaR');
/**VARIABLES DE ENVIO DE FORMULARIO */
var dataPE;
var dataD;
var dataC;
var registro;
/**FUNCIONES DE BOTONES EMPRESA Y PERSONA */
btnSelectP();

function btnSelectP(){
    btnPersona.style.backgroundColor = "#000";
    btnEmpresa.style.backgroundColor = "#e98f25";
    btnPersona.style.color = "#e98f25";
    btnEmpresa.style.color = "#000";
    btnPersona.style.border = "2px solid #e98f25";
    btnEmpresa.style.border = "none";
    contenedorBtnPE.style.display = "flex";
    contenedorFormR.style.top = "-299px";
    errorP.style.display =  'none';
    btnDevolverP();
    btnDevolverE();
    btnDevolverC();
};
function btnSelectE(){
    btnPersona.style.backgroundColor = "#e98f25";
    btnEmpresa.style.backgroundColor = "#000";
    btnPersona.style.color = "#000";
    btnEmpresa.style.color = "#e98f25";
    btnPersona.style.border = "none";
    btnEmpresa.style.border = "2px solid #e98f25";
    contenedorBtnPE.style.display = "flex";
    contenedorFormR.style.top = "-195px";
    errorE.style.display = "none"
    btnDevolverP();
    btnDevolverE();
    btnDevolverC();
};

/**EVENTLISTENER DE LOS BOTONES PERSONA Y EMPRESA */

btnPersona.addEventListener( "click", function(){
    fieldsetPersona.style.display = "block";
    fieldsetPersona.disabled = false;
    fieldsetEmpresa.style.display = "none";
    fieldsetEmpresa.disabled = true;
    fieldsetDomicilio.style.display = "none";
    fieldsetDomicilio.disabled = true;
    fieldsetContacto.style.display = "none";
    fieldsetContacto.disabled = true;
    btnSelectP();
});

btnEmpresa.addEventListener( "click", function(){
    fieldsetPersona.disabled = true;
    fieldsetPersona.style.display = "none";
    fieldsetEmpresa.disabled = false;
    fieldsetEmpresa.style.display = "block";
    fieldsetDomicilio.disabled = true;
    fieldsetDomicilio.style.display = "none";
    fieldsetContacto.disabled = true;
    fieldsetContacto.style.display = "none";
    btnSelectE();
    btnDevolverP();
    btnDevolverE();
    btnDevolverC();
});

/**BOTON DE SIGUIENTE EN EL FIELDSET DE PERSONA */

btnSiguienteP.addEventListener( "click", function(){
    if (!identiPersona.value || !nombre1.value || !apellido1.value){
        alert("Por favor, completa todos los campos obligatorios.");
        return;
    }
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/Solicitudes/ValidacionUsuario.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            if (this.responseText === "usuario_existente") {
                errorP.style.display = "block";
                contenedorFormR.style.top = "-319px"
            } else {
                fieldsetPersona.disabled = true;
                fieldsetPersona.style.display = "none";
                fieldsetEmpresa.disabled = true;
                fieldsetEmpresa.style.display = "none";
                fieldsetDomicilio.disabled = false;
                fieldsetDomicilio.style.display = "block";
                fieldsetContacto.disabled = true;
                fieldsetContacto.style.display = "none";
                contenedorBtnPE.style.display = "none";
                contenedorFormR.style.top = "-299px";
                btnDevolverD();
                recargaPaisRegistro();
            }
        }
    }
    var data = "Identificacion=" + identiPersona.value + "&TipoPersona=Persona";
    dataPE= "Identificacion=" + identiPersona.value + "&TipoPersona=Persona&Nombre1="+ nombre1.value + "&Nombre2=" + nombre2.value + "&Apellido1=" + apellido1.value + "&Apellido2=" + apellido2.value;
    xhr.send(data);
});

/**BOTON DE SIGUIENTE DEL FIELDSET DE EMPRESA */

btnSiguienteE.addEventListener( "click", function(){
    if (!identiEmpresa.value || !razonSocial.value){
        alert("Por favor, completa todos los campos obligatorios.");
        return;
    }
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/Solicitudes/ValidacionUsuario.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            if (this.responseText === "usuario_existente") {
                errorE.style.display = "block";
                contenedorFormR.style.top = "-215px"
            } else {
                fieldsetPersona.disabled = true;
                fieldsetPersona.style.display = "none";
                fieldsetEmpresa.disabled = true;
                fieldsetEmpresa.style.display = "none";
                fieldsetDomicilio.disabled = false;
                fieldsetDomicilio.style.display = "block";
                fieldsetContacto.disabled = true;
                fieldsetContacto.style.display = "none";
                contenedorBtnPE.style.display = "none";
                contenedorFormR.style.top = "-299px";
                btnDevolverD();
                recargaPaisRegistro();
            }
        }
    }
    var data = "Identificacion=" + identiEmpresa.value + "&TipoPersona=Empresa";
    dataPE= "Identificacion=" + identiEmpresa.value + "&TipoPersona=Empresa&Nombre1="+ razonSocial.value + "&Nombre2=&Apellido1=&Apellido2=";
    xhr.send(data);
});

/**BOTON DE DEVOLVER QUE ESTA EN FIELDSET DE DIRECCION */

btnAtrasDireccion.addEventListener ("click", function () {
    fieldsetPersona.style.display = "block";
    fieldsetPersona.disabled = false;
    fieldsetEmpresa.style.display = "none";
    fieldsetEmpresa.disabled = true;
    fieldsetDomicilio.style.display = "none";
    fieldsetDomicilio.disabled = true;
    fieldsetContacto.style.display = "none";
    fieldsetContacto.disabled = true;
    btnSelectP();
    btnDevolverD();
    btnDevolverE();
    btnDevolverP();
    btnDevolverC();
})

/**BOTON DE SIGUIENTE QUE ESTA EN EL FIELDSET DE DIRECCION */

btnSiguienteD.addEventListener ("click", function () {
    if (!paisR.value || !ciudadR.value || !barrioR.value || !tipoCalleR.value || !nombreCalleR.value || !numCalleR.value ) {
        alert("Por favor, completa todos los campos obligatorios.");
        return;
    }
    fieldsetPersona.disabled = true;
    fieldsetPersona.style.display = "none";
    fieldsetEmpresa.disabled = true;
    fieldsetEmpresa.style.display = "none";
    fieldsetDomicilio.disabled = true;
    fieldsetDomicilio.style.display = "none";
    fieldsetContacto.disabled = false;
    fieldsetContacto.style.display = "block";
    contenedorBtnPE.style.display = "none";
    contenedorFormR.style.top = "-215px";
    dataD ="&Pais=" + paisR.value + "&Ciudad=" + ciudadR.value + "&Barrio=" + barrioR.value + "&TipoCalle=" + tipoCalleR.value + "&NombreCalle=" + nombreCalleR.value + "&NumeroCalle=" + numCalleR.value + "&Torre=" + torreR.value + "&Piso=" + pisoR.value + "&Puerta=" + puertaR.value ;
});

/**DEVOLVER QUE ESTA EN EL FIELDSET DE CONTACTO */

btnAtrasContacto.addEventListener ("click", function () {
    fieldsetPersona.disabled = true;
    fieldsetPersona.style.display = "none";
    fieldsetEmpresa.disabled = true;
    fieldsetEmpresa.style.display = "none";
    fieldsetDomicilio.disabled = false;
    fieldsetDomicilio.style.display = "block";
    fieldsetContacto.disabled = true;
    fieldsetContacto.style.display = "none";
    contenedorBtnPE.style.display = "none";
    contenedorFormR.style.top = "-299px";
    recargaPaisRegistro()
    btnDevolverC();
    btnDevolverD();
})

/** ENVIAR REGISTRO BOTON QUE ESTA EN EL FIELDSET DE CONTACTO */

btnEnvio.addEventListener ('click', function(){
    if (!codigoPiasR.value || !numeroTelR.value || !correoR.value || !contraseñaR.value || !confirContraseñaR.value ) {
        alert("Por favor, completa todos los campos obligatorios.");
        return;
    }
    if (contraseñaR.value != confirContraseñaR.value) {
        alert('Las contraseñas no coinciden');
        return;
    }
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/Solicitudes/registro.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            if (this.responseText.startsWith("Error:")) {
                console.error(this.responseText);
            } else {
                alert('Registro realizado exitosamente');
                iniciarSesion();
            }
        }
    }
    dataC = "&Codigo=" + codigoPiasR.value + "&NumeroTelefono=" + numeroTelR.value + "&Correo=" + correoR.value + "&Contraseña=" + contraseñaR.value;
    registro = dataPE + dataD + dataC;
    xhr.send(registro);
})
/**FUNCIONES DE BOTONES DE VOLVER */
function btnDevolverP() {
    identiPersona.value = "";
    nombre1.value = "";
    nombre2.value = "";
    apellido1.value = "";
    apellido2.value = "";
    errorP.style.display = "none";
    dataPE = '';
}

function btnDevolverE() {
    identiEmpresa.value = "";
    razonSocial.value = "";
    errorE.style.display = "none";
    dataPE = '';
}

function btnDevolverD() {
    paisR.value = "";
    ciudadR.value = "";
    barrioR.value = "";
    tipoCalleR.value = "";
    nombreCalleR.value = "";
    numCalleR.value = "";
    torreR.value = "";
    pisoR.value = "";
    puertaR.value = "";
    dataD = '';
}

function btnDevolverC() {
    numeroTelR.value = "";
    correoR.value = "";
    contraseñaR.value = "";
    confirContraseñaR.value = "";
    dataC = '' ;
}
