function sessionFinish(){
    let formData = new FormData();
    formData.append('request', 'finish');
    let url = "controller/session.controlador.php";
    fetch(url,{
        method: "POST",
        body: formData,
        mode: "cors"
    })
    .then(response => response.text())
    .then(data => {
        alert("Sesión cerrada satisfactoriamente");
        window.location.href= "?ruta=inicio";
    })
    .catch(err => {
        console.log('Error al analizar la respuesta JSON:', err);
        console.log('Respuesta completa:', err.response); // Imprime la respuesta completa
    });
}