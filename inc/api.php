<?php

// This is the API...

//For photoqueries !


if($_SERVER['REQUEST_METHOD'] == "POST" || $_SERVER['REQUEST_METHOD'] ==  "PUT" || $_SERVER['REQUEST_METHOD'] ==  "DELETE" ){
  if($_GET['give_me'] === "photos"){
  do_photo_stuff();
  

  }else if($_GET['give_me'] === "accounts"){

    do_accounts_stuff();
  }


}else{

  if($_GET['give_me'] === "photos"){
  get_all_photos();


  }else if($_GET['give_me'] === "accounts"){

do_accounts_stuff();
  }
  
}  

function do_photo_stuff(){

  if($_SERVER['REQUEST_METHOD'] == "DELETE" ){
    $headers = apache_request_headers();
    foreach ($headers as $header => $value) {      
      if($header === 'id'){
        $modelDeleteID = $value;
      }else if($header === 'link'){
        $photo_link = '../'.$value;

      }else if($header === 'thumblink'){
        $thumb_link = '../'.$value;

      }


    }//End of if server delete
}else{//means it wasnt delete, probably POST OR PUT
  //Decode json and set variables
  $box_data = json_decode(file_get_contents('php://input'));
  $jsonid = $box_data->{'id'};
  $a = $box_data->{'name'};
  $b = $box_data->{'owner_id'};
  $c = $box_data->{'link'};
  $x = $box_data->{'thumblink'};
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
        $stmt = $mysqli->prepare("INSERT INTO photos (id, name, owner_id, link, description, public) VALUES (?, ?, ?, ?,, ? ?, ?)");
        $stmt->bind_param("isissi", $jsonid, $a, $b, $c, $x, $d, $e); 
        $stmt->execute();
        //Have to return the print
        print_r($box_data);
        break;
    case "PUT":
        $stmt = $mysqli->prepare("UPDATE photos SET name=?, owner_id=?, link=?, thumblink=?,description=?, public=? WHERE id=?");
        $stmt->bind_param("sisssii", $a, $b, $c, $x, $d, $e, $jsonid); 
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
        unlink($thumb_link);
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
      "SELECT id, name, owner_id, link, thumblink, description, public FROM photos");
     
    $stmt->execute();
    $stmt->bind_result($id, $name, $owner_id, $link, $thumblink, $description, $public);
    $result = array();
    while($row1 = $stmt->fetch()) {
      $arr = "{'id':".$id.", 'email': ".$name."}";
      $results['id'] = $id;
      $results['name'] = $name;
      $results['owner_id'] = $owner_id;
      $results['link'] = $link;
      $results['thumblink'] = $thumblink;
      $results['description'] = $description;
      $results['public'] = $public;
      array_push($result, $results);
          }
  print_r(json_encode($result));
  return json_encode($result);
}
//END OF PHOTOQUERIES

//START OF ACCOUNTQUERIES

function do_accounts_stuff(){
//should not be allowed
  if($_SERVER['REQUEST_METHOD'] == "DELETE" ){
    $headers = apache_request_headers();
    foreach ($headers as $header => $value) {      
      if($header === 'id'){
        $modelDeleteID = $value;
      }else if($header === 'link'){
        $photo_link = '../'.$value;

      }else if($header === 'thumblink'){
        $thumb_link = '../'.$value;

      }


    }//End of if server delete
}else{//means it wasnt delete, probably POST OR PUT
  //Decode json and set variables
  if($_SERVER['REQUEST_METHOD'] != "GET" ){
  $box_data = json_decode(file_get_contents('php://input'));
  $jsonid = $box_data->{'id'};
  $a = $box_data->{'email'};
  $b = $box_data->{'phonenumber'};
  $c = $box_data->{'street_address'};
  $d = $box_data->{'postal_code'};
  $e = $box_data->{'city'};
  $f = $box_data->{'province'};
  $g = $box_data->{'state'};
  $h = $box_data->{'country'};
  $i = $box_data->{'info'};
}
}
 //open dbconnection 
$mysqli = new mysqli("localhost", "root", "", "photobrawler");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
  }

//Switch for post or put or smthn else
  switch ($_SERVER['REQUEST_METHOD']){
    case "POST":
        $stmt = $mysqli->prepare("INSERT INTO accounts (id, email, phonenumber, street_address, postal_code, city, province, state, country, info) VALUES (?, ?, ?, ? ,? , ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssisssss", $jsonid, $a, $b, $c, $d, $e, $f, $g, $h, $i); 
        $stmt->execute();
        //Have to return the print
        print_r($box_data);
        break;
    case "PUT":
        $stmt = $mysqli->prepare("UPDATE accounts SET email=?, phonenumber=?, street_address=?, postal_code=?,city=?, province=?, state=?, country=?, info=? WHERE id=?");
        $stmt->bind_param("sssisssssi", $a, $b, $c, $d, $e, $f, $g, $h, $i, $jsonid); 
        $stmt->execute();
        //Have to return the print
        print_r($box_data);
        break;
    case "DELETE":
        $stmt = $mysqli->prepare("DELETE FROM accounts WHERE id=?");
        $stmt->bind_param("i", $modelDeleteID); 
        $stmt->execute();
        //Delete the file from directory
        unlink($photo_link);
        unlink($thumb_link);
        break;
    case "GET":
    $stmt = $mysqli->prepare(
      "SELECT id, email, phonenumber, street_address, postal_code, city, province, state, country, info FROM accounts");
     
    $stmt->execute();
    $stmt->bind_result($id, $email, $phonenumber, $street_address, $postal_code, $city, $province, $state, $country, $info);
    $result = array();
    while($row1 = $stmt->fetch()) {
      //$arr = "{'id':".$id.", 'email': ".$name."}";
      $results['id'] = $id;
      $results['email'] = $email;
      $results['phonenumber'] = $phonenumber;
      $results['street_address'] = $street_address;
      $results['postal_code'] = $postal_code;
      $results['city'] = $city;
      $results['province'] = $province;
      $results['state'] = $state;
      $results['country'] = $country;
      $results['info'] = $info;
      array_push($result, $results);
          }
  print_r(json_encode($result));
  return json_encode($result);
    break;
}
    //Id something went wrong
    if($stmt->error){
      printf("Error: %s.\n", $stmt->error);
    }
  
}

?>
