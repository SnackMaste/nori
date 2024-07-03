let imgCrediTar = {
    '40':'/Atoms/Img/tarjetas/VISA CREDITO FRENTE.png',
    '41':'/Atoms/Img/tarjetas/VISA CREDITO FRENTE.png',
    '42':'/Atoms/Img/tarjetas/VISA CREDITO FRENTE.png',
    '43':'/Atoms/Img/tarjetas/VISA CREDITO FRENTE.png',
    '44':'/Atoms/Img/tarjetas/VISA CREDITO FRENTE.png',
    '45':'/Atoms/Img/tarjetas/VISA CREDITO FRENTE.png',
    '46':'/Atoms/Img/tarjetas/VISA CREDITO FRENTE.png',
    '47':'/Atoms/Img/tarjetas/VISA CREDITO FRENTE.png',
    '48':'/Atoms/Img/tarjetas/VISA CREDITO FRENTE.png',
    '49':'/Atoms/Img/tarjetas/VISA CREDITO FRENTE.png',
    '51':'/Atoms/Img/tarjetas/MASTERCARD CREDITO FRENTE.png',
    '52':'/Atoms/Img/tarjetas/MASTERCARD CREDITO FRENTE.png',
    '53':'/Atoms/Img/tarjetas/MASTERCARD CREDITO FRENTE.png',
    '54':'/Atoms/Img/tarjetas/MASTERCARD CREDITO FRENTE.png',
    '55':'/Atoms/Img/tarjetas/MASTERCARD CREDITO FRENTE.png',
    '34':'/Atoms/Img/tarjetas/AMERICAN EXPRESS CREDITO FRENTE.png',
    '37':'/Atoms/Img/tarjetas/AMERICAN EXPRESS CREDITO FRENTE.png',
    '30':'/Atoms/Img/tarjetas/DINERS CLUB CREDITO FRENTE.png',
    '36':'/Atoms/Img/tarjetas/DINERS CLUB CREDITO FRENTE.png'
};
let imgDebiTar = {
    '40':'/Atoms/Img/tarjetas/VISA DEBITO FRENTE.png',
    '41':'/Atoms/Img/tarjetas/VISA DEBITO FRENTE.png',
    '42':'/Atoms/Img/tarjetas/VISA DEBITO FRENTE.png',
    '43':'/Atoms/Img/tarjetas/VISA DEBITO FRENTE.png',
    '44':'/Atoms/Img/tarjetas/VISA DEBITO FRENTE.png',
    '45':'/Atoms/Img/tarjetas/VISA DEBITO FRENTE.png',
    '46':'/Atoms/Img/tarjetas/VISA DEBITO FRENTE.png',
    '47':'/Atoms/Img/tarjetas/VISA DEBITO FRENTE.png',
    '48':'/Atoms/Img/tarjetas/VISA DEBITO FRENTE.png',
    '49':'/Atoms/Img/tarjetas/VISA DEBITO FRENTE.png',
    '51':'/Atoms/Img/tarjetas/MASTERCARD DEBITO FRENTE.png',
    '52':'/Atoms/Img/tarjetas/MASTERCARD DEBITO FRENTE.png',
    '53':'/Atoms/Img/tarjetas/MASTERCARD DEBITO FRENTE.png',
    '54':'/Atoms/Img/tarjetas/MASTERCARD DEBITO FRENTE.png',
    '55':'/Atoms/Img/tarjetas/MASTERCARD DEBITO FRENTE.png',
    '34':'/Atoms/Img/tarjetas/AMERICAN EXPRESS DEBITO FRENTE.png',
    '37':'/Atoms/Img/tarjetas/AMERICAN EXPRESS DEBITO FRENTE.png',
    '30':'/Atoms/Img/tarjetas/DINERS CLUB DEBITO FRENTE.png',
    '36':'/Atoms/Img/tarjetas/DINERS CLUB DEBITO FRENTE.png'
};
let imgCvv = {
    '40':'/Atoms/Img/tarjetas/VISA DEBITO ATRAS.png',
    '41':'/Atoms/Img/tarjetas/VISA DEBITO ATRAS.png',
    '42':'/Atoms/Img/tarjetas/VISA DEBITO ATRAS.png',
    '43':'/Atoms/Img/tarjetas/VISA DEBITO ATRAS.png',
    '44':'/Atoms/Img/tarjetas/VISA DEBITO ATRAS.png',
    '45':'/Atoms/Img/tarjetas/VISA DEBITO ATRAS.png',
    '46':'/Atoms/Img/tarjetas/VISA DEBITO ATRAS.png',
    '47':'/Atoms/Img/tarjetas/VISA DEBITO ATRAS.png',
    '48':'/Atoms/Img/tarjetas/VISA DEBITO ATRAS.png',
    '49':'/Atoms/Img/tarjetas/VISA DEBITO ATRAS.png',
    '51':'/Atoms/Img/tarjetas/MASTERCARD DEBITO ATRAS.png',
    '52':'/Atoms/Img/tarjetas/MASTERCARD DEBITO ATRAS.png',
    '53':'/Atoms/Img/tarjetas/MASTERCARD DEBITO ATRAS.png',
    '54':'/Atoms/Img/tarjetas/MASTERCARD DEBITO ATRAS.png',
    '55':'/Atoms/Img/tarjetas/MASTERCARD DEBITO ATRAS.png',
    '34':'/Atoms/Img/tarjetas/AMERICAN EXPRESS DEBITO ATRAS.png',
    '37':'/Atoms/Img/tarjetas/AMERICAN EXPRESS DEBITO ATRAS.png',
    '30':'/Atoms/Img/tarjetas/DINERS CLUB DEBITO ATRAS.png',
    '36':'/Atoms/Img/tarjetas/DINERS CLUB DEBITO ATRAS.png'
}
function metodoPago(efectiv,debito){
    formData = new FormData;
    formData.append('efectivo',efectiv);
    formData.append('debito',debito);
    fetch('/Solicitudes/metodoPago.php',{
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
            tipoDeEntrega(idRestaurante, domicilio, direCliente);
        });
        let cancelarPedido = document.getElementById("CancelarPedido");
        cancelarPedido.addEventListener('click',function(){
            if (confirm("Si realiza esta acción eliminará este pedido, ¿desea continuar?")) {
                pedido = {};
                infoPedido = {};
                contadores = {};
                ventanaPedido.style.display = "none";
                carrito.style.display = "block";
                totalGlobal = 0;
                contadorProducto = 0;
                location.reload();
            } else {}
        })
        let radioEfe = document.getElementById('Efec');
        let radioTar = document.getElementById('Tar');
        radioEfe.addEventListener('click', function(){
            efectivo = "true";
            metodoPago(efectivo, debi);
        })
        radioTar.addEventListener('click', function(){
            efectivo = "false";
            metodoPago(efectivo, debi);
        })
        let radioDebi = document.getElementById('Debi');
        let radioCredi = document.getElementById('Credi');
        let divCvv = document.getElementById('tarjetaCvv');
        radioDebi.addEventListener('click',function () {
            debi = "true";
            metodoPago(efectivo, debi);
            
        })
        radioCredi.addEventListener('click',function () {
            debi = "false";
            metodoPago(efectivo, debi);
        })
        let inputs = document.querySelectorAll('.inputNumTar');
        let divs = [document.querySelector('.numeroTarjeta1'), document.querySelector('.numeroTarjeta2'), document.querySelector('.numeroTarjeta3'), document.querySelector('.numeroTarjeta4')];
        let imgTarjeta = document.querySelector('#imgtarjeta');
        let radioDebit = document.querySelector('#Debi');
        let radioCredit = document.querySelector('#Credi');
        let digitos;
        let selectMes = document.querySelector('.selectCvv:nth-child(1)');
        let selectAno = document.querySelector('.selectCvv:nth-child(2)');
        let divCaducidad = document.querySelector('.caducidad');
        let inputTitular = document.getElementById('titular');
        let divTitular = document.querySelector('.nombreTitular');
        let cvv = document.getElementById('inputCvv');
        let imgtarjetaactiva = "/Atoms/Img/tarjetas/DEFAULT.png";
        for(let i = 0; i < inputs.length; i++) {
            inputs[i].addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
                divs[i].textContent = this.value.split('').join(' ');
                if(i == 0 && this.value.length >= 2) {
                    let firstTwoDigits = this.value.slice(0, 2);
                    digitos = firstTwoDigits;
                    if(radioDebit.checked && imgDebiTar[firstTwoDigits]) {
                        imgtarjetaactiva = imgDebiTar[firstTwoDigits];
                        imgTarjeta.setAttribute('src', imgtarjetaactiva);
                        divCvv.style.top = "12vh";
                    } else if(radioCredit.checked && imgCrediTar[firstTwoDigits]) {
                        imgtarjetaactiva = imgCrediTar[firstTwoDigits];
                        imgTarjeta.setAttribute('src', imgtarjetaactiva);
                        divCvv.style.top = "13.5vh";
                    } else {
                        alert('Esta tarjeta no es válida o no se recibe como medio de pago');
                        this.value = '';
                        imgTarjeta.setAttribute('src', '/Atoms/Img/tarjetas/DEFAULT.png');
                    }
                }
                imgTarjeta.setAttribute('src', imgtarjetaactiva);
                for(let i = 0; i <= 3; i++) {
                    divs[i].style.display = "flex";
                }
                divCvv.style.display = "none";
                divCaducidad.style.display = "block"; 
                divTitular.style.display = "block";               
                if(this.value.length >= 4) {
                    if(i < inputs.length - 1) {
                        inputs[i + 1].focus();
                        for(let i = 0; i <= 3; i++) {
                            divs[i].style.display = "flex";
                        }                
                    }
                }
            });
        }
        selectMes.addEventListener('change', function() {
            divCaducidad.textContent = this.value.split('').join(' ') + ' / ' + selectAno.value.split('').join(' ');
            imgTarjeta.setAttribute('src', imgtarjetaactiva);
            divCvv.style.display = "none";
            divCaducidad.style.display = "block"; 
            divTitular.style.display = "block";
            for(let i = 0; i <= 3; i++) {
                divs[i].style.display = "flex";
            }
        });
        selectAno.addEventListener('change', function() {
            divCaducidad.textContent = selectMes.value.split('').join(' ') + ' / ' + this.value.slice(-2).split('').join(' ');
            imgTarjeta.setAttribute('src', imgtarjetaactiva);
            divCvv.style.display = "none";
            divCaducidad.style.display = "block"; 
            divTitular.style.display = "block";
            for(let i = 0; i <= 3; i++) {
                divs[i].style.display = "flex";
            }
        });
        inputTitular.addEventListener('input', function() {
            divTitular.textContent = this.value;
            imgTarjeta.setAttribute('src', imgtarjetaactiva);
            divCvv.style.display = "none";
            divCaducidad.style.display = "block"; 
            divTitular.style.display = "block";
            for(let i = 0; i <= 3; i++) {
                divs[i].style.display = "flex";
            }
        });
        cvv.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '')
            divCvv.textContent = this.value;
        });
        cvv.addEventListener('click',function(){
            if (!digitos){
                alert('Debes ingresar primero el numero de la tarjeta');
                this.value = '';
                this.blur();
            }else{
                for(let i = 0; i <= 3; i++) {
                    divs[i].style.display = "none";
                }                
                divCaducidad.style.display = "none";
                divTitular.style.display = "none";
                divCvv.style.display = "block";
                imgTarjeta.setAttribute('src', imgCvv[digitos]);
            }
        })
        let confirmar = document.getElementById("Confirmar");
        confirmar.addEventListener("click", function (){
            let numero1 = document.getElementById("numtar1").value;
            let numero2 = document.getElementById("numtar2").value;
            let numero3 = document.getElementById("numtar3").value;
            let numero4 = document.getElementById("numtar4").value;
            let mes = document.getElementById("mesTar").value;
            let ano = document.getElementById("anoTar").value;
            let codigo = document.getElementById("inputCvv").value;
            if (efectivo == "true"){
                infoPedido['pago'] = "EFECTIVO";
                console.log('entra en efectivo');
                pedidoRealizado();
            }else{
                if (debi == "true"){
                    if (numero1=="" || numero2=="" || numero3=="" || numero4=="" || mes=="" || ano=="" || codigo==""){
                        alert('Por favor llena todos los campos');
                        return;
                    }else{
                        if(numero1.length!=4 || numero2.length!=4 || numero3.length!=4 || numero4.length!=4){
                            alert('Introduce un numero de tarjeta valido');
                            return;
                        }else{
                            if(codigo.length>=3){
                                infoPedido['pago'] = "DEBITO";
                                console.log('entra en debito');
                                pedidoRealizado(infoPedido);
                            }else{
                                alert('Introduce un codigo CCV valido');
                                return;
                            }
                        }
                    };
                }else{
                    let cuota = document.getElementById("cuoTar").value;
                    let titular = document.getElementById("titular").value;
                    if (numero1=="" || numero2=="" || numero3=="" || numero4=="" || mes=="" || ano=="" || codigo=="" || cuota=="" || titular==""){
                        alert('Por favor llena todos los campos');
                        return;
                    }else{
                        if(numero1.length!=4 || numero2.length!=4 || numero3.length!=4 || numero4.length!=4){
                            alert('Introduce un numero de tarjeta valido');
                            return;
                        }else{
                            if(codigo.length>=3){
                                if(cuota==""){
                                    alert("Introduce la cantidad de cuotas");
                                    return;
                                }else{
                                    if(titular==""){
                                        alert("Introduce el nombre del titular");
                                        return;
                                    }else{
                                        infoPedido['pago'] = "CREDITO";
                                        console.log('entra en credito');
                                        pedidoRealizado();
                                    }
                                }
                            }else{
                                alert('Introduce un codigo CCV valido');
                                return;
                            }
                        }
                    }
                }
            }
        })
    })
}

function pedidoRealizado(pedido){
    let confirmandoPago = document.getElementById("contenedorValidando");
    confirmandoPago.style.display = "block";
    setTimeout(function() {
        alert('Su pago se ha realizado con éxito')
    }, 5000);
}