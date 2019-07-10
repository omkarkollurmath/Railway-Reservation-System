<?php
session_start();
?>
<html>
<head>

<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">	
<style>
.main{
	border:2px solid black;
         }

.button1{
		border: 2px solid black;
		background-color:light grey;
   		color: black;
    		padding: 8px 50px;
    		text-align: center;
    		font-size: 15px;
    		margin: 4px 2px;
	}

body{
	font-family: 'Roboto', sans-serif;
}


</style>
</head>
<body>
	
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

		$sql = "select max(PnrNo) from train_pnr_demo2;";
      		$result = $conn->query($sql);

		if ($result) 
		{
		$row = mysqli_fetch_array($result);
		  $pnr = $row[0];
		}

		$conn->close();
?>

	<?php
	$subject="IRCTC";
	$trainno=$_SESSION['trainno'];
	$trainname=$_SESSION['trainname'];
	$from=$_SESSION['from'];
	$to=$_SESSION['to'];
	$traveldate=$_SESSION['traveldate'];
	$deptime=$_SESSION['deptime'];
	$message="This is an automated message. Please do not reply to this email address. \nYour ticket has been booked succesfully. \nPNR No: $pnr \nTrain No: $trainno \nTrain Name : $trainname \nSource: $from \nDestination:  $to \nJourney Date: $traveldate \nDeparture time: $deptime \nPlease be at station half an hour prior to departure time to avoid inconvinence.";
	?>
	<div class="main">
	
	<img src="raillogo.jpg" width="55px" height="60px" align="left" style="padding-left:10px;padding-top:10px;">
	<img src="irctclogo.png" width="50px" height="60px" align="right" style="padding-right:10px;padding-top:10px;padding-bottom:10px;">
	<center style="font-size:25px;padding-top:30px;">IRCTC E-Ticketing Service</center>
	<br><br><br>
	<table border="5" width="100%"height=5% align="center">
	
	<tr>
	<td>PNR NO. : <b><?php echo $pnr ?></b></td>
	<td>TRAIN NO. : <b><?php echo $_SESSION['trainno'] ?></b></td>
	<td>TRAIN NAME : <b><?php echo $_SESSION['trainname'] ?></b></td>
	</tr>
	<tr>
	<td>FROM :   <b><?php echo $_SESSION['from'] ?></b></td>
	<td>TO :         <b><?php echo $_SESSION['to'] ?></b></td>
	<td>DATE :     <b><?php echo $_SESSION['traveldate'] ?></b></td>
	</tr>
	<tr>
	<td>DEPARTURE TIME :   <b><?php echo $_SESSION['deptime'] ?></b></td>
	<td>ARRIVAL TIME :        <b><?php echo $_SESSION['arrtime'] ?></b></td>
 	<td>MOBILE NO. :           <b><?php echo $_SESSION['Mnumber'] ?></b></td>
	</tr>
	<td>EMAIL ID : <b><?php echo $_SESSION['email']; ?></b></td>
	<td colspan=2>
	<?php
	if(mail($_SESSION['email'],$subject,$message)){
		echo "Ticket Info has been sent to your email address";
	}
	?>
	</td>
	</tr>
	</table>
	<br><br>
	<span style="font-size:20px;font-weight:500px;">PASSENGER DETAILS :</span>
	<table border="2" width="100%" id="show">

	<tr>
	<th>Name </th>
	<th>Age</th>
	<th>Gender</th>
	</tr>
	<?php
	foreach($_SESSION['Pname'] as $a => $b){ 
	echo "<tr><td>" .$_SESSION['Pname'][$a]. 
	     "<td>".$_SESSION['Page'][$a]. 
	     "<td>".$_SESSION['Pgender'][$a].
	"</tr>";
	}
	?>
	</table>
	<br><br>
	<p>
	<center><button onclick="myFunction()" name="print" class="button1">PRINT </button></center>
	<a href="newhome.php">Go Back Home</a>
	</p>
	<br><br>
	</div>





<script>
function myFunction() {
    window.print();
}
</script>

</body>
</html>