<?php

/*After the user verifies their login credentials into the system, the latter will send a 6-Digit random number to the provided text. */
session_start();
$success = "";
$error_message = "";

require_once('connector.php');

if(!empty($_SESSION["email"])){
    $username_id = $_SESSION["email"];
    $stmt = $conn->prepare("");
    $stmt->bind_param('s', $username_id);
    $stmt->execute();

    if($stmt->num_rows() > 0){
        $otp = rand(100000, 999999);

        require_once("mail_function.php");
        $mail_status = sendOTP($_SESSION["email"], $otp);

        if($mail_status == 1){
            $stmt2 = $conn->prepare("INSERT INTO otp_verfication(otp, is_expired, created_at) VALUES(?, 0, NOW())");
            $stmt2->bind_param('i', $otp);
            $stmt2->execute();
            if(!empty($stmt2->insert_id)){
                $success = 1;
            }
            $stmt2->close();
        }
    }else{
        $error_message = "Account Does not Exist in the System. Please Register First.";
    }

    $stmt->close();
}

if(!empty($_POST["submit_otp"])){
    $stmt = $conn->prepare("SELECT * FROM otp_verification WHERE otp = ? AND is_expired != 1 AND NOW() <= DATE_ADD(created_at, INTERVAL 24 HOUR)");
    $stmt->bind_param('i', $_POST["submit_otp"]);
    $stmt->execute();
    if(!empty($stmt->num_rows() > 0)){
        $stmt2 = $conn->prepare("UPDATE otp_verification SET is_expired = 1 WHERE otp = ?");
        $stmt2->bind_param('i', $_POST["submit_otp"]);
        $stmt2->execute();
        $success = 2;
    }else{
        $success = 1;
        $error_message = "The OTP You Entered is Invalid. Please Try Again.";
    }
}