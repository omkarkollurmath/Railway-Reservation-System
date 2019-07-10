<html>

<head>

<style>

  
  #searchtrain {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 95%;
    border: 1px solid black;
}

#searchtrain td, #searchtrain th {
    border: 1px solid #ddd;
    padding: 8px;
}


#searchtrain tr:hover {background-color: #ddd;}

#searchtrain th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #4CAF50;
    color: white;
}

</style>
</head>
<body>

<?php

$number = $_POST["number"];

echo " <p> <font face='Roboto'  size='4px' >Showing Results for Train Number : ".$number."</font></p>";

$servername = "localhost:3306";
$username = "root";
$password = "root";
$dbname = "userdatabase";

  
$conn = new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error) {
  die("Connection Failed :" . $conn->connect_error);
}

$check  = "select t.TrainNo,t.TrainName,s.Station_Name,ts.ArrTime ,ts.DepartTime
FROM ((train_via_station ts
INNER JOIN  traininfo t  on t.TrainId = (select traininfo.TrainId from traininfo where traininfo.TrainNo = $number) and ts.TrainId = t.TrainId)
INNER JOIN station s ON s.Station_Id = ts.StationId );";

$result = $conn->query($check);

  if ($result->num_rows <=0) {
  echo "Record Does Not Exist";
    }

  else if($result->num_rows > 0){ 
   
   echo "<table id = 'searchtrain'>
    <tr><td style='font-weight: bold;'>TrainNo</td><td align='center' style='font-weight: bold;'>TrainName</td><td style='font-weight: bold;'>Station</td><td style='font-weight: bold;'>ArrTime</td><td >Departure Time</td>";
    while($row = $result->fetch_assoc()) {
        
        echo "<tr><td>" . $row["TrainNo"]. " <td width='100px'> " . $row["TrainName"]. " <td> " .$row["Station_Name"]. "<td> ".$row["ArrTime"]. "<td>" .$row["DepartTime"]."</td></tr>";
    }

  }

  else{
  echo "Error: " .$sql."<br>".$conn->connect_error;
  }

  $conn->close();
?>

</body>
</html>
