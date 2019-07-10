<?php

session_start();



if(isset($_POST['tno']) && isset($_POST['tname']))
{

	$_SESSION['sname'] = $_POST['StationName'];
	$_SESSION['scode'] = $_POST['StationCode'];
	$_SESSION['source'] = $_POST['src'];
	$_SESSION['destination'] = $_POST['dest'];
	$_SESSION['arr'] = $_POST['ArrTime'];
	$_SESSION['dep'] = $_POST['DeptTime'];

	$servername = "localhost:3306";
	$username = "root";
	$password = "root";
	$dbname = "userdatabase";

  
$conn = new mysqli($servername,$username,$password,$dbname);




if($conn->connect_error) {
  die("Connection Failed :" . $conn->connect_error);
}

	$i = 1;
	foreach($_SESSION['sname'] as $a => $b){ 

	     echo $_SESSION['sname'][$a];
	     echo $_SESSION['scode'][$a];
	 	
	

	$sql1 = "INSERT INTO stations (Station_Id,Station_Name,Station_code) select count(*)+1,'".$_SESSION['sname'][$a]."', '".$_SESSION['scode'][$a]."' from stations limit 1 ";

	$result1 = mysqli_query($conn, $sql1);		

	

	$sql2 = "select count(*) as count from timepass";
    $result2 = $conn->query($sql2);

	$row = $result2->fetch_assoc();
    $sql = "INSERT into timepass (TrainId,TrainNo,TrainName,TrainSrcId,TrainDestId) select '".$row['count']."'+1,'".$_POST['tno']."','".$_POST['tname']."',s.Station_Id,s1.Station_Id from timepass t,stations s,stations s1 where s.Station_Id = (select s.Station_Id from stations s where s.Station_Name like '".$_SESSION['source']."' and s.Station_code like ) and s1.Station_Id = (select s1.Station_Id from stations s1 where s1.Station_Name like '".$_SESSION['destination']."') limit 1";


	$result = $conn->query($sql);

	

				

				
				$sql2 = "select count(*) as count from timepass";
                $result2 = $conn->query($sql2);

 	            $row = $result2->fetch_assoc();	

				/*$sql3 = "select count(*) as count from routetable where TrainId = (select t.TrainId from timepass t where t.TrainName like '".$_POST['tname']."'";
                $result3 = $conn->query($sql2);

 	            $row3 = $result2->fetch_assoc();*/

				$st = "INSERT INTO routetable (TrainId, SrNo ,StationId, ArrTime,DepartTime)
				SELECT '".$row['count']."', $i ,s.Station_Id, '".$_SESSION['arr'][$a]."' , '".$_SESSION['dep'][$a]."' FROM timepass t,stations s
				WHERE t.TrainNo = '".$_POST['tno']."' and s.Station_Name like '".$_SESSION['sname'][$a]."' limit 1";

				$result = $conn->query($st);
				$i++;
			
		}

	
	if (mysqli_affected_rows($conn) >0 ) {
			echo "<script> alert('Train Added Successfully') </script>";
	} 
	else {
			echo "<script> alert('Record Creation  Unsuccessfull') </script>";
	}

}  



  

else{
	echo "<script>
	window.location.href='adminhome.php';
	</script>";
}


$conn->close();

?>



