<!-- header.php -->
<?php
session_start();
include '../controller/connector.php'; // Include the database connection

// Check if user is logged in (user_id is stored in session)
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to login page or show an error message
    header("Location: ../index.php");
    exit();
}
// Assuming tenant_id is stored in session
$tenantId = $_SESSION['user_id'];

// Fetch tenant information from the database
$sql = "SELECT t.fname, r.room_no, bm.bed_number, ba.due_date, bm.monthly_rent 
FROM bed_assignment ba CROSS JOIN bed_management bm ON ba.bed_id = bm.bed_id CROSS JOIN tenant t ON ba.tenant_id = t.tenant_id CROSS JOIN rooms r ON ba.room_id = r.room_id
WHERE t.tenant_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $tenantId);
$stmt->execute();
$result = $stmt->get_result();
$tenantInfo = $result->fetch_assoc();
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
        <a href="index.php"><h3>Lorica Residences Boarding House</h3></a>
        <a href="index.php"><i class="fa fa-home"></i> Home</a>
        <a href="announcements.php"><i class="fa fa-bullhorn"></i> Announcements</a>
        <a href="payments.php"><i class="fa fa-credit-card"></i> Proof of Payment</a>
        <a href="paymenthistory.php"><i class="fa fa-history"></i> Payment History</a>
        <a href="feedback.php"><i class="fa fa-comment"></i> Feedback</a>
        <div class="profile-section dropdown">
            <a href="#" class="dropdown-toggle" id="profileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Welcome, <?php echo $tenantInfo['fname']; ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="edit_profile.php"><i class="fa fa-user"></i> Edit Profile</a>
                <a class="dropdown-item" href="../login.php"><i class="fa fa-sign-out"></i> Logout</a>
            </div>
        </div>
    </div>
    <div class="content">