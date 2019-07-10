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
	$_SESSION['cla'] = $_POST['class'];
	$_SESSION['la'] = $_POST['Lat'];
	$_SESSION['lg'] = $_POST['Long'];

	$servername = "localhost:3306";
	$username = "root";
	$password = "root";
	$dbname = "userdatabase";

  
$conn = new mysqli($servername,$username,$password,$dbname);




if($conn->connect_error) {
  die("Connection Failed :" . $conn->connect_error);
}


$main = "select count(*) as count from traininfo where TrainNo ='".$_POST['tno']."' ";
$result = $conn->query($main);
$row = mysqli_fetch_assoc($result);

if($row['count'] != 0){
	echo "
	<script>
	alert('Train Record Already Present');
	window.location.href='adminhome.php';
	</script>";
}
else{

	
	foreach($_SESSION['sname'] as $a => $b){ 

	     echo $_SESSION['sname'][$a];
	     echo $_SESSION['scode'][$a];
	 	
	

	$sql1 = "INSERT INTO station (Station_Id,Station_Name,Station_code) select count(*)+1,'".$_SESSION['sname'][$a]."', '".$_SESSION['scode'][$a]."' from station limit 1 ";

	$result1 = mysqli_query($conn, $sql1);		

	}

	$sql2 = "select count(*) as count from traininfo";
    $result2 = $conn->query($sql2);

	$row = $result2->fetch_assoc();
    $sql = "INSERT into traininfo (TrainId,TrainNo,TrainName,TrainSrcId,TrainDesId) select '".$row['count']."'+1,'".$_POST['tno']."','".$_POST['tname']."',s.Station_Id,s1.Station_Id from traininfo t,station s,station s1 where s.Station_Id = (select s.Station_Id from station s where s.Station_Name like '".$_SESSION['source']."') and s1.Station_Id = (select s1.Station_Id from station s1 where s1.Station_Name like '".$_SESSION['destination']."') limit 1";


	$result = $conn->query($sql);

	

				$i = 1;

				foreach($_SESSION['arr'] as $a => $b){
				$sql2 = "select count(*) as count from traininfo";
                $result2 = $conn->query($sql2);

 	            $row = $result2->fetch_assoc();	

				/*$sql3 = "select count(*) as count from routetable3 where TrainId = (select t.TrainId from traininfo t where t.TrainName like '".$_POST['tname']."'";
                $result3 = $conn->query($sql2);

 	            $row3 = $result2->fetch_assoc();*/

				$st = "INSERT INTO routetable3 (TrainId, SrNo ,StationId, ArrTime,DepartTime)
				SELECT '".$row['count']."', $i ,s.Station_Id, '".$_SESSION['arr'][$a]."' , '".$_SESSION['dep'][$a]."' FROM traininfo t,station s
				WHERE  t.TrainNo = '".$_POST['tno']."' and s.Station_Name like '".$_SESSION['sname'][$a]."' limit 1";

				$result = $conn->query($st);
				$i++;
			}
				

			foreach ($_SESSION['la'] as $a => $b) {
				
				
				
				$stt = "insert into map7 values ('".$_SESSION['sname'][$a]."','".$_SESSION['la'][$a]."','".$_SESSION['lg'][$a]."')";
				$res1 = $conn->query($stt);
			}


			foreach ($_SESSION['cla'] as $a => $b) {
			
				$sql33 = "insert into t_class2 (TrainId,ClassId) select t.TrainId,c.ClassId from traininfo t, classes c where t.TrainId = (select a.TrainId from traininfo a where a.TrainNo = '".$_POST['tno']."') and c.ClassId = (select b.ClassId from classes b where b.classname like '".$_SESSION['cla'][$a]."') ";
				$result = $conn->query($sql33);

				echo $_SESSION['cla'][$a];

			}
		

	
	if (mysqli_affected_rows($conn) >0 ) {
			echo "<script> alert('Train Added Successfully');
				  window.location.href='adminhome.php';
				  </script>";
	} 
	else {
			echo "<script> alert('Record Creation  Unsuccessfull');
				 window.location.href='adminhome.php'; 
				 </script>";
	}

}  



  
}
else{
	echo "<script>
	window.location.href='adminhome.php';
	</script>";
}


$conn->close();

?>



