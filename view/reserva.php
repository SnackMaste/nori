<!-- CODIGO DEL FUNCIONAMIENTO DE LOS SELECT QUE SON DEPENDIENTES -->
<script src="./components/js/filtros_dependientes.js"></script>
<!-- CONTENIDO DE LOS EVENTOS DE NORI -->
<div class="Fichas contenedorEventos">
    <!-- EVENTO HANAMI -->
    <div class="my-4">
        <div class="text-center my-3">
            <span class="FontCanji fs-1">花見  Hanami</span>
        </div>
        <div class="d-flex justify-content-center">
            <img src="./images/events/eventodecerezo.avif" alt="imagen de postres rosas" class="w-50" style="min-width: 200px; max-width: 600px">
        </div>
        <div class="container-sm text-center"><span class=" FontParrafo fs-4">“Festival de la Flor de Cerezo en NORI: Únete a nosotros para celebrar la belleza y la tradición del Hanami, el festival japonés de la flor del cerezo. Disfruta de una experiencia culinaria única con nuestro menú especial de sushi, inspirado en la primavera y la efímera belleza de los cerezos en flor. Sumérgete en la cultura japonesa mientras te deleitas con nuestros exquisitos platos, en un ambiente decorado al estilo de los tradicionales picnics de Hanami bajo los cerezos. ¡Ven y celebra con nosotros la llegada de la primavera y la belleza de la flor de cerezo!”</span></div>
    </div>
    <!-- EVENTO TANABATA -->
    <div class="my-4">
        <div class="text-center my-3">
            <span class="FontCanji fs-1">七夕 Tanabata</span>
        </div>
        <div class="d-flex justify-content-center">
            <img src="./images/events/eventodelasestrellas.avif" alt="imagen de sushi con estrellas" class="w-50" style="min-width: 200px; max-width: 600px">
        </div>
        <div class="container-sm text-center"><span class=" FontParrafo fs-4">“Festival de Tanabata en NORI: Únete a nosotros para celebrar Tanabata, una de las festividades más coloridas de Japón. Disfruta de nuestro menú especial de sushi mientras te sumerges en la tradición de escribir tus deseos en tiras de papel y colgarlos en nuestras decoraciones de bambú. Experimenta la magia de esta antigua celebración de amor y esperanza en nuestro restaurante. ¡Ven y haz un deseo bajo las estrellas de Tanabata con nosotros!”</span></div>
    </div>
    <!-- EVENTO DE REUNIONES -->
    <div class="my-4">
        <div class="text-center my-3">
            <span class="FontCanji fs-1">Reuniones</span>
        </div>
        <div class="d-flex justify-content-center">
            <img src="./images/events/eventoreunion.avif" alt="imagen de sushi ejecutivo" class="w-50" style="min-width: 200px; max-width: 600px">
        </div>
        <div class="container-sm text-center"><span class=" FontParrafo fs-4">Evento de Cumpleaños en NORI: Celebra tu cumpleaños con un toque japonés. Disfruta de nuestro delicioso sushi y vive una experiencia única. Ofrecemos un menú especial para cumpleañeros y decoramos tu mesa con detalles festivos. ¡Ven a celebrar tu día especial con nosotros!</span></div>
    </div>
    <!-- EVENTO DE CUMPLEAÑOS-->
    <div class="my-4">
        <div class="text-center my-3">
            <span class="FontCanji fs-1">Cumpleaños</span>
        </div>
        <div class="d-flex justify-content-center">
            <img src="./images/events/eventodecumpleaños.avif" alt="imagen de sushi especial" class="w-50" style="min-width: 200px; max-width: 600px">
        </div>
        <div class="container-sm text-center"><span class=" FontParrafo fs-4">Evento de Reuniones en NORI: ¿Buscas un lugar para tu próxima reunión de negocios o encuentro con amigos? Nuestro restaurante ofrece un ambiente tranquilo y acogedor, perfecto para reuniones. Disfruta de nuestro exquisito sushi mientras te reúnes. Ofrecemos opciones de menú personalizadas para grupos. ¡Haz de tu reunión una experiencia memorable con nosotros!</span></div>
    </div>
</div>
<!-- INICIO DE LA SECCIÓN DE RESERVA -->
<div class="d-flex justify-content-center py-4 border-img-t">
    <span class="FontPrimary fs-3">RESERVA</span>
