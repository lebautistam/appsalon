<h1 class="nombre-pagina" >Recuperar Contraseña</h1>
<p class="descripcion-pagina">Ingresa tu nueva contraseña</p>
<?php include_once __DIR__.'/../templates/alertas.php' ?>
<?php if($error) return; ?>
<form class="formulario" method="POST">

    <div class="campo">
        <label for="pwd_usuari">Contraseña</label>
        <input type="password" id="pwd_usuari" placeholder="Tu contraseña nueva" name="pwd_usuari">
    </div>

    <input type="submit" class="button" value="Guardar contraseña">
</form>

<div class="acciones">
    <a href="./">¿Recuerdas tu contraseña? Inicia sesión</a>
    <a href="./crear-cuenta">Crear una cuenta</a>
</div>