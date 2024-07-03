var textSearch = document.getElementById('searchInput');
var tipo = document.getElementById('tipo');

document.addEventListener('DOMContentLoaded', function() {
    tipo.selectedIndex = 0;
    textSearch.value = '';
})

function tipoFiltro(){
    var idTipo = tipo.value;
    var texto = textSearch.value;
    products = document.querySelectorAll('[data-tipo]');
    products.forEach(element => {
        element.classList.remove('d-none');
    });
    if(idTipo === null || idTipo === undefined || idTipo === ''){
        if(texto === null || texto === undefined || texto === ''){
            return;
        }else{
            textFormat = removeAccents(textSearch.value.toLowerCase());
            products = document.querySelectorAll('[data-name]');
            products.forEach(element => {
            productName = removeAccents(element.getAttribute('data-name').toLowerCase()); 
            productName.includes(textFormat) ? element.classList.remove('d-none') : element.classList.add('d-none');
        });
        }
    }else{
        if(texto === null || texto === undefined || texto === ''){
            products.forEach(element => {
                tipoProducto = element.getAttribute('data-tipo'); 
                tipoProducto == idTipo ? element.classList.remove('d-none') : element.classList.add('d-none');
            });
        }else{
            textFormat = removeAccents(textSearch.value.toLowerCase());
            products.forEach(element => {
                productName = removeAccents(element.getAttribute('data-name').toLowerCase());
                type = element.getAttribute('data-tipo');
                productName.includes(textFormat) && type == idTipo ? element.classList.remove('d-none') : element.classList.add('d-none');
            });
        }
    }
}

textSearch.addEventListener('keyup',function(){
    var idTipo = tipo.value;
    if(idTipo === null || idTipo === undefined || idTipo === ''){
        textFormat = removeAccents(textSearch.value.toLowerCase());
        products = document.querySelectorAll('[data-name]');
        products.forEach(element => {
            productName = removeAccents(element.getAttribute('data-name').toLowerCase()); 
            productName.includes(textFormat) ? element.classList.remove('d-none') : element.classList.add('d-none');
        });
    }else{
        textFormat = removeAccents(textSearch.value.toLowerCase());
        products = document.querySelectorAll('[data-name]');
        products.forEach(element => {
            productName = removeAccents(element.getAttribute('data-name').toLowerCase());
            type = element.getAttribute('data-tipo');
            productName.includes(textFormat) && type == idTipo ? element.classList.remove('d-none') : element.classList.add('d-none');
        });
    }
})

function removeAccents(str) {
    return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
}