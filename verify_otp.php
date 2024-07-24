<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Lorica Residences - Verify OTP</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="d-lg-flex half">
        <div class="bg order-1 order-md-2" style="background-image: url('images/Hero-Boarding.jpg');"></div>
        <div class="contents order-2 order-md-1">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-7">
                        <div class="form-container">
                            <div class="mb-4">
                                <h3>Enter OTP</h3>
                                <p class="mb-4">A 6-Digit Verification Code Has Been Sent to Your Email. Verify Your 6-Digit Code.</p>
                            </div>
                            <form action="./controller/verify_otp.php" method="post">
                                <div class="form-group first">
                                    <label for="otp">OTP</label>
                                    <input type="text" class="form-control" id="otp" name="otp">
                                </div>
                                <input type="submit" value="Verify OTP" class="btn btn-block btn-primary">
                            </form>
                            <?php if (isset($_GET['error'])): ?>
                                <div class="alert alert-danger mt-3">
                                    <?php 
                                    switch ($_GET['error']) {
                                        case 'invalid':
                                            echo "The OTP you entered is invalid. Please try again.";
                                            break;
                                        default:
                                            echo "An unknown error occurred.";
                                    }
                                    ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
