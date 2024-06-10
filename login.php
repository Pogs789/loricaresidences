<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = hash('sha256', $_POST['password']);

    $data = json_encode(['username' => $username, 'password' => $password]);
    $options = [
        'http' => [
            'header'  => "Content-Type: application/json\r\n",
            'method'  => 'POST',
            'content' => $data,
        ],
    ];
    $context = stream_context_create($options);
    $result = file_get_contents('http://localhost/loricaresidences/login', false, $context);

    if ($result === FALSE) {
        echo "<div class='alert alert-danger text-center'>There was an error processing your request. Please try again.</div>";
    } else {
        $response = json_decode($result, true);
        if (isset($response['status']) && $response['status'] == 'success') {
            echo "<div class='alert alert-success text-center'>Successfully Logged in</div>";
            header("Location: home.php");
            exit();
        } else {
            echo "<div class='alert alert-danger text-center'>Incorrect Username or Password.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Lorica Residence Boarding House | LOGIN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <?php include "./layouts/navbar.html"; ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center">Login</h2>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
            </div>
        </div>
    </div>
    <?php include "./layouts/footer.html"; ?>
</body>
</html>
