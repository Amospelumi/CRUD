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
    header("Location: tractpagination.php");
}
$query = "SELECT * FROM tracts WHERE id=".$id;
$data = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($data);
 
// Define variables and initializes with empty values
$NumberError = $TitleError = $ContentError = null;

$Number = $row['id'];
$Title = $row['title'];
$Content = $row['content'];

 
 
//Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    //validate id
    if(empty($_POST["id"])){
        $NumberError = "Please enter a number.";
    }else{
        $Number = trim($_POST["id"]);
    }
 
    //validate email
    if(empty($_POST["title"])){
        $TitleError = "Please enter a title.";
    }else{
        $Title = trim($_POST["title"]);
    }
 
    //validate mobile
    if(empty($_POST["content"])){
        $ContentError = "Please enter your content.";
    }else{
        $Content = trim($_POST["content"]);
    }
 
 
    //checking input errors before inserting in database
    if( empty($NumberError) && empty($TitleError) && empty($ContentError) ){
        //Prepare an insert statement
        $sql = "UPDATE tracts SET id='".$Number."', title='".$Title."', content='".$Content."' WHERE id='".$id."' ";
        $query = mysqli_query($con, $sql);
 
        if($query){
            header("Location: tractpagination.php");
        }
 
    }
 
}
 
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Crud Demo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tiny.cloud/1/obg0scfvrjty466pn06958u02y9fajgvq1izt6jejiv0xh3p/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="tractupdate.css">
</head>
<body>
<div class="container">
    <div class="row">
        <h2><b>Update Tract</h2>
    </div><br>
 
    <form action="tractupdate.php?id=<?php echo $id;?>" method="POST" class="form-horizontal">
        <div class="form-group <?php echo !empty($NumberError)? 'error': ''; ?>">
            <label class="control-label col-sm-2" for="id">Number</label>
            <div class="col-sm-10">
                <input name="id" id="id" class="form-control" type="text" placeholder="Number" size=100 value="<?php echo !empty($Number) ? $Number : ''; ?>">
                <?php
                if(!empty($NumberError)){
                    ?>
                    <span class="help-inline"><?php echo $NumberError; ?></span>
                    <?php
                }
                ?>
            </div>
        </div><br>
 
        <div class="form-group <?php echo !empty($TitleError)? 'error': ''; ?>">
            <label class="control-label col-sm-2" for="title">Title</label>
            <div class="col-sm-10">
                <input name="title" id="title" class="form-control" type="text" placeholder="Title" size=100  value="<?php echo !empty($Title) ? $Title: ''; ?>">
                <?php
                if(!empty($TitleError)){
                    ?>
                    <span class="help-inline"><?php echo $TitleError; ?></span>
                    <?php
                }
                ?>
            </div>
        </div><br>
        <div class="form-group <?php echo !empty($ContentError)? 'error': ''; ?>">
            <label class="control-label col-sm-2" for="content">Content</label>
            <div class="col-sm-10">
                <textarea name="content" id="content" style="resize: none;" rows="40" type="text" placeholder="Content" > <?php echo !empty($Content) ? $Content: ''; ?> </textarea>
                <script>
                    tinymce.init({
                    selector: 'textarea',
                    plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    toolbar_mode: 'floating',
                    });
                </script>
                <?php
                if(!empty($ContentError)){
                ?>
                    <span class="help-inline"><?php echo $ContentError; ?></span>
                    <?php
                }
                ?>
            </div>
        </div><br>
        
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" style="background-color:green; color:white; padding: 10px 10px; border-radius: 8px; border: none;">Update</button>
                <a href="tractpagination.php"><button type="button" style="background-color:rgb(6, 6, 170); color:white; padding: 10px 10px; border-radius: 8px; border: none;float:right;">Back</button></a>
            </div>
        </div>
 
    </form>
</div>
</body>
</html>