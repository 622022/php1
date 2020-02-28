<!-- not using the include or require because crontab requires absolute path -->


<?php
define('DB_HOST', 'vlvlnl1grfzh34vj.chr7pe7iynqr.eu-west-1.rds.amazonaws.com');
define('DB_USER', 'uluyb2gfzzb66f8y');
define('DB_PASS', 'y2rwwwvhvynrimjb');
define('DB_DB', 'fjvme7pj0jur9p39');

// Create connection
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DB);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO log (log_info)
VALUES ('cron logged on')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
?>