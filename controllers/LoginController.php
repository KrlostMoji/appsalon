<?php 

namespace Controller;

use Classes\Email;
use Model\Cliente;
use MVC\Router;

class LoginController {
    public static function login(Router $router){
        $alertas = [];
        $auth = new Cliente;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Cliente($_POST);
            $alertas = $auth->validarLogin();
    
            if(empty($alertas)){
                //Comprobar si el usuario existe
                $usuario = Cliente::where('email', $auth->email);

                if($usuario){
                    //Verificar password y si está confirmada la cuenta
                    if($usuario->comprobarPasswordVerificacion($auth->password)){
                        
                        if(!isset($_SESSION)){
                            session_start();
                        }
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre_completo'] = $usuario->nombre . " " . $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;
                        
                        if($usuario->admin){
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            header('Location: /admin');
                        } else {
                            header('Location: /citas');
                        }
                        
                        

                    } else {
                        $alertas = Cliente::getAlertas();
                    }
                    

                } else {
                    Cliente::setAlerta('error', 'Usuario no encontrado, necesitas crear una cuenta para accesar.');
                    $alertas = Cliente::getAlertas();
                }
                
            }

        }

        $router->render('auth/login', [
            'alertas' => $alertas,
            'auth' => $auth
        ]);

    }

    public static function logout(){
        session_start();

        $_SESSION = [];

        header('Location: /');
        
    }

    public static function forgot(Router $router){        
        
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Cliente($_POST);
            $alertas = $auth->validarEmail();

            if(empty($alertas)){
                $usuario = Cliente::where('email', $auth->email);
                if($usuario && $usuario->confirmado === '1'){
                    $usuario->crearToken();
                    $usuario->guardar();

                    //Enviar email con el token
                    $email = new Email($usuario->nombre, $usuario->apellido, $usuario->email, $usuario->token);
                    $email->enviarReestablecimiento();

                    //Mensaje exitoso
                    Cliente::setAlerta('exito', 'Se te han enviado las instrucciones a tu correo para reestablecer tu password');

                } else {
                    if(!$usuario){
                        Cliente::setAlerta('error', 'El correo electrónico no se encuentra registrado');
                    } else {
                        if($usuario->confirmado === '0'){
                            Cliente::setAlerta('error', 'El correo electrónico no se ha confirmado');
                        }
                    }
                    
                }

            }

        }
        $alertas = Cliente::getAlertas();

        $router->render('auth/forgot', [
            'alertas' => $alertas
        ]);

    }
    
    public static function recovery(Router $router){
        $alertas = [];
        $error = false;
        $token = s($_GET['token']);
        $usuario = Cliente::where('token', $token); 
        if(is_null($usuario)){
            Cliente::setAlerta('error', 'Token no válido');
            $error = true;
            $alertas = Cliente::getAlertas();    
        }
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $newPassword = new Cliente($_POST);
            $alertas = $newPassword->validarPassword();
            if(empty($alertas)){
                $usuario->password = null;
                $usuario->password = $newPassword->password;
                $usuario->hashPassword();
                $usuario->token = null;
                $resultado = $usuario->guardar();
                if($resultado){
                    header('Location: /');
                }
                
            }
        }

        
        $router->render('auth/reestablecer', [
            'alertas' => $alertas,
            'error' => $error
        ]);
        
    }

    public static function crear(Router $router){
        
        $usuario = new Cliente;
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarUsuario();

            //Sin errores
            if(empty($alertas)){
                //Verificar registro del usuario 
                $resultado = $usuario->existeUsuario();

                if($resultado->num_rows){
                    $alertas = Cliente::getAlertas();

                } else {
                    //Hashear pass
                    $usuario->hashPassword();
                    
                    //Validar cuenta con Token por email
                    $usuario->crearToken();
                    
                    //Enviar email con el token
                    $email = new Email($usuario->nombre, $usuario->apellido, $usuario->email, $usuario->token);
                    $email->enviarConfirmacion();
                    $resultado = $usuario->guardar();

                    if($resultado){
                        header('Location: /mensaje');
                    }  else  {

                    }

                }

            }
        
        }
        
        $router->render('auth/crear', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
        
    }


    public static function confirmar(Router $router){
        $alertas = [];
        $token = s($_GET['token']);

        $usuario = Cliente::where('token', $token);
        
        if(empty($usuario)){
            //Mensaje de error
            Cliente::setAlerta('error', 'El token no es válido');

        } else {
            //Confirmar el registro del usuario
            $usuario->confirmado='1';
            $usuario->token = null;
            $usuario->guardar();
            Cliente::setAlerta('exito', 'Tu cuenta ha sido activada');

        }

        $alertas = Cliente::getAlertas();
        $router->render('auth/confirmar-cuenta', [
            'alertas' => $alertas
        ]);

    }

    public static function mensaje(Router $router){
        $router->render('auth/mensaje', [

        ]);

    }


}