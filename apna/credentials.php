<?php
$servername = "77.173.204.121";
$username = "s622022_user";
$password = "Phppassword101";
$databasename = "users";

// Create connection
$con = mysqli_connect($servername, $username, $password, $databasename);

// Check connection
if (!$con) {-+
  
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>
