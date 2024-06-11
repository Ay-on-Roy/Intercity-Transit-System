<?php  
require("connection.php");
$admin_no=$_POST['admin_remove_employee_no'];

$delqry2 = "delete from `admin` where `E_Phone` = '$admin_no'";
$run2 = mysqli_query($conn, $delqry2);

$delqry = "update `employee` set `Position` = Null where `E_Phone` = '$admin_no'";
$run = mysqli_query($conn, $delqry);


session_start();
$_SESSION['delete']="ok";
header("Location: employee_home.php");


?>