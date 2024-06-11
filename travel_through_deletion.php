<?php
require("connection.php");
$delete_route=$_POST['route_no'];
$delete_vehicle=$_POST['vehicle_no'];

$query = "DELETE FROM `travels_through` WHERE `travels_through`.`Route_no` ='$delete_route' and `travels_through`.`Vehicle_no`= '$delete_vehicle'";
$result = mysqli_query($conn,$query);

session_start();
$_SESSION['delete']="ok";
header("Location: travel_through.php");
?>