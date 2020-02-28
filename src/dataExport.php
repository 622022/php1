<?php
session_start();
require_once("../service/loginservice.php");
require_once("../service/dataService.php");
$loginService = loginService::getInstance();
$dataService = dataService::getInstance();
$result=$dataService->getData();
if ($loginService->checkSession())
{

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Export Page</title>
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
        
        <table>
        <tr>
        <th>User id</th>
        <th>User name</th>
        <th>User email</th>
        </tr>
            <?php
                //displaying the data to write to csv/excel file.
                foreach($result as $row)
                {
                    echo"<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";  
                    echo "<td>" . $row["email"] . "</td>";
                    echo"</tr>";
                    
                     
                }
                
               
            ?>
        </table>
        <br>
        <br>
        <h1>How do you want to export your file?</h1>
        <form action="dataExport.php" method="post">
            <input type="submit" name="CSV-select" value="select CSV">
            <br>
            <input type="submit" name="XLS-select" value="select XLS">
        </form>

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

<?php

// Connection


if (isset($_POST["CSV-select"])) {
    // Enable to download this file
    $filename = "sampledata.csv";

    // setting the file type to header for download
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    header("Content-Type: text/csv");

    // get the uploaded file and open it

    $file = fopen("php://output", 'w');
    $header=array("id", "name", "email");
    fputcsv($file, $header);

    // //iterate through the file to display the data
    foreach($result as $row)
    {
    $data = array();
    $data[] = $row["id"];
    $data[] = $row["name"];
    $data[] = $row["email"];
    fputcsv($file, $data);
    }
    fclose($file);
}

if (isset($_POST["XLS-select"])) {
    // Enable to download this file
    $filename = "sampledata.xls";
    
    // get the uploaded file and open it
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    header("Content-Type: application/vnd.ms-excel");

    $file = fopen("php://output", 'w');
    $header=array("id", "name", "email");
    fputcsv($file, $header);
    $isPrintHeader=false;

    // //iterate through the file to display the data

    foreach($result as $row)
    {
        if (! $isPrintHeader) {
            echo implode("\t", array_keys($row)) . "\n";
            $isPrintHeader = true;
        }
        echo implode("\t", array_values($row)) . "\n";
    }
    
    //fclose($file);
}
}else{
    Echo("You are not logged in!<a href=\"../index.php\">click here to login again</a>.");
} 
?>
