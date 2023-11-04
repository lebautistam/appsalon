<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token) {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarEmail () {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = 'c047170c1664ca';
        $mail->Password = '530de895707471';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 2525;
        $mail->setFrom('cuentas@appsalon.com');

        // Configurar el destinatario
        $mail->addAddress($this->email, $this->email);
        // Configurar el asunto
        $mail->Subject = "Confirmar cuenta App Salón";
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        // Configurar el cuerpo del mensaje
        $mail->Body = "<p><strong>Saludos ".ucfirst($this->nombre)."</strong></p>
                       <p>Te informamos que para confirmar tu cuenta debes dar click en el siguiente enlace</p>
                       <p><a href='http://localhost/AppSalon_PHP_MVC_JS_SASS/confirmar-cuenta?token={$this->token}'>Click aquí</a></p>
                       <p>Si no solicitaste esta cuenta, hacer caso omiso.</p>";

        // Imprimir un mensaje de éxito
        if ($mail->send()) {
            return true;
        }

        return false;
    }

    public function enviarInstrucciones() {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = 'c047170c1664ca';
        $mail->Password = '530de895707471';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 2525;
        $mail->setFrom('cuentas@appsalon.com');

        // Configurar el destinatario
        $mail->addAddress($this->email, $this->email);
        // Configurar el asunto
        $mail->Subject = "Restablece tu contraseña";
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        // Configurar el cuerpo del mensaje
        $mail->Body = "<html>
                       <p><strong>Saludos ".ucfirst($this->nombre)."</strong></p>
                       <p>Has soliticado cambiar tu contraseña dirigite al siguiente enlace</p>
                       <p><a href='http://localhost/AppSalon_PHP_MVC_JS_SASS/recuperar?token={$this->token}'>Click aquí</a></p>
                       <p>Si no solicitaste este cambio, hacer caso omiso.</p>
                       </html>";

        // Imprimir un mensaje de éxito
        if ($mail->send()) {
            return true;
        }

        return $mail->ErrorInfo;
    }
}