<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html ?? '');
    return $s;
}

// Funcion para revisar si el usuario está autenticado y proteger /citas
function isAuth() : void {
    if(!isset($_SESSION['login'])){
        header('Location: /');
    }
}

function isLast($actual, $proximo){
    if($actual !== $proximo){
        return true;
    }
    return false;
}

function isAdmin() : void {
    if(!isset($_SESSION['admin'])){
        header('Location: /');
    }
}