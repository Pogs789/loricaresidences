<?php
session_start();
include '../controller/connector.php'; // Include the database connection
include '../layouts/header.php'; // Include the header

// Assuming tenant_id is stored in session
$tenantId = $_SESSION['tenant_id'];

// Fetch tenant information from the database
$sql = "SELECT 
            u.firstName, u.lastName, 
            bm.bed_no, bm.room_id, 
            r.room_no, 
            tp.total_payables, 
            tp.months_paid 
        FROM users u
        JOIN bed_management bm ON u.id = bm.tenant_id
        JOIN rooms r ON bm.room_id = r.room_id
        LEFT JOIN tenant_payables tp ON u.id = tp.tenant_id
        WHERE u.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $tenantId);
$stmt->execute();
$result = $stmt->get_result();
$tenantInfo = $result->fetch_assoc();

?>

<div class="container mt-5">
    <h2>Tenant Dashboard</h2>
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Assigned Bed</h4>
                </div>
                <div class="card-body">
                    <p>Bed Number: <?php echo $tenantInfo['bed_no']; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Assigned Room</h4>
                </div>
                <div class="card-body">
                    <p>Room Number: <?php echo $tenantInfo['room_no']; ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Payables</h4>
                </div>
                <div class="card-body">
                    <p>Total Payables: <?php echo $tenantInfo['total_payables']; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Months Paid</h4>
                </div>
                <div class="card-body">
                    <p>Months Paid: <?php echo $tenantInfo['months_paid']; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../layouts/tenantfooter.html'; // Include the footer ?>

<?php
$stmt->close();
$conn->close();
?>
