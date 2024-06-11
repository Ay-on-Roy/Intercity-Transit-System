<?php  
require("connection.php");
$employee_phone = $_POST['phone'];
$updated_email=$_POST['email'];
$updated_name=$_POST['name'];
$updated_position=$_POST['position'];
$updated_address=$_POST['address'];

$update_sql="UPDATE `employee` SET `E_Email` = '$updated_email', `E_Name` = '$updated_name', `Position` = '$updated_position', `E_Address` = '$updated_address' WHERE `employee`.`E_Phone` = '$employee_phone'";

$result_update_info=mysqli_query($conn,$update_sql);

session_start();
$_SESSION['update']="ok";
header("Location: admin_list.php");
?>