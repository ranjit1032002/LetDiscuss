<?php
  session_start();
    echo "Logging Out  ";

    session_destroy();
    header("location:/forum/index.php");

?>
