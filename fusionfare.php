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
    <title>TRAIN-FARE</title>
    <link  rel="stylesheet" type="text/css" href="css/style.css" />
    <!-- You need to include the following JS file to render the chart.
    When you make your own charts, make sure that the path to this JS file is correct.
    Else, you will get JavaScript errors. -->
      <script src="js/fusioncharts.js"></script> 
      <link href="tabulator-master/dist/css/tabulator.min.css" rel="stylesheet">
      <script type="text/javascript" src="tabulator-master/dist/js/tabulator.min.js"></script>
      <script type="text/javascript" src="js/themes/fusioncharts.theme.candy.js"></script>
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
      <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
 
       <style>
      
          #example-table{
            margin-right: 90px;
            font-family: 'Quicksand', sans-serif;
            font-size: 18px;
          }

          .buttons{
            display : inline-block;
            margin-left: 400px;
          }

          #download-pdf,#download-csv,#download-json,#download-xlsx{
            font-family: 'Quicksand', sans-serif;
            border : 1px solid black;
            font-size: 15px;
            background-color : green;
            color : white;
          }
        
      </style>

  </head>
   <body>

    <p style="margin-left: 550px;font-size: 20px;font-family: Verdana;"> CLASS FARES <span style="margin-left: 350px;font-size: 15px;"><a href="adminhome.php" style="text-decoration: none;font-family: Verdana;">Go Back </a></span></p>

    <?php
      // Form the SQL query that returns the top 10 most populous countries
      $strQuery = "SELECT classname, classfare FROM classes ORDER BY classfare ";

      // Execute the query, or else return the error message.
      $result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

      // If the query returns a valid response, prepare the JSON string
      if ($result) {
          // The `$arrData` array holds the chart attributes and data
          $arrData = array(
              "chart" => array(
                  "caption" => "TRAIN-FARE",
                  "xAxisName" => "Class",
                  "yAxisName" => "Fare",
                  "showValues" => "1",
                  "theme" => "ocean"
                )
            );

          $arrData["data"] = array();

  // Push the data into the array
          while($row = mysqli_fetch_array($result)) {
            array_push($arrData["data"], array(
                "label" => $row["classname"],
                "value" => $row["classfare"]
                )
            );
             echo "<tr> <td>".$row["classname"]."</td><td>".$row["classfare"]."</td>"; 
          }

          echo "<table>";
          /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

          $jsonEncodedData = json_encode($arrData);

  /*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/

          $columnChart = new FusionCharts("column2D", "myFirstChart" ,800, 400, "chart-1", "json", $jsonEncodedData);

          // Render the chart
          $columnChart->render();

          // Close the database connection
          $dbhandle->close();
      }
    ?>
    <br>
    <br>
    <br>
    <br>
    <center>
        <div id="chart-1">Chart will render here!</div>
    </center>

    <script type="text/javascript" src="http://oss.sheetjs.com/js-xlsx/xlsx.full.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.2/jspdf.plugin.autotable.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script>
        var table = new Tabulator("#example-table", {});

        $("#download-csv").click(function(){
        table.download("csv", "data.csv");
        });

        //trigger download of data.json file
        $("#download-json").click(function(){
        table.download("json", "data.json");
        });

        //trigger download of data.xlsx file
        $("#download-xlsx").click(function(){
        table.download("xlsx", "data.xlsx", {sheetName:"My Data"});
        });

       
        //trigger download of data.pdf file
        $("#download-pdf").click(function(){
            table.download("pdf", "data.pdf", {
                orientation:"portrait", //set page orientation to portrait
                title:"Monthly Collection Report", //add title to report
            });
        });

    </script>

    </body>
</html>