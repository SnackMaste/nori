<!-- TITULO DE BIENVENIDA -->
<h1 class="container-fluid text-center border-img-b pb-2">
  <span class="FontPrimary fs-2 mx-2">Bienvenid@ <?php echo $currentUser['name']?> a la configuración de la cuenta</span>
</h1>

<!-- INFORMACIÓN DE LA CUENTA -->
<div class="container-sm d-flex justify-content-center align-items-center flex-column my-5">
  <div class="container-sm d-flex flex-column justify-content-center align-items-center">
    <span class="FontPrimary text-center my-3 fs-4">INFORMACIÓN DE LA CUENTA</span>
    <br>
    <div class="d-flex flex-wrap justify-content-around w-100">
      <div class="border border-3 border-warning rounded-3 text-center d-flex flex-column justify-content-around align-items-center m-2 py-4" style="width: 40%; min-width: 200px;" >
        <span class="FontPrimary" >DIRECCIÓN DOMICILIO</span>
        <div class="d-flex w-75 flex-wrap justify-content-around" >
          <span class="FontPrimary w-50" style="min-width: 110px;">PAÍS:</span ><span class="FontParrafo text-warning w-50" style="min-width: 110px;"><?php echo $currentUser['country_address'] ?></span >
        </div>
        <div class="d-flex w-75 flex-wrap justify-content-around" >
          <span class="FontPrimary w-50" style="min-width: 110px;">CIUDAD:</span ><span class="FontParrafo text-warning w-50" style="min-width: 110px;"><?php echo $currentUser['city_address'] ?></span >
        </div>
        <div class="d-flex w-75 flex-wrap justify-content-around" >
          <span class="FontPrimary w-50" style="min-width: 110px;">BARRIO:</span ><span class="FontParrafo text-warning w-50" style="min-width: 110px;"><?php echo $currentUser['neighborhood_address'] ?></span >
        </div>
        <div class="d-flex w-75 flex-wrap justify-content-around" >
          <span class="FontPrimary w-50" style="min-width: 110px;">CALLE:</span ><span class="FontParrafo text-warning w-50" style="min-width: 110px;"><?php echo $currentUser['street_type_address']." ".$currentUser['name_address']." # ".$currentUser['number_address'] ?></span >
        </div>
        <div class="d-flex w-75 flex-wrap justify-content-around" >
          <span class="FontPrimary w-50" style="min-width: 110px;">TORRE:</span ><span class="FontParrafo text-warning w-50" style="min-width: 110px;"><?php echo $currentUser['tower_address'] ?></span >
        </div>
        <div class="d-flex w-75 flex-wrap justify-content-around" >
          <span class="FontPrimary w-50" style="min-width: 110px;">PISO:</span ><span class="FontParrafo text-warning w-50" style="min-width: 110px;"><?php echo $currentUser['apartment_address'] ?></span >
        </div>
        <div class="d-flex w-75 flex-wrap justify-content-around" >
          <span class="FontPrimary w-50" style="min-width: 110px;">PUERTA:</span ><span class="FontParrafo text-warning w-50" style="min-width: 110px;"><?php echo $currentUser['gate_address'] ?></span >
        </div>
      </div>
      <div class="border border-3 border-warning rounded-3 text-center d-flex flex-column align-items-center justify-content-around m-2 py-4" style="width: 40%; min-width: 200px;" >
        <span class="FontPrimary" >DATOS <?php if($currentUser['client'] == 'companies'){ ?> DE LA EMPRESA <?php }else if($currentUser['client'] == 'persons'){ ?> PERSONALES <?php } ?></span>
        <div class="d-flex w-75 flex-wrap justify-content-around" >
          <span class="FontPrimary w-50" style="min-width: 160px;">NOMBRE:</span ><span class="FontParrafo text-warning w-50" style="min-width: 110px;"><?php echo $currentUser['name'] ?></span >
        </div>
        <div class="d-flex w-75 flex-wrap justify-content-around" >
          <span class="FontPrimary w-50" style="min-width: 160px;">IDENTIFICACIÓN:</span ><span class="FontParrafo text-warning w-50" style="min-width: 110px;"><?php echo $currentUser['identification'] ?></span >
        </div>
        <div class="d-flex w-75 flex-wrap justify-content-around" >
          <span class="FontPrimary w-50" style="min-width: 160px;">CORREO ELECTRÓNICO:</span ><span class="FontParrafo text-warning w-50" style="min-width: 110px;"><?php echo $currentUser['email'] ?></span >
        </div>
        <div class="d-flex w-75 flex-wrap justify-content-around" >
          <span class="FontPrimary w-50" style="min-width: 160px;">TELÉFONO:</span ><span class="FontParrafo text-warning w-50" style="min-width: 110px;"><?php echo $currentUser['phone'] ?></span >
        </div>
      </div>
    </div>
  </div>
