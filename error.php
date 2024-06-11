<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <style>
        body {
            background: url('bg.svg') center/cover no-repeat;
            background-size: cover;
            background-position: auto;
            /* White and background image */
            color: #333; /* Dark text color */
            font-family: Arial, sans-serif; /* Choose a suitable font-family */
            margin: 0; /* Remove default margin */
            padding: 0; /* Remove default padding */
        }

        .error-message {
            text-align: center;
            margin-top: 400px;
            padding: 20px;
            background-color: #ff5252; /* Red color */
            color: #fff; /* White color */
            font-size: 18px;
        }
    </style>
</head>

<body>
    <?php
    echo '<div class="error-message">No Buses Found!</div>';
    header("refresh:2;url=ticket.php");
    exit();
    ?>
</body>

</html>
