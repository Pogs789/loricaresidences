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
        $default_pic = "";
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

        $register = $conn->prepare("INSERT INTO tenant(lname, fname, mname, complete_address, email, contact_no, gender, profile_picture_link, valid_documents_link) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $register->bind_param('sssssssss', $lastName, $firstName, $middleName, $homeAddress, $email, $contactNumber, $gender, $default_pic, $target_file);
        if($register->execute()){
            $registerCondition = "You successfully Registered your account.";
            
        }else{
            $registerCondition = "An Error Occured during the Registration Process. Please Try Again.";
        }
    }
}

        /*
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
        */