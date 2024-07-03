const menu = document.getElementById('FichasM');
var idRestaurante;
document.addEventListener('DOMContentLoaded', (event) => {
    idRestaurante = localStorage.getItem('idRestaurante');
    getMenu()
});

function fetchAndSetData(url, formData, targetElement) {
    return fetch(url, {
        method: "POST", 
        body: formData, 
        mode: 'cors'
    })
    .then(response => response.json())
    .then(data => {
        targetElement.innerHTML=data
        setup();
    })
    .catch(err => console.log(err))
};

function getMenu () {
    let url = '/Solicitudes/getMenu.php'
    formData = new FormData()
    formData.append('idrestaurante', idRestaurante)
    fetchAndSetData(url, formData, menu)
};