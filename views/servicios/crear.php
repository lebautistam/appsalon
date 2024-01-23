<h1 class="nombre-pagina">Nuevo Servicio</h1>
<p class="descripcion-pagina">LLena todo el formulario</p>

<?php include_once __DIR__.'/../templates/barra.php' ?>
<?php include_once __DIR__.'/../templates/alertas.php' ?>

<form action="<?= $_ENV['APP_URL'] ?>/servicios/crear" class="formulario" method="POST">
    <?php include_once __DIR__.'/formulario.php' ?>
    <input type="submit" value="Guardar Servicio" class="button">
</form>