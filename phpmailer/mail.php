<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'storerobot14@gmail.com';                     //SMTP username
    $mail->Password   = 'yaraab00';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('storerobot14@gmail.com', 'Ahmed Store');
    $mail->addAddress($user->email);     //Add a recipient
    $mail->addReplyTo('storerobot14@gmail.com');

    $body = '<h1><a href="http://www.ahmedstore.com/change">click here</a> to change your password</h1>';
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Ahmed Store';
    $mail->Body    = $body;
    $mail->AltBody = strip_tags($body);

    if($mail->send()){
        echo "<script>alert('A link is sent to your email to change your password.'); window.location = 'login.php';</script>";
    }

    else {
        echo "<script>alert('The email does not exist')</script>";
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>