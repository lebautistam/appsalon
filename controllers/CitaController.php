<?php

namespace Controllers;

use MVC\Router;

class CitaController {

    public static function index( Router $router) {
        session_start();
        isAuth();
        $router->render('citas/index', [
            'nombre' => $_SESSION['nom_usuari'],
            'id' => $_SESSION['id']
        ]);
    }
}