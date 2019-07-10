<?php

$servername = "localhost:3306";
$username = "root";
$password = "root";
$dbname = "userdatabase";
$tablename = "userInfo";
  
$conn = new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error) {
  die("Connection Failed :" . $conn->connect_error);
}


session_start();

$uname = mysqli_real_escape_string($conn, $_REQUEST['uname']);
$pass = mysqli_real_escape_string($conn, $_REQUEST['pass']);

$_SESSION['login_user']=$uname; 

$check  = "select * from $tablename where UserName='$uname' and Pass = '$pass'";
$result = $conn->query($check);

  if ($result->num_rows <= 0) {
  echo "Record Does Not Exist";
    }

  else if($result->num_rows > 0){ 
 

  echo " ";

  }

  else{
  echo "Error: " .$sql."<br>".$conn->connect_error;
  }

  $conn->close();
?>