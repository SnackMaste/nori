<div class="Fichas contenedorEventos">
    <div class="my-4">
        <div class="text-center my-3">
            <span class="FontCanji fs-1">花見  Hanami</span>
        </div>
        <div class="d-flex justify-content-center">
            <img src="./images/events/EventoDeCerezo.jpg" alt="" class="w-50" style="min-width: 200px; max-width: 600px">
        </div>
        <div class="container-sm text-center"><span class=" FontParrafo fs-4">“Festival de la Flor de Cerezo en NORI: Únete a nosotros para celebrar la belleza y la tradición del Hanami, el festival japonés de la flor del cerezo. Disfruta de una experiencia culinaria única con nuestro menú especial de sushi, inspirado en la primavera y la efímera belleza de los cerezos en flor. Sumérgete en la cultura japonesa mientras te deleitas con nuestros exquisitos platos, en un ambiente decorado al estilo de los tradicionales picnics de Hanami bajo los cerezos. ¡Ven y celebra con nosotros la llegada de la primavera y la belleza de la flor de cerezo!”</span></div>
    </div>
    <div class="my-4">
        <div class="text-center my-3">
            <span class="FontCanji fs-1">七夕 Tanabata</span>
        </div>
        <div class="d-flex justify-content-center">
            <img src="./images/events/eventoDeLasEstrellas.jpg" alt="" class="w-50" style="min-width: 200px; max-width: 600px">
        </div>
        <div class="container-sm text-center"><span class=" FontParrafo fs-4">“Festival de Tanabata en NORI: Únete a nosotros para celebrar Tanabata, una de las festividades más coloridas de Japón. Disfruta de nuestro menú especial de sushi mientras te sumerges en la tradición de escribir tus deseos en tiras de papel y colgarlos en nuestras decoraciones de bambú. Experimenta la magia de esta antigua celebración de amor y esperanza en nuestro restaurante. ¡Ven y haz un deseo bajo las estrellas de Tanabata con nosotros!”</span></div>
    </div>
    <div class="my-4">
        <div class="text-center my-3">
            <span class="FontCanji fs-1">Reuniones</span>
        </div>
        <div class="d-flex justify-content-center">
            <img src="./images/events/eventoReunion.jpg" alt="" class="w-50" style="min-width: 200px; max-width: 600px">
        </div>
        <div class="container-sm text-center"><span class=" FontParrafo fs-4">Evento de Cumpleaños en NORI: Celebra tu cumpleaños con un toque japonés. Disfruta de nuestro delicioso sushi y vive una experiencia única. Ofrecemos un menú especial para cumpleañeros y decoramos tu mesa con detalles festivos. ¡Ven a celebrar tu día especial con nosotros!</span></div>
    </div>
    <div class="my-4">
        <div class="text-center my-3">
            <span class="FontCanji fs-1">Cumpleaños</span>
        </div>
        <div class="d-flex justify-content-center">
            <img src="./images/events/eventoDeCumpleaños.jpg" alt="" class="w-50" style="min-width: 200px; max-width: 600px">
        </div>
        <div class="container-sm text-center"><span class=" FontParrafo fs-4">Evento de Reuniones en NORI: ¿Buscas un lugar para tu próxima reunión de negocios o encuentro con amigos? Nuestro restaurante ofrece un ambiente tranquilo y acogedor, perfecto para reuniones. Disfruta de nuestro exquisito sushi mientras te reúnes. Ofrecemos opciones de menú personalizadas para grupos. ¡Haz de tu reunión una experiencia memorable con nosotros!</span></div>
    </div>
</div>
<div class="d-flex justify-content-center py-4 border-img-t">
    <span class="FontPrimary fs-3">RESERVA</span>
</div>
<div class="border-img-t">
    <form action="/Solicitudes/reserva.php" method="post" class="my-4 p-4 d-flex flex-column align-items-center">
        <div class="w-100 d-flex flex-wrap justify-content-around">
            <div class="w-25 border border-3 border-warning rounded-3 p-3 d-flex flex-column align-items-center" style="min-width: 200px;">
                <h5 class="text-center my-3"><span class="FontPrimary">INFORMACIÓN RESTAURANTE</span></h5>
                <label class="FontParrafo" for="PaisReserva">País:</label>
                <br>
                <select name="Pais" id="PaisReserva" onchange="getciudad()" class="w-75 bg-black border border-3 border-warning rounded-3 FontParrafo" required></select>
                <br>
                <label class="FontParrafo" for="CiudadReserva">Ciudad:</label>
                <br>
                <select name="Ciudad" id="CiudadReserva" onchange="getrestaurante()" class="w-75 bg-black border border-3 border-warning rounded-3 FontParrafo" required></select>
                <br>
                <label class="FontParrafo" for="estauranteReserva">Restaurante:</label>
                <br>
                <select name="Restaurante" id="RestauranteReserva" required class="w-75 bg-black border border-3 border-warning rounded-3 FontParrafo"></select>
            </div>
            <div class="w-25 border border-3 border-warning rounded-3 p-3 d-flex flex-column align-items-center" style="min-width: 200px;">
                <h5 class="text-center my-3"><span class="FontPrimary">INFORMACIÓN RESERVA</span></h5>
                <label for="NumPersonas" class="FontPrimary"><span class="FontPrimary">Número de personas:</span></label>
                <br>
                <input type="number" id="NumPersonas" name="numeroPersonas" required class="text-center w-75 bg-black border border-3 border-warning rounded-3 FontParrafo">
                <br>
                <label for="fechaReserva" class="FontPrimary"><span class="FontPrimary">Fecha De Reserva:</span></label>
                <br>
                <input type="date" id="fechaReserva" name="Fecha" required class="text-center w-75 bg-black border border-3 border-warning rounded-3 FontParrafo">
                <br>
                <label for="HoraReserva" class="FontPrimary"><span class="FontPrimary">Hora Reserva Disponible:</span></label>
                <br>
                <select id="HoraReserva" name="Hora" required class="text-center w-75 bg-black border border-3 border-warning rounded-3 FontParrafo"></select>
                <br>
                <div class="nota FontParrafo FontSize4 mt-2">Nota: Durante el fin de semana no se aceptan reservas</div>
            </div>
            <div class="w-25 border border-3 border-warning rounded-3 p-3 d-flex flex-column align-items-center" style="min-width: 200px;">
                    <h5 class="text-center my-3"><span class="FontPrimary">INFORMACIÓN ADICIONAL</span></h5>
                    <label for="ocasion" class="mb-2" ><span class="FontPrimary">Ocasión o evento:</span></label>
                    <br>
                    <input type="text" id="ocasion" name="Ocasion" placeholder="Opcional" maxlength="25" class="mb-2 text-center w-75 bg-black border border-3 border-warning rounded-3 FontParrafo">
                    <br>
                    <label for="EspecificacionEvento" class="mb-2" ><span class="FontPrimary">¿Alguna especificación del evento?</span></label>
                    <br>
                    <textarea id="EspecificacionEvento" name="Comentario" placeholder="Opcional" maxlength="100" class="text-center w-75 bg-black border border-3 border-warning rounded-3 FontParrafo" style="height: 90px;"></textarea>
            </div>
        </div>
        <button type="submit" id="Reservar" class="bg-black border border-3 border-warning py-2 px-3 my-4 rounded-3"><span class="FontPrimary">Reservar</span></button>
    </form>
</div>