<!-- header.php -->
<?php
/*
session_start();
if($_ISSET['user_id']){
    header("./login.php");
    exit();
}

// Set timeout duration (60 minutes)
$timeout_duration = 7200;

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit();
}

$_SESSION['last_activity'] = time();
*/
?>
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Panel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="sidebar">
        <div class="profile-section dropdown">
            <a href="#" class="dropdown-toggle" id="profileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Welcome, User
            </a>
            <div class="dropdown-menu" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="edit_profile.php"><i class="fa fa-user"></i> Edit Profile</a>
                <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
            </div>
        </div>
        <a href="index.php"><i class="fa fa-home"></i> Home</a>
        <a href="announcements.php"><i class="fa fa-bullhorn"></i> Announcements</a>
        <a href="payments.php"><i class="fa fa-credit-card"></i> Proof of Payment</a>
        <a href="paymenthistory.php"><i class="fa fa-history"></i> Payment History</a>
        <a href="feedback.php"><i class="fa fa-comment"></i> Feedback</a>
    </div>
    <div class="content">
