<?php 
// Included file for connecting to the database
include_once('mysql.inc.php');

// Declaring the name inputs from the form to write to the database
$email = $_POST['email'];
$u_name = $_POST['u_name'];
$pass = $_POST['pass'];

// SQL query to add the user into the database
$sql = "insert into users
(un, pwd, email) values
('$u_name', '$pass', '$email');";

// Storing data to the database
mysqli_query($conn, $sql);

// Closing the mysql database conenction
mysqli_close($conn);


// Fowarding to another page after successful signup
header("location: ../members/member.php");
