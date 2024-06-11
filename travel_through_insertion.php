<?php
require("connection.php");
session_start();
$new_vehi=$_POST['vehicle_no'];
$new_route=$_POST['route_no'];
$pleg="SELECT * FROM `travels_through` WHERE `Vehicle_no` LIKE '$new_vehi' AND `Route_no` LIKE '$new_route'";
$pleg_result=mysqli_query($conn,$pleg);
$check=mysqli_num_rows($pleg_result)==0;

$query="INSERT INTO `travels_through` (`Vehicle_no`, `Route_no`) VALUES ('$new_vehi', '$new_route')";
if ($check) {
	$result=mysqli_query($conn,$query);
	header("Location: travel_through.php");
}else{
	$_SESSION["travel_through_error"]="have";
	header("Location: error_work.php");
}

?>