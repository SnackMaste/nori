const btnPersona = document.getElementById('BtnPersona');
const btnEmpresa = document.getElementById('BtnEmpresa');
const spanPersona = document.getElementById('BtnspanP');
const spanEmpresa = document.getElementById('BtnspanE');
//BOTÓN PERSONA ACTIVO
btnPersona.addEventListener('click', () => {
    //ESTILOS DE BOTÓN EMPRESA AÑADIDO
    btnEmpresa.classList.add('bg-black');
    spanEmpresa.classList.add('FontAni');
    //ESTILOS DE BOTÓN EMPRESA REMOVIDO
    btnEmpresa.classList.remove('bg-gradient-img');
    spanEmpresa.classList.remove('FontSecundary');
    //ESTILOS DE BOTÓN PERSONA AÑADIDO
    btnPersona.classList.add('bg-gradient-img');
    spanPersona.classList.add('FontSecundary');
    //ESTILOS DE BOTÓN PERSONA REMOVIDO
    btnPersona.classList.remove('bg-black');
    spanPersona.classList.remove('FontAni');
});

//BOTÓN EMPRESA ACTIVO
btnEmpresa.addEventListener('click', () => {
    //ESTILOS DE BOTÓN EMPRESA AÑADIDO
    btnEmpresa.classList.add('bg-gradient-img');
    spanEmpresa.classList.add('FontSecundary');
    //ESTILOS DE BOTÓN EMPRESA REMOVIDO
    btnEmpresa.classList.remove('bg-black');
    spanEmpresa.classList.remove('FontAni');
    //ESTILOS DE BOTÓN PERSONA AÑADIDO
    btnPersona.classList.add('bg-black');
    spanPersona.classList.add('FontAni');
    //ESTILOS DE BOTÓN PERSONA REMOVIDO
    btnPersona.classList.remove('bg-gradient-img');
    spanPersona.classList.remove('FontSecundary');
});

function cargarLogin(activo){
    let formIngreso = document.getElementById('formIngresar');
    if (activo === 'persona') {
        url= 'components/php/form.ingresar.persona.php'
    } else if (activo === 'empresa') {
        url= 'components/php/form.ingresar.empresa.php'
    }
    fetch(url)
        .then(response => response.text())
        .then(data => {
            formIngreso.innerHTML = data;
        })
        .catch(error => console.error('Error al cargar el archivo PHP:', error));
}
function cargarRegistro(activo){
    var formRegistro = document.getElementById('divFormRegistro');
    if (activo === 'persona') {
        url= 'components/php/form.registro.persona.php'
    } else if (activo === 'empresa') {
        url= 'components/php/form.registro.empresa.php'
    }
    fetch(url)
        .then(response => response.text())
        .then(data => {
            formRegistro.innerHTML = data;
        })
        .catch(error => console.error('Error al cargar el archivo PHP:', error));
}