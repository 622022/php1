<?php
require_once("dataService.php");
$dataService = dataService::getInstance();
$result=$dataService->getData();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Dashboard</title>
        <link rel="stylesheet" href="css/main.css" />
    </head>
    <body>
        
        <table>
        <tr>
        <th>User id</th>
        <th>User name</th>
        <th>User email</th>
        </tr>
            <?php
                
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
        <form action="csvexport.php" method="post">
            <input type="submit" name="CSV-select" value="select CSV">
            <br>
            <input type="submit" name="XLS-select" value="select XLS">
        </form>

<?php

// Connection


if (isset($_POST["CSV-select"])) {
    // Enable to download this file
    $filename = "sampledata.csv";

    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    header("Content-Type: text/csv");

    $file = fopen("php://output", 'w');
    $header=array("id", "name", "email");
    fputcsv($file, $header);

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

    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    header("Content-Type: application/vnd.ms-excel");

    $file = fopen("php://output", 'w');
    $header=array("id", "name", "email");
    fputcsv($file, $header);
    $isPrintHeader=false;
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


?>