<!DOCTYPE html>
<html lang="en">
<head>
  <!-- font link -->
  
  <link rel="stylesheet" href="home.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,600;1,400;1,800&display=swap" rel="stylesheet">
  
  <title>Home</title>

 
</head>
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
  
    <div class="hero">
    <div class="banner">
      <div class="left-column">
        <h1>INTERCITY TRANSIT <span> SYSTEM</span></h1>
        <h3>Discover Bangladesh<span> with us</span></h3>
        <p>
            Discover the delight of reaching your destination with us – more than a travel service, we're your dedicated companions. Your journey is our priority, ensuring every moment is filled with comfort, safety, and warm hospitality. Trust us for an extraordinary travel experience. Safe travels await!
        </p>
        <div class="btn">
          <button type="button" class="book-btn">
            <h2><?php ?></h2>
            <a href="ticket.php" class="1">Book Now</a>
          </button>
        </div>
      </div>


      <div class="right-column"> 
        <img src="bus2.jpg" alt="">
      </div>
      

    </div>
  </div>
  
  <!-- Newsletter Section -->
  <div class="newsletter">
    <h2>Subscribe to Our Newsletter</h2>
    <p>Stay updated on our latest offers and travel news. Enter your email below:</p>
    <form action="#" method="post">
        <input type="email" name="email" placeholder="Enter your email" required>
        <button type="submit">Subscribe</button>
    </form>
  </div>
</body>
</html>