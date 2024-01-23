<?php

namespace Controllers;

use Model\Servicios;
use MVC\Router;

class ServicioController {
    public static function index(Router $router) {
        session_start();
        isAdmin();
        $servicios = Servicios::all();

        $router->render('servicios/index', [
            'nombre' => $_SESSION['nom_usuari'],
            'servicios' => $servicios
        ]);
    }

    public static function crear(Router $router) {
        session_start();
        isAdmin();
        $servicio = new Servicios;
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST['usu_creaci'] = $_SESSION['nom_usuari'];
            $_POST['fec_creaci'] = date('Y-m-d H:i:s'); 
            $servicio->sincronizar($_POST);

            $alertas = $servicio->validar();

            if(empty($alertas)) {
                $servicio->guardar();
                header('Location: '.$_ENV['APP_URL'].'/servicios');
            }
        }
        // debuguear($servicio);
        $router->render('servicios/crear', [
            'nombre' => $_SESSION['nom_usuari'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }

    public static function actualizar(Router $router) {
        session_start();
        isAdmin();
        $servicio = Servicios::find(s($_GET['id']));
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();

            if(empty($alertas)) {
                $servicio->guardar();
                header('Location: '.$_ENV['APP_URL'].'/servicios');
            }

        }

        $router->render('servicios/actualizar', [
            'nombre' => $_SESSION['nom_usuari'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }

    public static function eliminar() {
        session_start();
        isAdmin();
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicio = Servicios::find($_POST['id']);
            $servicio->eliminar();
            header('Location: '.$_ENV['APP_URL'].'/servicios');
        }
    }
}