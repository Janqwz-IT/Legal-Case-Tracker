<?php 
    require_once "db.php";

        //Creating connection
    $con = mysqli_connect($database_host, $database_user, $database_password, $database_name);

        //Checking connection
    if (!$con) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
?>