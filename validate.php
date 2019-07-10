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

$uname = mysqli_real_escape_string($conn, $_REQUEST['uname']);
$pass = mysqli_real_escape_string($conn, $_REQUEST['pass']);
$fname = mysqli_real_escape_string($conn, $_REQUEST['fname']);
$gender = mysqli_real_escape_string($conn, $_REQUEST['gender']);
$dob = mysqli_real_escape_string($conn, $_REQUEST['dob']);
$email = mysqli_real_escape_string($conn, $_REQUEST['email']);
$phno = mysqli_real_escape_string($conn, $_REQUEST['phno']);
$pin = mysqli_real_escape_string($conn, $_REQUEST['pin']);
$state = mysqli_real_escape_string($conn, $_REQUEST['state']);


$check  = "select * from $tablename where UserName like '$uname'";
$result = $conn->query($check);

	if ($result->num_rows > 0) {
	echo "Record Already Exists";
    }

	else{

	$sql = "INSERT into $tablename VALUES ('$uname','$pass','$fname','$gender','$dob','$email','$phno','$pin','$state')";

	if($conn->query($sql) == true){	
	echo "<script>
	alert('Record Created Successfully');
	window.location.href='userlogin.html';
	</script>";
	}

	else{
	echo "Error: " .$sql."<br>".$conn->connect_error;
	}


	}

	$conn->close();
?>