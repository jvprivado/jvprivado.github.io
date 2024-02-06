<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Authorization, Origin');
header('Access-Control-Allow-Methods:  POST, PUT, GET');



$json = file_get_contents('php://input');

// Converts it into a PHP object

$array = array ();

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

$dic = [];
$dic["done"] = "0";
$dic["inactive"] = "0";
$dic["pending"] = "0";



 foreach($dic as $name => $value) {
      
   

$sql = "SELECT SUM(howmany) FROM stats where user='$un' and kind='$name'";

//$stmt->execute();
$result= $conn->execute_query($sql);

foreach($result as $row){
	 $dic[$name] = $row["SUM(howmany)"];
	
}

   }

$results= $dic;

  
header("Content-Type: application/json");
echo json_encode($results);
exit();



?>