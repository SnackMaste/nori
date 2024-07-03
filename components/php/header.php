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
                        <button class="border-0 bg-black" onclick="getRuta()">
                            <img src="./images/icons/acceso.avif" alt="acceso" class="boton-ico">
                        </button>
                    </li>
                </ul>
                <!--MENU PARA PANTALLAS EXTRA PEQUEÑAS-->
                <div class="d-sm-none text-center">
                    <button class="navbar-toggler ml-auto border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuSidebar">
                        <img src="./images/icons/menu.avif" alt="menu" class="boton-ico">
                    </button>
                    <div class="offcanvas offcanvas-end bg-black max-width-50 border-3 border-start border-warning" id="menuSidebar">
                        <button type="button" class="btn-close boton-close mt-3 ms-3" data-bs-dismiss="offcanvas">
                            <img src="./images/icons/cerrar.avif" alt="cerrar" class="boton-close">
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
                                <a class="NavLink nav-link" href="" onclick="getRuta()">
                                    <div class="BtnNav">
                                        <span class="FontAni">INICIAR SESIÓN</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
<script >
    function getRuta(){
        //TOMAMOS LA URL DESDE DONDE SE ESTA HACIENDO LA SOLICITUD PARA DESPUÉS DEL INICIO DE SESIÓN NOS DEVUELVA A ESA PAGINA
        let location = window.location.href;
        //LA ALMACENAMOS EN EL ALMACENAMIENTO LOCAL DEL BUSCADOR
        localStorage.setItem('location', location);
        window.location.href = "?ruta=ingresar"
    }
</script>