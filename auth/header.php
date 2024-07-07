<!--HEADER-->
<header>
    <!--BACKGROUND Y CONTENEDOR DEL MENU DE NAVEGACIÓN-->
    <nav class="navbar navbar-expand-sm bg-black navbar-dark border-img-b">
        <div class="container-fluid">
            <!--CONTENEDOR DEL LOGO Y EL TEXTO AL LADO DEL LOGO-->
            <div class="navbar-brand d-flex align-items-center">
                <img src="./images/assets/logo.avif" alt="Nori Logo" class="ms-md-3 logo">
                <!--SE OCULTA CUANDO LA PANTALLA ES MENOR AL TAMAÑO MEDIANO-->
                <div class="ms-md-3 d-none d-md-block"><span class="FontCanji rem2-3">  RESTAURANTE  </span><span class="FontCanji rem2-3">  海苔  </span></div>
            </div>
            <!--MENU DE NAVEGACIÓN PARA PANTALLAS PEQUEÑAS HASTA LA MAS GRANDE -->
            <ul class="navbar-nav align-items-center me-md-5 d-none d-sm-flex">
                <li class="nav-item">
                    <a class="NavLink nav-link" href="index.php?ruta=inicio">
                        <div class="BtnNav">
                            <span class="FontAni">INICIO</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="NavLink nav-link" href="index.php?ruta=restaurante">
                        <div class="BtnNav">
                            <span class="FontAni">MENÚ</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="NavLink nav-link" href="index.php?ruta=reserva">
                        <div class="BtnNav">
                            <span class="FontAni">RESERVA</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <button class="bg-black border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuUser">
                        <img src="./images/users/<?php echo $currentUser['image'] ?>" alt="acceso" class="rounded-circle border border-3 border-warning" style="width: 65px;" >
                    </button>
                </li>
            </ul>
            <!--MENU PARA PANTALLAS EXTRA PEQUEÑAS-->
            <div class="d-sm-none text-center">
                <button class="navbar-toggler ml-auto border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuSidebar">
                    <img src="./images/users/<?php echo $currentUser['image'] ?>" alt="acceso" class="rounded-circle border border-3 border-warning" style="width: 50px;" >
                </button>
                <div class="offcanvas offcanvas-end bg-black max-width-50 border-3 border-start border-warning" id="menuSidebar">
                <button type="button" class="btn-close boton-close mt-3 ms-3" data-bs-dismiss="offcanvas">
                    <img src="./images/icons/cerrar.avif" alt="cerrar" class="boton-close" style="max-width: 25px; max-height: 25px">
                </button>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="NavLink nav-link" href="index.php?ruta=inicio">
                                <div class="BtnNav">
                                    <span class="FontAni">INICIO</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="NavLink nav-link" href="index.php?ruta=restaurante">
                                <div class="BtnNav">
                                    <span class="FontAni">MENÚ</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="NavLink nav-link" href="index.php?ruta=reserva">
                                <div class="BtnNav">
                                    <span class="FontAni">RESERVA</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <button class="bg-black border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuUser">
                                <span class="FontAni">USUARIO</span>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- MENU USUARIO -->
    <?php 
        $nombre = $currentUser['name'];
    ?>
    <div class="offcanvas offcanvas-end bg-black w-sm-50 w-md-25 w-m border-3 border-start border-warning" id="menuUser"  style="overflow-y: scroll;">
        <button type="button" class="btn-close boton-close mt-3 ms-3" data-bs-dismiss="offcanvas">
            <img src="./images/icons/cerrar.avif" alt="cerrar" class="boton-close" style="max-width: 25px; max-height: 25px">
        </button>
        <div class="d-flex flex-column w-100 justify-content-center align-items-center">
            <div class="d-flex justify-content-center align-items-center border-img-b pb-5 w-100">
                <img src="./images/users/<?php echo $currentUser['image'] ?>" alt="acceso" class="rounded-circle border border-3 border-warning" style="width: 150px;" >
            </div>
            <div class="d-flex w-100 justify-content-center py-2 text-center border-img-b"><span class="FontPrimary fs-5" >Bienvenid@<?php echo " ".$nombre; ?></span></div>
            <div class="d-flex w-100 justify-content-center py-2 border-img-b"><button class="bg-black border-0" onclick="window.location.href='?ruta=historial_pedidos'"><span class="FontPrimary fs-5">Historial de pedidos</span></button></div>
            <div class="d-flex w-100 justify-content-center py-2 border-img-b"><button class="bg-black border-0" onclick="window.location.href='?ruta=historial_reservas'"><span class="FontPrimary fs-5">Historial de Reservas</span></button></div>
            <div class="d-flex w-100 justify-content-center py-2 border-img-b"><button class="bg-black border-0" onclick="window.location.href='?ruta=perfil'"><span class="FontPrimary fs-5">Configuración</span></button></div>
            <div class="d-flex w-100 justify-content-center py-2 border-img-b"><span class="FontPrimary fs-5" >Puntos:</span></div>
            <div class="d-flex w-100 justify-content-center py-2 border-img-b"><button class="bg-black border-0" onclick="sessionFinish()"><span class="FontPrimary fs-5">Cerrar Sesión</span></button></div>
        </div>
    </div>
</header>
<script src="./components/js/menu_usuario.js"></script>