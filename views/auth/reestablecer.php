<h1 class="nombre-pagina">Reestablecer password</h1>

<?php include_once __DIR__ . '/../templates/alertas.php'; ?>
<?php if($error) return; ?>

<p class="descripcion-pagina">A continuación introduce tu nuevo password.</p>
<form class="formulario" method="POST">
    <div class="campo">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Nuevo password">
    </div>
    <input type="submit" class="boton" value="Reestablecer">
</form>



<div class="acciones">
    <a href="/">¿Ya estás registrado? Inicia Sesión</a>
    <a href="/crear-cuenta">¿No tienes cuenta? Crea una</a>
</div>