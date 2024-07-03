<?php 
$form='<!-- PANTALLAS EXTRA GRANDES -->
<div class="w-25 d-none d-xl-flex bg-black rounded-3 border border-3 border-warning my-5 p-3 align-items-center flex-column" style="min-height: 470px;" >
    <h3 class="text-center" ><span class="FontPrimary" >Iniciar Sesión</span></h3>
    <p class="FontParrafo fs-6" >como persona</p>
    <div class="w-100 border-img-b" ></div>
    <form action="" name="ingreso_xl" id="ingreso_xl" class="d-flex align-items-center flex-column w-75 my-5 text-center" >
        <input type="hidden" name="usuario" id="usuario_xl" value="persons">
        <label for="email"><span class="FontPrimary fs-5" >Correo Electrónico</span></label>
        <input type="email" name="email" id="email_xl" placeholder="example@domain.com" class="my-3 w-75 border border-3 border-warning rounded-3 bg-black FontParrafo fs-5 text-center" >
        <span id="alertEmail_xl" class="FontParrafo text-danger fs-6 text-center d-none">Correo no registrado</span>
        <label for="password"><span class="FontPrimary fs-5" >Contraseña</span></label>
        <input type="password" name="password" id="password_xl" placeholder="Ingrese la contraseña" class="my-3 w-75 border border-3 border-warning rounded-3 bg-black FontParrafo fs-5 text-center" >
        <span id="alertPass_xl" class="FontParrafo text-danger fs-6 text-center d-none">Contraseña Incorrecta</span>
        <div class="d-flex my-2">
            <input type="checkbox" onclick="showpassworld(\'password_xl\')">
            <span class="FontParrafo mx-3" >Mostrar Contraseña</span>
        </div>
        <div class="d-flex w-100 justify-content-center">
            <a href="#" class="FontParrafo text-center my-2">Olvidaste la contraseña?</a>
        </div>
        <div class="d-flex w-100 justify-content-center">
            <a href="?ruta=registro" class="FontParrafo text-center my-2">No estas registrado?</a>
        </div>
        <div class="d-flex w-100 justify-content-center">
            <button type="submit" id="btnIngreso_xl" onclick="idform(\'xl\')" class="border border-3 border-warning rounded-3 px-3 py-1 mt-2 mx-auto bg-black d-flex justify-content-center align-items-center"><span id="spinner_xl" class="spinner-border spinner-border-sm text-warning d-none"></span><span id="cargando_xl" class="FontAni fs-5 mx-2 d-none">Cargando . . .</span><span id="ingresar_xl" class="FontAni fs-5 mx-2">Ingresar</span></button>
        </div>
    </form>
</div>
<!-- PANTALLAS PEQUEÑAS A GRANDES -->
<div class="w-50 d-none d-sm-flex d-xl-none bg-black rounded-3 border border-3 border-warning my-5 p-3 align-items-center flex-column" style="min-height: 470px;" >
    <h3 class="text-center" ><span class="FontPrimary" >Iniciar Sesión</span></h3>
    <p class="FontParrafo fs-6" >como persona</p>
    <div class="w-100 border-img-b" ></div>
    <form action="" name="ingreso_sm" id="ingreso_sm" class="d-flex align-items-center flex-column w-75 my-5" >
        <input type="hidden" name="usuario" id="usuario_sm" value="persons">
        <label for="email"><span class="FontPrimary fs-5 " >Correo Electrónico</span></label>
        <input type="text" name="email" id="email_sm" placeholder="example@domain.com" class="my-3 w-75 border border-3 border-warning rounded-3 bg-black FontParrafo fs-5 text-center" >
        <span id="alertEmail_sm" class="FontParrafo text-danger fs-6 text-center d-none">Correo no registrado</span>
        <label for="password"><span class="FontPrimary fs-5" >Contraseña</span></label>
        <input type="password" name="password" id="password_sm" placeholder="Ingrese la contraseña" class="my-3 w-75 border border-3 border-warning rounded-3 bg-black FontParrafo fs-5 text-center" >
        <span id="alertPass_sm" class="FontParrafo text-danger fs-6 text-center d-none">Contraseña Incorrecta</span>
        <div class="d-flex my-2">
            <input type="checkbox" onclick="showpassworld(\'password_sm\')">
            <span class="FontParrafo mx-3" >Mostrar Contraseña</span>
        </div>
        <div class="d-flex w-100 justify-content-center">
            <a href="#" class="FontParrafo text-center my-2">Olvidaste la contraseña?</a>
        </div>
        <div class="d-flex w-100 justify-content-center">
            <a href="?ruta=registro" class="FontParrafo text-center my-2">No estas registrado?</a>
        </div>
        <div class="d-flex w-100 justify-content-center">
            <button type="submit" onclick="idform(\'sm\')" id="btnIngreso_sm" class="border border-3 border-warning rounded-3 px-3 py-1 mt-2 mx-auto bg-black d-flex justify-content-center align-items-center"><span id="spinner_sm" class="spinner-border spinner-border-sm text-warning d-none"></span><span id="cargando_sm" class="FontAni fs-5 mx-2 d-none">Cargando . . .</span><span id="ingresar_sm" class="FontAni fs-5 mx-2">Ingresar</span></button>
        </div>
    </form>
