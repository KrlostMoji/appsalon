<?php 

namespace Model;

class Cliente extends ActiveRecord {
    protected static $tabla = "clientes";
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono', 'password',  'email', 'confirmado', 'admin', 'token'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;
    public $password;
    public $email;
    public $confirmado;
    public $admin;
    public $token;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;        
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
        $this->admin = $args['admin'] ?? 0;
        $this->token = $args['token'] ?? '';
    }

    //Validación
    public function validarUsuario(){
        if(!$this->nombre){
            self::$alertas['error'][] = "Proporciona tu nombre";
        }
        if(!$this->apellido){
            self::$alertas['error'][] = "Proporciona tus apellidos";
        }
        if(!$this->email){
            self::$alertas['error'][] = "Se requiere un correo electrónico";
        }
        if(!$this->telefono){
            self::$alertas['error'][] = "Se requiere un número de teléfono";
        }
        if(!$this->password){
            self::$alertas['error'][] = "Debes crear un password de acceso";
        }
        if(strlen($this->password) < 8){
            self::$alertas['error'][] = "El password debe contener al menos 8 carácteres";
        }

        return self::$alertas;

    }

    public function validarLogin()
    {   
        if(!$this->email){
            self::$alertas ['error'][] = 'Introduce tu correo electrónico';
        }
        if(!$this->password){
            self::$alertas ['error'][] = 'Introduce tu password';
        }

        return self::$alertas;

    }

    public function existeUsuario(){
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";

        $resultado = self::$db->query($query);
        if($resultado->num_rows){
            self::$alertas['error'][] = 'El correo electrónico ya está asociado a un cliente registrado';
        }

        return $resultado;

    }

    public function hashPassword(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken(){
        $this->token = uniqid();
    }


    public function comprobarPasswordVerificacion($password){
        $resultado = password_verify($password, $this->password);
        if(!$resultado || ($this->confirmado === '0')){
            if(!$resultado){
                self::$alertas['error'][] = 'El password es incorrecto';
            }
            if($this->confirmado === '0'){
                self::$alertas['error'][] = 'Necesitas confirmar tu cuenta';
            }

        } else {
            return true;
        }

    }

    public function validarEmail()
    {
        if(!$this->email){
            self::$alertas ['error'][] = 'Introduce tu correo electrónico';
        }

        return self::$alertas;
    }

    public function validarPassword(){
        if(!$this->password){
            self::$alertas['error'][] = "Debes introducir un password de acceso";
        }
        if(strlen($this->password) < 8){
            self::$alertas['error'][] = "El password debe contener al menos 8 carácteres";
        }

        return self::$alertas;

    }

}