</div>

<!-- SECCIÓN DE CAMBIO DE IMAGEN DE PERFIL -->
<div class="container-fluid d-flex justify-content-center align-items-center flex-column my-5 border-img-t">
  <div class="container-sm d-flex flex-column justify-content-center align-items-center">
    <span class="FontPrimary text-center my-3 fs-4">ACTUALIZAR IMAGEN DE PERFIL</span>
    <br>
    <img src="./images/users/<?php echo $currentUser['image'] ?>" id="imagenUser" class="border border-3 border-warning" alt="imagen de perfil" style="width: 200px; height: 200px;" >
    <div class="container-sm d-flex flex-column mx-auto align-items-center" style="max-width: 50vw;">
      <img src="" id="imagenPrevia" alt="imagen subida" class="border border-3 border-warning d-none" style="max-width: 50vw;">
    </div>
    <button class="bg-black border border-3 border-warning px-3 py-2 rounded-3 my-3 d-none" id="buttonDrop"><span class="FontPrimary">ACEPTAR</span></button>
    <div action="" class="d-flex flex-column w-100" style="max-width: 338px;">
      <input type="file" id="inputImagen" class="my-3 FontParrafo" accept="image/*">
    </div>
    <button class="bg-black border border-3 border-warning px-3 py-2 rounded-3 my-3 d-none" id="buttonGuardar" onclick="saveImage()" ><span class="FontPrimary">GUARDAR</span></button>
  </div>
</div>

<!-- SECCIÓN DE CAMBIO DE DATOS PERSONALES -->
<div class="container-fluid d-flex justify-content-center align-items-center flex-column my-5 border-img-t">
  <div class="container-sm d-flex flex-column justify-content-center align-items-center">
    <span class="FontPrimary text-center my-3 fs-4">ACTUALIZAR LOS DATOS <?php if($currentUser['client'] == 'companies'){ ?>DE LA EMPRESA <?php }else if($currentUser['client'] == 'persons'){ ?> PERSONALES <?php } ?></span>
    <br>
    <div class="d-flex flex-column align-items-center w-100">
      <div class="w-75 d-flex flex-wrap justify-content-center">
        <div class="w-50 d-flex flex-column align-items-center" style="min-width: 230px">
        <?php if($currentUser['client'] == 'persons'){ ?>
          <input type="text" value="persons" id="client" hidden>
          <input type="text" id="name1" class="bg-black border border-3 border-warning rounded-3 text-warning FontParrafo px-2 py-1 m-3 w-75" placeholder="Primer Nombre" style="min-width: 200px" required>
          <input type="text" id="name2" class="bg-black border border-3 border-warning rounded-3 text-warning FontParrafo px-2 py-1 m-3 w-75" placeholder="Segundo Nombre" style="min-width: 200px">
          <?php }else if($currentUser['client'] == 'companies'){ ?>
            <input type="text" value="companies" id="client" hidden>
            <input type="text" id="name" class="bg-black border border-3 border-warning rounded-3 text-warning FontParrafo px-2 py-1 m-3 w-75" placeholder="Nombre" style="min-width: 200px" required>
          <?php } ?>
          <input type="text" id="identificacion" class="bg-black border border-3 border-warning rounded-3 text-warning FontParrafo px-2 py-1 m-3 w-75" placeholder="Identificación" style="min-width: 200px" required>
        </div>
        <div class="w-50 d-flex flex-column align-items-center" style="min-width: 230px">
        <?php if($currentUser['client'] == 'persons'){ ?>
          <input type="text" id="apellido1" class="bg-black border border-3 border-warning rounded-3 text-warning FontParrafo px-2 py-1 m-3 w-75" placeholder="Primer Apellido" style="min-width: 200px" required>
          <input type="text" id="apellido2" class="bg-black border border-3 border-warning rounded-3 text-warning FontParrafo px-2 py-1 m-3 w-75" placeholder="Segundo Apellido" style="min-width: 200px">
          <?php }else if($currentUser['client'] == 'companies'){} ?>
          <div class="d-flex justify-content-center align-items-center w-75 m-3" style="min-width: 200px">
            <div class="w-25 me-1">
              <select name="country_code" id="country_code" class="w-100 border rounded-2 border-3 border-warning FontParrafo bg-black p-1" required>
                <option value="" selected hidden>codigo</option>
                <option value="+56" class="FontParrafo">+56 Chile</option>
                <option value="+57" class="FontParrafo">+57 Colombia</option>
                <option value="+593" class="FontParrafo">+593 Ecuador </option>
                <option value="+51" class="FontParrafo">+51 Perú</option>
                <option value="+58" class="FontParrafo">+58 Venezuela </option>
              </select>
            </div>
            <input type="number" min="10000000" max="99999999999" onkeypress="limitarEntradaNumerica(event)" inputmode="numeric" placeholder="Celular" name="telefono" id="telefono" class="w-75 border border-3 border-warning rounded-3 bg-black FontParrafo fs-5 text-center" required>
          </div>
        </div>
      </div>
      <input type="password" id="ActualizarDatosPass" class="bg-black border border-3 border-warning rounded-3 text-warning FontParrafo px-2 py-1 m-3 w-75" placeholder="Contraseña" style="min-width: 200px; max-width: 360px;">
      <span id="ActualizarDatosAlertPass" class="FontParrafo text-danger fs-6 text-center mx-auto mb-3 d-none">Contraseña incorrecta</span>
      <div class="d-flex my-2">
        <input id="ActualizarDatosEmail" value="<?php echo $currentUser['email'] ?>" hidden>
        <input type="checkbox" onclick="showPassword('ActualizarDatosPass',null,null)">
        <span class="FontParrafo mx-3" >Mostrar Contraseña</span>
      </div>
      <button class="bg-black border border-3 border-warning rounded-3 px-3 py-2" onclick="datosClient()"><span class="FontPrimary">Actualizar</span></button>
    </div>
  </div>
