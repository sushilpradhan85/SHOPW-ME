<?php // Include file for navbar
    session_start();
    if (isset($_SESSION['user'])) {
        include_once("../includes/navbars/member.nav.php");
        echo "Welcome ".$_SESSION['user']."!";
    }
    else {
        include_once("../includes/navbars/main.nav.php");
        echo "<p>Please log in to purchase items.</p>";   
    };
    include_once("../includes/mysql.inc.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopWMe Products</title>
</head>
<body>
    <div id="product-grid">
        <div class="txt-heading">Products</div>
        <?php
            $sql = "select * from tblproduct order by id asc;";
            if ($product_array = mysqli_query($conn, $sql)) {
                // echo "I am here <br />";
                if(mysqli_num_rows($product_array) > 0) {
                    // echo "Hello World";
                    while($row = mysqli_fetch_assoc($product_array)) {
                        // echo "Hello World";
                        ?>
                        <form action="shopping_cart.php?action=add&code=<?php echo $row["code"]; ?>" method="post">
                        <?php
                        echo "<br />".$row['image']."<br />".
                             $row['name']."<br />".
                             $row['code']."<br />".
                             $row['price']."<br />";
                        ?>
                        <input type="text" name="quantity" value="1" size="2">
                        <input type="submit" value="Add to Cart">
                        </form>
                        <?php
                    }
                }
            }
        ?>
</body>
</html>