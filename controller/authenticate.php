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
        if ($status == 1) {
            $_SESSION['username'] = $username;

            // OTP Generation and Sending
            $stmt = $conn->prepare("SELECT t.email FROM tenant t JOIN user u ON t.tenant_id = u.tenant_id WHERE u.username = ?;");
            if (!$stmt) {
                error_log("Prepare failed: (" . $conn->errno . ") " . $conn->error);
                $_SESSION['error_message'] = "Internal server error.";
                header("Location: ../login.php");
                exit();
            }
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $stmt->bind_result($email);
            $stmt->fetch();
            $stmt->close();

            if ($email) {
                $otp = rand(100000, 999999);
                $subject = "Your One-Time Password to Access Your Tenant Account";
                $message = "Your OTP for the login in this system is:\n<h1>" . $otp . "</h1>";
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: noreply@loricaresidence.com' . "\r\n";

                $mail_status = mail($email, $subject, $message, $headers);
                echo var_dump($mail_status);
                exit();

                if ($mail_status) {
                    $stmt2 = $conn->prepare("INSERT INTO otp_verification (otp, is_expired, created_at) VALUES (?, 0, NOW())");
                    if (!$stmt2) {
                        error_log("Prepare failed: (" . $conn->errno . ") " . $conn->error);
                        $_SESSION['error_message'] = "Internal server error.";
                        header("Location: ../login.php");
                        exit();
                    }
                    $stmt2->bind_param('i', $otp);
                    $stmt2->execute();
                    $stmt2->close();
                    error_log("OTP sent and inserted into database for user: $username");
                    header("Location: ../verify_otp.php");
                    exit();
                } else {
                    $_SESSION['error_message'] = "Failed to send OTP. Please try again.";
                    error_log("Failed to send OTP to email: $email for user: $username");
                    header("Location: ../login.php");
                    exit();
                }
            } else {
                $_SESSION['error_message'] = "Account does not exist in the system. Please register first.";
                error_log("No email found for user: $username");
                header("Location: ../login.php");
                exit();
            }
        } else {
            $_SESSION['error_message'] = "Your account is inactive. Please contact support.";
            error_log("Inactive account for user: $username");
            header("Location: ../login.php");
            exit();
        }
    } else {
        $_SESSION['error_message'] = "Invalid username or password.";
        error_log("Invalid credentials for user: $username");
        header("Location: ../login.php");
        exit();
    }
} else {
    $_SESSION['error_message'] = "An unknown error occurred.";
    error_log("Unknown error occurred during login.");
    header("Location: ../login.php");
    exit();
}