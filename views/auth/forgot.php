<h1 class="nombre-pagina">Recuperar Contraseña</h1>
<p class="descripcion-pagina">Introduce el email con el que te registraste</p>

<form action="/forgot" class="formulario" method="POST">
    <div class="campo">
        <label for="email">Correo Electrónico</label>
        <input type="email" id="email" name="email" placeholder="Correo Electrónico">
    </div>

    <input type="submit" class="boton" value="Reestablecer mi contraseña">

</form>

<?php include_once __DIR__ . '/../templates/alertas.php'; ?>

<div class="acciones">
    <a href="/">¿Ya estás registrado? Inicia Sesión</a>
    <a href="/crear-cuenta">¿No tienes cuenta? Crea una</a>
</div>