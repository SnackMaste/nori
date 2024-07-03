const MenuUsuario = document.getElementById("MenuUsuario");
menuUsuario();
function fetchAndSetDataMenu(url, targetElement) {
    return fetch(url)
    .then(response => response.json())
    .then(data => {
        targetElement.innerHTML=data
        let abrirMenu = document.getElementById("MenuLogin");
        let cerrarMenu = document.getElementById("CerrarMenu");
        let contenedorMenu = document.getElementById("contenedorMenuLogin")
        let cerrarSesion = document.getElementById("CerrarSesion");
        abrirMenu.addEventListener('click', function() {
            contenedorMenu.style.display = "block";
            setTimeout(function() {
                contenedorMenu.style.opacity = 1;
                contenedorMenu.style.transform = "translateX(0)";
            }, 50);
        })
        cerrarMenu.addEventListener('click', function() {
            contenedorMenu.style.opacity = 0;
            contenedorMenu.style.transform = "translateX(100%)";
            setTimeout(function() {
                contenedorMenu.style.display = "none";
            }, 500);
        })
        cerrarSesion.addEventListener('click', function(){
            let url = '/Solicitudes/CerrarSesion.php';
            fetch(url).then(response => response.json())
            .then(data => {
                if(data == "Sesion_Cerrada"){
                    location.reload();
                }
            })
        });
    })
    .catch(err => console.log(err))

};
function menuUsuario () {
    let url = '/Solicitudes/MenuUsuario.php'
    fetchAndSetDataMenu(url, MenuUsuario)
};
