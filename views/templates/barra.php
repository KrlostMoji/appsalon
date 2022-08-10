<div class="barra">
    <p>Hola: <?php echo $nombre ?? '' ?></p>
    <a href="/logout">Cerrar sesión</a>
</div>

<?php if(isset($_SESSION['admin'])){ ?>
    <div class="barra-servicios">
        <a class="boton "href="/admin">Ver Citas</a>
        <a class="boton "href="/servicios">Mis Servicios</a>
        <a class="boton "href="/servicios/crear">Agregar Servicios</a>
    </div>

<?php } ?>