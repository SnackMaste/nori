let carrito = document.getElementById("CarritoCompras");
let ventanaPedido = document.getElementById("VentanaModalC");
const conenidoVentanaPedido = document.getElementById("ContenidoPedidoModal");
let checkedNo = "checked";
let checkedSi = "";
let puntos = "none";
let descuento = "none";
let gana = "table-row";
let valorinput = 0;
var puntosUsados = 0;
var puntosGanados = 0;
var totalAPagar = 0;
var idDelProducto;
var domicilio="true";
var direCliente="true";
var infoPedido={};
carrito.addEventListener('click', function(){
    cargarPedido(valorinput,checkedNo,checkedSi,puntos,descuento,gana);
});
function  cargarPedido(valor, checkedno, checkedsi, puntosv, descuentov, ganav) {
    if (pedido === null || pedido === "" || Object.keys(pedido).length === 0){
        alert("No hay productos en el carro de compras.");
        location.reload();
    }else {
        let formData = new FormData();
        formData.append('pedido', JSON.stringify(pedido));
        formData.append('valor', valor);
        formData.append('checkedNo', checkedno);
        formData.append('checkedSi', checkedsi);
        formData.append('puntos', puntosv);
        formData.append('descuento', descuentov);
        formData.append('gana', ganav);
        fetch('/Solicitudes/pedido.php',{
            method: "POST",
            body: formData ,
            mode: "cors"
        }).then(response => response.text())
        .then(data =>{
            conenidoVentanaPedido.innerHTML = data;
            ventanaPedido.style.display = "block";
            carrito.style.display = "none";
            let cerrarPedido = document.getElementById("CerrarPedido");
            cerrarPedido.addEventListener('click', function (){
                ventanaPedido.style.display = "none";
                carrito.style.display = "block";
            });
            let cancelarPedido = document.getElementById("CancelarPedido");
            cancelarPedido.addEventListener('click',function(){
                if (confirm("Si realiza esta acción eliminará todos los productos agregados al carrito, ¿desea continuar?")) {
                    pedido = {};
                    contadores = {};
                    infoPedido = {};
                    ventanaPedido.style.display = "none";
                    carrito.style.display = "block";
                    totalGlobal = 0;
                    contadorProducto = 0;
                    location.reload();
                } else {}
            })
            let fila = document.querySelectorAll(".fila");
            fila.forEach(function(boton){
                let span = boton.querySelector('span');
                let idProductoP = span.getAttribute('data-id');
                idDelProducto = idProductoP;
                let totalPedido = document.getElementById("TotalPedido");
                let valor = totalPedido.getAttribute('data-valor');
                valor = parseFloat(valor);
                let contenedor = document.body;
                let precioElement = contenedor.querySelector('.PrecioProducto');
                let moneda = precioElement.getAttribute('data-moneda');
                totalGlobal = valor;
                let totalElement = document.getElementById('totalPrecioProductos');
                let totalFormateado = totalGlobal.toLocaleString('es-CO');
                totalElement.textContent = `$${totalFormateado} ${moneda}`;
                let fichaProducto =  document.getElementById(idProductoP);
                let añadir = fichaProducto.querySelector('.Añadir');
                añadir.textContent = contadores[idProductoP];
                boton.addEventListener('click', function(event) {
                    if (event.target.matches('.boton-mas')) {
                        contadores[idProductoP]++;
                        pedido[idProductoP] = contadores[idProductoP];
                        contadorProducto += 1;
                        let contadorProductos = document.getElementById('contadorProductos');
                        contadorProductos.textContent = contadorProducto;
                        cargarPedido(valorinput,checkedNo,checkedSi,puntos,descuento,gana);
                    }
                    if (event.target.matches('.boton-menos')) {
                        contadores[idProductoP]--;
                        pedido[idProductoP] = contadores[idProductoP];
                        contadorProducto -= 1;
                        let contadorProductos = document.getElementById('contadorProductos');
                        contadorProductos.textContent = contadorProducto;
                        if (contadores[idProductoP] == 0) {
                            delete pedido[idProductoP];
                            let botonMenos = añadir.previousElementSibling;
                            let botonMas = añadir.nextElementSibling;
                            botonMenos.style.display = "none";
                            botonMas.style.display = "none";
                            añadir.textContent = "AÑADIR";
                        }
                        cargarPedido(valorinput,checkedNo,checkedSi,puntos,descuento,gana);
                    }
                    if (event.target.matches('.IcoBasura')) {
                        delete pedido[idProductoP];
                        let contadorProductos = document.getElementById('contadorProductos');
                        let unidad = contadores[idProductoP];
                        unidad =  parseInt(unidad);
                        contadorProducto -= unidad;
                        contadorProductos.textContent = (contadorProducto);
                        contadores[idProductoP] = 0;
                        let botonMenos = añadir.previousElementSibling;
                        let botonMas = añadir.nextElementSibling;
                        botonMenos.style.display = "none";
                        botonMas.style.display = "none";
                        añadir.textContent = "AÑADIR";
                        cargarPedido(valorinput,checkedNo,checkedSi,puntos,descuento,gana);
                    }
                })
            })
            let radioSi=document.getElementById('si');
            let radioNo=document.getElementById('no');
            radioSi.addEventListener('click', function() {
                checkedSi = "checked";
                checkedNo = "";
                puntos = "table-row";
                descuento = "table-row";
                gana = "none";
                valorinput=0;
                cargarPedido(valorinput, checkedNo, checkedSi, puntos, descuento, gana)
            });
            radioNo.addEventListener('click', function() {
                checkedSi = "";
                checkedNo = "checked";
                puntos = "none";
                descuento = "none";
                gana = "table-row";
                valorinput=0;
                cargarPedido(valorinput, checkedNo, checkedSi, puntos, descuento, gana)
            });
            let confirmarPedido =  document.getElementById('Confirmar');
            confirmarPedido.addEventListener('click',function(){
                puntosGanados = Number(document.getElementById('CantidadPuntos').value);
                puntosUsados = Number(document.getElementById('Gana').dataset.puntos);
                totalAPagar = Number(document.getElementById('TotalPedido').dataset.valor);
                let punto;
                let cantidadpunto;
                let totalParcial
                let descuentocompra;
                if (puntosUsados == 0){
                    punto = 'ganados';
                    cantidadpunto = puntosGanados;
                    descuentocompra = 0;
                    totalParcial = totalAPagar;
                }else{
                    punto = 'usados';
                    cantidadpunto = puntosUsados;
                    descuentocompra = Number(document.getElementById('descuentocompra').getAttribute('data-descuento'));
                    totalParcial = (totalAPagar + descuentocompra);
                };
                infoPedido['restaurante'] = idRestaurante;
                infoPedido['puntos'] = punto;
                infoPedido['cantidad puntos'] = cantidadpunto;
                infoPedido['descuento'] = descuentocompra;
                infoPedido['total parcial'] = totalParcial;
                infoPedido['total a pagar'] = totalAPagar;
                tipoDeEntrega(idRestaurante,domicilio,direCliente);
            })
        });
    }
};

function validarValor(input) {
    let max = parseInt(input.max);
    let min = parseInt(input.min);
    let valori = input.value.toString();
    valori = valori.replace(/\D/g,'');
    valori = parseInt(valori);
    if (valori > max) {
        valori = max;
    }
    if (valori < min) {
        valori = min;
    }
    input.value = valori;
    input.setAttribute('value', valori);
}
function valuePuntos(input){
    valorinput = input.value;
    checkedSi = "checked";
    checkedNo = "";
    puntos = "table-row";
    descuento = "table-row";
    gana = "none";
    cargarPedido(valorinput, checkedNo, checkedSi, puntos, descuento, gana);
}



