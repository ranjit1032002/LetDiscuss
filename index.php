<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <link href="style.css" rel="stylesheet">
    <title>Welcome To ProSolve</title>
</head>

<body>
    <?php  require 'partials/dbconnect.php';?>
    <?php  require 'partials/header.php';?>

    <!-- SLider Starts Here -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/slider-1.jpg" width="1600" height="500" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="images/slider-2.jpg" width="1600" height="500" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="images/slider-3.jpeg" width="1600" height="500" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

<!-- Category Container Starts Here -->
    <div class="container">
        <h1 class="text-center my-3"><marquee><b>Welcome To LetDiscuss</b></marquee></h1>
        <div class="row">

            <!-- Fetch All The Categories  use a for loop to iterate through categories -->
            <?php 
                $sql="SELECT * FROM `categories`";
                $result=mysqli_query($conn,$sql);
                
                while($row=mysqli_fetch_assoc($result)){
                //  echo $row['category_id'] . $row['category_name'] . $row['category_description'];
                $id=$row['category_id'];
                $cat=$row['category_name'];
                echo '<div class="col-md-4 my-3">
                            <div class="card">
                                <img src="https://source.unsplash.com/1600x900/?code,'.$cat.'" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="threads.php?catid='.$id.'" style="text-decoration:none;">'.$row['category_name'].'</a></h5>
                                    <p class="card-text">'.substr($row['category_description'],0,30).'....</p>
                                    <a href="threads.php?catid='.$id.'" class="btn btn-primary">View Threads</a>
                                </div>
                            </div>
                        </div>';
                }
            ?>
        </div>
    </div>
    <?php  require 'partials/footer.php';?>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>   

</html>