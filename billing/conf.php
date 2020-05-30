<?php
    // Starting the session
    session_start();
    // Conditional for if user is logged in or not
    if (isset($_SESSION['user'])) {
        include_once("../includes/navbars/member.nav.php");
        echo "Welcome ".$_SESSION['user']."!<br />";
        ?>

        <!-- HTML Markup -->
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>
        <body>
            <!-- Confirmation message -->
            <?php
                echo "Your ".$_SESSION['ccn']. " card will be charged x amount and can expect delivery 5-7 buisness days. If you chose Cash On Delivery, please pay before opening the package";

    } else {// Error message for when  session is not started
        include_once("../includes/navbars/main.nav.php");
        // Error message for log in
        echo "Please log in to view this page";
    }
?>

</body>
</html>