<?php

// This is the API, 2 possibility show the user list, and show a specifique user by action.
include('../inc/dbClass.php');

$db = new Db();

$db->connector();

/*function myPlaylists(){

$mysqli = new mysqli("localhost", "root", "", "diablofy");
  $stmt = $mysqli->prepare(
      "SELECT playlists.name, playlists.id FROM playlists
      LEFT JOIN users_playlists ON (users_playlists.playlistid=playlists.id)
      WHERE users_playlists.userid=?
      ");
    $stmt->bind_param( "i", $userid); 
    $stmt->execute();
    $stmt->bind_result($playlistName, $plistId);
    while($row1 = $stmt->fetch()) {
      echo '<li value="'.$plistId.'" name="plistID">'.$playlistName.'</li>';
    }

}*/
if($_SERVER['REQUEST_METHOD'] == "POST"){
  save_user();
}else{
  get_user_list();
}  
function save_photo()
{
  $box_data = json_decode(file_get_contents('php://input'));
  $x = $box_data->{'email'};
  $y = $box_data->{'password'};
  
  //$x = $_GET['name'];
  //$y = $_GET['pass'];
  
$mysqli = new mysqli("localhost", "root", "", "photobrawler");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
  }
  // make a call in db.

 $stmt = $mysqli->prepare("INSERT INTO photos (name, owner_id, link, description, public) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("ss", $x, $y); 
     
    
    
    $stmt->execute();

    //$stmt->bind_result($x, $y);
    print_r($box_data);

  
}

/*function get_user_by_id($id)
{
  $user_info = array();
$mysqli = new mysqli("localhost", "root", "", "photobrawler");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
  }
  // make a call in db.

 $stmt = $mysqli->prepare(
      "SELECT accounts.id, email FROM accounts");
     
    $stmt->execute();
    $stmt->bind_result($id, $name);
    while($row1 = $stmt->fetch()) {
      echo '<li value="'.$id.'" name="plistID">'.$name.'</li>';
    }

  return $user_info;
}*/

function get_user_list()
{
  
  $mysqli = new mysqli("localhost", "root", "", "photobrawler");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
  }
  // make a call in db.

 $stmt = $mysqli->prepare(
      "SELECT id, name, owner_id, link, description, public FROM photos");
     
    $stmt->execute();
    $stmt->bind_result($id, $name, $owner_id, $link, $description, $public);
    $result = array();
    while($row1 = $stmt->fetch()) {
      $arr = "{'id':".$id.", 'email': ".$name."}";
      //$arr = json_encode($arr, JSON_FORCE_OBJECT);
      $results['id'] = $id;
      $results['name'] = $name;
      $results['owner_id'] = $owner_id;
      $results['link'] = $link;
      $results['description'] = $description;
      $results['public'] = $public;
      array_push($result, $results);
          }
 
  //print_r($user_list);
  print_r(json_encode($result));
  
  
    //$post_data = json_encode(array('item' => $post_data), JSON_FORCE_OBJECT);
  return json_encode($result);
}


?>