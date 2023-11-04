<h1 class="nombre-pagina">login</h1>
<p class="descripcion-pagina">Inicia sesión con tus datos</p>
<?php include_once __DIR__.'/../templates/alertas.php' ?>
<form action="./" class="formulario" method="POST">
    <div class="campo">
        <label for="usu_email">Email</label>
        <input type="email" id="usu_email" placeholder="Tu email" name="usu_email">
    </div>
    <div class="campo">
        <label for="pwd_usuari">password</label>
        <input type="password" id="pwd_usuari" placeholder="Tu password" name="pwd_usuari">
    </div>

    <input type="submit" class="button" value="Iniciar sesión">
</form>

<div class="acciones">
    <a href="./crear-cuenta">¿Aún no tienes una cuenta? Crear una</a>
    <a href="./olvide">¿Olvidaste tu contraseña?</a>
</div>