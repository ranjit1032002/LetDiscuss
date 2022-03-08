<?php

  session_start();
 
  echo  '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><b>LetDiscuss</b></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Top Categories
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
              $sql="SELECT category_name,category_id FROM `categories`";
              $result=mysqli_query($conn,$sql);
              while($row=mysqli_fetch_assoc($result)){
                echo '<li><a class="dropdown-item" href="threads.php?catid='.$row['category_id'].'">'.$row['category_name'].'</a></li>';
              }              
            echo '</ul>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="contact.php">Contact</a>
          </li>
        </ul>';
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
          echo '<form class="d-flex my-2" action="search.php" method="get">
                  <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-primary" type="submit">Search</button>
                <p class="text-white my-2 mx-2">'.$_SESSION['useremail'].' </p>
                <button class="btn btn-outline-primary"><a href="partials/logout.php" style="text-decoration:none;">Logout</a></button>
                </form>' ;                 
        }
        else{
              echo '<form class="d-flex">
                      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                      <button class="btn btn-primary" type="submit">Search</button>
                    </form>
                  <div class="mx-2 my-2">
                    <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#login">Login</button>
                    <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#signup">Sign Up</button>
                  </div>';
          } 
                
          echo '</div>
    </div>
  </nav>';

  include 'partials/login.php';
  include 'partials/signup.php';

  if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true"){
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
            <strong>Success!</strong> You Can Now Login.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
  }
  else if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="false"){
    echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
            <strong>Failure!</strong> Please Try Again...
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
  }

  if(isset($_GET['loginsuccess']) && $_GET['loginsuccess']=="true"){
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
            <strong>Success!</strong> You Are Now Logged In.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
  }
  else if(isset($_GET['loginsuccess']) && $_GET['loginsuccess']=="false"){
      echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
      <strong>Failure!</strong> Wrong Credentials.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }
?>