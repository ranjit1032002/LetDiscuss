<?php
 if($_SERVER['REQUEST_METHOD']=='POST'){
    include 'dbconnect.php';

    $user=$_POST['loginUser'];
    $email=$_POST['loginEmail'];
    $pass=$_POST['loginPass'];

    $sql="SELECT * FROM `users` WHERE `user_email`='$email' AND `user_name`='$user'";
    $result=mysqli_query($conn,$sql);
    $numRows=mysqli_num_rows($result);

    if($numRows==1){
        $row=mysqli_fetch_assoc($result);
        if(password_verify($pass,$row['user_pass'])){
            session_start();
            $_SESSION['loggedin']=true;
            $_SESSION['useremail']=$user;
            $_SESSION['user_id']=$row['user_id'];
            // echo "logged in".$email;
            header("location:/forum/index.php?loginsuccess=true");
        }
        else{
            // echo "Unable To Logged In";
            header("location:/forum/index.php?loginsuccess=false");
        }
    }
 }
?>