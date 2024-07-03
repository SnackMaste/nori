<?php 
require_once '../Solicitudes/monedas.php';
require_once '../config/conexion.php';
$db = Database::getInstance();
$conn = $db->getConnection();

$mon = new Monedas();

$restaurante = $_POST['idrestaurante'];
$consultaMenu = $conn->prepare('SELECT producto.*
FROM menu 
JOIN producto ON menu.Id_Producto = producto.Id_Producto
WHERE menu.Id_Restaurante = :restaurante');
$consultaMenu->execute(array(':restaurante'=>$restaurante));
$resp = $conn->prepare('SELECT D.Pais 
FROM direccion D 
INNER JOIN restaurante R ON D.Id_Direccion = R.Direccion_Restaurante 
WHERE R.Id_Restaurante = :restaurante');
$resp->execute(array(':restaurante'=>$restaurante));
$paises = $resp->fetch(PDO::FETCH_ASSOC);
$pais = $paises['Pais'];
$moneda = $mon->moneda($pais);
$respuestaProducto = "";
while ($row = $consultaMenu->fetch(PDO::FETCH_ASSOC)) {
    $idProducto = $row['Id_Producto'];
    $nombreP = $row["Nombre_Producto"];
    $precioP = $row["Precio_Producto"];
    $imagenP = $row["Imagen_Producto"];
    $respuestaProducto .= '<div class="ProductoContainer">
    <img src="'.$imagenP.'" alt="" class="ImgProducto">
    <div class="BtnProductoContenedor" id="'.$idProducto.'">
        <div class="SeparadorBtnProducto">
            <div class="ContenedorBtnProducto">
                <div class="BtnNav">
                    <span class="FontAni Detalle" data-id="'.$idProducto.'">DETALLE</span>
                </div>
            </div>
            <div class="SeparadorBtnVertical">
            </div>
            <div class="ContenedorBtnProducto">
                <div class="BtnNav">
                    <span class="FontAni Añadir" data-añadir="'.$idProducto.'">AÑADIR</span>
                </div>
            </div>
        </div>
        <div class="SeparadorBtnProducto">
            <div class="NombreProducto">
            <span class="FontPrimary FontSize4">'.$nombreP.'</span>
            </div>
        </div>
        <div class="SeparadorBtnProducto">
            <div class="PrecioProducto" data-precio="'.$precioP.'" data-moneda="'.$moneda.'">';
    $precioP = $mon->formatearValor($precioP,$moneda);
    $respuestaProducto .= '<span class="FontPrimary">$ '.$precioP. ' '.$moneda.'</span>
            </div>
        </div>
    </div>
</div>';
}
echo json_encode($respuestaProducto, JSON_UNESCAPED_UNICODE);



