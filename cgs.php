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
    <title>Document</title>
    <link rel="stylesheet" href="tractpagination.css">
</head>
<body>
        <?php

        include("dbconnection.php");

        if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }

        $no_of_records_per_page = 10;
        $offset = ($pageno-1) * $no_of_records_per_page;
        
        $total_pages_sql = "SELECT COUNT(*) FROM cgs";
        $result = mysqli_query($con, $total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);
        
        $sql = "SELECT * FROM cgs LIMIT $offset, $no_of_records_per_page";
        $res_data = mysqli_query($con, $sql);
        ?>
        
        <div class="container">
            <div class="row">
                <h3>Christian Gospel Songs</h3>
            </div>
        
            <div class="row2">
                <p>
                    <a href="cgsnew.php"><input type="button" value="Add New CGS"  style="background-color:green; color:white; padding: 10px 10px; border-radius: 8px; border:none;"> </a>
                    <a href="welcome.php"><input type="button" value="<- Back" style="background-color:blue; float:right; color:white; padding: 10px 10px; border-radius: 8px; border:none;"></a>
                </p>
            </div>
                <table class="table table-bordered table-striped">
                    <div class="tablehead">  
                            <tr>
                                <th  style="text-align:center;">Id</th>
                                <th>Title</td>
                                <th  style="text-align:center;">Action</th>
                            </tr>
                        </div>
                    <?php
            while ($row = mysqli_fetch_assoc($res_data)){
                echo '<tr>';
                    echo '<td  style="text-align:center;">'.$row['cgs_no'].'</td>';
                    echo '<td><a href="cgsread.php?id='.$row['cgs_no'].'">'.$row['title'].'</a></td>';
                    echo '<td  style="text-align:center;">
                    <a href="cgsupdate.php?id='.$row['cgs_no'].'"><input type="button" value="Edit" style="background-color:green; color:white; border: none; padding: 10px 10px; border-radius: 8px;" ></a>
                    <a href="cgsdelete.php?id='.$row['cgs_no'].'"><input type= "button"value="Delete" style="background-color:red; color:white; border: none; padding: 10px 10px; border-radius: 8px;" ></a></td>';
                echo '</tr>';
                }
            ?>
            </tbody>
        </table><br>
        <ul class="pagination">
            <li><a href="?pageno=1">First</a></li>
            <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
            </li>
            <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
            </li>
            <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
        </ul>
        </div>
        
    </div>
</div>
 
</body>
</html>