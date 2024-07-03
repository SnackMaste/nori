const paisRegistro = document.getElementById('PaisRegistro');
const ciudadRegistro = document.getElementById('CiudadRegistro')
const tipoCalle = document.getElementById('TipoCalleRegistro')
function getAndSet(url, targetElement){
    return fetch(url, {
        method: "POST", 
        mode: 'cors'
    })
    .then(response => {
        if (!response.ok) {
            throw new Error("HTTP error " + response.status);
        }
        return response.json();
    })
    .then(data => {
        targetElement.innerHTML = data;
    })
    .catch(err => console.log(err));
};
function getAndSetDataCiudad(url, formData, targetElement) {
    return fetch(url, {
        method: "POST", 
        body: formData, 
        mode: 'cors'
    })
    .then(response => response.json())
    .then(data => {
        targetElement.innerHTML=data
    })
    .catch(err => console.log(err))
}

function recargaPaisRegistro() {
    let url = '/Organisms/Fichas/RecargaPaisFormulario.php'
    getAndSet(url,paisRegistro);
    recargaTipoCalle();
}
function recargaCiudadRegistro() {
    let paisSelecionadoRegistro = paisRegistro.value;
    let url = '/Organisms/Fichas/RecargaCiudadFormulario.php'
    formData = new FormData()
    formData.append('paisSelecionadoRegistro', paisSelecionadoRegistro)
    getAndSetDataCiudad(url, formData, ciudadRegistro)
}
function recargaTipoCalle(){
    let url = '/Organisms/Fichas/RecargaTipoCalleRegistro.php'
    getAndSet(url,tipoCalle)
}

