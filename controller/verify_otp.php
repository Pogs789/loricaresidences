<?php
session_start();
require_once('connector.php');

if (!empty($_POST["otp"])) {
    $otp = htmlspecialchars($_POST["otp"]);
    $stmt = $conn->prepare("SELECT * FROM otp_verification WHERE otp = ? AND is_expired = 0 AND NOW() <= DATE_ADD(created_at, INTERVAL 24 HOUR)");
    $stmt->bind_param('i', $otp);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt2 = $conn->prepare("UPDATE otp_verification SET is_expired = 1 WHERE otp = ?");
        $stmt2->bind_param('i', $otp);
        $stmt2->execute();
        $stmt2->close();
        header("Location: ../tenant/dashboard.php");
        exit();
    } else {
        $_SESSION['error_message'] = "The OTP you entered is invalid. Please try again.";
        header("Location: ../login.php?otp=required");
        exit();
    }
} else {
    $_SESSION['error_message'] = "Please enter the OTP.";
    header("Location: ../login.php?otp=required");
    exit();
}