<?php 
require_once '../Solicitudes/UserSession.php';
require_once '../config/conexion.php';
$db = Database::getInstance();
$conn = $db->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userSession = new UserSession();
    $currentUser = $userSession->getCurrentUser();
    list($tipoPersona, $identificacion) = explode('_', $currentUser);

    if($tipoPersona == "Empresa"){
        $result = $conn->prepare('SELECT Razon_Social, Id_Cliente FROM empresa WHERE NIT = :identificacion');
        $result->execute(array(':identificacion'=>$identificacion));
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $nombre = $row['Razon_Social'];
        $idCliente = $row['Id_Cliente'];
    }
    if($tipoPersona == "Persona"){
        $nombre = $conn->prepare('SELECT Primer_Nombre, Segundo_Nombre, Primer_Apellido, Segundo_Apellido, Id_Cliente FROM persona WHERE Identificacion = :identificacion');
        $nombre->execute(array(':identificacion'=>$identificacion));
        $row = $nombre ->fetch(PDO::FETCH_ASSOC);
        $primerNombre = $row["Primer_Nombre"];
        $segundoNombre = $row["Segundo_Nombre"];
        $primerApellido = $row["Primer_Apellido"];
        $segundoApellido =  $row["Segundo_Apellido"];
        $nombre = $primerNombre . " " . $segundoNombre . " " . $primerApellido . " " . $segundoApellido;
        $idCliente = $row['Id_Cliente'];
    }

    $result = $conn->prepare('SELECT Cantidad_Puntos FROM puntos WHERE Id_Cliente = :idCliente');
    $result->execute(array(':idCliente'=>$idCliente));
    $puntos = $result->fetch(PDO::FETCH_ASSOC)["Cantidad_Puntos"];
    $cantidadPuntos = $puntos;
    $checkedNo = $_POST['checkedNo'];
    $checkedSi = $_POST['checkedSi'];
    $divPuntos = $_POST['puntos'];
    $divDescuento = $_POST['descuento'];
    $divGana = $_POST['gana'];
    $value = $_POST['valor'];
    $value = intval($value);
    $pedido = json_decode($_POST['pedido'], true);
    $respuesta ="";
    $respuesta .= '<div class="TituloPedido"><span class="FontPrimary FontSize7">PEDIDO A NOMBRE DE: '.$nombre.'</span></div>
    <div class="ContenedorTablaPedido">
        <table class="TablaPedido">
            <thead>
                <tr>
                    <th class="nombreProductoPedido"><span class="FontPrimary FontSize4">Nombre Producto</span></th>
                    <th class="cantidadProductoPedido"><span class="FontPrimary FontSize4">Cantidad</span></th>
                    <th class="valorUniProcuctoPedido"><span class="FontPrimary FontSize4">Valor Unitario</span></th>
                    <th class="valorProductoPedido"><span class="FontPrimary FontSize4">Valor</span></th>
                    <th class="quitarProductoPedido"><span class="FontPrimary FontSize4">Quitar</span></th>
                    <th class="agregarProductoPedido"><span class="FontPrimary FontSize4">Agregar</span></th>
                    <th class="eliminarProductoPedido"><span class="FontPrimary FontSize4">Eliminar</span></th>
                </tr>
            </thead>
            <tbody>';
            $total=0;
            foreach ($pedido as $idañadir => $contador) {
                $resp = $conn->query('SELECT Nombre_Producto, Precio_Producto FROM producto WHERE Id_Producto = \''.$idañadir.'\'');
                $row = $resp ->fetch(PDO::FETCH_ASSOC);
                $nombreProducto = $row['Nombre_Producto'];
                $valorUni = $row['Precio_Producto'];
                $valor = ($valorUni * $contador);
                $total= $total + $valor;
                $resp = $conn->query('SELECT D.Pais 
                FROM producto P
                INNER JOIN menu M ON P.Id_Producto = M.Id_Producto
                INNER JOIN restaurante R ON M.Id_Restaurante = R.Id_Restaurante
                INNER JOIN direccion D ON R.Direccion_Restaurante = D.Id_Direccion
                WHERE P.Id_Producto = \''.$idañadir.'\'');
                $pais = $resp->fetch(PDO::FETCH_ASSOC)['Pais'];
                if($pais == "COLOMBIA"){
                    $moneda = "COP";
                    $valorPunto = 50;
                    $puntoPorCompra = 5000;
                    $valorUniFormat = number_format($valorUni, 0, '', '.');
                    $valorFormat = number_format($valor, 0, '', '.');
                };
                if($pais == "VENEZUELA"){$moneda = "VES";};
                if($pais == "ECUADOR"){$moneda = "USD";};
                if($pais == "CHILE"){$moneda = "CLP";};
                if($pais == "PERÚ"){$moneda = "PEN";};
                $respuesta .= '<tr class="fila">
                <td><span class="FontPrimary FontSize3" data-id="'.$idañadir.'">'.$nombreProducto.'</span></td>
                <td><span class="FontPrimary FontSize3 cantidad">'.$contador.'</span></td>
                <td><span class="FontPrimary FontSize3">$'.$valorUniFormat .' '.$moneda.'</span></td>
                <td><span class="FontPrimary FontSize3">$'.$valorFormat.' '.$moneda.'</span></td>
                <td><button class="boton-menos"> - </button></td>
                <td><button class="boton-mas"> + </button></td>
                <td><img src="/Atoms/Icons/borrar.png" class="IcoBasura" alt=""></td>
            </tr>';
            }
            $posiblesPuntos = $total / $valorPunto;
            $descuento = ($value * $valorPunto) ;
            if($descuento >= $total){
                $maxPuntos = $posiblesPuntos;
            }else{
                if($descuento==0){
                    if($posiblesPuntos > $cantidadPuntos){
                        $maxPuntos = $cantidadPuntos;
                    }else{
                        $maxPuntos = $posiblesPuntos;
                    }
                }else{
                    if($posiblesPuntos > $cantidadPuntos){
                        $maxPuntos = $cantidadPuntos;
                    }else{
                        $maxPuntos = $posiblesPuntos;
                    }
                }
            }
            if($value > $maxPuntos){
                $value = $maxPuntos;
                $descuento = ($value * $valorPunto) ;
            }
            $totalConDescuento = ($total - $descuento);
            if($descuento > 0){
                $ganaPuntos = 0;
            }else{
                $ganaPuntos = round($total/$puntoPorCompra);
            }

            $respuesta .='</tbody>
        </table>
    </div>
    <div class="TituloPedido"><span class="FontPrimary FontSize5">¿Deseas utilizar puntos para esta compra?</span></div>
    <div class="TituloPedido">
        <input type="radio" name="puntos" value="si" id="si" '.$checkedSi.'>
            <span class="FontPrimary FontSize5">Si</span>
        </input>
        <input type="radio" name="puntos" value="no" id="no" '.$checkedNo.'>
            <span class="FontPrimary FontSize5">No</span>
        </input>
    </div>
    <div class="ContenedorTablaTotal">
        <table class="TablaPedido">
            <thead>
                <tr id="Puntos" style="display: '.$divPuntos.';">
                    <th class="Puntos"><span class="FontPrimary FontSize4">PUNTOS A UTILIZAR,</span><span class="FontPrimary FontSize4"> DISPONIBLES: '.number_format($cantidadPuntos, 0, '', '.').' PUNTOS</span></th>
                    <th class="CantidadPuntos">
                        <input type="number" id="CantidadPuntos" value="'.$value.'" min="0" max="'.$maxPuntos.'" oninput="validarValor(this)" onchange="valuePuntos(this)"></input>
                        <div class="BtnNav" id="btnAceptarPuntos">
                            <span class="FontPrimary">ACEPTAR</span>
                        </div>
                    </th>
                </tr>
                <tr id="Descuento" style="display: '.$divDescuento.';">
                    <th class="Descuento"><span class="FontPrimary FontSize4">DESCUENTO</span></th>
                    <th class="ValorDescuento"><span class="FontPrimary FontSize4" id="descuentocompra" data-descuento="'.$descuento.'">-$'.number_format($descuento, 0, '', '.').' '.$moneda.'</span></th>
                </tr>
                <tr>
                    <th class="Total"><span class="FontPrimary FontSize4">TOTAL A PAGAR</span></th>
                    <th class="ValorAPagar"><span class="FontPrimary FontSize4" id="TotalPedido" data-valor="'.$totalConDescuento.'">$ '.number_format($totalConDescuento, 0, '', '.').' '.$moneda.'</span></th>
                </tr>
                <tr id="Gana" style="display: '.$divGana.';" data-puntos="'.$ganaPuntos.'">
                    <th class="GanaPuntos"><span class="FontPrimary FontSize4">POR ESTA COMPRA USTED GANARA</span></th>
                    <th class="ValorGanaPuntos"><span class="FontPrimary FontSize4">'.number_format($ganaPuntos, 0, '', '.').' PUNTOS</span></th>
                </tr>
            </thead>
        </table>
    </div>
    <div class="ContenedorBotones">
        <button id="CerrarPedido" type="button">AÑADIR</button>
        <button id="CancelarPedido" type="button">CANCELAR</button>
        <button id="Confirmar" type="button">CONFIRMAR</button>
    </div>';
}
echo $respuesta;