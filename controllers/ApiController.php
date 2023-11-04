<?php

namespace Controllers;

use COM;
use Model\Cita;
use Model\CitaServicio;
use Model\Servicios;

class ApiController {
    public static function index(){
        $servicios = Servicios::all();
        echo json_encode($servicios);
    }

    public static function guardar() {
        
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();

        $servicios = explode(",", $_POST['servicios']);

        foreach($servicios as $servicio) {
            $args = [
                'idx_citaxx' => $resultado['id'],
                'idx_servic' => $servicio
            ];

            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
        }


        echo json_encode(['resultado' => $resultado]);
    }

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['idx_citasx'];
            $eliminar = Cita::find($id);
            $resultado = $eliminar->eliminar();
            header('Location:'.$_SERVER['HTTP_REFERER']);
        }
    }
}