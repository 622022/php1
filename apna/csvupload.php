<form id="frm-upload" action="" method="post"
    enctype="multipart/form-data">
    <div class="form-row">
        <div>Choose file:</div>
        <div>
            <input type="file" class="file-input" name="file-input">
        </div>
    </div>

    <div class="button-row">
        <input type="submit" id="btn-submit" name="upload"
            value="Upload">
    </div>
</form>
<?php if(!empty($response)) { ?>
<div class="response <?php echo $response["type"]; ?>
    ">
    <?php echo $response["message"]; ?>
</div>
<?php }?>


<?php
if(!empty(isset($_POST["upload"]))) {
    if (($fp = fopen($_FILES["file-input"]["tmp_name"], "r")) !== FALSE) {
    ?>
<table class="csvtohtmltable" width="100%" border="1" cellspacing="0">
<?php
    $i = 0;
    while (($row = fgetcsv($fp)) !== false) {
        $class ="";
        if($i==0) {
           $class = "header";
        }
        ?>
    <tr>
            <td class="<?php echo $class; ?>"><?php echo $row[0]; ?></td>
            <td class="<?php echo $class; ?>"><?php echo $row[1]; ?></td>
            <td class="<?php echo $class; ?>"><?php echo $row[2]; ?></td>
        </tr>
    <?php
        $i ++;
    }
    fclose($fp);
    ?>
    </table>
<?php
    $response = array("type" => "success", "message" => "CSV is converted to HTML successfully");
    } else {
        $response = array("type" => "error", "message" => "Unable to process CSV");
    }
}
?>
</div>
<?php if(!empty($response)) { ?>
<div class="response <?php echo $response["type"]; ?>
    ">
    <?php echo $response["message"]; ?>
</div>
<?php } ?>