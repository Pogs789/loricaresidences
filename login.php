<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $url = "http://localhost/loricaresidences/api/login/";
    $data = array(
        'Username' => $username,
        'Password' => $password
    );

    $options = array(
        'http' => array(
            'header'  => "Content-Type: application/json\r\n",
            'method'  => 'POST',
            'content' => json_encode($data),
        ),
    );
    $context  = stream_context_create($options);
    $result = @file_get_contents($url, false, $context);

    if ($result === FALSE) {
        $error = "Unable to contact API.";
    } else {
        $response = json_decode($result, true);

        if ($response['status'] == 'success') {
            $_SESSION['username'] = $username;
            header("Location: tenant/index.php");
            exit();
        } else {
            $error = $response['message'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Lorica Residence Boarding House | LOGIN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <?php include "./layouts/navbar.html"; ?>

    <div class="container mt-5">
        <h2>Login</h2>
        <?php if (isset($error)) { echo '<div class="alert alert-danger">' . $error . '</div>'; } ?>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>

    <?php include "./layouts/footer.html"; ?>
</body>
</html>
