<?php 
require("connection.php");
$delete_vehicle_no=$_POST['del_vehicle_no'];

$delqry1 = "delete from `travels_through` where `Vehicle_no` = '$delete_vehicle_no'";
$run1 = mysqli_query($conn, $delqry1);
$delqry = "delete from `vehicle` where `Vehicle_no` = '$delete_vehicle_no'";
    $run = mysqli_query($conn, $delqry);


session_start();
$_SESSION['delete']="ok";
header("location: vehicle_home.php");
 ?>