<?php
session_start();
if (isset($_SESSION['user'])) {
    include_once("../includes/navbars/member.nav.php");
    echo "Welcome ".$_SESSION['user']."!";
} else {
    include_once("../includes/navbars/main.nav.php");
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopW/Me INC</title>
</head>
<body>
    <div id="content">
        <div id="dss">
            <p>Discount slide show</p>
        </div>

        <div id="ad">
            <p>This is where the advertisement is going</p>
        </div>

        <div id="f_sale">
            <h3>Flash Sale</h4>
                <p class="list">Countdown Timer</p>
                <p class="list">Item 1</p>
                <p class="list">Item 2</p>
                <p class="list">Item 3</p>
                <p class="list">Item 4</p>
                <p class="list">Item 5</p>
        </div>

        <div id="reason">
            <h2>Why shop with us?</h2>
        <ul>
            <li>Reason 1</li>
            <li>Reason 2</li>
            <li>Reason 3</li>
            <li>Reason 4</li>
            <li>Reason 5</li>
        </ul>
        </div>
    </div>

    <!-- Footer include -->
    <?php
        include_once("../includes/footer.inc.php");
    ?>
</body>
</html>