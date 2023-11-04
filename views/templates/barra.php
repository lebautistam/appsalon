<div class="barra">
    <p>Hola: <?= ucwords($nombre) ?? ''; ?> </p>
    <a href="./logout" class="button">Cerrar Sesión</a>
</div>

<?php if(isset($_SESSION['admin'])): ?>
    <div class="barra-servicios">
        <a class="button" href="<?= BASE_URL ?>admin">Ver Citas</a>
        <a class="button" href="<?= BASE_URL ?>servicios">Ver Servicios</a>
        <a class="button" href="<?= BASE_URL ?>servicios/crear">Nuevo Servicio</a>
    </div>
<?php endif; ?>