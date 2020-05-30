<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<table>
<tr>
<th>Id</th>
<th>Username</th>
<th>Password</th>
</tr>
<?php
    include_once("includes/mysql.inc.php");
    $query = "select * from tbl;";
    if ($result = mysqli_query($conn, $query)) {
        echo "I am here <br />";
        // if(mysqli_num_rows($result) > 0) {
        //     // echo "Hello World";
        //     while($row = mysqli_fetch_assoc($result)) {
        //         echo "<tr><td>" . $row['id'] . 
        //              "</td><td>" . $row['username'] .
        //              "</td><td>" . $row{'password'} . "</td></tr>";
        //     }
        // }
    }
?>   
</table> 
</body>
</html>

