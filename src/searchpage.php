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
                // reading the searchitem and calling search service to locate it and then display it
                $name=$_POST["search-name"];
            
                $searcharray = $searchService->searchUsers($name);

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

        <form action="javascript:void(0);" method="post" name="logout-form" Id="logout-form">
            <button id="logout-button"type="submit" name="logout-btn" onclick="Confirm()">Logout </button>
        </form>

        <script>
        function Confirm() {
            var r = confirm("You will be logged out. \n Are you sure?");
            if (r == true) {
                document.getElementById("logout-form").action = "../controller/controller.php";
            } else {
                header("Location: dashboard.php");
            }
        }
        </script>
               
    </body>
</html>
<?php } else{
    Echo("You are not logged in!<a href=\"../index.php\">click here to login again</a>.");
} 
?>