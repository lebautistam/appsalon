<h1 class="nombre-pagina">Panel de Administración</h1>

<?php 
    include_once __DIR__.'/../templates/barra.php';
?>

<h2>Buscar citas</h2>

<div class="busqueda">
    <form class="formulario">
        <div class="campo">
            <label for="fec_citasx">Fecha:</label>
            <input type="date" name="fec_citasx" id="fec_citasx" value="<?= $fecha ?>">
        </div>
    </form>
</div>
<?php if(count($citas) === 0): ?>
    <h3>No hay citas</h3>
<?php endif; ?>
<div id="citas-admin">
    <ul class="citas">
        <?php
            $idCitas = 0;
            foreach($citas as $key => $cita):
                if($idCitas !== $cita->num_citasx):
                    $total = 0;
        ?>
                    <li>
                        <p>ID: <span><?=$cita->num_citasx?></span></p>
                        <p>Hora: <span><?=$cita->hor_citasx?></span></p>
                        <p>Cliente: <span><?=ucwords($cita->nom_client)?></span></p>
                        <p>Email: <span><?=$cita->usu_email?></span></p>
                        <p>Teléfono: <span><?=$cita->tel_usuari?></span></p>
                        <h3>Servicios</h3>
       <?php
                    $idCitas = $cita->num_citasx;
                endif;
                $total += $cita->val_servic;
        ?>          
                        <p class="servicio"><span><?=$cita->nom_servic.'  $'. $cita->val_servic?></span></p>
                    <!-- </li>                    -->
                <?php 
                    $actual = $cita->num_citasx; 
                    $proximo = $citas[$key+1]->num_citasx ?? 0;
                    if(esUltimo($actual, $proximo)):?>
                        <p>Total: <span>$<?= $total ?></span></p>

                        <form action="./api/eliminar" method="POST">
                            <input type="hidden" name="idx_citasx" value="<?=$cita->num_citasx?>">
                            <input type="submit" value="Eliminar" class="button-eliminar">
                        </form>
                <?php endif;?>
        <?php
            endforeach;
        ?>

    </ul>
</div>

<?php $script = "<script src='build/js/buscador.js'></script>" ?>