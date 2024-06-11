<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Intercity Transport Ticket</title>
    <style>
        body {
            background: url('bg.jpeg') no-repeat center center fixed;
            background-size: cover;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.8); /* Adding a semi-transparent white background for better readability */
            padding: 20px;
            border-radius: 10px;
            margin-top: 50px;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.8); /* Adding a semi-transparent white background for better readability */
        }

        .card-header {
            background-color: #007bff;
            color: white;
            text-align: center;
        }

        .card-footer {
            background-color: rgba(255, 255, 255, 0.8); /* Adding a semi-transparent white background for better readability */
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="container mt-4">
        <?php
        require("connection.php");

        // Fetch details from the last row of the passenger table
        $sqlPassenger = "SELECT P_ID, Name, Phone_no FROM passenger ORDER BY P_ID DESC LIMIT 1";
        $resultPassenger = $conn->query($sqlPassenger);

        if ($resultPassenger->num_rows > 0) {
            $rowPassenger = $resultPassenger->fetch_assoc();
            $pId = $rowPassenger['P_ID'];
            $name = $rowPassenger['Name'];
            $phoneNo = $rowPassenger['Phone_no'];

            // Fetch Price, Route_no from the last row of the ticket table based on P_ID
            $sqlTicket = "SELECT Price, Route_no FROM ticket WHERE P_ID = '$pId' ORDER BY Ticket_no DESC LIMIT 1";
            $resultTicket = $conn->query($sqlTicket);

            if ($resultTicket->num_rows > 0) {
                $rowTicket = $resultTicket->fetch_assoc();
                $price = $rowTicket['Price']*2;
                $routeNo = $rowTicket['Route_no'];

                // Fetch Date, Departing_from, Destination from the route table based on Route_no
                $sqlRoute = "SELECT Date, Departing_from, Destination, Pickup_Time FROM route WHERE Route_no = '$routeNo'";
                $resultRoute = $conn->query($sqlRoute);

                if ($resultRoute->num_rows > 0) {
                    $rowRoute = $resultRoute->fetch_assoc();
                    $date = $rowRoute['Date'];
                    $departingFrom = $rowRoute['Departing_from'];
                    $destination = $rowRoute['Destination'];
                    $pickupTime = $rowRoute['Pickup_Time'];

                    // Fetch the Seat Number from the last row of the temp table's list column
                    $sqlSeatNumber = "SELECT list FROM temp ORDER BY id DESC LIMIT 1";
                    $resultSeatNumber = $conn->query($sqlSeatNumber);

                    if ($resultSeatNumber->num_rows > 0) {
                        $rowSeatNumber = $resultSeatNumber->fetch_assoc();
                        $seatNumber = $rowSeatNumber['list'];

                        // Display the ticket details with Seat Number
                        echo "<div class='card'>";
                        echo "<div class='card-header'>";
                        echo "<h2 class='card-title'>Intercity Transport Ticket</h2>";
                        echo "</div>";
                        echo "<div class='card-body'>";
                        echo "<p class='card-text'>Seat Number: $seatNumber</p>";
                        echo "<p class='card-text'>Traveling Date: $date</p>";
                        echo "<p class='card-text'>Traveling Time: $pickupTime</p>";
                        echo "<p class='card-text'>Name: $name</p>";
                        echo "<p class='card-text'>Phone Number: $phoneNo</p>";
                        echo "<p class='card-text'>Departing From: $departingFrom</p>";
                        echo "<p class='card-text'>Destination: $destination</p>";
                        echo "<p class='card-text'><h3>Fare: $price</h3></p>";
                        echo "</div>";
                    } else {
                        echo "Error fetching seat number: " . $conn->error;
                    }
                } else {
                    echo "Error fetching route details: " . $conn->error;
                }
            } else {
                echo "Error fetching ticket details: " . $conn->error;
            }
        } else {
            echo "Error fetching passenger details: " . $conn->error;
        }
        $conn->close();
        ?>
        <div class="card-footer">
            <a href="home.php" class="btn btn-primary">Home</a>
            </br>
            </br>
            <a href="javascript:void(0);" onclick="printTicket()" class="btn btn-secondary">Print</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        function printTicket() {
            var printWindow = window.open('', '_blank');
            printWindow.document.write('<html><head><title>Print Ticket</title>');
            printWindow.document.write('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">');
            printWindow.document.write('</head><body>');
            printWindow.document.write(document.querySelector('.card').outerHTML);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    </script>
</body>

</html>
