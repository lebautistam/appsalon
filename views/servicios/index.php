<h1 class="nombre-pagina">Servicios</h1>
<p class="descripcion-pagina">Administración de Servicios</p>

<?php include_once __DIR__.'/../templates/barra.php' ?>

<ul class="servicios">
    <?php foreach ($servicios as $servicio): ?>
        <li>
            <p>Nombre: <span><?= $servicio->nom_servic ?></span></p>
            <p>Precio: <span><?= $servicio->val_servic ?></span></p>

            <div class="acciones">
                <a class="button" href="<?=$_ENV['APP_URL']?>/servicios/actualizar?id=<?=$servicio->id?>">Actualizar</a>
                <form action="<?=$_ENV['APP_URL']?>/servicios/eliminar" method="POST">
                    <input type="hidden" name="id" value="<?=$servicio->id?>">
                    <input type="submit" value="Eliminar" class="button-eliminar">
                </form>
            </div>
        </li>
    <?php endforeach; ?>
</ul>