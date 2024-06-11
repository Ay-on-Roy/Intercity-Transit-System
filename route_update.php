<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Update Route Information</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
<?php
require("connection.php");
$route_no= $_POST["update_route_no"];
$query="SELECT * FROM `route` WHERE `Route_no` = '$route_no'";
$info=mysqli_fetch_assoc(mysqli_query($conn, $query));
?>
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-left">
            <div class="sidebar-card d-none d-lg-flex">
                                <img width = 500 length = 500 class="sidebar-card-illustration mb-2" src="img/road.svg" alt="...">
                            </div>


            <div class="col-xl-6 col-lg-12 col-md-9">


                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                            
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"><?php echo "Information of Route no", $route_no ; ?></h1>
                                    </div>
                                    <form class="user" action = "route_update_work.php" method = "post">
                                    <input type="hidden" name="route_no" value= <?php echo $route_no; ?>>
                                        

                                        <div class="form-group">
                                            <input type="date" class="form-control form-control-user" name = "date"
                                                placeholder=<?php echo $info["Date"];?>>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name = "depart"
                                                placeholder=<?php echo $info["Departing_from"];?>>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name = "desti"
                                                placeholder=<?php echo $info["Destination"];?>>
                                        </div>

                                        <div class="form-group">
                                            <input type="time" class="form-control form-control-user" name = "time"
                                                placeholder=<?php echo $info["Pickup_Time"];?>>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name = "fare"
                                                placeholder=<?php echo $info["Fare"];?>>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name = "seats"
                                                placeholder=<?php echo $info["sold_seats"];?>>
                                        </div>

                                    
                                        
                                        
                                        <button type = 'submit' name = 'enter' class="btn btn-primary btn-user btn-block">
                                            Update
                                        </button>
                                        

                                    </form>
                                    
                                </div>
                                <a href="route_home.php"><button href = "route_home.php" class="btn btn-primary btn-user btn-block">
                                            Back
                                        </button></a>    
                               
                    </div>
                </div>

            </div>

            

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>