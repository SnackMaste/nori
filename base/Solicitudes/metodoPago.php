<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $efectivo = $_POST["efectivo"];
    $debito = $_POST["debito"];

    if($efectivo == "true"){
        $radioEfectivo = "checked";
        $radioTarjeta = "";
        $relleno = '';
        $form = ' style="display: none;"';
    }else if($efectivo == "false"){
        $radioEfectivo = "";
        $radioTarjeta = "checked";
        $relleno = ' style="display: none;"';
        $form = '';
    }

    if($debito == "true"){
        $radioDebito = "checked";
        $radioCredito = "";
        $vence = 'style = "top: 21vh"';
        $adicionalCredi = 'style="display: none;"';
    }else if($debito == "false"){
        $radioDebito = "";
        $radioCredito = "checked";
        $adicionalCredi = '';
        $vence = '';
    }
    $imgTarjeta = 'src="/Atoms/Img/tarjetas/DEFAULT.png"';

    $respuesta = "";
    $respuesta .= '
    <div class="TituloPedido">
        <span class="FontPrimary FontSize7">TIPO DE PAGO</span>
    </div>
    <div class="TituloPedido TituloConMargen"><span class="FontPrimary FontSize5">¿Realizar pago en efectivo o tarjeta?</span></div>
    <div class="TituloPedido TituloConMargen">
        <input type="radio" name="EfeTar" value="Efec" id="Efec" '.$radioEfectivo.'>
            <span class="FontPrimary FontSize5">EFECTIVO</span>
        </input>
        <input type="radio" name="EfeTar" value="Tar" id="Tar" '.$radioTarjeta.'>
            <span class="FontPrimary FontSize5">TARJETA</span>
        </input>
    </div>
    <div class="rellenoRecoger" '.$relleno.'>
        <span class="FontParrafo">SE REALIZARA EL PAGO EN EFECTIVO </span>
    </div>
    <div class="DebitoCredito" '.$form.'>
        <div class="TituloPedido TituloConMargen">
            <input type="radio" name="DebiCredi" value="Debi" id="Debi" '.$radioDebito.'>
            <span class="FontPrimary FontSize5">DEBITO</span>
            <input type="radio" name="DebiCredi" value="Credi" id="Credi" '.$radioCredito.'>
            <span class="FontPrimary FontSize5">CREDITO</span>
        </div>
        <div class="contenedorLogosTarjetas">
                <img src="/Atoms/Img/tarjetas/LOGO VISA.png" class="logoTarjetas">
                <img src="/Atoms/Img/tarjetas/LOGO MASTERCARD.png" class="logoTarjetas">
                <img src="/Atoms/Img/tarjetas/LOGO AMERICAN EXPRESS.png" class="logoTarjetas">
                <img src="/Atoms/Img/tarjetas/LOGO DINERS CLUB.png" class="logoTarjetas">
            </div>
        <div class="contenedorInfoTarjeta">
            <img '.$imgTarjeta.' class="imgTarjeta" id="imgtarjeta">
            <div class="cvv" id="tarjetaCvv"></div>
            <div class="numeroTarjeta1" id="num1"></div>
            <div class="numeroTarjeta2" id="num2"></div>
            <div class="numeroTarjeta3" id="num3"></div>
            <div class="numeroTarjeta4" id="num4"></div>
            <div class="caducidad" '.$vence.' id="vence"></div>
            <div class="nombreTitular" '.$adicionalCredi.' id="nombretitular"></div>
            <div class="contenedorFormularioTarjeta"><span class="FontPrimary FontSize4">Numero de tarjeta</span>
            <div class="ContenedorNumeroTar">
                <input type="text" maxlength="4" class="inputNumTar" id="numtar1">
                <input type="text" maxlength="4" class="inputNumTar" id="numtar2">
                <input type="text" maxlength="4" class="inputNumTar" id="numtar3">
                <input type="text" maxlength="4" class="inputNumTar" id="numtar4">
            </div>        
                <span class="FontPrimary FontSize4 validadHastaTitulo">Valida hasta</span>
                <span class="FontPrimary FontSize4 cvvinput">CVV</span>
                <div>
                    <select class="selectCvv" id="mesTar">
                        <option selected disabled hidden> Mes </option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                    <select class="selectCvv" id="anoTar">
                        <option selected disabled hidden> AÑO </option>
                        <option value="24">2024</option>
                        <option value="25">2025</option>
                        <option value="26">2026</option>
                        <option value="27">2027</option>
                        <option value="28">2028</option>
                        <option value="29">2029</option>
                    </select>
                    <input type="text" maxlength="4" class="inputCvv" id="inputCvv">
                </div>
                <span class="FontPrimary FontSize4" '.$adicionalCredi.'>Nombre titular: </span>
                <input type="text" id="titular" '.$adicionalCredi.'>
                <span class="FontPrimary FontSize4" '.$adicionalCredi.'>Cuotas: </span>
                <select '.$adicionalCredi.' id="cuoTar">
                <option selected disabled hidden> Cuotas </option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>
                    <option value="32">32</option>
                    <option value="33">33</option>
                    <option value="34">34</option>
                    <option value="35">35</option>
                    <option value="36">36</option>
                </select>
                </select>
            </div>
        </div>
    </div>
    <div class="ContenedorBotones">
    <button id="CerrarPedido" type="button">VOLVER</button>
    <button id="CancelarPedido" type="button">CANCELAR</button>
    <button id="Confirmar" type="button">PAGAR</button>
</div>
<div id="contenedorValidando">
    <div id="fondoValidando"></div>
    <img src="/Atoms/Img/validando.gif" id="Pago">
    <img src="/Atoms/Img/cargando.gif" id="validando">
</div>
';
}
echo $respuesta;