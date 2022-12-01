<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'assets/vendor/PHPMailer/PHPMailer/src/Exception.php';
require 'assets/vendor/PHPMailer/PHPMailer/src/PHPMailer.php';
require 'assets/vendor/PHPMailer/PHPMailer/src/SMTP.php';

require 'assets/vendor/autoload.php';

require_once 'Test.php';

$mdp = new Test();
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'hugo.lop2304@gmail.com';                     //SMTP username
    $mail->Password   = $mdp->getmdp();                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('hugo.lop2304@gmail.com', 'Support');
    $mail->addAddress($_POST['email'], $_POST['name']);     //Add a recipient
    //$mail->addAddress('ellen@example.com');               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $_POST['subject'];
    $mail->Body    = 'Bonjour,<br><br>Nous avons bien reçu votre mail. <br>Vous serez contacté dans les plus brefs délais. <br> Nous vous remercions pour l\'intérêt que vous portez a mon site. <br><br><br> Bien cordialement, <br><br> Hugo Lopes.';
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


