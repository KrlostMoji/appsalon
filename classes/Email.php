<?php

namespace Classes;
use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $nombre;
    public $token;

    public function __construct($nombre, $apellido, $email, $token)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->token = $token;

    }

    public function enviarConfirmacion(){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'd35279385d1832';
        $mail->Password = '31a6044e1ef4c8';
        $mail->SMTPSecure = 'tls';

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');
        $mail->Subject = 'Confirma tu cuenta';
        
        //Establece uso de HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p>Hola<strong> " . $this->nombre . " " . $this->apellido .  "</strong>, has abierto una cuenta como nuevo cliente en App Salon, necesitas activar tu registro</p>";
        $contenido .= "<p><a href='http://localhost:3000/confirmar?token=". $this->token ."'>Confirma tu cuenta aquí:</a></p>";
        $contenido .= "<p>Si tú no creaste una nueva cuenta, ignora este mensaje";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        //Enviar el email
        $mail->send();

    }

    public function enviarReestablecimiento(){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'd35279385d1832';
        $mail->Password = '31a6044e1ef4c8';
        $mail->SMTPSecure = 'tls';

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');
        $mail->Subject = 'Reestablece tu password';
        
        //Establece uso de HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p>Hola<strong> " . $this->nombre . " " . $this->apellido .  "</strong>, has solicitado reestablecer tu password.</p>";
        $contenido .= "<p><a href='http://localhost:3000/recovery?token=". $this->token ."'>Reestablece aquí:</a></p>";
        $contenido .= "<p>Si tú no solicitaste este cambio, ignora este mensaje";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        //Enviar el email
        $mail->send();

    }


}

?>