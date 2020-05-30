<?php // Included files
    include_once("../includes/navbars/signup.nav.php");

 // Validation process
    if(isset($_POST['submit'])) {
        include_once("../includes/mysql.inc.php");

        // Declaring the names from the input form
        // Declaring u_name input
        $name = $_POST['u_name'];
        // Delcaring email input
        $email = $_POST['email'];
        // Declaring password input
        $pass = $_POST['pass'];
        // Declaring validation error to false (trick to store data into database after no error occurs during the validation process)
        $validationError = "false";

        // Validating the username input
        // Validating to make sure only alphabets and numbers are entered for the username
        if(!preg_match("/^[a-zA-Z0-9]*$/", $name)) {
            $name_error = "Name must contain onlyalphabets and numbers";
            $validationError = "true"; 
        }
        // Validating the username field if empty
        elseif (empty($name)) {
            $empty_name = "Please enter a username";
            $validationError = "true"; 
        }

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
            $validationError = "true"; 
        }

        // Validating the password field
        // Validating to make sure the password is atleast 6 characters long
        if (strlen($pass)<6) {
            $pass_error = "Password must be a minimum of 6 characters";
            $validationError = "true"; 
        }
        
        // Making sure the password and confirm password matches
        if($pass != $_POST['c_pass']) {
            $cpass_error = "Password and Confirm Password doesn't match";
            $validationError = "true"; 
        }

        // Email Validation:
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_error = "Please enter a valid email id";
            $validationError = "true"; 
        }

        // Validating if users email already exists
        // SQL query for pulling the email from the database
            $em = "select email from users where email='$email';";
        // Retrieving the database
            $Data= mysqli_query($conn, $em);
        // Storing the database
            $Row = mysqli_fetch_assoc($Data);
        // SQL query results
        // Turning the array into a string
            $result = implode(",", $Row);

        if ($email === $result) {
            $email_exist = "Email already exists. Please choose another email";
        }

        // Storing user data into the database
        if($validationError == "false") {
            session_start();
            $_SESSION['user'] = $name;
            include_once("../includes/store_cust_data.php");
       }
       // Closing the mysql connection
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
                // if the username field has incorrect characters:
                if(isset($name_error)) echo "<br>".$name_error; 

                // if the username field is empty
                if(isset($empty_name)) echo "<br>".$empty_name;
                
                // if username already exists
                if(isset($name_exist)) echo "<br />".$name_exist ?>
        </p>

        <!-- Password input -->
        <p>
            <input type="password" name="pass" placeholder="Password" <?php 
                // if the password field has less than 6 characters:
                if(isset($pass_error)) echo "<br>".$pass_error;?>>
        </p>

        <!-- Confirm Password input -->
        <p>
            <input type="password" name="c_pass" placeholder="Confirm Password"<?php 
            // Confrim password error: 
            if(isset($cpass_error)) echo "<br>".$cpass_error?>>
        </p>

        <!-- Email input -->
        <p>
            <input type="text" name="email" placeholder="E-mail" value="<?php // Beginning of php tag
                // email sticky form
                if(isset($email)) echo $email;?>"> <!--end of php tag -->
                
                <?php 
                // if email error occurs
                if(isset($email_error)) echo "<br>".$email_error;
                
                // if email already exists
                if(isset($email_exist)) echo "<br />".$email_exist; ?>
        </p> 

        <!-- Submit button for form -->
        <p>
            <input type="submit" name="submit" value="Sign Up">
        </p>
    <!-- End of sign up form -->
    </form> 

</body>
</html>



