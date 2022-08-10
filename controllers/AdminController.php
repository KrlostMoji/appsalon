<?php 

namespace Controller;

use Model\AdminCita;
use MVC\Router;

class AdminController{
    
    public static function index(Router $router){

        if(!isset($_SESSION)){
            session_start();    
        }

        //Verificar si es administrador el usuario
        isAdmin();

        //Obtener fecha del GET y si no existe la fecha de hoy
        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        
        $fechaExp = explode('-', $fecha);
        if(!checkdate($fechaExp[1], $fechaExp[2], $fechaExp[0])){
            header('Locatio: /404');
        }
        
        //Consultar a la base de datos
        $consulta = "SELECT citas.id, citas.hora, CONCAT( clientes.nombre, ' ', clientes.apellido) as cliente, ";
        $consulta .= " clientes.email, clientes.telefono, servicios.nombre as servicio, servicios.precio  ";
        $consulta .= " FROM citas  ";
        $consulta .= " LEFT OUTER JOIN clientes ";
        $consulta .= " ON citas.clienteId=clientes.id  ";
        $consulta .= " LEFT OUTER JOIN citasServicios ";
        $consulta .= " ON citasServicios.citaId=citas.id ";
        $consulta .= " LEFT OUTER JOIN servicios ";
        $consulta .= " ON servicios.id=citasServicios.servicioId ";
        $consulta .= " WHERE fecha =  '${fecha}' ";
        
        $citas = AdminCita::SQL($consulta);


        $router->render('admin/index', [
            'nombre' => $_SESSION['nombre_completo'],
            'citas' => $citas,
            'fecha' => $fecha
        ]);

    }

}