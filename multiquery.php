<?php

session_start();
$con=mysqli_connect("localhost:3308","root","root","userdatabase");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$trainno = $_SESSION['trainno'];

$sql = "INSERT INTO pnrtable (TrainId,Username) select t.TrainId,'".$_SESSION['user']."' from traininfo t where t.TrainNo = '".$trainno."'";
$sql .= "SELECT * from pnrtable";

// Execute multi query
if (mysqli_multi_query($con,$sql))
{
  do
    {
    // Store first result set
    if ($result=mysqli_store_result($con)) {
      // Fetch one and one row
      while ($row=mysqli_fetch_row($result))
        {
        printf("%s\n",$row[0]);
        }
      // Free result set
      mysqli_free_result($result);
      }
    }
  while (mysqli_next_result($con));
}

mysqli_close($con);
?>