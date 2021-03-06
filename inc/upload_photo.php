<?php

include('SimpleImage.php');

$database_name = '';
$new_filename = strtolower(basename($_FILES['photo']['name']));
$new_filename = str_replace(" ", "_", $new_filename);

$target_path = "../uploads/photos/";
$target_path = $target_path . $new_filename;
//echo '$target_path: ' . $target_path . '<br/>';
if (file_exists("photos/" . $_FILES['photo']['name'])) {
    //echo 'A file with that name already exists!';
} else {
    if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_path)) {
        //echo "path: " . $target_path . "<br/>";
        //echo "The file " . basename($_FILES['photo']['name']) . " has been uploaded.";

        $x = $new_filename;
        $y = "2";
        $z = "uploads/photos/".$x;

        $mysqli = new mysqli("localhost", "root", "", "photobrawler");
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }

        $thumblink = "uploads/thumbnails/" . $x;

		$image = new SimpleImage();
		$image->load("../uploads/photos/" . $x);
		$image->resize(250, 250);
		$image->save("../uploads/thumbnails/" . $x); 

        // make a call in db.
        $be_public = 1;
        $stmt = $mysqli->prepare("INSERT INTO photos (owner_id, link, thumblink, public) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("issi", $y, $z, $thumblink, $be_public); 
        $stmt->execute();

        // $stmt->bind_result($x, $y);

    } else {
    
    	// Error codes, not in use at the moment.
    
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



   
                
                
    $mysqli->close();
}
$mysqlitt = new mysqli("localhost", "root", "", "photobrawler");
 $stmtt = $mysqlitt->prepare("SELECT photos.id FROM photos WHERE photos.link = ?");
        $stmtt->bind_param("s", $z); 


$stmtt->execute();
    /* bind result variables */
    $stmtt->bind_result($district);
        while ($row = $stmtt->fetch()) {

                $picId = $district;
                

                
            }
header('Location: /photobrawler/?photoUpload=completed&photo='.$picId);
