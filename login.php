<!DOCTYPE html>
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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .form-container { transition: transform 0.5s ease-in-out; }
        .swipe-left { transform: translateX(-100%); }
        .swipe-right { transform: translateX(0); }
    </style>
</head>
<body>
    <div class="d-lg-flex half">
        <div class="bg order-1 order-md-2" style="background-image: url('images/Hero-Boarding.jpg');"></div>
        <div class="contents order-2 order-md-1">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-7">
                        <div id="login-form" class="form-container">
                            <div class="mb-4">
                                <h3>Tenant Log In</h3>
                                <p class="mb-4">To Check Your Tenant Information While Staying at Lorica Residence, You Need to Login First.</p>
                            </div>
                            <form action="./controller/authenticate.php" method="post">
                                <div class="form-group first">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username">
                                </div>
                                <div class="form-group last mb-3">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                                <div class="d-flex mb-5 align-items-center">
                                    <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                                    <input type="checkbox"/>
                                    <div class="control__indicator"></div>
                                    </label>
                                    <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span> 
                                </div>
                                <input type="submit" value="Log In" class="btn btn-block btn-primary">
                            </form>
                        </div>
                        <div id="otp-form" class="form-container">
                            <div class="mb-4">
                                <h3>Enter OTP</h3>
                                <p class="mb-4">Please enter the OTP sent to your email.</p>
                            </div>
                            <form action="./controller/verify_otp.php" method="post">
                                <div class="form-group first">
                                    <label for="otp">OTP</label>
                                    <input type="text" class="form-control" id="otp" name="otp">
                                </div>
                                <input type="submit" value="Verify OTP" class="btn btn-block btn-primary">
                            </form>
                        </div>
                        <?php if (!empty($error_message)): ?>
                            <div class="alert alert-danger"><?php echo $error_message; ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        $(document).ready(function() {
            <?php if (isset($_GET['otp']) && $_GET['otp'] == 'required'): ?>
                $('#login-form').addClass('swipe-left');
                $('#otp-form').addClass('swipe-right');
            <?php endif; ?>
        });
    </script>
</body>
</html>
