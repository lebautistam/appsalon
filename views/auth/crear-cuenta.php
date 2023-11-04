<h1 class="nombre-pagina">Crear cuenta</h1>
<p class="descripcion-pagina">Diligencie el siguiente formulario</p>

<?php include_once __DIR__.'/../templates/alertas.php' ?>

<form action="./crear-cuenta" class="formulario" method="POST">
    <div class="campo">
        <label for="nom_usuari">Nombre</label>
        <input type="text" id="nom_usuari" name="nom_usuari" placeholder="Tu Nombre" value="<?= s($usuario->nom_usuari);?>">
    </div>
    <div class="campo">
        <label for="ape_usuari">Apellido</label>
        <input type="text" id="ape_usuari" name="ape_usuari" placeholder="Tu Apellido" value="<?= s($usuario->ape_usuari);?>">
    </div>
    <div class="campo">
        <label for="tel_usuari">Teléfono</label>
        <input type="tel" id="tel_usuari" name="tel_usuari" placeholder="Tu Telefono" value="<?= s($usuario->tel_usuari);?>">
    </div>
    <div class="campo">
        <label for="usu_email">E-mail</label>
        <input type="email" id="usu_email" name="usu_email" placeholder="Tu E-mail" value="<?= s($usuario->usu_email);?>">
    </div>
    <div class="campo">
        <label for="pwd_usuari">Contraseña</label>
        <input type="password" id="pwd_usuari" name="pwd_usuari" placeholder="Tu Contraseña" >
    </div>

    <input type="submit" class="button" value="Crear Cuenta">
</form>

<div class="acciones">
    <a href="./">¿Ya tienes una cuenta? Inicia Sesión</a>
    <a href="./olvide">¿Olvidaste tu contraseña?</a>
</div>