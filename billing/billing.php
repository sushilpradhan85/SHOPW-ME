<?php
    // Starting the session
    session_start();
    // Conditional for if user is logged in or not
    if (isset($_SESSION['user'])) {
        include_once("../includes/navbars/member.nav.php");
        include_once("../includes/mysql.inc.php");
        echo "Welcome ".$_SESSION['user']."!";

        // Declaring the credit card number to store in session
        $_SESSION['ccn'] = $_POST['ccn'];

        // Validation check conditionals
    if(isset($_POST['submit'])) {
        $validationError = false;
        // echo $_SESSION['cart_item'];
        // Check if fields are empty
        if(empty( $_POST['f_name']
               && $_POST['l_name']
               && $_POST['m_add']
               && $_POST['b_add'])) {
                $validationError = true;
                echo "Please fill the form out completely";
        }
        
        // Validation for accepting only numbers
        // if (!is_numeric($_POST['ccn']
        //  && $_POST['expd']
        //  && $_POST['cvc'])) {
        //     echo "Hello World";
        //     $validationError = true;
        //     echo "Invalid Credit Card info";
        // } 

        // If no error, move to next page
        if($validationError == false) {
            header("location: conf.php");
        }
    }
    
?>

<!-- HTML Markup-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script>
        var cc = document.getElementbyId('cc');
        alert(cc);
    </script>
    <!-- Customer info form -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <p>Note: If choosing Cash On Delivery, you can leave the credit card info field empty</p>

        <!-- Customer info field -->
        <!-- First Name -->
        <label for="">
            <p>First Name:<input type="text" name="f_name" id=""> </p>
        </label>
        <!-- Last Name -->
        <label for="">
            <p>Last Name:<input type="text" name="l_name" id=""></p>
        </label>
        <!-- Mailing Address -->
        <label for="">
            <p>Mailing Address:<input type="text" name="m_add" id=""></p>
        </label>
        <!-- Billing Address -->
        <label for="">
            <p>Billing Address:<input type="text" name=" b_add" id=""></p>
        </label>
        <!-- Credit Card Number/C.O.D -->
        <select name="">
        <option id="cc" value="">Credit Card
            <input hidden="text" name="cc" value="Credit Card">
        </option>
        <option name="cod" value="">Cash On Delivery</option>
        </select>
        <!-- Submit Button -->
        <input type="submit" name="submit" value="Submit">
    </form>

<?php
    }
    else { // Error message for when session is not started
        include_once("../includes/navbars/main.nav.php");
        // Error message for Log in
        echo "Please Log in to view this page";
    }
    echo $total_price;
?>  
</body>
</html> 