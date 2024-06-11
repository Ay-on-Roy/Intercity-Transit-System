<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="feedback.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,600;1,400;1,800&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
</head>
<?php
require("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["feedback"])) {
        $message = $_POST["feedback"];

        $sql = "INSERT INTO feedback (Message) VALUES ('$message')";

        if ($conn->query($sql) === TRUE) {
            echo '<div class="success-message">Your Feedback Submitted Successfully!</div>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Feedback submission Incomplete.";
    }
}

$conn->close();
?>

<body>

  <div class="container">
    <h1>Connect with Us</h1>
    
    <p>Thank you for reaching out to us. We appreciate your interest in our services and are here to help. 
      <br>Please don't hesitate to send us your feedback
    </p>
    
    <div class="contact-box">
      <div class="contact-left">
        <h3>Send your feedback</h3>
        
        <form method="post" action="feedback.php">
          <div class="input-row">
            <div class="input-group">
              <label for="">Name</label>
              <input name="name" type="text" placeholder="Your name (Not mandatory)">
            </div>

            <div class="input-group">
              <label for="">email</label>
              <input name="email" type="email" placeholder="Your email (Not mandatory)">
            </div>
          </div>
          
          <br />
          <label for="">Message</label>
          <textarea  name="feedback" rows="5" placeholder="Write your feedback here" required></textarea>
          
          <button type="submit">Send</button>
        </form>
        
        <!-- Thank you note -->

      </div>
      
      <!-- 2 different column -->
      <div class="contact-right">
        <h3>Reach us</h3>

        <table>
          <!-- tr=table row -->
          <tr>
            <td>Email:</td>
            <td>intercitytransport@gmail.com</td>
          </tr>
          <!-- 2nd row -->
          <tr>
            <td>Phone:</td>
            <td>+880 1234 567890</td> 
          </tr>
        </table>
      </div>

    </div>

  </div>
</body>
</html>
