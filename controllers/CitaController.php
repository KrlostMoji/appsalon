<?php 

namespace Controller;

use MVC\Router;

class CitaController {

    public static function index(Router $router){

        if(!isset($_SESSION)){
            session_start();
        }

        isAuth();

        $router->render('citas/index', [
            'nombre' => $_SESSION['nombre_completo'],
            'id' => $_SESSION['id']
        ]);

    }


}