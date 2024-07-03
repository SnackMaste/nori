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
        $result = $conn->prepare('SELECT Id_Cliente FROM empresa WHERE NIT = :identificacion');
        $result->execute(array(':identificacion'=>$identificacion));
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $idCliente = $row['Id_Cliente'];
    }
    if($tipoPersona == "Persona"){
        $result = $conn->prepare('SELECT Id_Cliente FROM persona WHERE Identificacion = :identificacion');
        $result->execute(array(':identificacion'=>$identificacion));
        $row = $result ->fetch(PDO::FETCH_ASSOC);
        $idCliente = $row['Id_Cliente'];
    }

    $idRestaurante = $_POST["idRestaurante"];
    $domicilioA = $_POST["domicilio"];
    $dire = $_POST["direccion"];

    $result = $conn->prepare('SELECT direccion.*, tipo_calle.Nombre_Tipo_Calle FROM direccion INNER JOIN tipo_calle ON direccion.Id_Tipo_Calle = tipo_calle.Id_Tipo_Calle INNER JOIN cliente ON cliente.Id_Direccion = direccion.Id_Direccion WHERE cliente.Id_Cliente = :idCliente');
    $result->execute(array(':idCliente'=>$idCliente));
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $tipoCalleCliente = $row['Nombre_Tipo_Calle'];
    $nombreCalleCliente = $row['Nombre_Calle'];
    $numeroCalleCliente = $row['Numero_Calle'];
    $barrioCliente = $row['Barrio'];
    $ciudadCliente = $row['Ciudad'];
    $paisCliente = $row['Pais'];
    $puertaCliente = $row['Puerta'];
    $pisoCliente = $row['Piso'];
    $torreCliente = $row['Torre'];

    $result = $conn->prepare('SELECT direccion.*, tipo_calle.Nombre_Tipo_Calle 
    FROM direccion 
    INNER JOIN tipo_calle ON direccion.Id_Tipo_Calle = tipo_calle.Id_Tipo_Calle 
    INNER JOIN restaurante ON restaurante.direccion_Restaurante = direccion.Id_Direccion 
    WHERE restaurante.Id_Restaurante = :idRestaurante');
    $result->execute(array(':idRestaurante'=>$idRestaurante));
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $tipoCalleRestaurante = $row['Nombre_Tipo_Calle'];
    $nombreCalleRestaurante = $row['Nombre_Calle'];
    $numeroCalleRestaurante = $row['Numero_Calle'];
    $barrioRestaurante = $row['Barrio'];
    $ciudadRestaurante = $row['Ciudad'];
    $paisRestaurante = $row['Pais'];
    
    if($torreCliente == ""){
        $torreCliente = "";
    }else{
        $torreCliente = '<span class="FontPrimary FontSize4">Torre: '.$torreCliente.' </span>';
    };
    if($pisoCliente == ""){
        $pisoCliente = "";
    }else{
        $pisoCliente = '<span class="FontPrimary FontSize4">Piso: '.$pisoCliente.' </span>';
    };
    if($puertaCliente == ""){
        $puertaCliente = "";
    }else{
        $puertaCliente = '<span class="FontPrimary FontSize4">Puerta: '.$puertaCliente.' </span>';
    };
    $options = '<option value="" hidden selected>Tipo Calle</option>';
    $result = $conn->prepare('SELECT Nombre_Tipo_Calle FROM tipo_calle');
    $result->execute();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $options .= '<option value="'. $row['Nombre_Tipo_Calle'] .'" >'. $row['Nombre_Tipo_Calle'] .'</option>';
    }

    if($domicilioA == "true"){
        $domicilio = "";
        $recoger = "display:none;";
        $radioDomi = "checked";
        $radioReco = "";
    }else if($domicilioA=="false"){
        $domicilio = "display:none;";
        $recoger = "";
        $radioDomi = "";
        $radioReco = "checked";
    }

    if($dire=="true"){
        $direCliente = '';
        $direNueva = 'style="opacity: 0.4; width: 100%;" disabled';
        $radioDire = "checked";
        $radioNuev = "";
    }else if($dire=="false"){
        $direCliente = 'style="opacity: 0.4; width: 100%;" disabled';
        $direNueva = '';
        $radioDire = "";
        $radioNuev = "checked";
    }

    $respuesta = "";
    $respuesta .= '
    <div class="TituloPedido">
        <span class="FontPrimary FontSize7">TIPO DE ENTREGA</span>
    </div>
    <div class="TituloPedido TituloConMargen"><span class="FontPrimary FontSize5">¿A domicilio o pasar y recoger?</span></div>
    <div class="TituloPedido TituloConMargen">
        <input type="radio" name="DomiOReco" value="Domi" id="Domi" '.$radioDomi.'>
            <span class="FontPrimary FontSize5">DOMICILIO</span>
        </input>
        <input type="radio" name="DomiOReco" value="Reco" id="Reco" '.$radioReco.'>
            <span class="FontPrimary FontSize5">RECOGER</span>
        </input>
    </div>
    <div class="rellenoRecoger" style="'.$recoger.'">
        <span class="FontParrafo">SE RECOGERA EN '.$tipoCalleRestaurante.' '.$nombreCalleRestaurante.' '.$numeroCalleRestaurante.', '.$barrioRestaurante.', '.$ciudadRestaurante.', '.$paisRestaurante.'</span>
    </div>
    <form class="formDireDomi" style="'.$domicilio.'">
        <div class="DireCliente">
            <input type="radio" name="DireccionDomi" id="DireC" '.$radioDire.'>
            <fieldset '.$direCliente.'>
            <div>
                <div><span class="FontPrimary FontSize4">País: '.$paisCliente.'</span></div>
                <div><span class="FontPrimary FontSize4">Ciudad: '.$ciudadCliente.'</span></div>
                <div><span class="FontPrimary FontSize4">Barrio: '.$barrioCliente.'</span></div>
            </div>
            <div>
                <div><span class="FontPrimary FontSize4">'.$tipoCalleCliente.' '.$nombreCalleCliente.' '.$numeroCalleCliente.'</span></div>
                <div><span class="FontPrimary FontSize4">'.$torreCliente.$pisoCliente.$puertaCliente.'</span></div>
            </div>
            </fieldset>
        </div>
        <div class="DireNueva">
            <input type="radio" name="DireccionDomi" id="DireN" '.$radioNuev.'>
            <fieldset '.$direNueva.'>
                <div><span class="FontPrimary FontSize4" id="paisNuevo">País: '.$paisRestaurante.'</span></div>
                <div><span class="FontPrimary FontSize4" id="ciudadNueva">Ciudad: '.$ciudadRestaurante.'</span></div>
                <div><span class="FontPrimary FontSize4">Barrio: <input type="text" id="barrioNuevo"></input></span></div>
                <div><span class="FontPrimary FontSize4"> <select id="tipocalleNueva">'.$options.'</select> <input type="text" id="nombrecalleNueva" placeholder="Nombre Calle"> <input type="text" placeholder="Numero Calle" id="numerocalleNueva"> </div>
                <div> <input type="text" placeholder="Torre" id="torreNueva"> <input type="text" id="pisoNuevo" placeholder="Piso"> <input id="puertaNueva" type="text" placeholder="Puerta"></div>
            </fieldset>
        </div>
        <div class="mensajeCiudad"><span class="FontParrafo">Si desea pedir para otra ciudad, debera cambiar de restaurante</span></div>
    </form>
    <div class="ContenedorBotones">
    <button id="CerrarPedido" type="button">VOLVER</button>
    <button id="CancelarPedido" type="button">CANCELAR</button>
    <button id="Confirmar" type="button">CONFIRMAR</button>
</div>';
}
echo $respuesta;