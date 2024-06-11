<?php  
require("connection.php");
$delete_route_no=$_POST['del_route_no'];
//code

$delqry3 = "delete from `travels_through` where `Route_no` = '$delete_route_no'";
$run3 = mysqli_query($conn, $delqry3);

$delqry2 = "delete from `ticket` where `Route_no` = '$delete_route_no'";
$run2 = mysqli_query($conn, $delqry2);

$delqry = "delete from `route` where `Route_no` = '$delete_route_no'";
$run = mysqli_query($conn, $delqry);
session_start();
$_SESSION['delete']="ok";
header("Location: route_home.php");
?>