<?php
require("connection.php");
session_start();
$prev_user=$_POST['prev_user'];
$username=$_POST['user'];
$password=$_POST['pass'];

if ($prev_user == $username){
    $query1 = "UPDATE `admin` SET  `Password` = '$password' WHERE `admin`.`Username` = '$prev_user'";
    $done1=mysqli_query($conn,$query1);
    $_SESSION["Username"]=$username;
    header("location: admin_home.php");
}
else if ($prev_user != $username){
    $query2 = "SELECT * from `admin` WHERE `admin`.`Username` = '$username'";
    $done2=mysqli_query($conn,$query2);

    if (mysqli_num_rows($done2)==1){
        $_SESSION["update_username_pass_error"]="have";
        header("location: error_work.php");
        
    }
    else {
        $query="UPDATE `admin` SET `Username` = '$username', `Password` = '$password' WHERE `admin`.`Username` = '$prev_user'";
        $done=mysqli_query($conn,$query);
        $_SESSION["Username"]=$username;
        header("location: admin_home.php");
        
    }
}

?>