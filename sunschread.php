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
    $sql = "SELECT * FROM sunsch WHERE id=".$id;
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
    <?php echo '<a href="sunschupdate.php?id='.$row['id'].'">'?><button type="button" style="background-color:green; color:white; padding: 8px 8px; border-radius: 8px; border:none;">Edit</button></a>
        <a href="sundayschoolpagination.php"><button type="button" style="float: right; background-color:rgb(12, 12, 163); color:white; padding: 8px 8px; border-radius: 8px; border:none;">Back</button></a>
    </div><br>
        <div class="main">
                <div class="content">
            <p>Id : <strong><?php echo $row['id']; ?></strong></p>
            <p>Lesson Number : <strong><?php echo $row['title']; ?></strong></p>
            <p>Class : <strong><?php echo $row['bref']; ?></strong></p>
            <p>Title : <strong><?php echo $row['lessno']; ?></strong></p>
            <p>Text : <strong><?php echo $row['classv']; ?></strong></p>
            </div>
            <p>Memory Verse : <strong><?php echo $row['mverse']; ?></strong></p>
            <p>Intro : <strong><?php echo $row['notes']; ?></strong></p>
            <p>Items : <strong><?php echo $row['ques']; ?></strong></p>
            <p>Conclusion : <strong><?php echo $row['classv2']; ?></strong></p>
                   
        </div>
    </div>
</div>
</body>
</html>
