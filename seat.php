<?php
session_start();
include 'connection.php';

$routeNo = $_GET['routeNo'] ?? null;

if ($routeNo === null) {
    header("Location: Seat_Status.php");
    exit();
}

$sqlSelectSoldSeats = "SELECT sold_seats FROM route WHERE Route_no = '$routeNo'";
$result = $conn->query($sqlSelectSoldSeats);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $soldSeats = $row['sold_seats'];
} else {
    $soldSeats = 0;
}

// Set a default value for $totalSeatsPerRow
$totalSeatsPerRow = 5;

$numOfTickets = $_SESSION['numOfTickets'] ?? 0;
$soldSeats = $soldSeats - $numOfTickets;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Bus Seating</title>
    <style>
        body {
            background-image: url('bg.svg');
            background-size: cover;
            background-position: auto;
            font-family: Arial, sans-serif;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        h1 {
            font-family: cursive;
            padding: 40px;
            position: inherit;
            background-color: #1775c8b8;
            text-align: center;
            color: white;
            margin-top: 0px;
            margin-bottom: 50px;
        }

        .seat {
            height: 30px;
            width: 30px;
            border: 1px solid gray;
            cursor: pointer;
            background-color: white;
            text-align: center;
            line-height: 30px;
        }

        .walk {
            width: 30px;
        }

        #driver {
            background-color: gray;
            height: 30px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .highlighted {
            background-color: rgb(20 65 255 / 73%) !important;
        }

        .selected {
            background-color: rgb(20 65 255 / 73%) !important;
        }

        .bus-container {
            background-color: #8fc4f299;;
            background-blend-mode: color-burn;
            border: 1px solid gray;
            width: 249px;
            margin: 77px auto;
            padding: 3px;
        }

        table {
            margin: 10px auto;
        }

        #makePaymentBtn {
            background-color: blue;
            color: white;
            padding: 10px;
            border: 2px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }

        #makePaymentBtnContainer {
            text-align: center;
        }
    </style>
</head>

<body>

    <h1>Select your seat</h1>

    <div class="bus-container">
        <table>
            <tr>
                <td colspan="<?php echo $totalSeatsPerRow; ?>"></td>
            </tr>
            <?php
            $seatNumber = 1;
            $i=1;
            for ($row = 1; $row <= 9; $row++) {
                echo '<tr>';
                for ($col = 1; $col <= $totalSeatsPerRow; $col++) {
                    if ($col === $totalSeatsPerRow) {
                        echo '<td align="right"><div id="driver"></div></td>';
                    } else {
                        $seatNumber = ($row - 1) * $totalSeatsPerRow + $col;
                        $isSold = $seatNumber <= $soldSeats;
                        $isSelected = $seatNumber <= $numOfTickets;
                        $seatClass = $isSold ? 'seat highlighted' : 'seat';
                        $seatClass .= $isSelected ? ' selected' : '';

                        if ($col === 3) {
                            echo '<td class="walk"></td>';
                        }
                        
                        echo '<td><div class="' . $seatClass . '">' . $i . '</div></td>';
                        $i=$i+1;
                    }
                }
                echo '</tr>';
            }
            ?>
        </table>
    </div>

    <div id="makePaymentBtnContainer">
        <button id="makePaymentBtn" onclick="makePayment()">Make Payment</button>
    </div>

    <script>
        var selectedSeats = [];

        function updateSeatSelection(seat) {
            var bgclr = seat.style.backgroundColor;
            if (bgclr == 'red') {
                seat.style.backgroundColor = 'white';
                var index = selectedSeats.indexOf(seat.textContent);
                if (index !== -1) {
                    selectedSeats.splice(index, 1);
                }
            } else {
                seat.style.backgroundColor = 'red';
                selectedSeats.push(seat.textContent);
            }
        }

        function seatClickHandler() {
            var isSold = this.classList.contains('highlighted');
            var isSelected = this.classList.contains('selected');

            if (!isSold) {
                if (isSelected) {
                    this.classList.remove('selected');
                    var index = selectedSeats.indexOf(this.textContent);
                    if (index !== -1) {
                        selectedSeats.splice(index, 1);
                    }
                } else if (selectedSeats.length < <?php echo $numOfTickets; ?>) {
                    this.classList.add('selected');
                    selectedSeats.push(this.textContent);
                }
            }
        }

        function makePayment() {
            // Ensure there are selected seats before proceeding
            if (selectedSeats.length > 0) {
                // Prepare the data to be sent to the server
                var formData = new FormData();
                formData.append('seat_numbers', selectedSeats.join(', '));

                // Use fetch or XMLHttpRequest to send the data to the server
                fetch('payment.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Server response:', data);
                        // You can handle the server response as needed
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                window.location.href = 'payment.php';
            }
        }

        var allSeats = document.querySelectorAll('.seat');
        for (var i = 0; i < allSeats.length; i++) {
            allSeats[i].addEventListener('click', seatClickHandler, false);
        }
    </script>
</body>

</html>
