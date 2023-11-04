<?php

namespace Model;

class Cita extends ActiveRecord{

    protected static $tabla = 'tab_usuari_citasx';
    protected static $columnasDB = ['id','fec_citasx','usu_citasx','usu_modifi','fec_modifi'];

    public $id;
    public $fec_citasx;
    public $usu_citasx;
    public $usu_modifi;
    public $fec_modifi;

    public function __construct($args = []) {
        
        $this->id = $args['id'] ?? NULL;
        $this->fec_citasx = $args['fecha'].' '. $args['hora'] ?? '';
        $this->usu_citasx = $args['usu_citasx'] ?? '';
        $this->usu_modifi = $args['usu_modifi'] ?? NULL;
        $this->fec_modifi = $args['fec_modifi'] ?? NULL;
    }
}