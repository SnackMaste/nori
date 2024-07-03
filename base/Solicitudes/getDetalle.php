<?php 
require_once '../config/conexion.php';
$db = Database::getInstance();
$conn = $db->getConnection();

$productoid =$_POST['producto'];
$consultaDetalle = $conn->prepare('SELECT producto.*, tipo_producto.Nombre_Tipo_Producto FROM producto 
INNER JOIN tipo_producto ON producto.Id_Tipo_Producto = tipo_producto.Id_Tipo_Producto 
WHERE producto.Id_Producto = :productoid');
$consultaDetalle->execute(array(':productoid'=>$productoid));
$row = $consultaDetalle->fetch(PDO::FETCH_ASSOC);
$nombreProducto = $row["Nombre_Producto"];
$descripcionProducto = $row["Descripcion"];
$precioProducto = $row["Precio_Producto"];
$tamaño = $row["Tamaño"];
$imagenProducto = $row["Imagen_Producto"];
$nombreTipoProducto = $row["Nombre_Tipo_Producto"];
$respuestaDetalle = '<div class="VentanaModal"id="VentanaModalD">
    <div class="ModalContenido">
        <img src="../Atoms/Icons/cerrar.png" class="CerrarModal" id="CerrarModalD">
        <div class="NombreProductoModal">
            <span class="FontPrimary FontSize9">'.$nombreProducto.'</span>
        </div>
        <div class="DescripcionProducto">
            <span class="FontPrimary FontSize5">DESCRIPCION<br><br>'.$descripcionProducto.'</span>
        </div>
        <img src="'.$imagenProducto.'" class="ImgProductoModal">
        <div class="CantidadProducto">
        <span class="FontPrimary FontSize5">VALORACION<br><br>ESTRELLAS DE VALORACION</span>
        </div>
    </div>
</div>';

echo json_encode($respuestaDetalle, JSON_UNESCAPED_UNICODE);


