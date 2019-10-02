<?php
session_start();
    if ($_SESSION['user_login']) {
      session_destroy();
      header("Location:index.php");
    }



  ?>
