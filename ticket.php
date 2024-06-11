<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Ticket Search</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('bg.svg');
            background-size: cover;
            background-position: auto;
            color: #fff;
        }

        .jumbotron {
            background-color: rgba(0, 0, 0, 0.7); /* Adjust the transparency as needed */
            padding: 30px;
        }

        .search-container {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            margin-top: 50px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .success-message {
            text-align: center;
            margin-top: 20px;
            padding: 15px;
            background-color: #28a745;
            color: #fff;
            font-size: 18px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        label {
            font-weight: bold;
            color: black;
        }
    </style>
</head>

<?php
session_start();

require("connection.php");
$sqlDeparting = "SELECT DISTINCT Departing_from FROM route";
$resultDeparting = $conn->query($sqlDeparting);

if ($resultDeparting->num_rows > 0) {
    $departingOptions = "";
    while ($rowDeparting = $resultDeparting->fetch_assoc()) {
        $departingOptions .= "<option value='" . $rowDeparting['Departing_from'] . "'>" . $rowDeparting['Departing_from'] . "</option>";
    }
} else {
    $departingOptions = "<option value=''>No departing locations available</option>";
}

$sqlGoingTo = "SELECT DISTINCT Destination FROM route";
$resultGoingTo = $conn->query($sqlGoingTo);
if ($resultGoingTo->num_rows > 0) {
    $goingToOptions = "";
    while ($rowGoingTo = $resultGoingTo->fetch_assoc()) {
        $goingToOptions .= "<option value='" . $rowGoingTo['Destination'] . "'>" . $rowGoingTo['Destination'] . "</option>";
    }
} else {
    $goingToOptions = "<option value=''>No destination locations available</option>";
}

$sqlDate = "SELECT DISTINCT Date FROM route";
$resultDate = $conn->query($sqlDate);
if ($resultDate->num_rows > 0) {
    $dateOptions = "";
    while ($rowDate = $resultDate->fetch_assoc()) {
        $dateOptions .= "<option value='" . $rowDate['Date'] . "'>" . $rowDate['Date'] . "</option>";
    }
} else {
    $dateOptions = "<option value=''>No available dates</option>";
}

$sqlSeatType = "SELECT DISTINCT Vehicle_type FROM vehicle";
$resultSeatType = $conn->query($sqlSeatType);
if ($resultSeatType->num_rows > 0) {
    $seatTypeOptions = "";
    while ($rowSeatType = $resultSeatType->fetch_assoc()) {
        $seatTypeOptions .= "<option value='" . $rowSeatType['Vehicle_type'] . "'>" . $rowSeatType['Vehicle_type'] . "</option>";
    }
} else {
    $seatTypeOptions = "<option value=''>No seat types available</option>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $departingFrom = $_POST['departing-from'];
    $goingTo = $_POST['going-to'];
    $date = $_POST['date'];
    $vehicleType = $_POST['seat-type'];

    $_SESSION['DepartingFrom'] = $departingFrom;
    $_SESSION['GoingTo'] = $goingTo;
    $_SESSION['Date'] = $date;
    $_SESSION['SeatType'] = $vehicleType;

    echo '<div class="success-message">Searching...</div>';
    header("refresh:2;url=Seat_Status.php");
    exit();
}
?>

<body>
    <div class="jumbotron text-white">
        <h1 class="display-4 text-center">Bus Ticket Search</h1>
        <p class="lead text-center">Find available buses for your journey</p>
    </div>

    <div class="container search-container">
        <form class="search-form" method="post" action="">
            <div class="form-group">
                <label for="departing-from">Departing From:</label>
                <select class="form-control" id="departing-from" name="departing-from" required>
                    <?php echo $departingOptions; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="going-to">Going To:</label>
                <select class="form-control" id="going-to" name="going-to" required>
                    <?php echo $goingToOptions; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>

            <div class="form-group">
                <label for="seat-type">Vehicle Type:</label>
                <select class="form-control" id="seat-type" name="seat-type">
                    <?php echo $seatTypeOptions; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Search</button>
        </form>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
