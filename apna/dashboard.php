<?php
session_start();
echo("Successfull!");
require_once("searchService.php");
$searchService = searchService::getInstance();
//echo $_SESSION["USERNAME"];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Dashboard</title>
        <link rel="stylesheet" href="main.css" />
    </head>
    <body>
        <form action="controller.php" method ="post">
            <input type="text" name="searchuser">
            <button type="submit" name="search-button"> Search user</button>  
        </form>
        
    </body>