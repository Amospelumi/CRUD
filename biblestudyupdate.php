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
    header("Location: biblestudy.php");
}
$query = "SELECT * FROM bible_study WHERE id=".$id;
$data = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($data);
 
// Define variables and initializes with empty values
$NumberError = $LessnoError = $ClassError  = $TitleError = $TextError = $MverseError = $IntroError  = $ItemsError = $ConclusionError = null;

$Number = $row['id'];
$Lessno = $row['lesson_no'];
$Class = $row['class'];
$Title = $row['title'];
$Text = $row['text'];
$Mverse = $row['mverse'];
$Intro= $row['intro'];
$Items = $row['items'];
$Conclusion = $row['conclusion'];

//Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    //validate id
    if(empty($_POST["id"])){
        $NumberError = "Please enter a number.";    
    }else{
        $Number = trim($_POST["id"]);     
    }

    if(empty($_POST["lesson_no"])){
        $LessnoError = "Please enter a lesson number.";    
    }else{
        $Lessno = trim($_POST["lesson_no"]);     
    }
    
    //validate class
    if(empty($_POST["class"])){
        $ClassError = "Please enter your class.";
    }else{
        $Class = trim($_POST["class"]);
    }
    
    //validate title
    if(empty($_POST["title"])){
        $TitleError = "Please enter a title.";
    }else{
        $Title = trim($_POST["title"]);
    }

    //validate text
    if(empty($_POST["text"])){
        $TextError = "Please enter a text.";
    }else{
        $Text = trim($_POST["text"]);
    }
    
    //validate mverse
    if(empty($_POST["mverse"])){
        $MverseError = "Please enter a mverse.";
    }else{
        $Mverse = trim($_POST["mverse"]);
    }
 
    //validate intro
    if(empty($_POST["intro"])){
        $IntroError = "Please enter your intro.";
    }else{
        $Intro = trim($_POST["intro"]);
    }
    
    //validate item
    if(empty($_POST["items"])){
        $ItemsError = "Please enter your items.";
    }else{
        $Items = trim($_POST["items"]);
    }
    
    //validate conclusion
    if(empty($_POST["conclusion"])){
        $ConclusionError = "Please enter your conclusion.";
    }else{
        $Conclusion = trim($_POST["conclusion"]);
    }
   
    echo $NumberError;

    //checking input errors before inserting in database
    if(empty($NumberError) && empty($LessnoError) && empty($ClassError) && empty($TitleError) && empty($TextError) && empty($MverseError) && empty($IntroError) && empty($ItemsError) && empty($ConclusionError)){ 
       
        //Prepare an insert statement
        $sql = "UPDATE bible_study SET id='".$Number."', lesson_no='".$Lessno."', class='".$Class."', title='".$Title."', text='".$Text."', mverse='".$Mverse."', intro='".$Intro."', items='".$Items."', conclusion='".$Conclusion."'  WHERE id='".$id."' ";
        $query = mysqli_query($con, $sql);
        
        if($query){
            header("Location: biblestudy.php");
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
        <h2><b>Edit Bible Study</h2>
    </div><br>
 
    <form action="biblestudyupdate.php?id=<?php echo $id;?>" method="POST" class="form-horizontal">
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
        
        <div class="form-group <?php echo !empty($LessnoError)? 'error': ''; ?>">
            <label class="control-label col-sm-2" for="lesson_no">Lessno:</label>
            <div class="col-sm-10">
                <input name="lesson_no" id="lesson_no" class="form-control" type="text" placeholder="Lessno" size=100 value="<?php echo !empty($Lessno) ? $Lessno : ''; ?>">
                <?php
                if(!empty($LessonError)){
                    ?>
                    <span class="help-inline"><?php echo $LessonError; ?></span>
                    <?php
                }
                ?>
            </div>
        </div><br>

        <div class="form-group <?php echo !empty($ClassError)? 'error': ''; ?>">
            <label class="control-label col-sm-2" for="class">Class:</label>
            <div class="col-sm-10">
                <input name="class" id="class" type="text" placeholder="text" value="<?php echo !empty($Class) ? $Class:''; ?>">
                <?php
                if(!empty($ClassError)){
                ?>
                    <span class="help-inline"><?php echo $ClassError; ?></span>
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

        <div class="form-group <?php echo !empty($TextError)? 'error': ''; ?>">
            <label class="control-label col-sm-2" for="text">Bible text:</label>
            <div class="col-sm-10">
                <textarea name="text" id="text" class="form-control" type="text" placeholder="Title" size=100><?php echo !empty($Text) ? $Text: ''; ?></textarea> 
                <script>
                    tinymce.init({
                    selector: 'textarea',
                    plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    toolbar_mode: 'floating',
                    });
                </script><?php
                if(!empty($TextError)){
                    ?>
                    <span class="help-inline"><?php echo $TextError; ?></span>
                    <?php
                }
                ?>
            </div>
        </div><br>

        <div class="form-group <?php echo !empty($MverseError)? 'error': ''; ?>">
            <label class="control-label col-sm-2" for="mverse">Memory Verse:</label>
            <div class="col-sm-10">
                <textarea name="mverse" id="mverse" class="form-control" type="text" placeholder="Mverse" size=100 ><?php echo !empty($Mverse) ? $Mverse: ''; ?></textarea>
                <script>
                    tinymce.init({
                    selector: 'textarea',
                    plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    toolbar_mode: 'floating',
                    });
                </script><?php
                if(!empty($MverseError)){
                    ?>
                    <span class="help-inline"><?php echo $MverseError; ?></span>
                    <?php
                }
                ?>
            </div>
        </div><br>
                
        <div class="form-group <?php echo !empty($IntroError)? 'error': ''; ?>">
            <label class="control-label col-sm-2" for="bref">Intro:</label>
            <div class="col-sm-10">
                <textarea name="intro" id="intro" class="form-control" type="text" placeholder="intro" size=100 ><?php echo !empty($Intro) ? $Intro : ''; ?></textarea>
                <script>
                    tinymce.init({
                    selector: 'textarea',
                    plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    toolbar_mode: 'floating',
                    });
                </script>
                <?php
                if(!empty($IntroError)){
                    ?>
                    <span class="help-inline"><?php echo $IntroError; ?></span>
                    <?php
                }
                ?>
            </div>
        </div><br>
        
        <div class="form-group <?php echo !empty($ItemsError)? 'error': ''; ?>">
            <label class="control-label col-sm-2" for="items">Items:</label>
            <div class="col-sm-10">
                <textarea name="items" id="items" type="text" placeholder="text" ><?php echo !empty($Items) ? $Items: ''; ?>"</textarea>
                <script>
                    tinymce.init({
                    selector: 'textarea',
                    plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    toolbar_mode: 'floating',
                    });
                </script>
                <?php
                if(!empty($ItemsError)){
                ?>
                    <span class="help-inline"><?php echo $ItemsError; ?></span>
                    <?php
                }
                ?>
            </div>
        </div><br>

        <div class="form-group <?php echo !empty($ConclusionError)? 'error': ''; ?>">
            <label class="control-label col-sm-2" for="conclusion">Conclusion:</label>
            <div class="col-sm-10">
                <textarea name="conclusion" id="conclusion" type="text" placeholder="text"><?php echo !empty($Conclusion) ? $Conclusion: ''; ?>"</textarea>
                <script>
                    tinymce.init({
                    selector: 'textarea',
                    plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    toolbar_mode: 'floating',
                    });
                </script>
                <?php
                if(!empty($ConclusionError)){
                ?>
                    <span class="help-inline"><?php echo $ConclusionError; ?></span>
                    <?php
                }
                ?>
            </div>
        </div><br>
        
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" name="submit" style="background-color:green; color:white; padding: 10px 10px; border-radius: 8px; border: none;">Submit</button>
                <a href="biblestudy.php"><button type="button" style="background-color:rgb(6, 6, 170); color:white; padding: 10px 10px; border-radius: 8px; border: none;float:right;">Back</button></a>
            </div>
        </div>
        
    </form>
    
</div>
</body>
</html>