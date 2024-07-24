<?php
session_start();
require_once "connector.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        header("Location: ../login.php?error=empty");
        exit();
    }

    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars(hash("sha256", $_POST['password']));

    $verification = $conn->prepare("SELECT user_id, status FROM user WHERE username = ? AND hashed_password = ?");
    $verification->bind_param('ss', $username, $password);
    $verification->execute();
    $verification->bind_result($user_session, $status);
    $verification->store_result();

    if ($verification->num_rows == 1) {
        $verification->fetch();
        if ($status == 1) {
            $_SESSION['username'] = $username;
            header("Location: ../verify_otp.php");
            exit();
        } else {
            header("Location: ../login.php?error=inactive");
            exit();
        }
    } else {
        header("Location: ../login.php?error=invalid");
        exit();
    }
} else {
    header("Location: ../login.php?error=unknown");
    exit();
}