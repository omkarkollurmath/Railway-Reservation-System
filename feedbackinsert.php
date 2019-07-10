<?php

 $servername = "localhost:3306";
  $username = "root";
  $password = "root";
  $dbname = "userdatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$mysqli = new mysqli($servername, $username, $password, $dbname);


extract($_POST);


$sql = "INSERT into rating1 (name,rating,message) VALUES('" . $name . "','" . $rating . "','" . $message . "')";


$success = $mysqli->query($sql);


if (!$success) {
    die("Couldn't enter data: ".$mysqli->error);
}


echo "Thank You For Contacting Us ";
echo "<br> <br><a href='newhome.php'> Home </a>";


$conn->close();


?>