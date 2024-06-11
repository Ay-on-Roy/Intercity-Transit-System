

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="faq.css">    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,600;1,400;1,800&display=swap" rel="stylesheet">
    <title>Help</title>

</head>
<?php
require("connection.php"); // Change the path accordingly
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Your PHP logic here
}
$conn->close();
?>
<body>
    <nav>
      <ul>
          <li><a href="home.php">Home</a></li>
          <li><a href="ticket.php">Ticket</a></li>
          <li><a href="faq.php">FAQ</a></li>
          <li><a href="feedback.php">Feedback</a></li>
          <li><a href="login.php">Admin Login</a></li>
   
        <li><?php 
          if (!isset($_SESSION)){
            session_start();
          }
          if (isset($_SESSION['cid'])){
            echo $_SESSION['cid'];
          }
          else if (isset($_SESSION['aid'])){
            echo $_SESSION['aid'];
        }
        ?></li>
      </ul>
    </nav>
    <div class="container">
        
        <h1>Frequently Asked Questions</h1>
   
        <div class='tab'>
            <input type="radio" name="acc" id="1">
            <label for="1">
                <h2>01</h2>
                <h3>How can I book a bus ticket on your website?</h3>
            </label>
            <div class="content"><p>You can book a bus ticket on our website by selecting the "ticket" tab and entering your travel dates and destination.
                 You can then choose from available buses and enter your passenger information and payment to complete the booking process.</p></div>
        </div>

        <div class='tab'>
            <input type="radio" name="acc" id="2">
            <label for="2">
                <h2>02</h2>
                <h3>Can I change or cancel my bus reservation?</h3>
            </label>
            <div class="content"><p>Yes, you can make changes or cancel your reservation depending on our policies. Contact our customer support for assistance.</p></div>
        </div>

        <div class='tab'>
            <input type="radio" name="acc" id="3">
            <label for="3">
                <h2>03</h2>
                <h3>How can I find information about bus schedules?</h3>
            </label>
            <div class="content"><p> Bus schedules are available on our website. Enter your departure and arrival locations, along with your travel dates, to view the available bus options and their respective schedules.</p></div>
        </div>

        <div class='tab'>
            <input type="radio" name="acc" id="4">
            <label for="4">
                <h2>04</h2>
                <h3>What payment methods are accepted?</h3>
            </label>
            <div class="content"><p>We accept various payment methods, including credit cards, debit cards, and online payment platforms. Check the payment options during the booking process.</p></div>
        </div>
        
        <div class='tab'>
            <input type="radio" name="acc" id="5">
            <label for="5">
                <h2>05</h2>
                <h3>What if my bus is delayed or cancelled?</h3>
            </label>
            <div class="content"><p>If your bus is delayed or cancelled,
                 we will make every effort to notify you as soon as possible and provide you with options for rebooking or receiving a refund.</p></div>
        </div>           
    </div>
</body>
</html>