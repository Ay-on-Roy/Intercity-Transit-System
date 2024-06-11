<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Payment Information</title>

    <style>
        .success-message {
            text-align: center;
            margin-top: 50px;
            padding: 20px;
            background-color: #28a745;
            color: #fff;
            font-size: 18px;
        }

        .container {
            background-color: #ffffffba;
            font-size: large;
            color: darkblue;
            margin-top: 50px;
            position: relative;
            z-index: 1;
            padding: 20px;
        }

        .title {
            color: #007bff; /* Blue color */
        }

        .inputBox {
            margin-bottom: 20px;
        }

        .submit-btn {
            background-color: #007bff; /* Blue color */
            color: #fff; /* White color */
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .header {
            margin-top: 0px;
            width: 100%;
            position: relative;
            top: 0;
            padding: 32px;
            color: white;
            text-align: center;
            background-color: #007bff;
            font-size: 24px;
            margin-bottom: 55px;
            z-index: 1;
        }

        .col-12 {
            margin-top: 40px;
            -webkit-box-flex: 0;
            -ms-flex: 0 0 100%;
            flex: 0 0 100%;
            max-width: 100%;
        }

        input[name="address"] {
            height: 45px;
        }

        video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.6;
            z-index: 0;
        }
    </style>
</head>

<?php
session_start();
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['seat_numbers'])) {
    $selectedSeats = $_POST['seat_numbers'];
    $sqlAddSeats = "INSERT INTO temp (list) VALUES ('$selectedSeats')";

    if ($conn->query($sqlAddSeats) === TRUE) {
        $response = ['success' => true, 'message' => 'Selected seats added to temp table successfully.'];
    } else {
        $response = ['success' => false, 'message' => 'Error adding selected seats to temp table: ' . $conn->error];
    }
    exit(); 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST["name"]) ? $_POST["name"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $address = isset($_POST["address"]) ? $_POST["address"] : "";
    $paymentMethod = isset($_POST["payment_method"]) ? $_POST["payment_method"] : "";
    $sqlUpdateTicket = "UPDATE ticket SET Payment_Type = '$paymentMethod' ORDER BY Ticket_no DESC LIMIT 1";

    if ($conn->query($sqlUpdateTicket) === TRUE) {
        echo '<div class="success-message">Payment Received Successfully!</div>';
        header("refresh:2;url=get_ticket.php");
    } else {
        echo "Error updating ticket: " . $conn->error;
    }
}

$sql = "SELECT * FROM passenger ORDER BY P_ID DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row["Name"];
    $email = $row["Email"];
    $address = $row["Address"];
} else {
    $name = "";
    $email = "";
    $address = "";
}
?>

<body>
    <video autoplay loop muted>
        <source src="pay.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div class="container">
        <div class="header">
            Billing Gateway
        </div>
        <form method="post" class="row">
            <div class="col">
                <h3 class="title">Billing address</h3>

                <div class="inputBox">
                    <span>Name :</span>
                    <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                </div>
                <div class="inputBox">
                    <span>Email :</span>
                    <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                </div>
                <div class="inputBox">
                    <span>Address :</span>
                    <input type="text" name="address" placeholder="City" class="form-control" value="<?php echo $address; ?>">
                </div>
            </div>

            <div class="col">
                <h3 class="title">Payment</h3>

                <div class="inputBox">
                    <span>Payment Method :</span>
                    <select name="payment_method" class="form-control">
                        <option value="Card">Card</option>
                        <option value="Bkash">Bkash</option>
                        <option value="Nagad">Nagad</option>
                    </select>
                </div>

                <div class="inputBox">
                    <span>Name on card :</span>
                    <input type="text" name="card_name" class="form-control">
                </div>
                <div class="inputBox">
                    <span>Promo Code :</span>
                    <input type="text" name="Promo Code" class="form-control">
                </div>
                <div class="inputBox">
                    <span>Card or Bkash Number :</span>
                    <input type="numeric" name="card_number" placeholder="111-222-333-444 or 01234567890"
                        class="form-control">
                </div>
            </div>

            <div class="col-12 text-center">
                <input type="submit" value="Get Your Ticket" class="submit-btn btn btn-primary">;
            </div>
            
        </form>
    </div>
</body>

</html>
