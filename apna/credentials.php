<?php

  // Fill in your own credentials here then rename this file to 'credentials.php'
     define('DB_HOST', '77.173.204.121');
     define('DB_USER', 's622022_user');
     define('DB_DB', 's622022_db');
     define('DB_PASSWORD', 'Phppassword101');
     define('DB_PORT','3306');

     $conn = new mysqli(DB_HOST, DB_USER, DB_DB,DB_PASSWORD);


    
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";
?>