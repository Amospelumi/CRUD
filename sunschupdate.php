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
$query = "SELECT * FROM sunsch WHERE id=".$id;
$data = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($data);
 
// Define variables and initializes with empty values
$NumberError = $TitleError = $BrefError = $LessnoError = $ClassvError = $MverseError = $CrefError = $NotesError = $QuesError = $Classv2Error = null;

$Number = $row['id'];
$Title = $row['title'];
$Bref = $row['bref'];
$Lessno = $row['lessno'];
$Classv = $row['classv'];
$Mverse = $row['mverse'];
$Cref = $row['cref'];
$Notes = $row['notes'];
$Ques = $row['ques'];
$Classv2 = $row['classv2'];

//Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    //validate id
    if(empty($_POST["id"])){
        $NumberError = "Please enter a number.";    
    }else{
        $Number = trim($_POST["id"]);     
    }
 
    //validate notes
    if(empty($_POST["title"])){
        $TitleError = "Please enter a notes.";
    }else{
        $Title = trim($_POST["title"]);
    }
 
    //validate brief
    if(empty($_POST["bref"])){
        $BrefError = "Please enter your brief.";
    }else{
        $Bref = trim($_POST["bref"]);
    }

    //validate lessno
    if(empty($_POST["lessno"])){
        $LessnoError = "Please enter your lessno.";
    }else{
        $Lessno = trim($_POST["lessno"]);
    }

    //validate classv
    if(empty($_POST["classv"])){
        $ClassvError = "Please enter your classv.";
    }else{
        $Classv = trim($_POST["classv"]);
    }
    
    //validate mverse
    if(empty($_POST["mverse"])){
        $MverseError = "Please enter your mverse.";
    }else{
        $Mverse = trim($_POST["mverse"]);
    }
 
    //validate cref
    if(empty($_POST["cref"])){
        $CrefError = "Please enter your cref.";
    }else{
        $Cref = trim($_POST["cref"]);
    }
 
    //validate notes
    if(empty($_POST["notes"])){
        $NotesError = "Please enter your notes.";
    }else{
        $Notes = trim($_POST["notes"]);
    }
 
    //validate ques
    if(empty($_POST["ques"])){
        $QuesError = "Please enter your ques.";
    }else{
        $Ques = trim($_POST["ques"]);
    }
 
    //validate classv2
    if(empty($_POST["classv2"])){
        $Classv2Error = "Please enter your classv2.";
    }else{
        $Classv2 = trim($_POST["classv2"]);
    }
 
 
    //checking input errors before inserting in database
    if(empty($NumberError) && empty($TitleError) && empty($BrefError) && empty($LessnoError) && empty($ClassvError) && empty($MverseError)  && empty($CrefError) && empty($NotesError) && empty($QuesError) && empty($Classv2Error)){ 
        //Prepare an insert statement
        $sql = "UPDATE sunsch SET id='".$Number."', title='".$Title."', bref='".$Bref."', lessno='".$Lessno."', classv='".$Classv."', mverse='".$Mverse."', cref='".$Cref."', notes='".$Notes."', ques='".$Ques."', classv2='".$Classv2."' WHERE id='".$id."' ";
        $query = mysqli_query($con, $sql);
        
        if($query){
            header("Location: sundayschoolpagination.php");
        }
        
    }
 
}
 
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Crud Demo</title>
    <meta charset="utf-8">
    <meta name="viewport" lessno="width=device-width, initial-scale=1">
    <script src="https://cdn.tiny.cloud/1/obg0scfvrjty466pn06958u02y9fajgvq1izt6jejiv0xh3p/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="tractupdate.css">
