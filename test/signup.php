<?php // Included files
    include_once("../includes/navbars/signup.nav.php");

 // Validation process
    if(isset($_POST['submit'])) {
        include_once("../includes/mysql.inc.php");

        // Declaring the names from the input form
        // Declaring u_name input
        $name = $_POST['u_name'];
        // Declaring validation error to false (trick to store data into database after no error occur
        $validationError = "false";

        // Validating if username already exists
        // SQL query for pulling the users from the database
        $sql = "select un from users where un ='$name';";
        // Retrieving the database
        $data= mysqli_query($conn, $sql);
        // Storing the database
        $row = mysqli_fetch_assoc($data);
        // SQL query results
        // Turning the array into a string
        $result = implode(",", $row);

        if($name === $result) {
            $name_exist = "User already exists. Please choose another username";
            $validationError = true; 
        }

        if($validationError == false)

        mysqli_close($conn);
    } 
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopWMe INC</title>
</head>
<body>


    <!-- Sign up form for users -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <!-- Username input -->
        <p>
            <input type="text" name="u_name" placeholder="Username" value="<?php // Beginning of php tag
                // Username sticky form
                if(isset($name)) echo $name;?>"> <!--end of php tag -->
                
                <?php
                // if username already exists
                if(isset($name_exist)) echo "<br />".$name_exist ?>
        </p>
        <p>
            <input type="submit" name="submit" value="Sign Up">
        </p>
    </form> 
</body>
</html>