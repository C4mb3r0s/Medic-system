<?php
//Token
$Token = uniqid();
session_start();
$_SESSION['token'] = $Token;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = '';                     //SMTP username
    $mail->Password   = '';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('', '');
    
    $email = $_SESSION['Email'];
    $full_name = $_SESSION['Nombre'];
    $mail->addAddress( $email, $full_name);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Verificación de acceso';
    $mail->Body    = '<!DOCTYPE html>
                        <html lang="en">
                        <head>
                            <meta charset="UTF-8">
                            <meta http-equiv="X-UA-Compatible" content="IE=edge">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <title>Correo</title>
                            <link href="css/bootstrap.min.css" rel="stylesheet">
                            <link href="css/font-awesome.min.css" rel="stylesheet">    
                            <style>
                            * {
                                margin: 0;
                                padding: 0;
                                box-sizing: border-box;
                            }
                              body{
                                background-color: white;
                            }
                            .container .forms_conatiner .token {
                                position: absolute;
                                align-content: center;
                            }
                            h2{
                                position: absolute;
                                align-content: center;
                                top: 240px;
                                left: 473px; 
                                color: black;
                                font-weight: 500;   
                            }
                        </style>
                        </head>
                        <body>
                            <div class="container">
                                <div class="forms-container">
                                    <div class="token">
                                        <h2 class="subtitle" style="font-family: poppins, sans-serif;">Tú código de verificación es: '.$Token.'</h2>
                                    </div>
                                </div>
                            </div>
                        </body>
                        </html>';
                        
    $mail->CharSet = 'UTF-8';
    $mail->send();
    
    echo '<script language="javascript"> alert("Correo envido con exitó"); window.location.href="../verificacion_token.php";</script>';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
