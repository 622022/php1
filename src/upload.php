<?php
namespace Verot\Upload;
session_start();
include('../vendor/autoload.php');


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Upload image page</title>
        <link rel="stylesheet" href="../css/main.css" />
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
    </body>
</html>

<?php
//namespace Verot\Upload;

error_reporting(E_ALL);

// we first include the upload class, as we will need it here to deal with the uploaded file
include('../vendor/autoload.php');

// set variables
$dir_dest = (isset($_GET['dir']) ? $_GET['dir'] : 'tmp');
$dir_pics = (isset($_GET['pics']) ? $_GET['pics'] : $dir_dest);

$log = '';

$action = (isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : ''));


if ($action == 'multiple') {


  // as it is multiple uploads, we will parse the $_FILES array to reorganize it into $files
  $files = array();
  foreach ($_FILES['my_field'] as $k => $l) {
      foreach ($l as $i => $v) {
          if (!array_key_exists($i, $files))
              $files[$i] = array();
          $files[$i][$k] = $v;
      }
  }

  // now we can loop through $files, and feed each element to the class
  foreach ($files as $file) {

      // we instanciate the class for each element of $file
      $handle = new Upload($file);

      // then we check if the file has been uploaded properly
      // in its *temporary* location in the server (often, it is /tmp)
      if ($handle->uploaded) {

          // now, we start the upload 'process'. That is, to copy the uploaded file
          // from its temporary location to the wanted location
          //NOTE: both the uploaded file and the edited version will be in the /tmp folder
          $handle->process($dir_dest);

          $handle->image_resize            = true;
          $handle->image_ratio_y           = true;
          $handle->image_x                 = 300;
          $handle->image_reflection_height = '25%';
          $handle->image_contrast          = 50;
          $handle->image_rotate          = '90';

          $handle->process($dir_dest);
  

          // we check if everything went OK
        if ($handle->processed) {
            // everything was fine !
            echo '<p class="result">';
            echo '  <b>File uploaded and processed with success!</b><br />';
            echo '  <img src="'.$dir_pics.'/' . $handle->file_dst_name . '" />';
            $info = getimagesize($handle->file_dst_pathname);
            echo '  File: <a href="'.$dir_pics.'/' . $handle->file_dst_name . '">' . $handle->file_dst_name . '</a><br/>';
            echo '   (' . $info['mime'] . ' - ' . $info[0] . ' x ' . $info[1] .' - ' . round(filesize($handle->file_dst_pathname)/256)/4 . 'KB)';
            echo '</p>';
        } else {
            // one error occured
            echo '<p class="result">';
            echo '  <b>File not uploaded to the wanted location</b><br />';
            echo '  Error: ' . $handle->error . '';
            echo '</p>';
        }
        // we delete the temporary files
        $handle-> clean();

        
      } else {
          // if we're here, the upload file failed for some reasons
          // i.e. the server didn't receive the file
          echo '<p class="result">';
          echo '  <b>File not uploaded on the server</b><br />';
          echo '  Error: ' . $handle->error . '';
          echo '</p>';
      }

      $log .= $handle->log . '<br />';
  }

}

?>
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

