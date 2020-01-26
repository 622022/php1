<?php session_start() ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Welcome Home</title>
        <link rel="stylesheet" href="css/main.css" />
    </head>
    <body>
        <div class="form">
            <p>Welcome <?php echo($_SESSION['USER']); ?>!</p>
            <p>This is a secure area.</p>
            <p><a href="dashboard.php">Dashboard</a></p>
            <a href="logout.php">Logout</a>
    </body>
</html>