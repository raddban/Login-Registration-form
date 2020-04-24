<?php


namespace Mail\Core;


use PHPMailer\PHPMailer\PHPMailer;

class Mail
{

    public static function send()
    {
        $mail = new PHPMailer;

        $mail->SMTPDebug = 3;                               // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = '';                 // SMTP username
        $mail->Password = '';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        $mail->setFrom('akotikovs7@gmail.com', 'Arturs');
        $mail->addAddress($_POST['email'], $_POST['name']);     // Add a recipient
        $mail->addReplyTo('akotikovs7@gmail.com');

        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Body    = $_POST['text'];

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            header('location:/email');
        }
    }
}