</head>
<body>
<div class="container">
    <div class="row">
        <h2><b>Edit Sundayschool</h2>
    </div><br>
 
    <form action="sunschupdate.php?id=<?php echo $id;?>" method="POST" class="form-horizontal">
        <div class="form-group <?php echo !empty($NumberError)? 'error': ''; ?>">
            <label class="control-label col-sm-2" for="id">Number:</label>
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
            <label class="control-label col-sm-2" for="title">Title:</label>
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
                
        <div class="form-group <?php echo !empty($BrefError)? 'error': ''; ?>">
            <label class="control-label col-sm-2" for="bref">Brief:</label>
            <div class="col-sm-10">
                <input name="bref" id="bref" class="form-control" type="text" placeholder="bref" size=100 value="<?php echo !empty($Bref) ? $Bref : ''; ?>">
                <?php
                if(!empty($BrefError)){
                    ?>
                    <span class="help-inline"><?php echo $BrefError; ?></span>
                    <?php
                }
                ?>
            </div>
        </div><br>
                        
        <div class="form-group <?php echo !empty($LessnoError)? 'error': ''; ?>">
            <label class="control-label col-sm-2" for="lessno">Lessno:</label>
            <div class="col-sm-10">
                <input name="lessno" id="lessno" class="form-control" type="text" placeholder="Lessno" size=100 value="<?php echo !empty($Lessno) ? $Lessno : ''; ?>">
                <?php
                if(!empty($LessonError)){
                    ?>
                    <span class="help-inline"><?php echo $LessonError; ?></span>
                    <?php
                }
                ?>
            </div>
        </div><br>
        
        <div class="form-group <?php echo !empty($ClassvError)? 'error': ''; ?>">
            <label class="control-label col-sm-2" for="classv">Classv:</label>
            <div class="col-sm-10">
                <input name="classv" id="classv" type="text" placeholder="text" value="<?php echo !empty($Classv) ? $Classv:''; ?>">
                <?php
                if(!empty($ClassvError)){
                ?>
                    <span class="help-inline"><?php echo $ClassvError; ?></span>
                    <?php
                }
                ?>
            </div>
        </div><br>
        
        <div class="form-group <?php echo !empty($MverseError)? 'error': ''; ?>">
            <label class="control-label col-sm-2" for="mverse">Memory verse:</label>
            <div class="col-sm-10">
                <textarea name="mverse" id="mverse" type="text" placeholder="text"><?php echo !empty($Mverse) ? $Mverse: ''; ?>"</textarea>
                <script>
                    tinymce.init({
                    selector: 'textarea',
                    plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    toolbar_mode: 'floating',
                    });
                </script>
                <?php
                if(!empty($MverseError)){
                ?>
                    <span class="help-inline"><?php echo $MverseError; ?></span>
                    <?php
                }
                ?>
            </div>
        </div><br>
        
        <div class="form-group <?php echo !empty($CrefError)? 'error': ''; ?>">
            <label class="control-label col-sm-2" for="cref">Cref:</label>
            <div class="col-sm-10">
                <textarea name="cref" id="cref" type="text" placeholder="text" ><?php echo !empty($Cref) ? $Cref: ''; ?>"</textarea>
                <script>
                    tinymce.init({
                    selector: 'textarea',
                    plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    toolbar_mode: 'floating',
                    });
                </script>
                <?php
                if(!empty($CrefError)){
                ?>
                    <span class="help-inline"><?php echo $CrefError; ?></span>
                    <?php
                }
                ?>
            </div>
        </div><br>
        
        <div class="form-group <?php echo !empty($NotesError)? 'error': ''; ?>">
            <label class="control-label col-sm-2" for="notes">Content:</label>
            <div class="col-sm-10">
                <textarea name="notes" id="notes" type="text" placeholder="text"><?php echo !empty($Notes) ? $Notes: ''; ?>"</textarea>
                <script>
                    tinymce.init({
                    selector: 'textarea',
                    plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    toolbar_mode: 'floating',
                    });
                </script>
                <?php
                if(!empty($NoteError)){
                ?>
                    <span class="help-inline"><?php echo $NoteError; ?></span>
                    <?php
                }
                ?>
            </div>
        </div><br>
        
        <div class="form-group <?php echo !empty($QuesError)? 'error': ''; ?>">
            <label class="control-label col-sm-2" for="ques">Questions:</label>
            <div class="col-sm-10">
                <textarea name="ques" id="ques" type="text" placeholder="text"><?php echo !empty($Ques) ? $Ques: ''; ?>"</textarea>
                <script>
                    tinymce.init({
                    selector: 'textarea',
                    plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    toolbar_mode: 'floating',
                    });
                </script>
                <?php
                if(!empty($QuesError)){
                ?>
                    <span class="help-inline"><?php echo $QuesError; ?></span>
                    <?php
                }
                ?>
            </div>
        </div><br>
                
        <div class="form-group <?php echo !empty($Classv2Error)? 'error': ''; ?>">
            <label class="control-label col-sm-2" for="classv2">Class Value 2:</label>
            <div class="col-sm-10">
                <input name="classv2" id="classv2" type="text" placeholder="text" value="<?php echo !empty($Classv2) ? $Classv2: ''; ?>">
                <?php
                if(!empty($Classv2Error)){
                ?>
                    <span class="help-inline"><?php echo $Classv2Error; ?></span>
                    <?php
                }
                ?>
            </div>
        </div><br>
       
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" name="submit" style="background-color:green; color:white; padding: 10px 10px; border-radius: 8px; border: none;">Submit</button>
                <a href="sundayschoolpagination.php"><button type="button" style="background-color:rgb(6, 6, 170); color:white; padding: 10px 10px; border-radius: 8px; border: none;float:right;">Back</button></a>
            </div>
        </div>
        
    </form>
    
</div>
</body>
</html>