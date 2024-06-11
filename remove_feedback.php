<?php 
require("connection.php");
$id=$_POST['feedback_id'];

$delqry = "delete from `feedback` where `Feedback_id` = '$id'";
$run = mysqli_query($conn, $delqry);

session_start();
$_SESSION['delete']="ok";
header("location: feedback_admin.php");
 ?>