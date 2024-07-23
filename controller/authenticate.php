<?php
session_start();
require_once "connector.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        header("Location: ../login.php?login=failed&reason=empty");
        exit();
    }
    
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars(hash("sha256", $_POST['password']));

    $verification = $conn->prepare("SELECT user_id, status FROM user WHERE username = ? AND hashed_password = ?;");
    $verification->bind_param('ss', $username, $password);
    $verification->execute();
    $verification->bind_result($user_session, $status);
    $verification->store_result();
    
    if ($verification->num_rows == 1) {
        $verification->fetch();
        if ($status == 1) {
            $_SESSION['username'] = $username;
            header("Location: ../otp_verification.php");
            exit();
        } else {
            header("Location: ../login.php?login=failed&reason=inactive");
            exit();
        }
    } else {
        header("Location: ../login.php?login=failed&reason=invalid");
        exit();
    }
} else {
    header("Location: ../login.php?login=failed&reason=unknown");
    exit();
}