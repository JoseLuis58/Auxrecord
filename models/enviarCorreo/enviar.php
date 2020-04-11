<?php

$dni = $_POST['dni-reg'];
$user = $_POST['usuario-reg'];
$password = $dni;
$correo = $_POST['email-reg'];

require "exception.php";
require "PHPMailer.php";
require "SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'AuxRecord2020@gmail.com';                     // SMTP username
    $mail->Password   = 'Jx6y2Uf7jtHaJQm';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('AuxRecord2020@gmail.com', 'AuxRecord');
    $mail->addAddress(''.$correo.'', ''.$user.'');     // Add a recipient
    $mail->addReplyTo('info@example.com', 'Information');
    
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Correo creado';
    $mail->Body    = 'Su correo a sido satisfactoriamente creado, sus datos de cuenta son Usuario: '.$user.'
     Y contraseña: '.$password.'</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo'<script> alert("El mensaje se ha enviado correctamente"); </script>';
    
} catch (Exception $e) {
    echo "mensaje no enviado el error es:{$mail->ErrorInfo}";
}