<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';



//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

$titulo = 'Titulo creado con una variable';
//Server settings
$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
$mail->isSMTP();                                            //Send using SMTP
$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = 'cesarr13468@gmail.com';                     //SMTP username
$mail->Password   = 'nieowrxuwnpmwbie';                               //SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
$mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

//Recipients
$mail->setFrom('cesarr13468@gmail.com', 'Japan Journey');
$mail->addAddress('jardielnruiz@gmail.com', 'Jardiel Ruiz');     //Add a recipient
$mail->addAddress('jardielnruiz@gmail.com');               //Name is optiona


//Content
$mail->isHTML(true);                                  //Set email format to HTML
$mail->Subject = $titulo;
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

$mail->send();
echo 'Message has been sent';