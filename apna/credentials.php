<?php
$servername = "localhost";
$username = "s622022_user";
$password = "Phppassword101";
$databasename = "s622022_db";

// Create connection
$con = mysqli_connect($servername, $username, $password, $databasename);

// Check connection
if (!$con) {-+

    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>
