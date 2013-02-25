<?php

// This is the API...

if($_SERVER['REQUEST_METHOD'] == "POST" || $_SERVER['REQUEST_METHOD'] ==  "PUT" || $_SERVER['REQUEST_METHOD'] ==  "DELETE" ){
  do_photo_stuff();
}else{
  get_all_photos();
}  

function do_photo_stuff(){

  if($_SERVER['REQUEST_METHOD'] == "DELETE" ){
    $headers = apache_request_headers();
    foreach ($headers as $header => $value) {      
      if($header === 'id'){
        $modelDeleteID = $value;
      }else if($header === 'link'){
        $photo_link = '../'.$value;
      }
    }//End of if server delete
}else{//means it wasnt delete, probably POST OR PUT
  //Decode json and set variables
  $box_data = json_decode(file_get_contents('php://input'));
  $jsonid = $box_data->{'id'};
  $a = $box_data->{'name'};
  $b = $box_data->{'owner_id'};
  $c = $box_data->{'link'};
  $d = $box_data->{'description'};
  $e = $box_data->{'public'};
}
 //open dbconnection 
$mysqli = new mysqli("localhost", "root", "", "photobrawler");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
  }

//Switch for post or put or smthn else
  switch ($_SERVER['REQUEST_METHOD']){
    case "POST":
        $stmt = $mysqli->prepare("INSERT INTO photos (id, name, owner_id, link, description, public) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isissi", $jsonid, $a, $b, $c, $d, $e); 
        $stmt->execute();
        //Have to return the print
        print_r($box_data);
        break;
    case "PUT":
        $stmt = $mysqli->prepare("UPDATE photos SET name=?, owner_id=?, link=?, description=?, public=? WHERE id=?");
        $stmt->bind_param("sissii", $a, $b, $c, $d, $e, $jsonid); 
        $stmt->execute();
        //Have to return the print
        print_r($box_data);
        break;
    case "DELETE":
        $stmt = $mysqli->prepare("DELETE FROM photos WHERE id=?");
        $stmt->bind_param("i", $modelDeleteID); 
        $stmt->execute();
        //Delete the file from directory
        unlink($photo_link);
        break;
}
    //Id something went wrong
    if($stmt->error){
      printf("Error: %s.\n", $stmt->error);
    }
  
}

function get_all_photos(){
  
  $mysqli = new mysqli("localhost", "root", "", "photobrawler");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
  }
  

 $stmt = $mysqli->prepare(
      "SELECT id, name, owner_id, link, description, public FROM photos");
     
    $stmt->execute();
    $stmt->bind_result($id, $name, $owner_id, $link, $description, $public);
    $result = array();
    while($row1 = $stmt->fetch()) {
      $arr = "{'id':".$id.", 'email': ".$name."}";
      $results['id'] = $id;
      $results['name'] = $name;
      $results['owner_id'] = $owner_id;
      $results['link'] = $link;
      $results['description'] = $description;
      $results['public'] = $public;
      array_push($result, $results);
          }
  print_r(json_encode($result));
  return json_encode($result);
}


?>
