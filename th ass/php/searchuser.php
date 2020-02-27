<?php
    session_start();
    require_once("searchservice.php");
    $searchService = searchService::getInstance();

    $query = $_POST["query"];
?>

<h1>Users that match '<?php echo($query) ?>'.</h1>
<table>
    <?php 
        $userArray = $searchService->searchUsers($query);
        for ($i=0; $i < sizeof($userArray); $i++) { 
            echo("<tr><th>" . $userArray[$i]["email"] . "</tr></th>");
        }
    ?>
</table>
<a href="../index.php">Return to index</a>