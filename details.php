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

<!Doctype html>

  <head>
    <title>CLASS-PASSENGER</title>
    <link  rel="stylesheet" type="text/css" href="css/style.css" />
    <!-- You need to include the following JS file to render the chart.
    When you make your own charts, make sure that the path to this JS file is correct.
    Else, you will get JavaScript errors. -->
      <script src="js/fusioncharts.js"></script> 
      <script type="text/javascript" src="js/themes/fusioncharts.theme.candy.js"></script>
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
 
  </head>
   <body>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <input type="text" name="no" minlength="5" maxlength="5" required>
    <input type="date" name="date" placeholder="Enter Date" required>
    <input type="submit" name="submit" value="submit">
  </form>

    <?php

      if(isset($_POST['submit'])){
      // Form the SQL query that returns the top 10 most populous countries
      $strQuery = "SELECT distinct(t.Class) as class , count(distinct(t.Class)) as count FROM train_pnr_demo2 t  where t.TrainId = (select ts.TrainId from traininfo ts where ts.TrainNo = '".$_POST['no']."') and t.TravelDate like '".$_POST['date']."' group by t.Class";

      // Execute the query, or else return the error message.
      $result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

      // If the query returns a valid response, prepare the JSON string
      if ($result) {
          // The `$arrData` array holds the chart attributes and data
          $arrData = array(
              "chart" => array(
                  "caption" => "CLASSES-PASSENGER",
                  "xAxisName" => "Month",
                  "yAxisName" => "Collections",
                  "showValues" => "1",
                  "theme" => "fusion"
                )
            );

          $arrData["data"] = array();

  // Push the data into the array
          while($row = mysqli_fetch_array($result)) {
            array_push($arrData["data"], array(
                "label" => $row["class"],
                "value" => $row["count"]
                )
            );
          }

          /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

          $jsonEncodedData = json_encode($arrData);

  /*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/

          $columnChart = new FusionCharts("doughnut3D", "myFirstChart" , 900, 600, "chart-1", "json", $jsonEncodedData);

          // Render the chart
          $columnChart->render();

          // Close the database connection
          $dbhandle->close();
      }
    }
    ?>

    <br>
    <br>
    <br>
    
    <center>
        <div id="chart-1">Doughnut will render here!</div>
    </center>
   </body>
</html>