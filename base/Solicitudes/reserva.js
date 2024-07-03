const pais = document.getElementById("PaisReserva");
const ciudad = document.getElementById("CiudadReserva");
const restaurante = document.getElementById("RestauranteReserva");
const horaDisponible = document.getElementById("HoraReserva");
const ventanaReserva = document.getElementById("ContenidoVentanaModalReserva");
document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelector('.formularioReserva').reset();
});
/**SELECT DE PAIS EN RESERVA */
getpais();
function getpais(){
    fetch('/Solicitudes/PaisReserva.php')
    .then(response => response.text())
    .then(data => {
        pais.innerHTML = data;
    })
    .catch(err => console.log(err));
};

/**SELECT DE CIUDAD EN RESERVA */
function getciudad(){
    let paisSelecionado = document.getElementById("PaisReserva").value;
    formData = new FormData()
    formData.append('paisSelecionado', paisSelecionado)
    fetch('/Solicitudes/CiudadReserva.php',{
        method: "POST", 
        body: formData, 
        mode: 'cors'
    })
    .then(response => response.json())
    .then(data => {
        console.log('data es ' + JSON.stringify(data));
        ciudad.innerHTML = data;
    })
    .catch(err => console.log(err));
};
/**SELECT DEL RESTAURANTE EN RESERVA */
function getrestaurante(){
    let ciudadSelecionada = ciudad.value;
    formData = new FormData()
    formData.append('ciudad', ciudadSelecionada)
    fetch('/Solicitudes/RestauranteReserva.php',{
        method: "POST", 
        body: formData, 
        mode: 'cors'
    })
    .then(response => response.json())
    .then(data => {
        restaurante.innerHTML = data;
    })
    .catch(err => console.log(err));
};
/**CANCELAR FECHAS ANTERIORES DE FECHA RESERVA */
var today = new Date().toISOString().split('T')[0];
document.getElementById('fechaReserva').setAttribute('min', today);
/**DESACTIVAR EL INPUT TYPE FECHA HASTA QUE SE SELECCIONE UN RESTAURANTE */
window.onload = function() {
    document.getElementById('fechaReserva').disabled = true;
};

document.getElementById('RestauranteReserva').onchange = function() {
    if (this.value != '') {
        document.getElementById('fechaReserva').disabled = false;
    } else {
        document.getElementById('fechaReserva').disabled = true;
    }
};
/**EVITANDO QUE SE SELECCIONE UN SABADO O DOMINGO, Y CARGANDO LAS HORAS DISPONIBLES PARA LA RESERVA */
document.getElementById('fechaReserva').onchange = function() {
    var fechaSeleccionada = new Date(this.value);
    var diaDeLaSemana = fechaSeleccionada.getDay();
    if (diaDeLaSemana == 6 || diaDeLaSemana == 5) {
        alert('Lo sentimos, no se pueden hacer reservas los sábados ni domingos.');
        this.value = '';
    } else {
        var restauranteReserva = document.getElementById('RestauranteReserva').value;
        var data = {fecha: fechaSeleccionada, restaurante: restauranteReserva};
        fetch('/Solicitudes/horasDisponibles.php',{
            method: "POST", 
            body: JSON.stringify(data), 
            headers: {
                'Content-Type': 'application/json'
            },
            mode: 'cors'
        })
        .then(response => response.text())
        .then(data => {
            horaDisponible.innerHTML = data;
        })
        .catch(err => console.log(err));
    }
};

/**ENVIO DE FORMULARIO, VALIDACIONES REQUERIDAS Y VENTANA MODAL */
document.querySelector('.formularioReserva').addEventListener('submit', function(event) {
    event.preventDefault();
    fetch("/Solicitudes/sesion.php",{
        method : "POST",
        mode : "cors"
    })
    .then(response => response.text())
    .then(usuarioHaIniciadoSesion => {
        if (usuarioHaIniciadoSesion == "Sesion_No_Iniciada") {
            alert('Debes iniciar sesión para realizar la reserva.');
        } else {
            let restauranteReserva = document.getElementById('RestauranteReserva').value;
            let numPersonas = document.getElementById('NumPersonas').value;
            let fechaSeleccionada = document.getElementById("fechaReserva").value;
            let horaSeleccionada = document.getElementById('HoraReserva').value;
            let ocasion = document.getElementById('ocasion').value;
            let infoAdicional = document.getElementById('EspecificacionEvento').value;
            if(ocasion == ""){
                ocasion = "Ninguna Especificada";
            };
            if(infoAdicional == ""){
                infoAdicional = "Ninguna Información Adicional.";
            };
            let data = {idRestaurante: restauranteReserva, numeroPersonas: numPersonas, fecha: fechaSeleccionada, horaSelect: horaSeleccionada, Ocasion: ocasion, infoAdicion: infoAdicional};
            fetch('/Solicitudes/ConfirmarReserva.php',{
                method: "POST", 
                body: JSON.stringify(data), 
                headers: {
                    'Content-Type': 'application/json'
                },
            mode: 'cors'
        }).then(response => response.text())
            .then(data =>{
                ventanaReserva.innerHTML = data;
                let ventanaModal = document.getElementById("VentanaModalReserva");
                ventanaModal.style.display = "block";
                document.getElementById('ConfirmarCancelarButon').addEventListener("click",function(){
                    ventanaModal.style.display = "none";
                });
                document.getElementById('ConfirmarAceptarButton').addEventListener("click",function(){
                    event.preventDefault();
                    let formData = new FormData();
                    formData.append('Restaurante', document.getElementById('RestauranteReserva').value);
                    formData.append('numeroPersonas', document.getElementById('NumPersonas').value);
                    formData.append('Fecha', document.getElementById("fechaReserva").value);
                    formData.append('Hora', document.getElementById('HoraReserva').value);
                    formData.append('Ocasion', document.getElementById('ocasion').value);
                    formData.append('Comentario', document.getElementById('EspecificacionEvento').value);
                    fetch('/Solicitudes/reserva.php', {
                        method: 'POST',
                        body: formData,
                        mode : "cors"
                    })
                .then(response => response.text())
                .then(data => {
                    if(data == "se_inserto"){
                        alert("¡Reserva Realizada con Exito!");
                        ventanaModal.style.display = "none";
                        window.location.href = '/Pages/Reserva.html';
                    }
                    else{
                        console.log("error "+data);
                        alert("Intentelo en otro momento.");
                        
                    }
    });
                });
            })
        }
    })
    .catch(error => console.error('Error:', error));
});



