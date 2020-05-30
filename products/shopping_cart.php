<?php
    session_start();
    include_once("../includes/mysql.inc.php");
    if(isset($_SESSION['user'])) {
        include_once("../includes/navbars/member.nav.php");
        // echo "Hello World";
        if(!empty($_GET['action'])){
        // echo "Hello";
            switch($_GET['action']) {
            case "add":
                if(!empty($_POST["quantity"])) {
                    // echo "I am here";
                    $sql = "select * from tblproduct where code='".$_GET['code']."'";
                    // echo $sql;
                    if($result = mysqli_query($conn, $sql)) {
                        if(mysqli_num_rows($result) > 0) {
                            // echo "It worked";
                            while ($row = mysqli_fetch_assoc($result)) {
                                $itemArray = array(
                                    $row["code"]=>array(
                                        'name'=>$row["name"], 
                                        'code'=>$row["code"], 
                                        'quantity'=>$_POST["quantity"], 
                                        'price'=>$row["price"], 
                                        'image'=>$row["image"]));
                                
                                if(!empty($_SESSION["cart_item"])) {
                                    // echo "Hello World";
                                    if(in_array($row["code"],array_keys($_SESSION["cart_item"]))) {
                                        // echo "Normal";
                                        foreach($_SESSION["cart_item"] as $k => $v) {
                                                if($row["code"] == $k) {
                                                    // echo "What about here?";
                                                    if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                                                        $_SESSION["cart_item"][$k]["quantity"] = 0;
                                                    // echo "Now here";
                                                    }
                                                    // $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                                                    $sum = $_SESSION["cart_item"][$k]["quantity"] + $_POST["quantity"];
                                                }
                                        }
                                    } else {
                                        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                                    }
                                } else {
                                    $_SESSION["cart_item"] = $itemArray;
                                }
                            }
                            // print_r($itemArray);
                            // echo $_SESSION["cart_item"][$k]["quantity"]." ".$_POST['quantity']." = ".$sum;
                        }
                    }
                }
            break; 

            case "remove":
                if(!empty($_SESSION['cart_item'])) {
                    foreach ($_SESSION['cart_item'] as $k => $v) {
                        if($_GET['code']==$k) {
                            unset($_SESSION['cart_item'][$k]);
                        }
                    }
                }
            break; 

            case "empty": 
                unset($_SESSION['cart_item']);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHOPWME</title>
</head>
<body>
<div id="shopping-cart">
<div class="txt-heading">Shopping Cart</div>

<a id="btnEmpty" href="shopping_cart.php?action=empty">Empty Cart</a>
<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>	
<table class="tbl-cart" cellpadding="10" cellspacing="1">
<!-- <tbody> -->
<tr>
<th style="text-align:left;">Name</th>
<th style="text-align:left;">Code</th>
<th style="text-align:right;" width="5%">Quantity</th>
<th style="text-align:right;" width="10%">Unit Price</th>
<th style="text-align:right;" width="10%">Price</th>
<th style="text-align:center;" width="5%">Remove</th>
</tr>
<?php		
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["price"];
	 	?>
	 		<tr>
	 		<td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
	 		<td><?php echo $item["code"]; ?></td>
	 		<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
	 		<td  style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
	 		<td  style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></
	 		<td style="text-align:center;"><a href="shopping_cart.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
	 		</tr> 
	 	<?php
		$total_quantity += $item["quantity"];
		$total_price += ($item["price"]*$item["quantity"]);
	}
		?>

<tr>
<td colspan="2" align="right">Total:</td>
<td align="right"><?php echo $total_quantity; ?></td>
<td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
<td></td>
</tr>
<!-- </tbody> -->
</table>
  <?php
} else {
?>
<div class="no-records">Your Cart is Empty</div>
<?php 
}
?>
</div>
<form action="../billing/billing.php" method="post">
    <input type="submit" value="Checkout">
</form>
</body>
</html>
<?php
    } else {
        session_start();
        header("location: ../members/logIn.php");
    }
    mysqli_close($conn);
?>