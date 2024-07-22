<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php';

function sendOTP($email, $otp){
    require('./vendor/phpmailer/phpmailer/src/class.PHPMailer.php');
    require('./vendor/phpmailer/phpmailer/src/class.SMTP.php');

    $message_body = "Your One-Time Password for your email is: <br></br>" . $otp;
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Port = "SMTP port";
    $mail->Username = "SMTP username";
    $mail->Password = "SMTP password";
    $mail->Host = "SMTP HOST";
    $mail->Mailer = "smtp";
    $mail->SetFrom("loricaresidences@gmail.com", "Cesphillip Lorica, Owner if Lorica Residence");
    $mail->addAddress($email);
    $mail->Subject = "Your OTP to Use the Boarding House System";
    $mail->MsgHTML($message_body);
    $mail->IsHTML(true);
    $result = $mail->send();

    return $result;
}