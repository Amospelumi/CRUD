<?php
// Initialize the session
session_start();
 
// If the user isn't logged in, and he/she claims to have logges in redirect him/her to login page
if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

 
require('dbconnection.php');
 
$id = null;
 
if(!empty($_GET['id'])){
    $id = $_REQUEST['id'];
}
 
if(null == $id){
    header("Location: welcome.php");
}else{
    $sql = "SELECT * FROM cgs WHERE cgs_no=".$id;
    $query = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($query);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Crud Demo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="tractread.css">
</head>
<body>
<div class="container" style="margin-top:20px;">
<div id="data">
    <div class="button">
    <?php echo '<a href="cgsupdate.php?id='.$row['cgs_no'].'">'?><button type="button" style="background-color:green; color:white; padding: 8px 8px; border-radius: 8px; border:none;">Edit</button></a>
        <a href="cgs.php"><button type="button" style="float: right; background-color:rgb(12, 12, 163); color:white; padding: 8px 8px; border-radius: 8px; border:none;">Back</button></a>
    </div><br>
        <div class="main">
            <div class="content">
        <p>Id : <strong><?php echo $row['cgs_no']; ?></strong></p>
        <p>Title : <strong><?php echo $row['title']; ?></strong></p>
        </div>
        <p>Lyrics : <strong><?php echo $row['lyrics']; ?></strong></p>
        <p>Langauge : <strong><?php echo $row['lang']; ?></strong></p>
    </div>
</div>
</body>
</html>
