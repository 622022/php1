
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Dashboard</title>
        <link rel="stylesheet" href="css/main.css" />
    </head>
    <body>
        <header>
            <div class="topnav">
                <a class="active" href="dashboard.php">Home</a>
                <a href="PHP 2">PHP2</a>
                <a href="changeinfo.php">Update info</a>
                </div>
        </header>
        <?php
        session_start();
        echo ("Welcome ") . $_SESSION['USER'] . "!";
        require_once("searchService.php");
        $searchService = searchService::getInstance();
        ?>
        <h2>Usres can be searched here!</h2>
        <form action="searchpage.php" method ="post">
            Username<input type="text" name="search-name" placeholder="Name to be searched" required>
            <!-- Useremail<input type="text" name="search-email">
            Register date<input type="text" name="search-date"> -->
            <button type="submit" name="search-button"> Search user</button>  
        </form>

        <form action="controller.php" method="post">
            <button type="submit" name="logout-btn">Logout</button>
        </form>
        
    </body>
</html>