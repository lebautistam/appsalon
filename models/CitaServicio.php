<?php

namespace Model;

class CitaServicio extends ActiveRecord{
    protected static $tabla = 'tab_relaci_citser';
    protected static $columnasDB = ['id','idx_citaxx','idx_servic'];

    public $id;
    public $idx_citaxx;
    public $idx_servic;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->idx_citaxx = $args['idx_citaxx'] ?? '';
        $this->idx_servic = $args['idx_servic'] ?? '';
    }
}