<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Error Declaration</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>
<body  style="background-color: #0776D9;">
<?php
session_start();
if (isset($_SESSION["vehicle_no_exist"])){
    unset($_SESSION["vehicle_no_exist"]);
    ?>
    <div class="modal-dialog" role="document">
            <div class="modal-content">
                
                <div class="modal-body">Vehicle of this number alredy exists.</div>
                <div class="modal-footer">
                    
                    <a class="btn btn-primary" href="vehicle_insertion_page.php">OK</a>
                </div>
            </div>
        </div>
    </div>
    
<?php
}
elseif (isset($_SESSION["vehicle_info_error"])){
    unset($_SESSION["vehicle_info_error"]);
    ?>
    <div class="modal-dialog" role="document">
            <div class="modal-content">
                
                <div class="modal-body">Wrong Vehicle number format.</div>
                <div class="modal-footer">
                    
                    <a class="btn btn-primary" href="vehicle_insertion_page.php">OK</a>
                </div>
            </div>
        </div>
    </div>    
<?php
}
elseif(isset($_SESSION["route_error"])){
    unset($_SESSION["route_error"]);
    ?>
    <div class="modal-dialog" role="document">
            <div class="modal-content">
                
                <div class="modal-body">This Route Number alredy exists.</div>
                <div class="modal-footer">
                    
                    <a class="btn btn-primary" href="route_insertion_page.php">OK</a>
                </div>
            </div>
        </div>
    </div>    
<?php
}elseif (isset($_SESSION["travel_through_error"])) {
    unset($_SESSION["travel_through_error"]);
    ?>
    <div class="modal-dialog" role="document">
            <div class="modal-content">
                
                <div class="modal-body">This Route & Vehicle Combination alredy exists.</div>
                <div class="modal-footer">
                    
                    <a class="btn btn-primary" href="travel_through_insertion_page.php">OK</a>
                </div>
            </div>
        </div>
    </div> 
<?php
}elseif (isset($_SESSION["username_error"])) {
    unset($_SESSION["username_error"]);
    ?>
    <div class="modal-dialog" role="document">
            <div class="modal-content">
                
                <div class="modal-body">This Username is already taken.</div>
                <div class="modal-footer">
                    
                    <a class="btn btn-primary" href="employee_home.php">OK</a>
                </div>
            </div>
        </div>
    </div> 
<?php
}elseif (isset($_SESSION["employee_wrong_phone_no"])) {
    unset($_SESSION["employee_wrong_phone_no"]);
    ?>
    <div class="modal-dialog" role="document">
            <div class="modal-content">
                
                <div class="modal-body">Phone Number is not of 11 digits.</div>
                <div class="modal-footer">
                    
                    <a class="btn btn-primary" href="employee_insertion_page.php">OK</a>
                </div>
            </div>
        </div>
    </div> 
<?php
}elseif (isset($_SESSION["employee_exist_phone_no"])) {
    unset($_SESSION["employee_exist_phone_no"]);
    ?>
    <div class="modal-dialog" role="document">
            <div class="modal-content">
                
                <div class="modal-body">This Phone Number already exists.</div>
                <div class="modal-footer">
                    
                    <a class="btn btn-primary" href="employee_home.php">OK</a>
                </div>
            </div>
        </div>
    </div> 
<?php
}elseif (isset($_SESSION["update_username_pass_error"])) {
    unset($_SESSION["update_username_pass_error"]);
    ?>
    <div class="modal-dialog" role="document">
            <div class="modal-content">
                
                <div class="modal-body">This Username is already taken.</div>
                <div class="modal-footer">
                    
                    <a class="btn btn-primary" href="admin_home.php">OK</a>
                </div>
            </div>
        </div>
    </div> 
<?php
}elseif (isset($_SESSION["login_error"])) {
    unset($_SESSION["login_error"]);
    ?>
    <div class="modal-dialog" role="document">
            <div class="modal-content">
                
                <div class="modal-body">Wrong Username or Password.</div>
                <div class="modal-footer">
                    
                    <a class="btn btn-primary" href="login.php">OK</a>
                </div>
            </div>
        </div>
    </div> 
<?php
}
?>


</body>
</html>