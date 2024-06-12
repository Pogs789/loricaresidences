<?php include '../layouts/header.php'; // Include the header ?>

<div class="container mt-5">
    <h2>Tenant Dashboard</h2>
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Assigned Bed</h4>
                </div>
                <div class="card-body">
                    <h5>You are Assigned to sleep at bed number <?php echo $tenantInfo['bed_number']; ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Assigned Room</h4>
                </div>
                <div class="card-body">
                    <h5>You are staying at room number <?php echo $tenantInfo['room_no']; ?></h5>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Your Current Balance</h4>
                </div>
                <div class="card-body">
                    <h5>P <?php echo $tenantInfo['monthly_rent']; ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Due Date</h4>
                </div>
                <div class="card-body">
                    <h5><?php echo date("F d Y", strtotime($tenantInfo['due_date'])); ?></h5>
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
