<?php
include_once("../includes/mysql.inc.php");

$u_name = $_POST['u_name'];

$sql = "insert into users (un) values (''$u_name);";

mysql_query($conn, $sql);

mysqli_close($conn);

header("location: ../PHP/member.php");