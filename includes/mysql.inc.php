<?php // Code for connecting to mysql database. 
$dbs = "localhost";
$un = "root";
$pwd = "";
$dbn = "test";
// $dbn = "shopwme";

$conn = mysqli_connect($dbs, $un, $pwd, $dbn);
// echo "I am here";
