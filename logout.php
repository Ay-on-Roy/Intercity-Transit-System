<?php
require("connection.php");
session_start();
unset($_SESSION['Username']);
header("location: login.php");
?>