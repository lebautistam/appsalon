<?php

namespace Model;

class Servicios extends ActiveRecord {

    protected static $tabla = 'tab_genera_servic';
    protected static $columnasDB = ['id', 'nom_servic', 'val_servic', 'usu_creaci', 'fec_creaci'];

    public $id;
    public $nom_servic;
    public $val_servic;
    public $usu_creaci;
    public $fec_creaci;

    public function __construct($args = []) {

        $this->id = $args['id'] ?? null;
        $this->nom_servic = $args['nom_servic'] ?? '';
        $this->val_servic = $args['val_servic'] ?? '';
        $this->usu_creaci = $args['usu_creaci'] ?? '';
        $this->fec_creaci = $args['fec_creaci'] ?? '';
    }

    public function validar() {
        if(!$this->nom_servic) {
            self::$alertas['error'][] = 'Nombre obligatorio';
        }
        if(!$this->val_servic) {
            self::$alertas['error'][] = 'Precio obligatorio';
        }
        if(!is_numeric($this->val_servic)) {
            self::$alertas['error'][] = 'Precio no válido';
        }
        return self::$alertas;
    }
}