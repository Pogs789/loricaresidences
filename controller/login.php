<?php
session_start();
require_once "connector.php";
$username = "";
$password = "";
$user_session = $count = 0;
$failed_attempts = 0;
$status = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        header("Location: ../index.php?login=failed&reason=empty");
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
        if ($status == 0) { // Assuming 0 means active and 1 means inactive
            $_SESSION['user_id'] = $user_session;
            header("Location: ../index.php?login=success");
            exit();
        } else {
            header("Location: ../index.php?login=failed&reason=inactive");
            exit();
        }
    } else {
        header("Location: ../index.php?login=failed&reason=invalid");
        exit();
    }
} else {
    header("Location: ../index.php?login=failed&reason=unknown");
    exit();
}