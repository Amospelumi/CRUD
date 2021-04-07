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
    $sql = "SELECT * FROM bible_study WHERE";
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
    <. rel="stylesheet" href="tractread.css">
</head>

<body>
<div class="container" style="margin-top:20px;">
<div id="data">
    <div class="button">
    <?php echo '<a href="biblestudyupdate.php?id='.$row['id'].'">'?><button type="button" style="background-color:green; color:white; padding: 8px 8px; border-radius: 8px; border:none;">Edit</button></a>
        <a href="biblestudy.php"><button type="button" style="float: right; background-color:rgb(12, 12, 163); color:white; padding: 8px 8px; border-radius: 8px; border:none;">Back</button></a>
    </div><br>
            <div class="content">
        <p>Id : <strong><?php echo $row['id']; ?></strong></p>
        <p>Lesson Number : <strong><?php echo $row['lesson_no']; ?></strong></p>
        <p>Class : <strong><?php echo $row['class']; ?></strong></p>
        <p>Title : <strong><?php echo $row['title']; ?></strong></p>
        </div>
        <p>Text : <strong><?php echo $row['text']; ?></strong></p>
        <p>Memory Verse : <strong><?php echo $row['mverse']; ?></strong></p>
        <p>Intro : <strong><?php echo $row['intro']; ?></strong></p>
        <p>Items : <strong><?php echo $row['items']; ?></strong></p>
        <p>Conclusion : <strong><?php echo $row['conlusion']; ?></strong></p>
        <p>Langauge : <strong><?php echo $row['lang']; ?></strong></p>
        </div>
    </div>
</div>
</body>
</html>
