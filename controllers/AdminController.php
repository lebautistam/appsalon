<?php

namespace Controllers;

use Model\AdminCita;
use MVC\Router;

class AdminController {

    public static function index(Router $router) {
        session_start();

        isAdmin();
        $fecha = $_GET['fecha'] ?? date('Y-m-d');

        $fechas = explode("-", $fecha);
        if(!checkdate($fechas[1], $fechas[2], $fechas[0])) {
            header('Location: ./');
        }
        // debuguear($fechas);

        $query = "SELECT b.id as num_citasx, TIME(b.fec_citasx) as hor_citasx, 
                         CONCAT(a.nom_usuari,' ', a.ape_usuari) as nom_client, 
                         a.usu_email, a.tel_usuari, d.nom_servic, 
                         d.val_servic"; 
        $query .= " FROM tab_genera_usuari a";
        $query .= " INNER JOIN tab_usuari_citasx b ON b.usu_citasx = a.id"; 
        $query .= " LEFT OUTER JOIN tab_relaci_citser c ON b.id = c.idx_citaxx";
        $query .= " LEFT OUTER JOIN tab_genera_servic d ON c.idx_servic = d.id";
        $query .= " WHERE DATE(b.fec_citasx) = '{$fecha}'";
        $citas = AdminCita::SQL($query);
        // debuguear($query);
        $router->render('admin/index', [
            'nombre' => $_SESSION['nom_usuari'],
            'citas' => $citas,
            'fecha' => $fecha
        ]);
    }
}