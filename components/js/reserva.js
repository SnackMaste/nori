/**CANCELAR FECHAS ANTERIORES DE FECHA RESERVA */
/**Tomamos la fecha de hoy */
var today = new Date().toISOString().split('T')[0];
document.getElementById('fecha').setAttribute('min', today);
/**DESACTIVAR EL INPUT TYPE FECHA HASTA QUE SE SELECCIONE UN RESTAURANTE */
window.onload = function() {
    let fechaElement = document.getElementById('fecha');
    let horaElement = document.getElementById('hora');
    fechaElement.disabled = true;
    fechaElement.setAttribute("data-bs-toggle", "tooltip");
    fechaElement.setAttribute("title", "Escoge primero un restaurante para seleccionar una fecha");
    horaElement.disabled = true;
    horaElement.setAttribute("data-bs-toggle", "tooltip");
    horaElement.setAttribute("title", "Escoge primero una fecha para seleccionar una hora");
};
document.getElementById('restaurante').onchange = function() {
    if (this.value != '') {
        document.getElementById('fecha').disabled = false;
    } else {
        document.getElementById('fecha').disabled = true;
    }
};
//Función para limitar a solo entrada numérica el input de personas
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
/**EVITANDO QUE SE SELECCIONE UN SÁBADO O DOMINGO, Y CARGANDO LAS HORAS DISPONIBLES PARA LA RESERVA */
document.getElementById('fecha').onchange = function() {
    var fechaSeleccionada = new Date(this.value);
    var diaDeLaSemana = fechaSeleccionada.getDay();
    if (diaDeLaSemana == 6 || diaDeLaSemana == 5) {
        alert('Lo sentimos, no se pueden hacer reservas los sábados ni domingos.');
        this.value = '';
        return;
    } else {
        if (this.value != '') {
            document.getElementById('hora').disabled = false;
        } else {
            document.getElementById('hora').disabled = true;
        }
        var restaurante = document.getElementById('restaurante').value;
        formData = new FormData();
        formData.append('solicitud', 'disponibilidad');
        formData.append('id', restaurante);
        formData.append('fecha', fechaSeleccionada);
        let url = './controller/reserva.controlador.php';
        var hora = document.getElementById('hora');
        fetch(url,{
            method: "POST", 
            body: formData, 
            mode: 'cors'
        })
        .then(response => response.text())
        .then(data => {
            hora.innerHTML = data;
        })
        .catch(err => console.log(err));
    }
};