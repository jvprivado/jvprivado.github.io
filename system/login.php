<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Authorization, Origin');
header('Access-Control-Allow-Methods:  POST, PUT, GET');


$n = 20;

function getName($n) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
 
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
 
    return $randomString;
}
 


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



$sql = "SELECT * FROM users where email=? and password=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email,$pw);

$email = $_POST["email"];
$pw = $_POST["pw"];
$stmt->execute();

$result =  $stmt->get_result();

  // output data of each row
 $count = 0;
  while($row = $result->fetch_assoc()) {
   
	$count +=1;
  }
  
 
  if($count>0){
	  echo getName($n);
  }
  
  
  
  else{
echo "Invalid";
  }

?>