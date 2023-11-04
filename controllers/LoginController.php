<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController {
    public static function login(Router $router) {
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);

            $alertas = $auth->validarLogin();

            if(empty($alertas)){
                $usuario = Usuario::where('usu_email', $auth->usu_email);
                if($usuario) {
                    if( $usuario->testUsuarioExisteANDVerificado($auth->pwd_usuari) ) {
                        session_start();

                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['usu_email'] = $usuario->usu_email;
                        $_SESSION['nom_usuari'] = "{$usuario->nom_usuari} {$usuario->ape_usuari}";
                        $_SESSION['login'] = true; 

                        if($usuario->usu_admin) {
                            $_SESSION['admin'] = $usuario->usu_admin;
                            header('Location: ./admin');
                            // debuguear($_SESSION);
                        }else {
                            header('Location: ./citas');
                        }
                        
                    } 
                }else {
                    Usuario::setAlerta('error', 'El usuario no esta creado');
                }
            }
            

        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/login',[
            'alertas' => $alertas
        ]);
    }

    public static function logout() {
        session_start();

        $_SESSION = [];

        header('Location: ./');
    }

    public static function olvide(Router $router) {

        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();

            if(empty($alertas)) {
                $usuario = Usuario::where('usu_email', $auth->usu_email);

                if($usuario && $usuario->usu_confir) {
                    //crear token
                    $usuario->generarToken();
                    $usuario->guardar();

                    //Enviar Email
                    $email = new Email($usuario->usu_email, $usuario->nom_usuari, $usuario->cod_token);
                    $email->enviarInstrucciones();

                    Usuario::setAlerta('exito', 'Revisa tu Email');
                }else {
                    Usuario::setAlerta('error', 'El Usuario no existe o no esta confirmado');
                    $alertas = Usuario::getAlertas();
                }
            }
        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/olvide-password',[
            'alertas' => $alertas
        ]);
    }

    public static function crear(Router $router) {

        $usuario = new Usuario();
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            if(empty($alertas)) {
                $resultado = $usuario->existeUsuario();

                if($resultado->num_rows) {
                    $alertas = Usuario::getAlertas();               
                }else {
                    //hashear contraseña para guardar
                    $usuario->hashPassword();
                    //Generar token para validar Email
                    $usuario->generarToken();
                    //Enviar Email
                    $email = new Email($usuario->usu_email, $usuario->nom_usuari, $usuario->cod_token);
                    $sendMail = $email->enviarEmail();

                    $resultado = $usuario->guardar();
                    if($resultado) {
                        header("Location: ./mensaje");
                    }
                }
            }

        }
        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function mensaje(Router $router) {
        $router->render('auth/mensaje');
    }

    public static function confirmar(Router $router) {
        $alertas = [];
        $token = s($_GET['token']);
        $usuario = Usuario::where('cod_token', $token );

        if($usuario){
            $usuario->usu_confir = 1;
            $usuario->cod_token = NULL;
            $usuario->guardar();

            Usuario::setAlerta('exito', 'Cuenta confirmada correctamente');
        
        }else {
            Usuario::setAlerta('error', 'Token invalido');
        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/confirmar-cuenta',[
            'alertas' => $alertas
        ]);
    }

    public static function recuperar(Router $router) {
        
        $alertas = [];
        $error = false;
        $token = s($_GET['token']);

        $usuario = Usuario::where('cod_token', $token);

        if(empty($usuario)) {
            Usuario::setAlerta('error', 'Token no válido');
            $error = true;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $password = new Usuario($_POST);
            $alertas = $password->validarPassword();
            
            if(empty($alertas)) {
                $usuario->pwd_usuari = null;
                $usuario->pwd_usuari = $password->pwd_usuari;
                $usuario->hashPassword();
                $usuario->cod_token = null;
                $resultado = $usuario->guardar();

                if($resultado) {
                    header('Location: ./');
                }
                
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/recuperar-password', [
            'alertas' => $alertas,
            'error' => $error
        ]);
    }

}