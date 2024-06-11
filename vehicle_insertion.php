<?php
require("connection.php");
session_start();



$vehicle_no=$_POST["vehicle_no"];
$registered_area=$_POST["regi_area"];
$total_seat=$_POST["seat"];
$vehicle_type=$_POST["type"];


$check_sql="select * from `Vehicle` where Vehicle_no='$vehicle_no'";
$check_run=mysqli_query($conn, $check_sql);
if (mysqli_num_rows($check_run)==1){
	$_SESSION["vehicle_no_exist"]="have";
	header("location: error_work.php") ;

}elseif (strlen($vehicle_no)==0 || strlen($vehicle_no)>11) {
	$_SESSION["vehicle_info_error"]="have";
	header("location: error_work.php") ;
}else{
	
	$sql="INSERT INTO `vehicle` (`Vehicle_no`, `Registered_Area`, `Total_Seat`, `Vehicle_type`) VALUES ('$vehicle_no', '$registered_area', '$total_seat', '$vehicle_type')";
	mysqli_query($conn,$sql);
	header("location: vehicle_home.php") ;
	
}

?>
