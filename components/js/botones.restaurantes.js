
function getMenu(boton) {
    const valorDataId = boton.getAttribute("data-id");
    window.location.href = "?ruta=menu&&id=" + valorDataId;
}
