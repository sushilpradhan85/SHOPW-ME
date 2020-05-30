<?php
 // Validation process
 if(isset($_POST['submit'])) {
    
    $name = $_POST['u_name'];
    $pass = $_POST['pass'];
    $email = $_POST['email'];
    
    // Validating the username input
    // Validating to make sure only alphabets and numbers are entered for the username
    if(!preg_match("/^[a-zA-Z0-9]*$/", $name)) {
        $name_error = "Name must contain onlyalphabets and numbers";
    }
    // Validating the username field if empty
    elseif (empty($name)) {
        $empty_name = "Please enter a username";
    }
         
    // Validating the password field
    // Validating to make sure the password is atleast 6 characters long
    if (strlen($pass)<6) {
        $pass_error = "Password must be a minimum of 6 characters";
    }
    
    // Confirming Password
    if($pass != $_POST['c_pass']) {
        $cpass_error = "Password and Confirm Password doesn't match";
    }

    // Email Validation:
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Please enter a valid email id";
    }
} else {
    include_once("signup.inc.php");
}
?>