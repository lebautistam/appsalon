<?php

namespace Model;

class AdminCita extends ActiveRecord{
    protected static $tabla = 'tab_relaci_citser';
    protected static $columnasDb = ['num_citasx','hor_citasx','nom_client','usu_email','tel_usuari','nom_servic','val_servic'];

    public $num_citasx;
    public $hor_citasx;
    public $nom_client;
    public $usu_email;
    public $tel_usuari;
    public $nom_servic;
    public $val_servic;

    public function __construct($args = []) {
        $this->num_citasx = $args['num_citasx'] ?? null;
        $this->hor_citasx = $args['hor_citasx'] ?? '';
        $this->nom_client = $args['nom_client'] ?? '';
        $this->usu_email = $args['usu_email'] ?? '';
        $this->tel_usuari = $args['tel_usuari'] ?? '';
        $this->nom_servic = $args['nom_servic'] ?? '';
        $this->val_servic = $args['val_servic'] ?? '';
    }
}