</div>
<div class="border-img-t">
    <!-- FORMULARIO DE LA RESERVA -->
    <form action="/Solicitudes/reserva.php" method="post" class="my-4 p-4 d-flex flex-column align-items-center">
        <div class="w-100 d-flex flex-wrap justify-content-around">
            <!-- SECCIÓN DE LA INFORMACIÓN DEL RESTAURANTE -->
            <div class="container-sm border border-3 border-warning rounded-3 p-3 d-flex flex-column align-items-center my-3" style="min-width: 200px; max-width:450px;">
                <h5 class="text-center my-3"><span class="FontPrimary">INFORMACIÓN RESTAURANTE</span></h5>
                <!-- SECCIÓN DE PAÍS -->
                <label class="FontParrafo text-center" for="pais">País:</label>
                <br>
                <select name="pais" id="pais" onchange="cargar_ciudad('restaurante')" class="w-75 bg-black border border-3 border-warning rounded-3 FontParrafo" required>
                    <?php $pais = Filtros_Controlador::ctr_pais('restaurant'); ?>
                </select>
                <br>
                <!-- SECCIÓN DE CIUDAD -->
                <label class="FontParrafo text-center" for="ciudad">Ciudad:</label>
                <br>
                <select name="ciudad" id="ciudad" onchange="cargaRestaurantes(this)" class="w-75 bg-black border border-3 border-warning rounded-3 FontParrafo" required>
                    <option class="FontParrafo" value="">Seleccione primero un pais</option>
                </select>
                <br>
                <!-- SECCIÓN DE RESTAURANTE -->
                <label class="FontParrafo text-center" for="restaurante">Restaurante:</label>
                <br>
                <select name="restaurante" id="restaurante" required class="w-75 bg-black border border-3 border-warning rounded-3 FontParrafo">
                    <option class="FontParrafo" value="">Seleccione primero una ciudad</option>
                </select>
            </div>
            <!-- SECCIÓN DE LA INFORMACIÓN DE LA RESERVA -->
            <div class="container-sm border border-3 border-warning rounded-3 p-3 d-flex flex-column align-items-center my-3" style="min-width: 200px; max-width:450px;">
                <h5 class="text-center my-3"><span class="FontPrimary">INFORMACIÓN RESERVA</span></h5>
                <!-- SECCIÓN DE NUMERO DE PERSONAS -->
                <label for="persona" class="FontPrimary text-center"><span class="FontPrimary">Número de personas:</span></label>
                <br>
                <input type="number" id="NumPersonas" name="persona" placeholder="Cantidad" onkeypress="limitarEntradaNumerica(event)" required class="text-center w-75 bg-black border border-3 border-warning rounded-3 FontParrafo">
                <br>
                <!-- SECCIÓN DE FECHA RESERVA -->
                <label for="fecha" class="FontPrimary text-center"><span class="FontPrimary">Fecha De Reserva:</span></label>
                <br>
                <input type="date" id="fecha" name="Fecha" required class="text-center w-75 bg-black border border-3 border-warning rounded-3 FontParrafo">
                <br>
                <!-- SECCIÓN DE HORA RESERVA -->
                <label for="hora" class="FontPrimary text-center"><span class="FontPrimary">Hora Reserva Disponible:</span></label>
                <br>
                <select id="hora" name="Hora" required class="text-center w-75 bg-black border border-3 border-warning rounded-3 FontParrafo">
                    <option class="FontParrafo" value="">Seleccione primero una fecha</option>
                </select>
                <br>
                <!-- ETIQUETA INFORMATIVA -->
                <div class="nota FontParrafo FontSize4 mt-2 text-center text-danger">Nota: Durante el fin de semana no se aceptan reservas</div>
            </div>
            <!-- SECCIÓN DE LOS DATOS ADICIONALES DE LAS RESERVA -->
            <div class="container-sm border border-3 border-warning rounded-3 p-3 d-flex flex-column align-items-center my-3" style="min-width: 200px; max-width:450px;">
                <h5 class="text-center my-3"><span class="FontPrimary">INFORMACIÓN ADICIONAL</span></h5>
                <!-- SECCIÓN DE OCASIÓN O EVENTO RESERVA -->
                <label for="ocasion" class="mb-2 text-center" ><span class="FontPrimary">Ocasión o evento:</span></label>
                <br>
                <input type="text" id="ocasion" name="Ocasion" placeholder="Opcional" maxlength="25" class="mb-2 text-center w-75 bg-black border border-3 border-warning rounded-3 FontParrafo">
                <br>
                <!-- SECCIÓN DE COMENTARIO RESERVA -->
                <label for="EspecificacionEvento" class="mb-2 text-center" ><span class="FontPrimary">¿Alguna especificación del evento?</span></label>
                <br>
                <textarea id="EspecificacionEvento" name="Comentario" placeholder="Opcional" maxlength="100" class="text-center w-75 bg-black border border-3 border-warning rounded-3 FontParrafo" style="height: 90px;"></textarea>
            </div>
        </div>
        <button type="submit" id="Reservar" class="bg-black border border-3 border-warning py-2 px-3 my-4 rounded-3"><span class="FontPrimary">Reservar</span></button>
    </form>
</div>
<!-- CÓDIGO DE FUNCIONAMIENTO DE LA PAGINA RESERVA -->
<script src="./components/js/reserva.js"></script>