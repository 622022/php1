<?php
session_start();
require_once("../service/searchService.php");
require_once("../service/loginservice.php");
$searchService = searchService::getInstance();
$loginService = loginService::getInstance();
if ($loginService->checkSession())
{
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Search Page</title>
        <link rel="stylesheet" href="../css/main.css" />
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    </head>
    <body>
        <header>
            <!--Navigation bar-->
            <div id="nav-placeholder">

            </div>

            <script>
            $(function(){
            $("#nav-placeholder").load("nav.html");
            });
            </script>
            <!--end of Navigation bar-->
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
<?php } else{
    Echo("You are not logged in!<a href=\"../index.php\">click here to login again</a>.");
} 
?>