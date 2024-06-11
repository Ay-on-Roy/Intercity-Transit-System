<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Home Page</title>

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
$a=1;
if ($a==1){
    ?>
    <div class="modal-dialog" role="document">
            <div class="modal-content">
                
                <div class="modal-body">error message</div>
                <div class="modal-footer">
                    
                    <a class="btn btn-primary" href="login.html">OK</a>
                </div>
            </div>
        </div>
    </div>

<?php
}
else{
    ?>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                
            <div class="modal-body">anothererror message</div>
                <div class="modal-footer">
                    
                    <a class="btn btn-primary" href="login.html">OK</a>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>

</body>
</html>