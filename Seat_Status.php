<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="Seat_Status.css"> -->
    <title>Seat Status</title>
    <style>
        body {
            overflow: hidden; /* Hide scrollbars */
            color: #000;
        }

        .video-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }

        video {
            object-fit: cover;
            width: 100%;
            height: 100%;
        }

        .container {
            position: relative;
            z-index: 1;
            margin-top: 50px;
        }

        .table-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<?php
session_start();
if (isset($_SESSION['DepartingFrom'], $_SESSION['GoingTo'], $_SESSION['Date'], $_SESSION['SeatType'])) {
    $departingFrom = $_SESSION['DepartingFrom'];
    $goingTo = $_SESSION['GoingTo'];
    $date = $_SESSION['Date'];
    $vehicleType = $_SESSION['SeatType'];
} else {
    header("Location: ticket.php");
    exit();
}

require("connection.php");

$sqlRouteInfo = "SELECT r.Route_no, r.Pickup_Time, r.Fare FROM route r 
                 JOIN travels_through t ON r.Route_no = t.Route_no
                 JOIN vehicle v ON t.Vehicle_no = v.Vehicle_no
                 WHERE r.Departing_from = '$departingFrom' AND r.Destination = '$goingTo' AND r.Date = '$date' AND v.Vehicle_type = '$vehicleType'";

$resultRouteInfo = $conn->query($sqlRouteInfo);
?>

<body>
    <div class="video-container">
        <video autoplay loop muted>
            <source src="bg_video.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <div class="container">
        <div class="table-container">
            <h1 class="text-center mb-4">Available Buses</h1>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col"><center>Departing From</center></th>
                        <th scope="col"><center>Going To</center></th>
                        <th scope="col"><center>Date</center></th>
                        <th scope="col"><center>Pickup Time</center></th>
                        <th scope="col"><center>Price</center></th>
                        <th scope="col"><center>Vehicle No</center></th>
                        <th scope="col"><center>Available Seats</center></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($resultRouteInfo->num_rows > 0) {
                        while ($rowRouteInfo = $resultRouteInfo->fetch_assoc()) {
                            $routeNo = $rowRouteInfo['Route_no'];
                            $fare = $rowRouteInfo['Fare'];
                            $pickupTime = $rowRouteInfo['Pickup_Time'];

                            $sqlSeatInfo = "SELECT v.Total_Seat, r.Sold_seats FROM vehicle v 
                                            JOIN travels_through t ON v.Vehicle_no = t.Vehicle_no 
                                            JOIN route r ON t.Route_no = r.Route_no 
                                            WHERE r.Route_no = '$routeNo'";
                            $resultSeatInfo = $conn->query($sqlSeatInfo);

                            if ($resultSeatInfo->num_rows > 0) {
                                $rowSeatInfo = $resultSeatInfo->fetch_assoc();
                                $totalSeats = $rowSeatInfo['Total_Seat'];
                                $soldSeats = $rowSeatInfo['Sold_seats'];

                                $availableSeats = $totalSeats - $soldSeats;
                            } else {
                                $availableSeats = "N/A";
                            }
                            ?>
                            <tr onclick="window.location='customer_info.php?routeNo=<?php echo $routeNo; ?>&fare=<?php echo $fare; ?>&pickupTime=<?php echo $pickupTime; ?>';" style="cursor: pointer;">
                                <td><center><?php echo $departingFrom; ?></center></td>
                                <td><center><?php echo $goingTo; ?></center></td>
                                <td><center><?php echo $date; ?></center></td>
                                <td><center><?php echo $pickupTime; ?></center></td>
                                <td><center><?php echo $fare; ?></center></td>
                                <td><center><?php echo $routeNo; ?></center></td>
                                <td><center><?php echo $availableSeats; ?></center></td>
                            </tr>
                        <?php
                        }
                    } else {
                        header("Location: error.php");
                        exit();
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
