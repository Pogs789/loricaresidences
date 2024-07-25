<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once 'connector.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $_SESSION['error_message'] = "Please fill in both fields.";
        header("Location: ../login.php");
        exit();
    }

    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars(hash("sha256", $_POST['password']));

    $verification = $conn->prepare("SELECT user_id, status FROM user WHERE username = ? AND hashed_password = ?");
    if (!$verification) {
        error_log("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        $_SESSION['error_message'] = "Internal server error.";
        header("Location: ../login.php");
        exit();
    }
    $verification->bind_param('ss', $username, $password);
    $verification->execute();
    $verification->bind_result($user_session, $status);
    $verification->store_result();

    if ($verification->num_rows == 1) {
        $verification->fetch();
        $verification->close();
        if ($status == 1) {
            $_SESSION['user_id'] = $user_session;

            // OTP Generation and Sending
            $stmt = $conn->prepare("SELECT t.email FROM tenant t JOIN user u ON t.tenant_id = u.tenant_id WHERE u.username = ?;");
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $stmt->bind_result($email);
            $stmt->fetch();
            $stmt->close();

            if ($email) {
                require "send_email.php";
                $otp = random_int(100000, 999999);
                $mail_status = sendOTP($email, $otp);

                if ($mail_status) {
                    $stmt2 = $conn->prepare("INSERT INTO otp_verification (otp, is_expired, created_at) VALUES (?, 0, NOW())");
                    $stmt2->bind_param('i', $otp);
                    $stmt2->execute();
                    $stmt2->close();
                    header("Location: ../otp.php");
                    exit();
                } else {
                    $_SESSION['error_message'] = "Failed to send OTP. Please try again.";
                    header("Location: ../login.php");
                    exit();
                }
            } else {
                $_SESSION['error_message'] = "Account does not exist in the system. Please register first.";
                header("Location: ../login.php");
                exit();
            }
        }
        else {
            $_SESSION['error_message'] = "Your account is inactive. Please contact support.";
            header("Location: ../login.php");
            exit();
        }
    } else {
        $_SESSION['error_message'] = "Invalid username or password.";
        header("Location: ../login.php");
        exit();
    }
} else {
    $_SESSION['error_message'] = "An unknown error occurred.";
    header("Location: ../login.php");
    exit();
}