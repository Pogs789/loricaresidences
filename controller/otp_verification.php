<?php
session_start();
require_once('connector.php');
require_once('mail_function.php');

if (!empty($_SESSION["username"])) {
    $username = $_SESSION["username"];
    $stmt = $conn->prepare("SELECT t.email FROM tenant t JOIN user u ON t.tenant_id = u.tenant_id WHERE u.username = ?;");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->fetch();
    $stmt->close();

    if ($email) {
        $otp = rand(100000, 999999);
        $mail_status = sendOTP($email, $otp);

        if ($mail_status == 1) {
            $stmt2 = $conn->prepare("INSERT INTO otp_verification (otp, is_expired, created_at) VALUES (?, 0, NOW())");
            $stmt2->bind_param('i', $otp);
            $stmt2->execute();
            $stmt2->close();
        } else {
            $_SESSION['error_message'] = "Failed to send OTP. Please try again.";
            header("Location: ../login.php?otp=required");
            exit();
        }
    } else {
        $_SESSION['error_message'] = "Account does not exist in the system. Please register first.";
        header("Location: ../login.php");
        exit();
    }
} else {
    header("Location: ../login.php");
    exit();
}

header("Location: ../login.php?otp=required");
exit();