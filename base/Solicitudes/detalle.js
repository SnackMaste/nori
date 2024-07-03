const detalle = document.getElementById('modal');
function fetchAndSetDataDetalle(url, formData, targetElement) {
    return fetch(url, {
        method: "POST", 
        body: formData, 
        mode: 'cors'
    })
    .then(response => response.json())
    .then(data => {
        targetElement.innerHTML=data
        let ventana = document.getElementById("VentanaModalD");
        let cerrar = document.getElementById("CerrarModalD");
        ventana.style.display = "block";
        cerrar.onclick = function() {
            ventana.style.display = "none";
        }
    })
    .catch(err => console.log(err))
};
// Asegúrate de que getDetalle devuelva una promesa
function getDetalle(event) {
    let idProducto = event.target.getAttribute("data-id");
    let url = '/Solicitudes/getDetalle.php'
    let formData = new FormData()
    formData.append('producto', idProducto)
    fetchAndSetDataDetalle(url, formData, detalle)
};
var pedido = {};
var contadores = {};
var totalGlobal = 0;
var contadorProducto = 0;

function setup() {
    let botones = document.querySelectorAll('.ContenedorBtnProducto');
    botones.forEach(function(boton) {
        let span = boton.querySelector('span');
        let idañadir = span.getAttribute('data-añadir');
        contadores[idañadir] = 0;
        let mas = document.createElement('button');
        mas.textContent = '+';
        let menos = document.createElement('button');
        menos.textContent = '-';
        span.after(mas);
        span.before(menos);
        mas.style.display = 'none';
        menos.style.display = 'none';
        boton.addEventListener('click', function(event) {
            if (event.target.matches('.Detalle')) {
                getDetalle(event);
            }
            if (event.target.matches('.Añadir')){
                fetch("/Solicitudes/sesion.php",{
                    method : "POST",
                    mode : "cors"
                })
                .then(response => response.text())
                .then(usuarioHaIniciadoSesion => {
                    console.log(usuarioHaIniciadoSesion)
                    if (usuarioHaIniciadoSesion == "Sesion_No_Iniciada") {
                        alert('Debes iniciar sesión para añadir al carrito');
                    } else {
                contadores[idañadir] += 1;
                span.textContent = contadores[idañadir];
                mas.style.display = 'inline';
                menos.style.display = 'inline';
                pedido[idañadir] = contadores[idañadir];
                let contenedor = this.closest('.BtnProductoContenedor');
                let precioElement = contenedor.querySelector('.PrecioProducto');
                let precio = parseFloat(precioElement.getAttribute('data-precio'));
                let moneda = precioElement.getAttribute('data-moneda');
                let total = precio;
                totalGlobal += total;
                let totalElement = document.getElementById('totalPrecioProductos');
                let totalFormateado = totalGlobal.toLocaleString('es-CO');
                totalElement.textContent = `$${totalFormateado} ${moneda}`;
                let contadorProductos = document.getElementById('contadorProductos');
                contadorProducto += 1;
                contadorProductos.textContent = contadorProducto;}
                    })
            }})
            mas.addEventListener('click', function(){
                contadores[idañadir] += 1;
                span.textContent = contadores[idañadir];
                pedido[idañadir] = contadores[idañadir];
                let contenedor = this.closest('.BtnProductoContenedor');
                let precioElement = contenedor.querySelector('.PrecioProducto');
                let precio = parseFloat(precioElement.getAttribute('data-precio'));
                let moneda = precioElement.getAttribute('data-moneda');
                let total = precio;
                totalGlobal += total;
                let totalElement = document.getElementById('totalPrecioProductos');
                let totalFormateado = totalGlobal.toLocaleString('es-CO');
                totalElement.textContent = `$${totalFormateado} ${moneda}`;
                let contadorProductos = document.getElementById('contadorProductos');
                contadorProducto += 1;
                contadorProductos.textContent = contadorProducto;
            });
            menos.addEventListener('click', function(){
                if (contadores[idañadir] > 0) {
                    contadores[idañadir]-=1;
                    let contenedor = this.closest('.BtnProductoContenedor');
                    let precioElement = contenedor.querySelector('.PrecioProducto');
                    let precio = parseFloat(precioElement.getAttribute('data-precio'));
                    let moneda = precioElement.getAttribute('data-moneda');
                    let total = precio;
                    totalGlobal -= total;
                    let totalElement = document.getElementById('totalPrecioProductos');
                    let totalFormateado = totalGlobal.toLocaleString('es-CO');
                    totalElement.textContent = `$${totalFormateado} ${moneda}`;
                    let contadorProductos = document.getElementById('contadorProductos');
                    contadorProducto -= 1;
                    contadorProductos.textContent = contadorProducto;
                    span.textContent = contadores[idañadir];
                    pedido[idañadir] = contadores[idañadir];
                    if (contadores[idañadir] == 0){
                        span.textContent = "AÑADIR";
                        mas.style.display = 'none';
                        menos.style.display = 'none';
                        delete pedido[idañadir];
                    }
                }
                else {
                    span.textContent = "AÑADIR";
                    mas.style.display = 'none';
                    menos.style.display = 'none';
                    delete pedido[idañadir];
                }
            });
        })};




