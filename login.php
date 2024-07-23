<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Lorica Residences - Login</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="fonts/icomoon/style.css">
        <link rel="stylesheet" href="css/owl.carousel.min.css">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- Style -->
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        
        <!-- Login Modal -->
        <div class="modal fade" id="LoginModal" tabindex="-1" role="dialog" aria-labelledby="LoginModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="LoginModalTitle">Login to Access Your Tenant Account</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container mt-5">
                            <?php
                            if (isset($_GET['login'])) {
                                if ($_GET['login'] == 'success') {
                                    echo '<div class="alert alert-success">Login successful! Please Wait.</div>';
                                } elseif ($_GET['login'] == 'failed') {
                                    $reason = isset($_GET['reason']) ? $_GET['reason'] : 'unknown';
                                    switch ($reason) {
                                        case 'empty':
                                            $message = 'Username and password cannot be empty.';
                                            header("Location: index.php");
                                            break;
                                        case 'inactive':
                                            $message = 'Your account is inactive.';
                                            header("Location: index.php");
                                            break;
                                        case 'invalid':
                                            $message = 'Invalid username or password.';
                                            header("Location: index.php");
                                            break;
                                        default:
                                            $message = 'An unknown error occurred.';
                                            header("Location: index.php");
                                    }
                                    echo '<div class="alert alert-danger">' . $message . '</div>';
                                }
                            }
                            ?>
                            <div class="text-center">
                                <img src="./images/4170019.jpg" alt="Blank" class="image-center" width="250" height="250">
                            </div>
                            <form action="./controller/login.php" method="POST">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>