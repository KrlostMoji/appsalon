<?php 

namespace Model;

class Servicio extends ActiveRecord{

    //Configurar BD
    protected static $tabla = 'servicios';
    protected static $columnasDB = ['id', 'nombre', 'precio'];

    public $id;
    public $nombre;
    public $precio;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->precio = $args['precio'] ?? '';
    }

    public function validar(){
        if(!$this->nombre){
            self::$alertas['error'][] = 'Debes introducir el nombre del servicio';
        }

        if(!$this->precio){
            self::$alertas['error'][] = 'Favor de proporcionar el precio del servicio';
        }

        if(!is_numeric($this->precio)){
            self::$alertas['error'][] = 'El precio debe ser numerico';
        }

        return self::$alertas;

    }

}