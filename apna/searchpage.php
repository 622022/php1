<?php
session_start();
require_once("searchService.php");
$searchService = searchService::getInstance();
//echo $_SESSION["USERNAME"];
?>
<h2>USERS</h2>
        <table>
        <tr>
        <th>Username</th>
        <th>User email</th>
        <th>Registration date</th>
        </tr>
            <?php
                $query=$_POST["search-name"];
                $query1=$_POST["search-email"];
                $query2=$_POST["search-date"];
                $searcharray = $searchService->searchUsers($query,$query1,$query2);
                //$searcharray = $searchService->searchAllUsers();
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