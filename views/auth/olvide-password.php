<h1 class="nombre-pagina">Olvide Contraseña</h1>
<p class="descripcion-pagina">Diligencia el campo con tu email para el restablecimiento</p>
<?php include_once __DIR__.'/../templates/alertas.php' ?>
<form action="./olvide" class="formulario" method="POST">
    <div class="campo">
        <label for="usu_email">Email</label>
        <input type="email" id="usu_email" placeholder="Tu email" name="usu_email">
    </div>

    <input type="submit" class="button" value="Enviar">
</form>

<div class="acciones">
    <a href="./crear-cuenta">¿Aún no tienes una cuenta? Crear una</a>
</div>

