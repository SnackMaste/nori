var efectivo = "true";
var debi = "true";
var direccioncliente  = {};
function tipoDeEntrega(idRestaurantex,Domicilio,Direccion){
    let formData = new FormData();
    formData.append('idRestaurante', idRestaurantex);
    formData.append("domicilio", Domicilio);
    formData.append("direccion", Direccion);
    fetch('/Solicitudes/tipoDeEntrega.php',{
        method: "POST",
        body: formData ,
        mode: "cors"
    }).then(response => response.text())
    .then(data =>{
        conenidoVentanaPedido.innerHTML = data;
        ventanaPedido.style.display = "block";
        carrito.style.display = "none";
        let volverPedido = document.getElementById("CerrarPedido");
        volverPedido.addEventListener('click', function (){
            cargarPedido(valorinput,checkedNo,checkedSi,puntos,descuento,gana);
        });
        let cancelarPedido = document.getElementById("CancelarPedido");
        cancelarPedido.addEventListener('click',function(){
            if (confirm("Si realiza esta acción eliminará este pedido, ¿desea continuar?")) {
                pedido = {};
                contadores = {};
                direccioncliente = {};
                infoPedido = {};
                ventanaPedido.style.display = "none";
                carrito.style.display = "block";
                totalGlobal = 0;
                contadorProducto = 0;
                location.reload();
            } else {}
        })
        let radioDomi =  document.getElementById("Domi");
        let radioRecoger = document.getElementById("Reco");
        radioDomi.addEventListener("click", function(){
            domicilio="true";
            tipoDeEntrega(idRestaurante, domicilio, direCliente)
        })
        radioRecoger.addEventListener("click", function(){
            domicilio="false";
            tipoDeEntrega(idRestaurante, domicilio, direCliente);
        })
        let radioCliente =  document.getElementById("DireC");
        let radioNueva = document.getElementById("DireN");
        radioCliente.addEventListener("click", function(){
            domicilio="true";
            direCliente="true";
            tipoDeEntrega(idRestaurante, domicilio, direCliente);
        })
        radioNueva.addEventListener("click", function(){
            domicilio="true";
            direCliente="false";
            tipoDeEntrega(idRestaurante, domicilio, direCliente);
        })
        let confirmar = document.getElementById("Confirmar");
        confirmar.addEventListener("click", function (){
            if (domicilio == "true"){
                infoPedido['tipo pedido'] = 'DOMI';
                if(direCliente == "false"){
                    let pais=document.getElementById('paisNuevo').innerText.replace('País: ', '');
                    let ciudad=document.getElementById('ciudadNueva').innerText.replace('Ciudad: ', '');
                    let barrio=document.getElementById('barrioNuevo').value;
                    let tipocalle=document.getElementById('tipocalleNueva').value;
                    let nombrecalle=document.getElementById('nombrecalleNueva').value;
                    let numerocalle=document.getElementById('numerocalleNueva').value;
                    let torrec=document.getElementById('torreNueva').value;
                    let pisoc=document.getElementById('pisoNuevo').value;
                    let puertac=document.getElementById('puertaNueva').value;
                    if(pais=="" || ciudad=="" || barrio=="" || tipocalle=="" || nombrecalle=="" || numerocalle==""){
                        alert('Por favor llena todos los campos de la dirección')
                        return;
                    }else{
                        direccioncliente['pais'] = 
                        direccioncliente['ciudad'] = 
                        direccioncliente['barrio'] = 
                        direccioncliente['tipo calle'] = 
                        direccioncliente['nombre calle'] = 
                        direccioncliente['numero calle'] = 
                        direccioncliente['torre'] = 
                        direccioncliente['piso'] = 
                        direccioncliente['puerta'] = 
                        infoPedido['direccion'] = direccioncliente;
                    }
                }else{
                    infoPedido['direccion'] = "actual";
                };
            }else{
                infoPedido['tipo pedido'] = 'RECO';
                infoPedido['direccion'] = "no"
            };
            metodoPago(efectivo, debi);
        })
    })
}