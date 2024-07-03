const ciudad = document.querySelector('.optionsCiudad');
const restaurante = document.querySelector('.Fichas');
function aggEventlistener(){
    let botones = document.querySelectorAll('.BtnMenu');
    if (botones.length) {
        botones.forEach((boton) => {
            boton.addEventListener('click', function() {
                let idRestaurante = this.getAttribute('data-id');
                localStorage.setItem('idRestaurante', idRestaurante);
                location.href='/Pages/Menu.html';
            });
        });
    }
};

/*CIUDAD */

function fetchAndSetData(url, formData, targetElement) {
    return fetch(url, {
        method: "POST", 
        body: formData, 
        mode: 'cors'
    })
    .then(response => response.json())
    .then(data => {
        targetElement.innerHTML=data;
        aggEventlistener();
    })
    .catch(err => console.log(err))
}

function getCiudades () {
    let pais = window.pais;
    let url = '/Solicitudes/getCiudad.php'
    formData = new FormData()
    formData.append('pais', pais)

    fetchAndSetData(url, formData, ciudad)
}
/*RESTAURANTE */
function getRestaurante () {
    let ciudad = window.ciudad;
    let url = '/Solicitudes/getRestaurante.php'
    formData = new FormData()
    formData.append('ciudad', ciudad)

    fetchAndSetData(url, formData, restaurante)
}