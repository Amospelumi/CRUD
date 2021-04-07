<?php
// Initialize the session
session_start();
 
// If the user isn't logged in, and he/she claims to have logges in redirect him/her to login page
if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
//include connection file
include('dbconnection.php');
 
$id = null;
 
if(!empty($_GET['id'])){
    $id = $_REQUEST['id'];
}
 
if ( null==$id ) {
    header("Location: sundayschoolpagination.php");
}
 
//Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    $id = $_POST['id'];
 
    $sql = "DELETE FROM sunsch WHERE id = $id";
    $query = mysqli_query($con, $sql);
 
    if($query){
        header("Location: sundayschoolpagination.php");
    }
}
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Crud Demo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
 
        <div class="row">
            <h3>Delete a Person</h3>
        </div>
 
        <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $id;?>"/>
            <p class="alert alert-danger">Are you sure you want to delete this?</p>
            <div class="form-actions">
                <button type="submit" class="btn btn-danger">Yes</button>
                <a class="btn btn-default" href="biblestudy.php">No</a>
            </div>
        </form>
</div>
</body>
</html>