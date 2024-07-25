<?php
session_start();
require_once "connector.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['otp'])) {
        header("Location: ../verify_otp.php?error=empty");
        exit();
    }

    $otp = intval($_POST['otp']);

    $stmt = $conn->prepare("SELECT * FROM otp_verification WHERE otp = ? AND is_expired != 1 AND NOW() <= DATE_ADD(created_at, INTERVAL 24 HOUR)");
    $stmt->bind_param('i', $otp);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt2 = $conn->prepare("UPDATE otp_verification SET is_expired = 1 WHERE otp = ?");
        $stmt2->bind_param('i', $otp);
        $stmt2->execute();
        header("Location: ../tenant/index.php");
        exit();
    } else {
        header("Location: ../verify_otp.php?error=invalid");
        exit();
    }
} else {
    header("Location: ../verify_otp.php?error=unknown");
    exit();
}