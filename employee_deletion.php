<?php  
require("connection.php");
$delete_no=$_POST['del_employee_no'];

$delqry2 = "delete from `admin` where `E_Phone` = '$delete_no'";
$run2 = mysqli_query($conn, $delqry2);

$delqry = "delete from `employee` where `E_Phone` = '$delete_no'";
$run = mysqli_query($conn, $delqry);


session_start();
$_SESSION['delete']="ok";
header("Location: employee_home.php");


?>