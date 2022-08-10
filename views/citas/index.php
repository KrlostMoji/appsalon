<h1 class="nombre-pagina">Citas</h1>
<p class="descripcion-pagina">Programa una cita para tu atención</p>

<?php include_once __DIR__ . '/../templates/barra.php';
?>

<div id="app">
    <nav class="tabs">
        <button type="button" data-paso="1">Servicios</button>
        <button type="button" data-paso="2">Información Cita</button>
        <button type="button" data-paso="3">Resumen General</button>
    </nav>
    <div id="paso-1" class=seccion>
        <h2>Servicios</h2>
        <p class="text-center">Elige los servicios deseados</p>
        <div id="servicios" class="listado-servicios"></div>
    </div>
    <div id="paso-2" class=seccion>
        <h2>-Datos-&-Cita-</h2>
        <p class="text-center">Favor de llenar tus datos y la cita</p>
        <div class="campo">
            <label for="nombre">Nombre</label>
            <input id="nombre" type="text" value="<?php echo $nombre ?>" disabled>
        </div>
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input id="fecha" type="date" min="<?php echo Date('Y-m-d', strtotime('+1 day')) ?>">
        </div>
        <div class="campo">
            <label for="hora">Hora</label>
            <input id="hora" type="time" mix="09:00" max="17:30">
        </div>
        <input type="hidden" id='id' value="<?php echo $id ?>">
    </div>
    <div id="paso-3" class="seccion contenido-resumen">
        <h2>Resumen general</h2>
        <p class="text-center">Confirma la información</p>
        <div id="resumen" class="listado-servicios"></div>
    </div>
    <div class="paginacion">
        <button id="anterior" class="boton">&laquo; Anterior</button>
        <button id="siguiente" class="boton">Siguiente &raquo;</button>
    </div>
</div>

<?php 

    $script = "
    <script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
        <script src='build/js/app.js'></script>
    ";