<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Lorica Residence Boarding House | REGISTER</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <?php include "./layouts/navbar.html"; ?>

    <div class="container mt-5">
        <h2>Register</h2>
        <form action="register.php" method="POST" enctype="multipart/form-data" class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" required>
                </div>
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" required>
                </div>
                <div class="form-group">
                    <label for="middleName">Middle Name</label>
                    <input type="text" class="form-control" id="middleName" name="middleName" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="others">Others</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="homeAddress">Home Address</label>
                    <input type="text" class="form-control" id="homeAddress" name="homeAddress" required>
                </div>
                <div class="form-group">
                    <label for="contactNumber">Contact Number</label>
                    <input type="text" class="form-control" id="contactNumber" name="contactNumber" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="document">Upload Valid Documents (PDF)</label>
                    <input type="file" class="form-control-file" id="document" name="document" accept="application/pdf" required>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </form>
    </div>

    <?php include "./layouts/footer.html"; ?>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Validate form inputs
    if (
        isset($_POST['lastName']) && isset($_POST['firstName']) && isset($_POST['middleName']) &&
        isset($_POST['homeAddress']) && isset($_POST['email']) && isset($_POST['contactNumber']) &&
        isset($_POST['gender']) && isset($_POST['username']) && isset($_POST['password']) &&
        isset($_FILES['document'])
    ) {
        $lastName = $_POST['lastName'];
        $firstName = $_POST['firstName'];
        $middleName = $_POST['middleName'];
        $homeAddress = $_POST['homeAddress'];
        $email = $_POST['email'];
        $contactNumber = $_POST['contactNumber'];
        $gender = $_POST['gender'];
        $username = $_POST['username'];
        $password = hash('sha256', $_POST['password']);
        
        // Handle file upload
        $target_dir = "C:/Users/loric/OneDrive/Documents/3rd year/2nd Sem/Event Driven Programming/Lorica Residences Rental Management System/Tenant/Documents/";
        $target_file = $target_dir . basename($_FILES["document"]["name"]);
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        // Check if file is a PDF
        if ($fileType != "pdf") {
            echo "Sorry, only PDF files are allowed.";
            $uploadOk = 0;
        }

        // Data to be sent to the C# API
        $data = [
            'lastName' => $lastName,
            'firstName' => $firstName,
            'middleName' => $middleName,
            'homeAddress' => $homeAddress,
            'email' => $email,
            'contactNumber' => $contactNumber,
            'gender' => $gender,
            'username' => $username,
            'password' => $password,
            'documentPath' => $target_file
        ];

        // API URL
        $apiUrl = "http://localhost:8080/loricaresidence/api/register";

        // Initialize cURL session
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        // Execute cURL request and get the response
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // Close cURL session
        curl_close($ch);

        // Check the response
        if ($httpcode == 200) {
            echo "Registration successful! You can now login to your new account. Enjoy your stay at our residence.";
            header("Location: login.php");
            exit();
        } else {
            echo $response;
        }
    } else {
        echo "Error: Missing required form data.";
    }
}
?>
