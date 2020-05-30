<?php
    session_start();
    $_SESSION = array();
    session_destroy();
    $_SESSION['message'] = "You have successfully logged out";
    header("location: ../homepage/index.php?logout=success");