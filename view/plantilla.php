<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--╔═════════╗
    ║ FAVICON ║
    ╚═════════╝-->
    <link rel="shortcut icon" href="./images/icons/favicon.ico">
<!--╔═════════════════════╗
    ║ NOMBRE DE LA PAGINA ║
    ╚═════════════════════╝-->
    <title>Nori | Bienvenidos</title>
<!--╔════════════════════════╗
    ║ ESTILOS PERSONALIZADOS ║
    ╚════════════════════════╝-->
    <link rel="stylesheet" href="./style/styles.css" type="text/css">
<!--╔════════════════════════╗
    ║ FUENTES PERSONALIZADAS ║
    ╚════════════════════════╝-->
    <link rel="stylesheet" href="./fonts/Fonts.css">
<!--╔═══════════════════════════════════════════════╗
    ║ FUNCIONALIDAD DE LOS COMPONENTES DE BOOTSTRAP ║
    ╚═══════════════════════════════════════════════╝-->
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!--╔═══════════════════════════════════════════════════╗
    ║ ESTILOS PARA EL RECORTE DE IMÁGENES DEL CROPPERJS ║
    ╚═══════════════════════════════════════════════════╝-->
    <link rel="stylesheet" href="./node_modules/cropperjs/dist/cropper.min.css" defer>
</head>
<body class="bg-black">
    <?php 
        require_once "./auth/session.php";
        $userSession = new SessionUser();
        $currentUser = $userSession->getCurrentUser();
    
        if(isset($currentUser)){
            include_once "./auth/header.php";
        } else {
            include_once "./components/php/header.php";
        }

        if(isset($_GET["ruta"])){

            if($_GET["ruta"] == "inicio" || $_GET["ruta"] == "restaurante" || $_GET["ruta"] == "reserva" || $_GET["ruta"] == "ingresar" || $_GET["ruta"] == "registro" || $_GET["ruta"] == "menu" ){

                include $_GET["ruta"].".php";
            }else if($_GET["ruta"] == "perfil" || $_GET["ruta"] == "historial_pedidos" || $_GET["ruta"] == "historial_reservas"){
                if(isset($currentUser)){
                    include_once "./auth/".$_GET["ruta"].".php";
                } else {
                    include_once "inicio.php";
                }
            }else{
                include "404.php";
            }

        }else{

            include "inicio.php";

        }

        include "./components/php/footer.php";
    ?>
</body>
</html>