//FUNCIÓN PARA CARGAR LAS CIUDADES PANTALLAS PEQUEÑAS A GRANDES EN LOS RESTAURANTES Y RECARGA EL SELECT DEL REGISTRO
function cargar_ciudad(lugar){
    //SELECCIONAMOS Y ALMACENAMOS EN UNA VARIABLE EL PRIMER SELECT QUE ES PARA PANTALLAS PEQUEÑAS A GRANDES
    let pais = document.getElementById('pais').value;
    if(pais == ""){
        return;
    }else{
        //CREAMOS UN NUEVO form-data
        let formData = new FormData()
        //LE COLOCAMOS LA VARIABLE PAÍS QUE CONTIENE EL PAÍS CON EL NOMBRE PAÍS
        formData.append('pais', pais);
        formData.append('lugar', lugar);
        //SELECCIONAMOS Y ALMACENAMOS EN UNA VARIABLE EL PRIMER SELECT QUE ES PARA PANTALLAS PEQUEÑAS A GRANDES
        let targetElement = document.getElementById('ciudad');
        //URL DE DONDE SE HARÁ LA SOLICITUD
        let url = 'controller/filtros.controlador.php';
        //REALIZACIÓN DE LA SOLICITUD
        fetch(url, {
            method: "POST", 
            body: formData, 
            mode: 'cors'
        })
        .then(response => response.text())
        .then(data => {
            //PONEMOS LA RESPUESTA EN EL SELECT
            targetElement.innerHTML=data
        })
        .catch(err => console.log(err))
    }
}
//FUNCIÓN PARA CARGAR LAS CIUDADES EN PANTALLAS EXTRA PEQUEÑAS DE LOS RESTAURANTES
function cargar_ciudad_ep(lugar){
    //SELECCIONAMOS Y ALMACENAMOS EN UNA VARIABLE EL PRIMER SELECT QUE ES PARA PANTALLAS PEQUEÑAS A GRANDES
    let pais = document.getElementById('pais_ep').value;
    if(pais == ""){
        return;
    }else{
        //CREAMOS UN NUEVO form-data
        let formData = new FormData()
        //LE COLOCAMOS LA VARIABLE PAÍS QUE CONTIENE EL PAÍS CON EL NOMBRE PAÍS
        formData.append('pais', pais)
        formData.append('lugar', lugar);
        //SELECCIONAMOS Y ALMACENAMOS EN UNA VARIABLE EL PRIMER SELECT QUE ES PARA PANTALLAS PEQUEÑAS A GRANDES
        let targetElement = document.getElementById('ciudad_ep');
        //URL DE DONDE SE HARÁ LA SOLICITUD
        let url = 'controller/filtros.controlador.php';
        //REALIZACIÓN DE LA SOLICITUD
        fetch(url, {
            method: "POST", 
            body: formData, 
            mode: 'cors'
        })
        .then(response => response.text())
        .then(data => {
            //PONEMOS LA RESPUESTA EN EL SELECT
            targetElement.innerHTML=data
        })
        .catch(err => console.log(err))
    }
}
//FUNCIÓN PARA CARGAR LAS FICHAS DE LOS RESTAURANTES PANTALLAS PEQUEÑAS A GRANDES
function cargar_restaurantes(){
    //SELECCIONAMOS Y ALMACENAMOS EN UNA VARIABLE EL SELECT QUE ES PARA PANTALLAS PEQUEÑAS A GRANDES
    let ciudad = document.getElementById('ciudad').value;
    if(ciudad == ""){
        return;
    }else{
        //CREAMOS UN NUEVO form-data
        let formData = new FormData()
        //LE COLOCAMOS EL VALOR DE LA VARIABLE DE CIUDAD Y LE COLOCAMOS EL NOMBRE DE CIUDAD
        formData.append('ciudad', ciudad)
        //SELECCIONAMOS DONDE VAMOS A CARGAR LA RESPUESTA QUE RECIBIREMOS DEL CONTROLADOR
        let targetElement = document.getElementById('fichas_restaurante');
        //LA URL DEL CONTROLADOR
        let url = 'components/php/restaurantes.php';
        //HACEMOS LA SOLICITUD
        fetch(url, {
            method: "POST", 
            body: formData, 
            mode: 'cors'
        })
        .then(response => response.text())
        .then(data => {
            //CARGAMOS LA RESPUESTA RECIBIDA DESDE EL CONTROLADOR
            targetElement.innerHTML=data
        })
        .catch(err => console.log(err))
    }
}
//FUNCIÓN PARA CARGAR LAS FICHAS DE LOS RESTAURANTES PANTALLAS EXTRA PEQUEÑAS ep
function cargar_restaurantes_ep(){
    //SELECCIONAMOS Y ALMACENAMOS EN UNA VARIABLE EL SELECT QUE ES PARA PANTALLAS PEQUEÑAS A GRANDES
    let ciudad = document.getElementById('ciudad_ep').value;
    if(ciudad == ""){
        return;
    }else{
        //CREAMOS UN NUEVO form-data
        let formData = new FormData()
        //LE COLOCAMOS EL VALOR DE LA VARIABLE DE CIUDAD Y LE COLOCAMOS EL NOMBRE DE CIUDAD
        formData.append('ciudad', ciudad)
        //SELECCIONAMOS DONDE VAMOS A CARGAR LA RESPUESTA QUE RECIBIREMOS DEL CONTROLADOR
        let targetElement = document.getElementById('fichas_restaurante');
        //LA URL DEL CONTROLADOR
        let url = 'components/php/restaurantes.php';
        //HACEMOS LA SOLICITUD
        fetch(url, {
            method: "POST", 
            body: formData, 
            mode: 'cors'
        })
        .then(response => response.text())
        .then(data => {
            //CARGAMOS LA RESPUESTA RECIBIDA DESDE EL CONTROLADOR
            targetElement.innerHTML=data
        })
        .catch(err => console.log(err))
    }
}


