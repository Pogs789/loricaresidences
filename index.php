<?php include "./controller/connector.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lorica Residence Boarding House</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        .warning {
            color: red;
            display: none;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Lorica Residence</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#services">Our Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#locations">Locations Nearby</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#rooms">Our Existing Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#rent">Rent a Bedspace Now</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href = "login.php">Currently Staying?</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="home" class="section">
        <div class="container">
            <h1 class="center-text">Welcome to Lorica Residence Boarding House</h1>
        </div>
    </div>

    <!--Register Modal-->
    <!-- Modal -->
    <div class="modal fade" id="RegisterModal" tabindex="-1" role="dialog" aria-labelledby="RegisterModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="RegisterModalTitle">Be Our Tenant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container mt-5">
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Register New Tenant</button>
            </div>
            </div>
        </div>
    </div>

    <!--Begin Homepage-->
    <div id="about" class="section bg-light">
        <div class="container">
            <h2 class="center-text">About Us</h2>
            <p>Lorica Residence's Bedspace and Transient House is one of the Affordable Rental Bedspacing and Transient House located in the Humble Town of Daraga, Albay.
                Founded in 2024, Lorica Residence allows bedspacers to have a comfortable bed to sleep on as they study or work within the Vicinity of Daraga, Legazpi, and Camalig.
                It saves bedspacers precious time as it shortens the distance from their homes to their workplaces.
            </p>
        </div>
    </div>

    <div id="services" class="section">
        <div class="container">
            <h2 class="center-text">Our Services</h2>
            <p>Details of our services.</p>
        </div>
    </div>

    <div id="locations" class="section bg-light">
        <div class="container">
            <h2 class="center-text">Locations Nearby</h2>
            <p>Bicol University - Daraga. Bicol University - Main Campus, Bicol University - East Campus.</p>
        </div>
    </div>

    <div id="rooms" class="section">
        <div class="container">
            <h2 class="center-text">Our Existing Rooms</h2>
            <div class="row">
                <?php
                $sql = "SELECT * FROM rooms";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $image = str_replace("\\", "/", $row['image_link']);
                        echo "<div class='col-md-4 mb-4'>";
                        echo "<div class='card'>";
                        echo "<img class='card-img-top' src='" . $image . "' alt='Room image'>";
                        echo "<div class='card-body'>";
                        echo "<h5 class='card-title'>Room Number: " . $row['room_no'] . "</h5>";
                        echo "<p class='card-text'>" . $row['description'] . "</p>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo '<p>No rooms available.</p>';
                }
                ?>
            </div>
        </div>
    </div>

    <div id="contact" class="section bg-light">
        <div class="container">
            <h2 class="center-text">Contact Us</h2>
            <p>Contact information.</p>
        </div>
    </div>

    <div id="rent" class="section">
        <div class="container">
            <h2 class="center-text">Rent a Bedspace Now</h2>
            <form action="index.php#rent" method="POST" class="mt-4">
                <div class="form-group">
                    <label for="checkDate">Check Availability Date</label>
                    <input type="date" class="form-control" id="checkDate" name="checkDate" onchange="validateDate()" required>
                    <div id="warningMessage" class="warning" style="display: none;">
                        The date you entered is behind today! Please Select another date.
                    </div>
                </div>
                <button type="submit" name="checkAvailability" class="btn btn-primary">Check Availability</button>
            </form>

            <?php
            if (isset($_POST['checkAvailability'])) {
                $checkDate = $_POST['checkDate'];

                $sql = "SELECT r.room_id, r.room_no, r.description, r.image_link, b.bed_id, b.bed_number, b.daily_rent, b.monthly_rent 
                        FROM rooms r
                        JOIN bed_management b ON r.room_id = b.room_id
                        WHERE b.bed_status = 0";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    echo '<form action="index.php#RegisterModal" method="POST" class="mt-4">';
                    echo '<div class="form-group">';
                    echo '<label for="selectBed">Select Room and Bed</label>';
                    echo '<select class="form-control" id="selectBed" name="selectedBed" required>';
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['bed_id'] . '">Room: ' . $row['room_no'] . ' - Bed: ' . $row['bed_number'] . ' (Daily Rent: ' . $row['daily_rent'] . ', Monthly Rent: ' . $row['monthly_rent'] . ')</option>';
                    }
                    echo '</select>';
                    echo '</div>';
                    echo '<button type="submit" name="rentBedspace" class="btn btn-success" data-toggle="modal" data-target="#RegisterModal">Rent a Room/Bedspace</button>';
                    echo '</form>';
                } else {
                    echo '<p class="mt-4 text-danger">No available rooms or beds found for the selected date.</p>';
                }

                $stmt->close();
            }
            ?>
        </div>
    </div>

    <?php include './layouts/footer.html'; ?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            <?php
            if (isset($_GET['login'])) {
                echo "$('#LoginModal').modal('show');";
            }
            ?>
        });
    </script>
</body>
</html>
