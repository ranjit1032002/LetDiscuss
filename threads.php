<!doctype html>
<html lang="en">
<?php
    
 ?>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <title>Welcome To ProSolve</title>
</head>

<body>
    <?php  require 'partials/dbconnect.php';?>
    <?php  require 'partials/header.php';?>

    <?php
        $id=$_GET['catid'];
        $sql="SELECT * FROM `categories` WHERE `category_id`=$id";
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result)){
            $catname=$row['category_name'];
            $catdesc=$row['category_description'];
        }
    ?>

    <?php
        $showAlert=false;
        $method=$_SERVER['REQUEST_METHOD'];
        if($method=='POST'){
            // Insert into thread  db

            $th_title=$_POST['title'];
            $th_desc=$_POST['desc'];

            $th_title=str_replace("<", "&lt;", $th_title);
            $th_title=str_replace(">", "&gt;", $th_title);

            $th_desc=str_replace("<", "&lt;", $th_desc);
            $th_desc=str_replace(">", "&gt;", $th_desc);

            $user_id=$_POST['user_id'];

            $sql="INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) 
            VALUES ('$th_title', '$th_desc', '$id', '$user_id', current_timestamp())";
            $result=mysqli_query($conn,$sql);
            $showAlert=true;
            if($showAlert){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your thread has been added! Please wait for comunity to respond.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }
        }
        
    ?>

    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">Welcome To <?php echo $catname;?> Forum</h1>
            <p class="lead"><?php echo $catdesc;?> </p>
            <hr class="my-4">
            <p>This is a peer to peer forum for sharing knowledge with each other</p>
        </div>
    </div>


<!-- Check Whether The User Logged in to ]start a  discussion -->

    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
        echo '<div class="container">
                <h2>Start a Discussion</h2>
                <form action="'.$_SERVER["REQUEST_URI"].'" method="post">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Thread Title</label>
                            <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">Keep your title short as possible.</div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Elaborate your concern</label>
                            <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                            <input type="hidden" name="user_id" value="'.$_SESSION["user_id"].'">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>';
        }
        else{
            echo '<div class="container">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Failure!</strong> You are not logged in! Login to start a discussion.
                    </div>
            </div>';
        }
    
    ?>

<!-- Fetching the data from the database -->
    <div class="container">
        <h2>Browse Questions</h2>
        <?php
            $id=$_GET['catid'];
            $sql="SELECT * FROM `threads` WHERE `thread_cat_id`=$id";
            $result=mysqli_query($conn,$sql);
            $noResult=true;
            while($row=mysqli_fetch_assoc($result)){
                $noResult=false;
                $id=$row['thread_id'];
                $title=$row['thread_title'];
                $desc=$row['thread_desc'];
                $thread_time=$row['timestamp'];
                $thread_user_id=$row['thread_user_id'];

                $sql2="SELECT user_name FROM `users` WHERE `user_id`='$thread_user_id'";
                $result2=mysqli_query($conn,$sql2);
                $row2=mysqli_fetch_assoc($result2);

                echo' <div class="media">
                <img class="mr-3" src="images/userdefault.png" witdth="60" height="60" alt="user default image">
                <div class="media-body">
                <p><b> '.$row2['user_name'] .' at '.$thread_time.'</b></p>
                    <h5 class="mt-0"><a href="inner_thread.php?thread-id='.$id.'" style="text-decoration:none;" class="text-dark">'.$title.'</a></h5>
                    '.$desc.'
                </div>
            </div>';
            }

            if($noResult){
            echo'<div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <h3 class="display-6"> <b>No Threads Found</b> </h3>
                        <p class="lead">Be the first person to ask a question</p>
                    </div>
                </div>';
            }           
        ?>
    </div>


    <?php  require 'partials/footer.php';?>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>   


</html>