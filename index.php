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
</head>
<body>
    <?php include './layouts/navbar.html'; ?>

    <div id="home" class="section">
        <div class="container">
            <h1 class="center-text">Welcome to Lorica Residence Boarding House</h1>
        </div>
    </div>

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
                    <input type="date" class="form-control" id="checkDate" name="checkDate" required>
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
                    echo '<form action="register.php" method="POST" class="mt-4">';
                    echo '<div class="form-group">';
                    echo '<label for="selectBed">Select Room and Bed</label>';
                    echo '<select class="form-control" id="selectBed" name="selectedBed" required>';
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['bed_id'] . '">Room: ' . $row['room_no'] . ' - Bed: ' . $row['bed_number'] . ' (Daily Rent: ' . $row['daily_rent'] . ', Monthly Rent: ' . $row['monthly_rent'] . ')</option>';
                    }
                    echo '</select>';
                    echo '</div>';
                    echo '<button type="submit" name="rentBedspace" class="btn btn-success">Rent a Room/Bedspace</button>';
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
</body>
</html>
