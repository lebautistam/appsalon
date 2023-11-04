<h1 class="nombre-pagina">Crear Nueva Cita</h1>
<p class="descripcion-pagina">Elige tus servicios a continuación</p>
<?php 
    include_once __DIR__.'/../templates/barra.php';
?>
<div id="app">
    <div class="tabs">
        <button class="actual" type="button" data-paso="1">Servicios</button>
        <button type="button" data-paso="2">Información cita</button>
        <button type="button" data-paso="3">Resumen</button>
    </div>
    <div id="paso-1" class="seccion">
        <h2>Servicios</h2>
        <p class="text-center">Elige tus servicios a continuación</p>
        <div id="servicios" class="listado-servicios"></div>
    </div>
    <div id="paso-2" class="seccion">
        <h2>Tus datos y cita</h2>
        <p class="text-center">Ingresa tus datos y fecha de tu cita</p>
        <form class="formulario">
            <div class="campo">
                <label for="pwd_usuari">Nombre</label>
                <input type="text" id="nom_usuari" placeholder="Tu nombre" value="<?= ucwords($nombre); ?>" readonly>
            </div>
            <div class="campo">
                <label for="fec_citaxx">Fecha</label>
                <input type="date" id="fec_citaxx" min="<?= date('Y-m-d', strtotime('+1 day'));?>">
            </div>
            <div class="campo">
                <label for="hor_citaxx">Hora</label>
                <input type="time" id="hor_citaxx" step="60">
            </div>
            <input type="hidden" name="usu_citasx" id="usu_citasx" value="<?=$id?>">
        </form>
    </div>
    <div id="paso-3" class="seccion contenido-resumen">
        <h2>Tus datos y cita</h2>
        <p class="text-center">Verifica que la información sea correcta</p>
    </div>
    <div class="paginacion">
        <button class="button" id="anterior">&laquo; Anterior</button>
        <button class="button" id="siguiente">Siguiente &raquo;</button>
    </div>
</div>

<?php $script = "<script src='build/js/app.js'></script>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>"; 

?> 