</div>
<!-- PANTALLAS EXTRA PEQUEÑAS -->
<div class="w-75 d-flex d-sm-none bg-black rounded-3 border border-3 border-warning my-5 p-3 align-items-center flex-column" style="min-height: 470px;" >
    <h3 class="text-center" ><span class="FontPrimary fs-4" >Iniciar Sesión</span></h3>
    <p class="FontParrafo fs-6" >como persona</p>
    <div class="w-100 border-img-b" ></div>
    <form action="" name="ingreso_ep" id="ingreso_ep" class="d-flex align-items-center flex-column w-100 my-5" >
        <input type="hidden" name="usuario" id="usuario_ep" value="persons">
        <label for="email"><span class="FontPrimary fs-6 " >Correo Electrónico</span></label>
        <input type="text" name="email" id="email_ep" placeholder="example@domain.com" class="my-3 w-75 border border-3 border-warning rounded-3 bg-black FontParrafo fs-5 text-center" >
        <span id="alertEmail_ep" class="FontParrafo text-danger fs-6 text-center d-none">Correo no registrado</span>
        <label for="password"><span class="FontPrimary fs-6" >Contraseña</span></label>
        <input type="password" name="password" id="password_ep" placeholder="Ingrese la contraseña" class="my-3 w-75 border border-3 border-warning rounded-3 bg-black FontParrafo fs-5 text-center" >
        <span id="alertPass_ep" class="FontParrafo text-danger fs-6 text-center d-none">Contraseña Incorrecta</span>
        <div class="d-flex my-2">
            <input type="checkbox" onclick="showpassworld(\'password_ep\')">
            <span class="FontParrafo mx-3" >Mostrar Contraseña</span>
        </div>
        <div class="d-flex w-100 justify-content-center">
            <a href="#" class="FontParrafo text-center my-2">Olvidaste la contraseña?</a>
        </div>
        <div class="d-flex w-100 justify-content-center">
            <a href="?ruta=registro" class="FontParrafo text-center my-2">No estas registrado?</a>
        </div>
        <div class="d-flex w-100 justify-content-center">
            <button type="submit" onclick="idform(\'ep\')" id="btnIngreso_ep" class="border border-3 border-warning rounded-3 px-3 py-1 mt-2 mx-auto bg-black d-flex justify-content-center align-items-center"><span id="spinner_ep" class="spinner-border spinner-border-sm text-warning d-none"></span><span id="cargando_ep" class="FontAni fs-5 mx-2 d-none">Cargando . . .</span><span id="ingresar_ep" class="FontAni fs-5 mx-2">Ingresar</span></button>
        </div>
    </form>
</div>';
echo $form;