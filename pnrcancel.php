<?php
session_start();
$pnr=$_POST['pnr'];


if(isset($_POST['submit'])){ 
$servername = "localhost:3306";
$username = "root";
$password = "root";
$dbname = "userdatabase";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql1 = "select p.TrainNo,p.TrainName,tp.PnrNo,tp.PassengerName,tp.PassengerGender,tp.PassengerAge,tp.SourceStation,tp.DestStation,tp.TravelDate from train_pnr_demo2 tp, traininfo p where tp.PnrNo = '".$_POST['pnr']."' and p.TrainId = tp.TrainId ";
$result = $conn->query($sql1);

if ($result) {
    
  echo " <p> <font face='VERDANA'  size='4rt' >Showing Results for Pnr Number : ".$_POST['pnr']."</font></p><br>";
   echo "<table id = 'searchpnr' border='2'>";
    echo "<tr><td style='font-weight: bold;'>TrainNo</td><td align='center' style='font-weight: bold;'>TrainName</td><td style='font-weight: bold;'>PNR NO</td><td style='font-weight: bold;'>PASSENGER NAME</td><td style='font-weight: bold;'>PASSENGER GENDER</td><td style='font-weight: bold;'>Passenger AGE </td> <td style='font-weight: bold;'> SOUCRE STATION </td> <td style='font-weight: bold;'> DESTINATION STATION </td> <td style='font-weight: bold;'> JOURNEY DATE </td></tr> ";
    while($row = $result->fetch_assoc()) {
        
        echo "<tr><td>" . $row["TrainNo"]. " <td width='100px'> " . $row["TrainName"]. " <td> " .$row["PnrNo"]. "<td> ".$row["PassengerName"]. "<td>" .$row["PassengerGender"]." <td>" .$row["PassengerAge"]." <td> " .$row["SourceStation"]." <td> " .$row["DestStation"]. " <td> ".$row["TravelDate"]."</tr>";
    }

	echo "</table>";

// sql to delete a record
$sql1 = "DELETE FROM pnrtable  WHERE PnrNo = '".$pnr."' and UserName like '".$_SESSION['uname']."' ";
$result = $conn->query($sql1);

     if (mysqli_affected_rows($conn) > 0) {   
        echo "<label class='showResult'>Record Deleted Successfully!</label>";
     }
     else{
        echo "<label class='showResult'>This PNR is not registered to your account.Please enter correct PNR.</label>";
     }
}

else{
        echo "<label class='showResult'>Record Not Found</label>";
     }

mysqli_close($conn);
}


?>

<html>
<body>
    <br><br><a href='newhome.php'>Go back Home </a><br><br>
</body>
</html>
