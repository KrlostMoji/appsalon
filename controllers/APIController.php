<?php 

namespace Controller;

use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;

class APIController {

    public static function index (){
        $servicios = Servicio::all();
        $JsonServcios = json_encode($servicios);
        echo $JsonServcios;
    }

    public static function guardar(){
        if(isset($_POST)){
            $cita = new Cita($_POST);
            $resultado = $cita->guardar();

            $id = $resultado['id'];

            //Almacena la cita y el servicio 
            $idServicios = explode (",", $_POST['servicios']);
            foreach($idServicios as $idServicio){
                $args = [
                    'citaId' => $id,
                    'servicioId' => $idServicio
                ];
                $citaServicio = new CitaServicio($args);
                $citaServicio->guardar();
            }


            echo json_encode($resultado);        
        }
        
    }

    public static function eliminar(){
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $cita = Cita::find($id);
            $cita->eliminar();
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }

    }

}
