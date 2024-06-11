<?php
session_start();
include 'connection.php';

$routeNo = $_GET['routeNo'] ?? null;
$fare = $_GET['fare'] ?? null;
$pickupTime = $_GET['pickupTime'] ?? null;

if ($routeNo === null || $fare === null || $pickupTime === null) {
    header("Location: Seat_Status.php");
    exit();
}

function insertPassenger($name, $email, $phoneNo, $address, $conn)
{
    $sql = "INSERT INTO passenger (Name, Email, Phone_no, Address) VALUES ('$name', '$email', '$phoneNo', '$address')";

    if ($conn->query($sql) === TRUE) {
        $pId = $conn->insert_id;
        $_SESSION['P_ID'] = $pId;
        echo '<div class="alert alert-success mt-4" role="alert">Passenger data inserted Successfully!</div>';
    } else {
        echo '<div class="alert alert-danger mt-4" role="alert">Error: ' . $conn->error . '</div>';
    }
}

function insertTicket($price, $pId, $routeNo, $conn)
{
    $sql = "INSERT INTO ticket (Price, P_ID, Route_no) VALUES ('$price', '$pId', '$routeNo')";

    if ($conn->query($sql) === TRUE) {
        echo '<div class="alert alert-success mt-4" role="alert">Ticket data inserted Successfully!</div>';
    } else {
        echo '<div class="alert alert-danger mt-4" role="alert">Error: ' . $conn->error . '</div>';
    }
}

function updateSoldSeats($routeNo, $numOfTickets, $conn)
{
    $sqlSelectSoldSeats = "SELECT sold_seats FROM route WHERE Route_no = '$routeNo'";
    $result = $conn->query($sqlSelectSoldSeats);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $currentSoldSeats = $row['sold_seats'];
        $newSoldSeats = $currentSoldSeats + $numOfTickets;

        $sqlUpdateSoldSeats = "UPDATE route SET sold_seats = '$newSoldSeats' WHERE Route_no = '$routeNo'";
        if ($conn->query($sqlUpdateSoldSeats) === FALSE) {
            echo '<div class="alert alert-danger mt-4" role="alert">Error updating sold seats: ' . $conn->error . '</div>';
        }
    } else {
        echo '<div class="alert alert-danger mt-4" role="alert">Error retrieving sold seats.</div>';
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phoneNo = $_POST["phoneNo"];
    $address = $_POST["address"];

    insertPassenger($name, $email, $phoneNo, $address, $conn);

    $numOfTickets = $_POST['numOfTickets'];
    $_SESSION['numOfTickets'] = $numOfTickets;

    insertTicket($fare, $_SESSION['P_ID'], $routeNo, $conn);
    updateSoldSeats($routeNo, $numOfTickets, $conn);

    header("Location: seat.php?routeNo=" . $routeNo);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="customer_info.css"> -->
    <title>Passenger Information</title>
    <style>
        body {
            overflow: hidden;
        }

        #bg-video {
            position: fixed;
            right: 0;
            bottom: 0;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            z-index: -1;
        }

        .mb-4, .my-4 {
            color: black;
            margin-bottom: 1.5rem!important;
        }

        .bg-light {
            background-color: #ffffffd4!important;
        }

        .header {
            padding: 26px;
            position: fixed;
            top: 0;
            width: 100%;
            /* background-color: #267bd475!important; */
            background-color: rgb(20 65 255 / 73%);
            z-index: 1500;
            color: white;
        }

        .container {
            margin-top: 100px;
            max-width: 500px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-top: 20px;
        }

        label {
            font-weight: bold;
            color: #333;
        }

        textarea {
            height: 100px;
            resize: none;
        }

        button {
            background-color: rgb(20 65 255 / 73%);;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: rgb(20 65 255 / 73%);;
        }

        /* Table styles */
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #28a745;
            color: #fff;
        }

        tr:hover {
            background-color: rgba(40, 167, 69, 0.2);
        }
    </style>
</head>

<body>
    <video id="bg-video" autoplay muted loop>
        <source src="pi_bg.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div class="header">
        <center><h1> Your Information Will Be Confidential!</h1></center>
    </div>


    <div class="container bg-light p-4">
        <h2 class="mb-4">Passenger Information</h2>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"] . '?routeNo=' . $routeNo . '&fare=' . $fare . '&pickupTime=' . $pickupTime; ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="phoneNo">Phone No:</label>
                <input type="text" class="form-control" id="phoneNo" name="phoneNo" required>
            </div>

            <div class="form-group">
                <label for="address">Address:</label>
                <textarea class="form-control" id="address" name="address" required></textarea>
            </div>

            <div class="form-group">
                <label for="numOfTickets">Number of Seats:</label>
                <select class="form-control" id="numOfTickets" name="numOfTickets" required>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success btn-block">Submit</button>
        </form>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
