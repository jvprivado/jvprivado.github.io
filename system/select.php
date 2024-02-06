<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Authorization, Origin');
header('Access-Control-Allow-Methods:  POST, PUT, GET');



$json = file_get_contents('php://input');

// Converts it into a PHP object


$servername = "localhost";
$username = "llogixit";
$password = "123wet123";
$dbname = "statsapp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$data = json_decode($json);
$un = $data->user;
$kind = $data->kind;
$values= $data->data;

$sql = "SELECT * FROM stats where kind='$kind' and user='$un' and  whn IN  (".implode(",",array_map(fn()=>"?",$values)).") order by whn ASC";

//$stmt->execute();
$result= $conn->execute_query($sql, $values);


  // output data of each row
 $count = 0;
 $results = array();
 
 foreach ($result as $row) {

   array_push($results,array("whn"=>$row["whn"],"val"=>$row["howmany"]));
	$count +=1;
  }
  
header("Content-Type: application/json");
echo json_encode($results);
exit();



?>