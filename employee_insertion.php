<?php
require("connection.php");
$new_employee_email=$_POST['email'];
$new_employee_name=$_POST['name'];
$new_employee_phone=$_POST['phone'];
$new_employee_position=$_POST['position'];
$new_employee_address=$_POST['address'];

$pleg_sql="SELECT * FROM `employee` WHERE `E_Phone` LIKE '$new_employee_phone'";
$pleg=mysqli_query($conn,$pleg_sql);
$check=mysqli_num_rows($pleg)==0;
session_start();

if (strlen($new_employee_phone)==11 && $check) {
	$sql="INSERT INTO `employee` (`E_Email`, `E_Phone`, `E_Name`, `Position`, `E_Address`) VALUES ('$new_employee_email', '$new_employee_phone','$new_employee_name', '$new_employee_position', '$new_employee_address')";
	$result_entry=mysqli_query($conn, $sql);
	header("Location: employee_home.php");

}elseif (strlen($new_employee_phone)!=11) {
	$_SESSION["employee_wrong_phone_no"]="have";
	header("Location: error_work.php");

}else{
	$_SESSION["employee_exist_phone_no"]="have";
	header("Location: error_work.php");
}
?> 