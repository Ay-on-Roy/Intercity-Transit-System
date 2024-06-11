<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
<?php
require("connection.php");
$vehicle_no=$_POST['vehicle_no'];
$regi_area=$_POST['area'];
$seat=$_POST['seat'];
$type=$_POST['type'];
echo $vehicle_no;
echo $regi_area;
echo $seat;
echo $type;
$query="UPDATE `vehicle` SET `Registered_Area` = '$regi_area', `Total_Seat` = '$seat', `Vehicle_type` = '$type' WHERE `vehicle`.`Vehicle_no` = '$vehicle_no'";
$work=mysqli_query($conn, $query);
header("location: vehicle_home.php");
?>
</body>
</html>