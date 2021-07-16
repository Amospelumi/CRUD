<?php 
//connecting to database
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "";
$con = mysqli_connect($host, $user, $pass, $dbname);

//checking connection
if($con === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
