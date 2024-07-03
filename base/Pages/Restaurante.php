<?php 
require_once '../config/conexion.php';
$db = Database::getInstance();
$pdo = $db->getConnection();
$pais = $pdo->query('SELECT DISTINCT direccion.Pais
FROM restaurante
JOIN direccion ON restaurante.Direccion_Restaurante = direccion.Id_Direccion
ORDER BY direccion.Pais ASC;');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/Atoms/Icons/NORI-2.0.ico">
    <title>NORI | Restaurantes</title>
    <link rel="stylesheet" href="/Templates/Restaurantes.css" type="text/css">
    <link rel="stylesheet" href="/Atoms/Fonts/Fonts.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <!--Header-->
    <div id="header"></div>
    <!---Filtro-->
    <section class="Filtro-container">
        <div class="TituloFiltro">
            <span class="FontPrimary">Buscar Restaurantes</span>
        </div>
        <div class="DosFiltros">
            <div class="select-conatinerPais">
                <div class="selectPais">
                    <div class="selected-optionPais">
                        <span class="FontPrimary FontSize5"><span class="select-valuePais">PAIS</span></span>
                        <img data-paisicon="rotatePais" src="../Atoms/Icons/desplegable.ico" alt="" class="icon-selectPais">
                    </div>
                    <div data-pais="collapsedPais" class="optionsPais"> 
                        <?php while($row = $pais->fetch(PDO::FETCH_ASSOC)) { ?>
                            <div class="optionPais" value="<?php echo $row['Pais'] ?>" ><span class="FontPrimary FontSize5"><?php echo $row['Pais'] ?></span></div>
                            <?php } ?>
                    </div>
                </div>
            </div>
            <div class="select-conatinerCiudad">
                <div class="selectCiudad">
                    <div class="selected-optionCiudad">
                        <span class="FontPrimary FontSize5"><span class="select-valueCiudad">CIUDAD</span></span>
                        <img data-ciudadicon="rotateCiudad" src="../Atoms/Icons/desplegable.ico" alt="" class="icon-selectCiudad">
                    </div>
                    <div data-ciudad="collapsedCiudad" class="optionsCiudad">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="/Molecules/Filtros/Pais.js"></script>
    <!--Fichas de los restaurantes-->
    <section class="Fichas">
        <div class="relleno"></div>
    </section>
    <!---Footer-->
    <div id="footer"></div>
    <div id="ventanaModalLogin"></div>
    <div id="incluir"></div>
    <script src="/Solicitudes/session.js"></script>
    <script src="/Solicitudes/restaurante.js"></script>
    <script src="/Molecules/Filtros/Ciudad.js"></script>
</body>
</html>