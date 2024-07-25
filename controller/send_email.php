<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/phpmailer/PHPMailer/src/Exception.php';
require '../vendor/phpmailer/PHPMailer/src/PHPMailer.php';
require '../vendor/phpmailer/PHPMailer/src/SMTP.php';

function sendOTP($email, $otp) {
    $message_body = "One Time Password for PHP login authentication is:<br/><br/>" . htmlspecialchars($otp);
    try {
        $phpmailer = new PHPMailer(true);
        $phpmailer->isSMTP();
        $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = 'f82fd206fdef95';
        $phpmailer->Password = 'a5383923ddc00a';

        $phpmailer->setFrom("ceslorica15@gmail.com", "Cesphillip Lorica");
        $phpmailer->addAddress($email);
        $phpmailer->Subject = "Tenant Account Login OTP";
        $phpmailer->msgHTML($message_body);
        $phpmailer->isHTML(true);
        $result = $phpmailer->send();

        if ($result == false) {
            throw new Exception($phpmailer->ErrorInfo);
        }

        return $result;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
    }
}

// Usage example (uncomment to test):
// echo sendOTP('test@example.com', 123456) ? 'OTP sent successfully' : 'Failed to send OTP';
