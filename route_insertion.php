<?php 
require("connection.php");
$new_route_no=$_POST['route_no'];
$new_date=$_POST['date'];
$new_departing=$_POST['depart_from'];
$new_destination=$_POST['desti'];
$new_time=$_POST['time'];
$new_fare=$_POST['fare'];
$new_sold_seats=0;

session_start();

$pleg_sql="SELECT * FROM `route` WHERE `Route_no` LIKE '$new_route_no'";
$pleg_result=mysqli_query($conn,$pleg_sql);
$check=(mysqli_num_rows($pleg_result)>0);


$sql="INSERT INTO `route` (`Route_no`, `Date`, `Departing_from`, `Destination`, `Pickup_Time`, `Fare`,`sold_seats`) VALUES ('$new_route_no', '$new_date', '$new_departing', '$new_destination', '$new_time', '$new_fare','$new_sold_seats')";
if (!$check) {
	$execute=mysqli_query($conn,$sql);
	header("Location: route_home.php");
}else{
	$_SESSION["route_error"]="have";
	header("Location: error_work.php");

}

?>