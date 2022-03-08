<?php
$showError="false";
$showAlert=false;
    if($_SERVER['REQUEST_METHOD']=='POST'){
        include 'dbconnect.php';

        $user_name=$_POST['signupUser'];
        $user_email=$_POST['signupEmail'];
        $user_pass=$_POST['signupPassword'];
        $user_cpass=$_POST['signupcPassword'];

        //check whether the email already exists
        $existSql="SELECT * FROM `users` where `user_email`='$user_email'";
        $result=mysqli_query($conn,$existSql);
        $numRows=mysqli_num_rows($result);
        if($numRows>0){
            $showError="Email Id Already Exists Please Login To Continue";
        }
        else{
                if($user_pass==$user_cpass){
                    $hash=password_hash($user_pass,PASSWORD_DEFAULT);
                    $sql="INSERT INTO `users` (`user_name`, `user_pass`,`user_email`,`timestamp`) 
                    VALUES ('$user_name', '$hash','$user_email', current_timestamp())";
                    $result=mysqli_query($conn,$sql);

                    if($result){
                        $showAlert=true;
                        header("location:/forum/index.php?signupsuccess=true");
                        exit();
                    }
                }
                else{
                    $showError="Password does not match please try again...";
                }
            }
            header("location:/forum/index.php?signupsuccess=$showError");

    }
?>