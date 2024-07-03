<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuenta Regresiva</title>
</head>
<body>
    <p id="contador">10:00</p>

    <script>
        // Función que se ejecutará cuando llegue a cero
        function ejecutarAlFinalizar() {
            console.log("¡Cuenta regresiva finalizada! Ejecutando otra función.");
            // Aquí puedes llamar a la función que deseas ejecutar
        }

        // Función para la cuenta regresiva
        function cuentaRegresiva() {
            const contadorElemento = document.getElementById("contador");
            let tiempoRestante = 600; // 10 minutos en segundos

            function actualizarContador() {
                const minutos = Math.floor(tiempoRestante / 60);
                const segundos = tiempoRestante % 60;
                const tiempoFormateado = `${minutos}:${segundos.toString().padStart(2, '0')}`;
                contadorElemento.textContent = tiempoFormateado;

                if (tiempoRestante === 0) {
                    clearInterval(intervalo);
                    ejecutarAlFinalizar();
                }
            }

            // Actualiza el contador cada segundo
            const intervalo = setInterval(function() {
                tiempoRestante--;
                actualizarContador();
            }, 1000);
        }

        // Inicia la cuenta regresiva al cargar la página
        
        
    </script>
    <?php
    if(isset($_GET['iniciar'])){
        ?><script> cuentaRegresiva();</script><?php
    }else{
        ?><script> console.log('seguir cuenta')</script><?php
    }
    ?>
</body>
</html>