</div>

<!-- SECCIÓN DE CAMBIO DE CORREO -->
<div class="container-fluid d-flex justify-content-center align-items-center flex-column my-5 border-img-t">
  <div class="container-sm d-flex flex-column justify-content-center align-items-center">
    <span class="FontPrimary text-center my-3 fs-4">ACTUALIZAR EL CORREO ELECTRÓNICO</span>
    <br>
      <div id="CambioEmail" class="d-flex flex-column align-items-center w-100">
        <div class="w-75 d-flex flex-wrap justify-content-center">
          <div class="w-50 d-flex flex-column align-items-center" style="min-width: 230px">
            <input type="email" id="ActualEmail" class="bg-black border border-3 border-warning rounded-3 text-warning FontParrafo px-2 py-1 m-3 w-75" placeholder="Actual Correo Electrónico" style="min-width: 200px">
            <span id="alertEmail" class="FontParrafo text-danger fs-6 text-center mx-auto d-none">Ingrese un Correo valido</span>
            <input type="email" id="ActualizarEmail" class="bg-black border border-3 border-warning rounded-3 text-warning FontParrafo px-2 py-1 m-3 w-75" placeholder="Nuevo Correo Electrónico" style="min-width: 200px">
            <span id="alertNewEmail" class="FontParrafo text-danger fs-6 text-center mx-auto d-none">Ingrese un Correo valido</span>
            <input type="password" id="ActualizarEmailPass" class="bg-black border border-3 border-warning rounded-3 text-warning FontParrafo px-2 py-1 m-3 w-75" placeholder="Contraseña" style="min-width: 200px">
            <span id="alertPass" class="FontParrafo text-danger fs-6 text-center mx-auto mb-3 d-none">Contraseña incorrecta</span>
            <div class="d-flex my-2">
              <input type="checkbox" onclick="showPassword('ActualizarEmailPass',null,null)">
              <span class="FontParrafo mx-3" >Mostrar Contraseña</span>
            </div>
          </div>
        </div>
        <span id="alertCambioEmail" class="FontParrafo text-danger fs-6 text-center mx-auto my-2 d-none">Por favor llena todos los campos</span>
        <button id="buttonActualizarEmail" class="bg-black border border-3 border-warning rounded-3 px-3 py-2" onclick="cambioEmail()"><span class="FontPrimary">Actualizar</span></button>
      </div>
  </div>
