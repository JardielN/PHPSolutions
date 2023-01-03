<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';


// pattern to locate suspect phrases
$pattern = '/[\s\r\n]|Content-Type:|Bcc:|Cc:/i';
// check the submitted email address
$suspect = preg_match($pattern,  $_POST['email']);
if (!$suspect) {
    foreach ($_POST as $key => $value) {
        // strip whitespace from $value if not an array
        if (!is_array($value)) {
            $value = trim($value);
        }
        if (!in_array($key, $expected)) {
            // ignore the value, it's not in $expected
            continue;
        }
        if (in_array($key, $required) && empty($value)) {
            // required value is missing
            $missing[] = $key;
            $$key = "";
            continue;
        }
        $$key = $value;
    }
}
// validate the user's email
if (!$suspect && !empty($email)) {
    $validemail = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    if ($validemail) {
        $headers['Reply-To'] = $validemail;
    } else {
        $errors['email'] = true;
    }
}
$mailSent = false;
// go ahead only if not suspect, all required fields OK, and no errors
if (!$suspect && !$missing && !$errors) {
    // initialize the $message variable
    $message = '';
    // loop through the $expected array
    foreach($expected as $item) {
        // assign the value of the current item to $val
        if (isset($$item) && !empty($$item)) {
            $val = $$item;
        } else {
            // if it has no value, assign 'Not selected'
            $val = 'Not selected';
        }
        // if an array, expand as comma-separated string
        if (is_array($val)) {
            $val = implode(', ', $val);
        }
        // replace underscores in the label with spaces
        $item = str_replace('_', ' ', $item);
        // add label and value to the message body
        $message .= ucfirst($item).": $val\r\n\r\n";
    }
    // limit line length to 70 characters
    $message = wordwrap($message, 70);
    //Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

$titulo = $subject;
//Server settings
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
$mail->isSMTP();                                            //Send using SMTP
$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = 'cesarr13468@gmail.com';                     //SMTP username
$mail->Password   = 'nieowrxuwnpmwbie';                               //SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
$mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

//Recipients
$mail->setFrom('cesarr13468@gmail.com', 'Mailer');
$mail->addAddress($to);     //Add a recipient
//$mail->addAddress('jardielnruiz@gmail.com');               //Name is optiona

//Content
$mail->isHTML(true);                                  //Set email format to HTML
$mail->Subject = $titulo;
$mail->Body    = $message;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
$mail->CharSet = 'UTF-8';

$mail->send();
echo 'Message has been sent';
}
