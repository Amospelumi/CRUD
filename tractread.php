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
    $sql = "SELECT * FROM tracts WHERE id=".$id;
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
<div class="container"> 
    <div id="data">
    <div class="button">
    <?php echo '<a href="tractupdate.php?id='.$row['id'].'">'?><button type="button" style="background-color:green; color:white; padding: 8px 8px; border-radius: 8px; border:none;">Edit</button></a>
        <a href="tractpagination.php"><button type="button" style="float: right; background-color:rgb(12, 12, 163); color:white; padding: 8px 8px; border-radius: 8px; border:none;">Back</button></a>
    </div><br>
        <div class="main">
            <div class="content">
                <p><b>Id : <strong><?php echo $row['id']; ?></strong></b></p>
                <p><b>Number : <strong><?php echo $row['no']; ?></strong></b></p>
                <p><b>Title : </b><strong><?php echo $row['title']; ?></strong></p>
            </div>
            <p style="font-size: 20px;"><b><u>Content:</u></b><?php echo $row['content']; ?>
            
        
        </div>
    </div>
</div>
</body>
</html>
