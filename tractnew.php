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
 
// Define variables and initializes with empty values
$NumberError = $TitleError = $ContentError  = null;
$Number = $TItle = $Content = null;
 
//Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    //validate name
    if(empty($_POST["id"])){
        $NumberError = "Please enter your name.";
    }else{
        $Number = trim($_POST["id"]);
    }
 
    //validate email
    if(empty($_POST["title"])){
        $TitleError = "Please enter a title.";
    }else{
        $Title= trim($_POST["title"]);
    }
 
    //validate content
    if(empty($_POST["content"])){
        $ContentError = "Please enter your content.";
    }else{
        $Content = trim($_POST["content"]);
    }
 
   
 
    //checking input errors before inserting in database
    if( empty($NumberError) && empty($TitleError) && empty($ContentError) ){
        //Prepare an insert statement
        $sql = "INSERT INTO tracts (id, title, content ) VALUES ('".$Number."', '".$Title."', '".$Content."')";
        $query = mysqli_query($con, $sql);
 
        if($query){
            header("Location: Tract.php");
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
    <link rel="stylesheet" href="tractnew.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <h3><b>Add new Tract</h3>
        </div><br>
 
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="form-horizontal">
            <div class="form-group <?php echo !empty($NumberError)? 'error': ''; ?>">
                <label class="control-label col-sm-2" for="id">Number</label>
                <div class="col-sm-10">
                    <input name="id" class="form-control" size=70 type="text" placeholder="Number" value="<?php echo !empty($Number) ? $Number : ''; ?>">
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
                    <input name="title" size=70 class="form-control" type="text" placeholder="Title" value="<?php echo !empty($Title) ? $Title : ''; ?>">
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
                    <textarea name="content" rows="40" class="form-control" type="text" placeholder="content" ><?php echo !empty($Content) ? $Content : ''; ?></textarea>
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
                <button type="submit" style="background-color:green; color:white; padding: 10px 10px; border-radius: 8px; border: none;">Submit</button>
                <a href="tractpagination.php"><button type="button" style="background-color:rgb(6, 6, 170); color:white; padding: 10px 10px; border-radius: 8px; border: none; float:right;">Back</button></a>
                </div>
            </div>
 
        </form>
    </div>
</body>
</html>