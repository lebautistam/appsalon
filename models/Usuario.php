<?php

namespace Model;

class Usuario extends ActiveRecord{
    //Base datos
    protected static $tabla = 'tab_genera_usuari';
    protected static $columnasDB = ['id', 'nom_usuari', 'ape_usuari',
                                 'usu_email', 'tel_usuari', 'pwd_usuari',
                                 'usu_confir', 'usu_admin', 'cod_token'];
    public $pattern = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
    public $id;
    public $nom_usuari;
    public $ape_usuari;
    public $usu_email;
    public $tel_usuari;
    public $pwd_usuari;
    public $usu_confir;
    public $usu_admin;
    public $cod_token;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nom_usuari = $args['nom_usuari'] ?? '';
        $this->ape_usuari = $args['ape_usuari'] ?? '';
        $this->usu_email = $args['usu_email'] ?? '';
        $this->tel_usuari = $args['tel_usuari'] ?? null;
        $this->pwd_usuari = $args['pwd_usuari'] ?? '';
        $this->usu_confir = $args['usu_confir'] ?? 0;
        $this->usu_admin = $args['usu_admin'] ?? 0;
        $this->cod_token = $args['cod_token'] ?? '';
    }

    //Validaciones alertas
    public function validarNuevaCuenta () {
        if(!$this->nom_usuari){
            self::$alertas['error'][] = 'El Nombre es requerido';
        }
        if(!$this->ape_usuari){
            self::$alertas['error'][] = 'El Apellido es requerido';
        }
        if(!$this->usu_email){
            self::$alertas['error'][] = 'El Email es requerido';
        }
        if(!$this->tel_usuari){
            self::$alertas['error'][] = 'El Teléfono es requerido';
        }
        if(!$this->pwd_usuari || (strlen($this->pwd_usuari) < 6)){
            self::$alertas['error'][] = 'La contraseña es requerida y/o debe contener minímo 6 carácteres';
        }else if(!preg_match($this->pattern,$this->pwd_usuari) ){
            self::$alertas['error'][] = 'La contraseña debe llevar mayúsculas, minúsculas y carácteres especiales';
        }

        return self::$alertas;
    }

    public function validarLogin() {
        if(!$this->usu_email) {
            self::$alertas['error'][] = 'El email es obligatorio';
        }
        if(!$this->pwd_usuari) {
            self::$alertas['error'][] = 'La contraseña es obligatoria';
        }

        return self::$alertas;
    }

    public function validarEmail() {
        if(!$this->usu_email) {
            self::$alertas['error'][] = 'El email es obligatorio';
        }
        return self::$alertas;
    }

    public function validarPassword() {
        if(!$this->pwd_usuari || (strlen($this->pwd_usuari) < 6)){
            self::$alertas['error'][] = 'La contraseña es requerida y/o debe contener minímo 6 carácteres';
        }else if(!preg_match($this->pattern,$this->pwd_usuari) ){
            self::$alertas['error'][] = 'La contraseña debe llevar mayúsculas, minúsculas y carácteres especiales';
        }
        return self::$alertas;
    }

    public function existeUsuario() {
        $query = "SELECT * FROM ".self::$tabla." WHERE usu_email = '".$this->usu_email."' LIMIT 1";

        $resultado = self::$db->query($query);

        if($resultado->num_rows) {
            self::$alertas['error'][] = 'El usuario ya existe';
        }

        return $resultado;
    }

    public function hashPassword() {
        $this->pwd_usuari = password_hash($this->pwd_usuari, PASSWORD_BCRYPT);
    }

    public function generarToken() {
        $this->cod_token = uniqid();
    }
    
    public function testUsuarioExisteANDVerificado($password) {
        $resultado = password_verify($password, $this->pwd_usuari);
        
        if(!$resultado || !$this->usu_confir) {
            self::$alertas['error'][] = 'Contraseña incorrecta o el usuario no esta confirmado';
        }else {
            return true;
        }
    }

}   