<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    <link href="style.css" rel="stylesheet">
    <title>Welcome To ProSolve</title>
</head>

<body>
    <?php  require 'partials/dbconnect.php';?>
    <?php  require 'partials/header.php';?>

    

    <!-- Search Results -->
    <div class="container my-3">
        <h1 class="py-3">Search Result for "<em><?php echo $_GET['search'] ?></em>"</h1>


        <?php
            $noResult=true;
            $search=$_GET['search'];
            $sql="SELECT * FROM `threads` WHERE match(thread_title,thread_desc) against ('$search')";
            $result=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_assoc($result)){
                $title=$row['thread_title'];
                $desc=$row['thread_desc'];
                $thread_id=$row['thread_id'];
                $url="inner_thread.php?thread-id=".$thread_id;
                $noResult=false;
                // Diplay The Search Result
                echo '<div class="result">
                        <h3> <a href="'.$url.'" class="text-dark">'.$title.'</a></h3>
                        <p>'.$desc.'</p>
                    </div>';
            }

            if($noResult){
                echo'<div class="container my-4">
                        <div class="jumbotron">
                            <h1 class="display-4">No Results Found</h1>
                            <p class="lead"> Suggestions:
                            <ul>
                                <li>Make sure that all words are spelled correctly.</li>
                                <li>Try different keywords.</li>
                                <li>Try more general keywords.</li>
                            </u>
                            </p>
                            <hr class="my-4">
                            <p>This is a peer to peer forum for sharing knowledge with each other</p>
                        </div>
                    </div>';
            }

        ?>

    </div>
    <?php  require 'partials/footer.php';?>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
    integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
    integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous">
</script>
<!-- alter table threads add FULLTEXT(`thread_title`,`thread_desc`); 
SELECT * FROM `threads` WHERE match(`thread_title`,`thread_desc`) against ('install');
-->
</html>