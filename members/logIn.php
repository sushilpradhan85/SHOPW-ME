<?php
    // Include for nav bar
    include_once("../includes/navbars/login.nav.php");
    // Include for connecting to the database
    include_once("../includes/mysql.inc.php");

    // Validating user information
    if (isset($_POST['submit'])) {
        // declaring user inputs
        $name = $_POST['u_name'];
        $pass = $_POST['pass'];
        // // Storing user data into the database
        $validationError = false;
        // $attempt = 0;

        // SQL for username:
        $un = "select un from users where un='$name';";
        $data = mysqli_query($conn, $un);
        $row = mysqli_fetch_assoc($data);
        $result = implode(",", $row);

        // SQL for user password:
        $pwd = "select pwd from users where un ='$name';";
        $data1= mysqli_query($conn, $pwd);
        $row1 = mysqli_fetch_assoc($data1);
        $result1 = implode(",", $row1);
        
        // Verifying if the username and/or password is empty
        if(empty($name) || empty($pass)) { 
            $validationError = true;
            echo "Please enter your username and/or password";
        }
        
        // Verifying the username:
        elseif($name != $result) {
            $validationError = true;
            echo "Invalid username and/or password";
            // Log in attempt 
        }

        // Verifying the password: 
        elseif($pass != $result1) {
            $validationError = true;
            echo "Invalid username and/or password";
        }
        
        // Fowarding to members page
        if($validationError == false) {
            session_start();
            $_SESSION['user'] = $name;
            mysqli_close ($conn);
            header("location:member.php");
        }
    }

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- Log in form for users -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <!-- Username field -->
        <p>
            <input type="text" name="u_name" placeholder="username">
        </p>

        <!-- Password field -->
        <p>
            <input type="password" name="pass" placeholder="password">
        </p>
        <p>
            <input type="submit" name="submit" value="Log In">
        </p>

    </form>
</body>
</html>