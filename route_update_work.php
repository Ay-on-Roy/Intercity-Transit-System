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
$route_no=$_POST['route_no'];
$date=$_POST['date'];
$departure_from=$_POST['depart'];
$destination=$_POST['desti'];
$time=$_POST['time'];
$fare=$_POST['fare'];
$sold_seats=$_POST['seats'];

$query="UPDATE `route` SET `Date` = '$date', `Departing_from` = '$departure_from', `Destination` = '$destination', `Pickup_Time` = '$time', `Fare` = '$fare', `sold_seats` = '$sold_seats' WHERE `route`.`Route_no` = '$route_no'";
$work=mysqli_query($conn, $query);
header("location: route_home.php");
?>
</body>
</html>