</div>

<!-- SECCIÓN DE CAMBIO DE CONTRASEÑA -->
<div class="container-fluid d-flex justify-content-center align-items-center flex-column my-5 border-img-t">
  <div class="container-sm d-flex flex-column justify-content-center align-items-center">
    <span class="FontPrimary text-center my-3 fs-4">ACTUALIZAR LA CONTRASEÑA</span>
    <br>
      <div action="" class="d-flex flex-column align-items-center w-100">
        <div class="w-75 d-flex flex-wrap justify-content-center">
          <div class="w-50 d-flex flex-column align-items-center" style="min-width: 230px">
            <input id="ActualizarPassAct" type="password" class="bg-black border border-3 border-warning rounded-3 text-warning FontParrafo px-2 py-1 m-3 w-75" placeholder="Contraseña actual" style="min-width: 200px">
            <span id="alertNewPassAct" class="FontParrafo text-danger fs-6 text-center mx-auto d-none">Contraseña Incorrecta</span>
            <input id="ActualizarPassNew" type="password" class="bg-black border border-3 border-warning rounded-3 text-warning FontParrafo px-2 py-1 m-3 w-75" placeholder="Nueva Contraseña" style="min-width: 200px">
            <span id="alertNewPassNoValida" class="FontParrafo text-danger fs-6 text-center mx-auto d-none">La contraseña debe tener mínimo 8 caracteres, una minúscula, una mayúscula y un numero</span>
            <input id="ActualizarPassConfirmaNew" type="password" class="bg-black border border-3 border-warning rounded-3 text-warning FontParrafo px-2 py-1 m-3 w-75" placeholder="Confirmar nueva contraseña" style="min-width: 200px">
            <span id="alertNewPassNoIgual" class="FontParrafo text-danger fs-6 text-center mx-auto d-none">Las contraseñas no coinciden</span>
          </div>
        </div>
        <div class="d-flex my-2">
          <input type="checkbox" onclick="showPassword('ActualizarPassAct','ActualizarPassNew','ActualizarPassConfirmaNew')">
          <span class="FontParrafo mx-3" >Mostrar Contraseña</span>
        </div>
        <button class="bg-black border border-3 border-warning rounded-3 px-3 py-2" onclick="actualizarPass()"><span class="FontPrimary">Actualizar</span></button>
      </div>
  </div>
</div>

