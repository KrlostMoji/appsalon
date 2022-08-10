<h1 class="nombre-pagina">Menú Administrador</h1>
<p class="descripcion-pagina">Actualizar datos Servicio</p>


<?php 
    include_once __DIR__ . '/../templates/barra.php';
    include_once __DIR__ . '/../templates/alertas.php';
?>

<form class="formulario" method="POST">
    <?php 
        include_once  __DIR__ . '/formulario.php';
    ?>
    <input type="submit" class="boton" value="Guardar">
</form>