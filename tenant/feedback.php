<!-- feedback.php -->
<?php 
include '../layouts/header.php'; 
include "../controller/connector.php";

$stmt = $conn->prepare("SELECT * FROM feedback WHERE tenant_id = ?");
$stmt->bind_param('i', $tenantId);
$stmt->execute();
if($result = $stmt->get_result()){
?>

<h2>Your Feedback</h2>

<button class = "button" onclick = "displayMessageForm()">Send a New Message</button>
<table class = "table">
    <th>Date of Feedback</th>
    <th>Message</th>
    <th>Owner Reply</th>
    <th>Status</th>
    <th>Action</th>
    <?php
        while($row = $result->fetch_assoc()){
            echo "<td>".$row['feedback_date']."</td>";
            echo "<td>".$row['message']."</td>";
            echo "<td>".$row['owner_reply']."</td>";
            echo "<td>".$row['status']."</td>";
            echo "<td>Edit Icon Goes Here | View Feedback Goes Here</td>";
        }
    }else{
        echo "<p>You Dont have messages sent yet to the owner.</p>";
    }?>
</table>

<script>
    function displayMessageForm(){
        //Display the Form where the user will send a message to the tenant.
        <?php
        $stmt = $conn->prepare("INSERT INTO feedback(tenant_id, message, feedback_date, status) VALUES(?, ?, ?, UNREAD)");
        $stmt->bind_param("iss", $tenantId, $message, $feedback_date);
        /*Change this into a bootstrap popup. */
        if($stmt->execute()){
            echo "Feedback SUccessfully Sent";
        }else{
            echo "An Error Occured while Sending a Message. Please Try Again.";
        }
        ?>
    }
</script>

<?php include '../layouts/tenantfooter.html';?>