<!-- SECCIÓN DE CAMBIO DE DIRECCIÓN -->
<div class="container-fluid d-flex justify-content-center align-items-center flex-column my-5 border-img-t">
  <div class="container-sm d-flex flex-column justify-content-center align-items-center">
    <span class="FontPrimary text-center my-3 fs-4">CAMBIAR DATOS DE DOMICILIO</span>
    <br>
    <div class="d-flex flex-wrap align-items-center justify-content-center w-100">
      <div class="w-50 d-flex flex-column align-items-center" style="min-width: 200px">
        <div class="d-flex w-75 justify-content-between" style="min-width: 200px" >
          <select name="pais" id="pais" class="border rounded-2 border-3 border-warning FontParrafo bg-black my-2 p-1 ps-3" onchange="cargar_ciudad('registro')" required  style="width: 45%;">
            <?php $pais = Filtros_Controlador::ctr_pais('address') ?>
          </select>
          <select name="ciudad" id="ciudad" class="border rounded-2 border-3 border-warning FontParrafo bg-black my-2 p-1 ps-3" required style="width: 45%;">
            <option value="" selected hidden>Ciudad</option>
          </select>
        </div>
        <input type="text" placeholder="Nombre del Barrio" name="barrio" id="barrio" class="mb-3 mt-2 w-75 border border-3 border-warning rounded-3 bg-black FontParrafo fs-5 text-center" required style="min-width: 200px">
        <select name="tipo_calle" id="tipo_calle" class="w-75 border rounded-2 border-3 border-warning FontParrafo bg-black my-2 mx-5 p-1 ps-3" required style="min-width: 200px">
          <?php $pais = Filtros_Controlador::ctr_tipo_calle() ?>
        </select>
      </div>
      <div class="w-50 d-flex flex-column align-items-center" style="min-width: 200px">
        <input type="text" placeholder="Nombre de la Calle" name="name_calle" id="name_calle" class="mb-3 mt-2 w-75 border border-3 border-warning rounded-3 bg-black FontParrafo fs-5 text-center" required style="min-width: 200px">
        <input type="text" placeholder="Numero de la Calle" name="number_calle" id="number_calle" class="mb-3 mt-2 w-75 border border-3 border-warning rounded-3 bg-black FontParrafo fs-5 text-center" required style="min-width: 200px">
        <div class="d-flex justify-content-between w-75" style="min-width: 200px">
          <input type="text" placeholder="Torre" class="mb-3 mt-2 border border-3 border-warning rounded-3 bg-black FontParrafo fs-5 text-center" name="torre" id="torre" style="width: 30%;">
          <input type="text" placeholder="Piso" class="mb-3 mt-2 border border-3 border-warning rounded-3 bg-black FontParrafo fs-5 text-center" name="piso" id="piso" style="width: 30%;">
          <input type="text" placeholder="Puerta" class="mb-3 mt-2 border border-3 border-warning rounded-3 bg-black FontParrafo fs-5 text-center" name="puerta" id="puerta" style="width: 30%;">
        </div>
      </div>
    </div>
    <input type="password" id="ActualizarDirePass" class="bg-black border border-3 border-warning rounded-3 text-warning FontParrafo px-2 py-1 m-3 w-75" placeholder="Contraseña" style="min-width: 200px; max-width: 360px;">
    <span id="ActualizarDireAlertPass" class="FontParrafo text-danger fs-6 text-center mx-auto mb-3 d-none">Contraseña incorrecta</span>
    <div class="d-flex my-2">
      <input type="checkbox" onclick="showPassword('ActualizarDirePass',null,null)">
      <span class="FontParrafo mx-3" >Mostrar Contraseña</span>
    </div>
    <button class="bg-black border border-3 border-warning rounded-3 px-3 py-2" onclick="actualizarDomicilio()"><span class="FontPrimary">Actualizar</span></button>
    <div class="FontParrafo text-center w-50 mx-auto text-danger my-3" style="min-width: 200px">Tenga en cuenta que esta Información es la que se utilizara para envío a Domicilio.</div>
  </div>
</div>

<!-- SECCIÓN DE ELIMINACIÓN DE LA CUENTA-->
<div class="container-fluid d-flex justify-content-center align-items-center flex-column my-5 border-img-t">
  <div class="container-sm d-flex flex-column justify-content-center align-items-center">
    <span class="FontPrimary text-center my-3 fs-4">ELIMINAR ESTA CUENTA</span>
    <br>
      <div class="d-flex flex-column align-items-center w-100">
        <div class="w-75 d-flex flex-wrap justify-content-center">
          <div class="w-50 d-flex flex-column align-items-center" style="min-width: 230px">
            <input type="email" id="eliminaEmail" class="bg-black border border-3 border-warning rounded-3 text-warning FontParrafo px-2 py-1 m-3 w-75" placeholder="Correo Electrónico" style="min-width: 200px">
            <span id="alertEliminaEmail" class="FontParrafo text-danger fs-6 text-center mx-auto d-none">Correo Incorrecto</span>
          </div>
          <div class="w-50 d-flex flex-column align-items-center" style="min-width: 230px">
            <input type="password" id="eliminaPass" class="bg-black border border-3 border-warning rounded-3 text-warning FontParrafo px-2 py-1 m-3 w-75" placeholder="Contraseña" style="min-width: 200px">
            <span id="alertEliminaPass" class="FontParrafo text-danger fs-6 text-center mx-auto d-none">Contraseña Incorrecta</span>
          </div>
        </div>
        <span id="alertEliminaCuentaObliga" class="FontParrafo text-danger fs-6 text-center mx-auto d-none">Llena los campos obligatorios</span>
        <div class="d-flex my-2">
          <input type="checkbox" onclick="showPassword('eliminaPass',null,null)">
          <span class="FontParrafo mx-3" >Mostrar Contraseña</span>
        </div>
        <button class="bg-black border border-3 border-warning rounded-3 px-3 py-2" onclick="eliminaCuenta()"><span class="FontPrimary">Eliminar La Cuenta</span></button>
      </div>
  </div>
</div>
<script src="./node_modules/cropperjs/dist/cropper.min.js"></script>
<script src="./components/js/perfil_config.js"></script>