//Función que cargara la información del modal
function detalle(producto){
    nameProduct= producto.getAttribute('data-name');
    descriptionProduct= producto.getAttribute('data-description');
    imageProduct= producto.getAttribute('data-img');
    //creamos el elemento que enviara la información
    let formData = new FormData();
    //lo llenamos de la información
    formData.append('modal', 'detalle');
    formData.append('name', nameProduct);
    formData.append('description', descriptionProduct);
    formData.append('image', imageProduct);
    //SELECCIONAMOS DONDE VAMOS A CARGAR LA RESPUESTA QUE RECIBIREMOS DEL CONTROLADOR
    let targetElement = document.getElementById('modal-content');
    //LA URL DEL CONTROLADOR
    let url = 'controller/modal.controller.php';
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