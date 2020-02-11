<?php
session_start();
echo ("Welcome ") . $_SESSION['USER'] . "!";
require_once("searchService.php");
$searchService = searchService::getInstance();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Dashboard</title>
        <link rel="stylesheet" href="main.css" />
    </head>
    <body>
        <form action="searchpage.php" method ="post">
            Username<input type="text" name="search-name">
            Useremail<input type="text" name="search-email">
            Register date<input type="text" name="search-date">
            <button type="submit" name="search-button"> Search user</button>  
        </form>

        <form action="controller.php" method="post">
            <button type="submit" name="logout-btn">Logout</button>
        </form>
        
    </body>