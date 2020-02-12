<?php
session_start();
require_once("searchService.php");
$searchService = searchService::getInstance();
//echo $_SESSION["USERNAME"];
?>
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
        <h2>Here are the searched users</h2>
        <table>
        <tr>
        <th>Username</th>
        <th>User email</th>
        <th>Registration date</th>
        </tr>
            <?php
                $name=$_POST["search-name"];
                //$query1=$_POST["search-email"];
                //$query2=$_POST["search-date"];
                //$searcharray = $searchService->searchUsers($query,$query1,$query2);
                $searcharray = $searchService->searchUsers($name);

                // $keys=array();

        
                // $keys = array_search($query, array_column($searcharray, 'name'));
                // $keys = array_search($query1, array_column($searcharray, 'email'));
                // $keys = array_search($query2, array_column($searcharray, 'registration'));
                    //print_r ($searcharray[$key]['name']);


                
                for($x=0; $x < sizeof($searcharray);$x++)
                {
                    echo"<tr>";
                    echo "<td>" . $searcharray[$x]['name'] . "</td>";
                    echo "<td>" . $searcharray[$x]['email'] . "</td>";  
                    echo "<td>" . $searcharray[$x]['registration_date'] . "</td>";
                    echo"</tr>";
                    
                     
                }
                
               
            ?>
        </table>
               
    </body>
</html>