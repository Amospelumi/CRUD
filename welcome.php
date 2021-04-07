<?php
// Initialize the session
session_start();
 
// If the user isn't logged in, and he/she claims to have logges in redirect him/her to login page
if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="welcome.css">
    <title>Document</title>
</head>
<body>
<div class="welcome">
    <small> <marquee> Welcome to Apostle Christian Church of God. (Kind follow the following link to know more about us www.apostolicchristian.com)</marquee></small>
</div>
<div class="button4">
        <a href="logout.php"><input type="button" style="float: right; background-color:rgb(12, 12, 163); color:white; padding: 8px 8px; border-radius: 8px; border:none; margin-right:50px; margin-top:20px; width:5em;" value="Logout"></button></a>
        </div>
    <div class="container">
        <div class="button1">
            <a href="tractpagination.php"><input type="button" value="Tracts" style="background-color:red; color:white;box-shadow: 4px 4px 7px black;"></a>
        </div><br>
        <div class="button2">
            <a href="sundayschoolpagination.php"><input type="button"  value="Sunday School" style="background-color:rgb(0, 0, 133); color:white;box-shadow: 4px 4px 7px black;"></a>
        </div><br>
        <div class="button3">
            <a href="biblestudy.php"><input type="button" value="Bible Study" style="background-color:rgb(13, 99, 13); color:white;box-shadow: 4px 4px 7px black;"></a>
        </div><br>
        <div class="button4">
            <a href="cgs.php"><input type="button" value="Christian Gospel Song" style="background-color: rgb(78, 30, 2);color:white;box-shadow: 4px 4px 7px black;"></a>
        </div>
        
    </div>

</body>
</html>