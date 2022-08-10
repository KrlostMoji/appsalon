<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Introduce tus datos para iniciar sesión</p>

<form action="/" class="formulario" method="POST">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" id="email" placeholder="Ingresa tu email" name="email" value="<?php echo $auth->email ?>">
    </div>
    <div class="campo">
        <label for="password">Password</label> 
        <input type="password" id="password" placeholder="Password" name="password">
    </div>

    <input type="submit" class="boton" value="Iniciar Sesión">

</form>

<?php 
    include_once __DIR__ . "/../templates/alertas.php";

?>

<div class="acciones">
    <a href="/crear-cuenta">¿No tienes cuenta? Crea una</a>
    <a href="/forgot">¿Olvidaste tu password? Recupéralo</a>
</div>