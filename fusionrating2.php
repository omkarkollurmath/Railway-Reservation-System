<?php

/* Include the `fusioncharts.php` file that contains functions  to embed the charts. */

include("integrations/php/fusioncharts-wrapper/fusioncharts.php");
/* The following 4 code lines contain the database connection information. Alternatively, you can move these code lines to a separate file and include the file here. You can also modify this code based on your database connection. */
$hostdb   = "localhost:3306"; // MySQl host
$userdb   = "root"; // MySQL username
$passdb   = "root"; // MySQL password
$namedb = "userdatabase";  // MySQL database name

   // Establish a connection to the database
   $dbhandle = new mysqli($hostdb, $userdb, $passdb, $namedb);

   /*Render an error message, to avoid abrupt failure, if the database connection parameters are incorrect */
   if ($dbhandle->connect_error) {
    exit("There was an error with your connection: ".$dbhandle->connect_error);
   }
?>

<html>
    <head>
        <title>CUSTOMER-RATING</title>
        <style>
	 
	</style>
       <script src="js/fusioncharts.js"></script> 
      <script type="text/javascript" src="js/themes/fusioncharts.theme.candy.js"></script>
    </head>
    <body>
        <br><br><br>
    <p style="margin-left: 500px;font-size: 24px;font-family: Verdana;"> CUSTOMER SATISFACTION SCORE <span style="margin-left: 350px;font-size: 15px;"><a href="adminhome.php" style="text-decoration: none;font-family: Verdana;">Go Back </a></span></p>
    
<?php

$strQuery = "select sum(rating)/count(*) as ans from rating1";
$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");
  $ans = mysqli_fetch_assoc($result);
    // Widget appearance configuration
   if ($result) {
    $arrChartConfig = array(
        "chart" => array(
            "caption" => "Customer Satisfaction Score",
            "lowerLimit" => "0",
            "upperLimit" => "100",
            "showValue" => "1",
            "numberSuffix" => "%",
            "theme" => "fusion",
            "showToolTip" => "0"
             

        )
    );
    // Widget color range data
    $colorDataObj = array("color" => array(
        ["minValue" => "0", "maxValue" => "50", "code" => "#F2726F"],
        ["minValue" => "50", "maxValue" => "75", "code" => "#FFC533"],
        ["minValue" => "75", "maxValue" => "100", "code" => "#228B22"]
    ));


    $dial = array();

	


    
    // Widget dial data in array format, multiple values can be separated by comma e.g. ["81", "23", "45",...]
    $widgetDialDataArray = array($ans["ans"]);
    for($i = 0; $i < count($widgetDialDataArray); $i++) {
        array_push($dial,array(
	"value" => $widgetDialDataArray[$i],
		)
	);
    }

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

       $sql = "select name,rating,message from rating1";
      $result = $conn->query($sql);
       echo "<table border='5' align='right'><tr><td style='font-weight: bold;'>Name</td><td align='center' style='font-weight: bold;'>Rating</td><td style='font-weight: bold;'>Suggestions</td></tr>";
      while($row = $result->fetch_assoc()) {
	 if($result){
	 echo "<tr><td>" . $row["name"]. " <td width='100px'> " . $row["rating"]. "<td>" .$row["message"]. "</tr>";
      	}
       }
	echo "<table>";





    $arrChartConfig["colorRange"] = $colorDataObj;
    $arrChartConfig["dials"] = array( "dial" => $dial);

    // JSON Encode the data to retrieve the string containing the JSON representation of the data in the array.
    $jsonEncodedData = json_encode($arrChartConfig);

    // Widget object
    $Widget = new FusionCharts("angulargauge", "MyFirstWidget" , "500", "250", "widget-container", "json", $jsonEncodedData);

    // Render the Widget
    $Widget->render();
           $dbhandle->close();
}
?>

    <br>
    <br>
    <br>
    
    <center>
        <div id="widget-container">Widget will render here!</div>
    </center>
</body>
</html>