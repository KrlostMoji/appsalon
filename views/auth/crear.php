<h1 class="nombre-pagina">Crear cuenta</h1>
<p class="descripcion-pagina">Completa los datos para crear un nuevo usuario</p>

<form action="/crear-cuenta" class="formulario" method="POST">
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" placeholder="Nombre(s)" value="<?php echo s($usuario->nombre) ?>">
    </div>
    <div class="campo">
        <label for="apellido">Apellido</label>
        <input type="text" id="apellido" name="apellido" placeholder="Apellidos" value="<?php echo s($usuario->apellido) ?>">
    </div>
    <div class="campo">
        <label for="telefono">Teléfono</label>
        <input type="tel" id="telefono" name="telefono" placeholder="Número de teléfono celular" value="<?php echo s($usuario->telefono) ?>">
    </div>
    <div class="campo">
        <label for="email">Correo Electrónico</label>
        <input type="email" id="email" name="email" placeholder="Correo Electrónico" value="<?php echo s($usuario->email) ?>">
    </div>
    <div class="campo">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Crea una contraseña" >
    </div>

    <input type="submit" class="boton" value="Crear mi cuenta">

</form>

<?php 
    include_once __DIR__ . "/../templates/alertas.php";

?>

<div class="acciones">
    <a href="/">¿Ya estás registrado? Inicia Sesión</a>
    <a href="/forgot">¿Olvidaste tu password? Recupéralo</a>
</div>