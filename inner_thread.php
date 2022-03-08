<!doctype html>
<html lang="en">

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

<!-- getting the id of ech thread to comment on it -->
    <?php
        $id=$_GET['thread-id'];
        $sql="SELECT * FROM `threads` WHERE `thread_id`=$id";
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result)){
            $title=$row['thread_title'];
            $desc=$row['thread_desc'];
            $thread_user_id=$row['thread_user_id'];

            //Query the users table to find out the name of original post
            $sql2="SELECT user_name FROM `users` WHERE `user_id`='$thread_user_id'";
            $result2=mysqli_query($conn,$sql2);
            $row2=mysqli_fetch_assoc($result2);
            $posted_by=$row2['user_name'];

        }
    ?>

<!-- Post the form data to the database -->
    <?php
        $showAlert=false;
        $method=$_SERVER['REQUEST_METHOD'];
        if($method=='POST'){
            // Insert into comment  db

            $th_content=$_POST['comment'];
            $th_content=str_replace("<", "&lt;", $th_content);
            $th_content=str_replace(">", "&gt;", $th_content);
            $user_id=$_POST['user_id'];

            $sql="INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`,`comment_time`)
            VALUES ('$th_content', '$id','$user_id',current_timestamp())";
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
            <h1 class="display-4"> <?php echo $title;?> </h1>
            <p class="lead"><?php echo $desc;?> </p>
            <hr class="my-4">
            <p>This is a peer to peer forum for sharing knowledge with each other</p>
            <p> <b>Posted By:<?php echo $posted_by; ?></b> </p>
        </div>
    </div>

<!-- Check Whether The User Logged in to post a comment -->
    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
        echo '<div class="container">
                <h2>Post a Comment</h2>
                <form action=" '.$_SERVER['REQUEST_URI'].' " method="post">
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Type your comment</label>
                            <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                            <input type="hidden" name="user_id" value="'.$_SESSION["user_id"].'">

                        </div>
                        <button type="submit" class="btn btn-primary">Post Comment</button>
                    </form>
                </div>';
        }
        else{
            echo '<div class="container">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Failure!</strong> You are not logged in! Login to post a comment.
                    </div>
            </div>';
        }
    
    ?>

<!-- Fetch The Comments -->
    <div class="container">
        <h1>Discussions</h1>
        <?php
            $noResult=true;
            $id=$_GET['thread-id'];
            $sql="SELECT * FROM `comments` WHERE `thread_id`=$id";
            $result=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_assoc($result)){
                $noResult=false;
                $id=$row['comment_id'];
                $content=$row['comment_content'];
                $comment_time=$row['comment_time'];
                $thread_user_id=$row['comment_by'];
                
                $sql2="SELECT user_name FROM `users` WHERE `user_id`='$thread_user_id'";
                $result2=mysqli_query($conn,$sql2);
                $row2=mysqli_fetch_assoc($result2);

                echo' <div class="media">
                <img class="mr-3" src="images/userdefault.png" witdth="60" height="60" alt="user default image">
                <div class="media-body">
                <p><b>'.$row2['user_name'].' at '.$comment_time.'</b></p>
                    '.$content.'
                </div>
            </div>';
            } 
            
            if($noResult){
                echo'<div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h3 class="display-6"> <b>No Comments Found</b> </h3>
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