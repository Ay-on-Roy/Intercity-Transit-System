<?php
require("connection.php");
$admin_username=$_POST['username'];
$admin_password=$_POST['pass'];
$admin_phone=$_POST['phone'];
echo $admin_phone;

$pleg_sql="select * from `admin` where `Username` LIKE '$admin_username'";
$pleg=mysqli_query($conn,$pleg_sql);
$check=mysqli_num_rows($pleg)==0;
session_start();
echo $admin_phone;
if ($check) {
	$sql="insert into `admin` (`Username`, `Password`, `E_Phone`) VALUES ('$admin_username', '$admin_password','$admin_phone')";
	$result_entry=mysqli_query($conn, $sql);
	$delqry = "update `employee` set `Position` = 'Admin' where `E_Phone` = '$admin_phone'";
	$run = mysqli_query($conn, $delqry);
	header("Location: admin_list.php");

}else{
	$_SESSION["username_error"]="have";
	header("Location: error_work.php");
}

  ?> 