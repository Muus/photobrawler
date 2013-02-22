<?php

echo "name: " . $_FILES["photo"]["name"] . "<br/>";
echo "tmp_name: " . $_FILES["photo"]["tmp_name"] . "<br/>";
echo "type: " . $_FILES["photo"]["type"] . "<br/>";
echo "size: " . $_FILES["photo"]["size"] . "<br/>";

echo "basename: " . basename($_FILES['photo']['name']) . "<br/>";

$new_filename = strtolower(basename($_FILES['photo']['name']));
$new_filename = str_replace(" ", "_", $new_filename);

echo "new_filename: " . $new_filename . "<br/>";

$target_path = "photos/";
$target_path = $target_path . $new_filename; 

if (file_exists("photos/" . $_FILES['photo']['name'])) {
    echo 'A file with that name already exists!';
} else {
    if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_path)) {
        echo "The file " . basename($_FILES['photo']['name']) . " has been uploaded.";


            /* Musens */
//$box_data = json_decode(file_get_contents('php://input'));
  $x = $new_filename;
  $y = "2";

  $z = "inc/photos/".$target_path;

  //$x = $_GET['name'];
  //$y = $_GET['pass'];
  
$mysqli = new mysqli("localhost", "root", "", "photobrawler");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
  }
  // make a call in db.

 $stmt = $mysqli->prepare("INSERT INTO photos (name, owner_id, link) VALUES (?, ?, ?)");
  $stmt->bind_param("sis", $x, $y, $z); 
     
    
    
    $stmt->execute();

    //$stmt->bind_result($x, $y);
    






            /* END */
            } else {
        echo "There was an error uploading the file, please try again!<br/>";
        echo "error_code = ";
        if ($_FILES['photo']['error'] == 1) {
            echo 'Value: 1; The uploaded file exceeds the upload_max_filesize directive in php.ini.';
        } else if ($_FILES['photo']['error'] == 2) {
            echo 'Value: 2; The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.';
        } else if ($_FILES['photo']['error'] == 3) {
            echo 'Value: 3; The uploaded file was only partially uploaded.';
        } else if ($_FILES['photo']['error'] == 4) {
            echo 'Value: 4; No file was uploaded.';
        } else if ($_FILES['photo']['error'] == 5) {
            echo 'Value: 5; (?) Massive unknown error.';
        } else if ($_FILES['photo']['error'] == 6) {
            echo 'Value: 6; Missing a temporary folder. Introduced in PHP 4.3.10 and PHP 5.0.3.';
        } else if ($_FILES['photo']['error'] == 7) {
            echo 'Value: 7; Failed to write file to disk. Introduced in PHP 5.1.0.';
        } else if ($_FILES['photo']['error'] == 8) {
            echo 'Value: 8; A PHP extension stopped the file upload. PHP does not provide a way to ascertain which extension caused the file upload to stop; examining the list of loaded extensions with phpinfo() may help. Introduced in PHP 5.2.0.';
        }    
    }
}
