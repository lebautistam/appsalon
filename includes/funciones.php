<?php

function debuguear($variable, $exit = true) {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    $exit ? exit : '';
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function esUltimo(string $actual, string $proximo): bool{
    if($actual !== $proximo) {
        return true;
    }
    return false;
}

//Función para coprobar que el usuario esta autenticado
function isAuth() : void {
    if(!isset($_SESSION['login'])){
        header('Location: ./');
    }
}

//Función para coprobar que el usuario esta autenticado
function isAdmin() : void {
    if(!isset($_SESSION['admin'])){
        header('Location: ./');
    }
}