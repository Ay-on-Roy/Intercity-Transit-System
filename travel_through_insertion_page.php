<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Route Insertion</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="sidebar-card d-none d-lg-flex">
                                <img width = 300 length = 300 class="sidebar-card-illustration mb-2" src="img/bus.svg" alt="...">
                                <img width = 300 length = 300 class="sidebar-card-illustration mb-2" src="img/road.svg" alt="...">
                                
                            </div>


            <div class="col-xl-6 col-lg-12 col-md-9">


                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                            
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Select Route & Vehicle</h1>
                                    </div>
                                    <form class="user" action = "travel_through_insertion.php" method = "post">
                                        <div class="form-group">
                                            <p>Select Route</p>
                                            <center>
                                            <select type="text" name = "route_no" placeholder="Enter Route Number">
                                                <?php
                                                require("connection.php");
                                                $sql="SELECT * FROM `route`";
                                                $run=mysqli_query($conn, $sql);
                                                while($row=mysqli_fetch_assoc($run)){
                                                    ?>
                                                    <option value=<?php echo $row["Route_no"]; ?>><?php echo $row["Departing_from"]," to ",$row["Destination"],
                                                    " on ",$row["Date"], " at ",$row["Pickup_Time"] ;?></option>
                                                
                                                <?php
                                                }
                                                ?>

                                            </select><br>
                                            </center>
                                        </div>

                                        <div class="form-group">
                                        <p>Select Vehicle</p>
                                            <center>
                                            <select type="text"  name = "vehicle_no" placeholder="Enter Vehicle Number">
                                                <?php
                                                require("connection.php");
                                                $sql="SELECT * FROM `vehicle`";
                                                $run=mysqli_query($conn, $sql);
                                                while($row=mysqli_fetch_assoc($run)){
                                                    ?>
                                                    <option value=<?php echo $row["Vehicle_no"]; ?>><?php echo $row["Vehicle_no"]," registered at ",$row["Registered_Area"],
                                                    " having ",$row["Total_Seat"]," Seats";?></option>
                                                
                                                <?php
                                                }
                                                ?>

                                            </select><br>
                                            </center>
                                        </div>
                                        <button type = 'submit' name = 'enter' class="btn btn-primary btn-user btn-block">
                                            Enter
                                        </button>

                                    </form>
                                    
                                </div>
                                <a href="travel_through.php"><button class="btn btn-primary btn-user btn-block">
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