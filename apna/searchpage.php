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
                //$searcharray = $searchService->searchUsers($query,$query1,$query2);
                $searcharray = $searchService->searchAllUsers();

                $keys=array();

        
                $keys = array_search($query, array_column($searcharray, 'name'));
                $keys = array_search($query1, array_column($searcharray, 'email'));
                $keys = array_search($query2, array_column($searcharray, 'registration'));
                    //print_r ($searcharray[$key]['name']);


                
                for($x=0; $x < sizeof($keys);$x++)
                {
                    echo"<tr>";
                    echo "<td>" . $searcharray[$key[$x]]['name'] . "</td>";
                    echo "<td>" . $searcharray[$key[$x]]['email'] . "</td>";  
                    echo "<td>" . $searcharray[$key[$x]]['registration_date'] . "</td>";
                    echo"</tr>";
                    
                     
                }
                
               
            ?>
        </table>