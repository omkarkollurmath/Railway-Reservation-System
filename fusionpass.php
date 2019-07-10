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
    <title>TRAIN PASSENGER</title>
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

    <p style="margin-left: 550px;font-size: 24px;font-family: Verdana;"> TRAIN BOOKINGS <span style="margin-left: 350px;font-size: 15px;"><a href="adminhome.php" style="text-decoration: none;font-family: Verdana;">Go Back </a></span></p><br><br>
    <?php
      // Form the SQL query that returns the top 10 most populous countries
      $strQuery = "select t.TrainName as Name,count(t.TrainId) as Total_Passenger from traininfo t,pnrtable p where t.TrainId=p.TrainId group by p.TrainId order by Total_Passenger";

      // Execute the query, or else return the error message.
      $result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

      // If the query returns a valid response, prepare the JSON string
      if ($result) {
          // The `$arrData` array holds the chart attributes and data
          $arrData = array(
              "chart" => array(
                  "caption" => "TOTAL BOOKINGS",
                  "xAxisName" => "TRAIN_NAME",
                  "yAxisName" => "BOOKING_COUNT",
                   "showplotborder" => "1",
                  "showValues" => "1",
                  "plotbordercolor" => "#FFA500",
                  "plotcolor"=> "#FFA500",
                  "theme" => "candy"
                )
            );

          $arrData["data"] = array();

          echo "<div class='buttons'>";
          echo "<input type='button' id='download-pdf' value='DOWNLOAD PDF'> ";
          echo "<input type='button' id='download-csv' value='DOWNLOAD CSV'> ";
          echo "<input type='button' id='download-json' value='DOWNLOAD JSON'> ";
          echo "<input type='button' id='download-xlsx' value='DOWNLOAD XLSX'> ";

          echo "</div>";
          echo "<table id='example-table' style='float:right;margin-top: 90px;border:1px solid black'>";
          echo "<tr><th>Train Name</th><th>Booking Count</th></tr>";


  // Push the data into the array
          while($row = mysqli_fetch_array($result)) {
            array_push($arrData["data"], array(
                "label" => $row["Name"],
                "value" => $row["Total_Passenger"]
                )
            );
            echo "<tr> <td>".$row["Name"]."</td><td>".$row["Total_Passenger"]."</td>"; 
          }

          echo "<table>";
          /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

          $jsonEncodedData = json_encode($arrData);

  /*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/

          $columnChart = new FusionCharts("column3D", "myFirstChart" , 700, 400, "chart-1", "json", $jsonEncodedData);

          // Render the chart
          $columnChart->render();

          // Close the database connection
          $dbhandle->close();
      }
    ?>
    <br>
    <center>
        <div id="chart-1" style="float:left; margin-left: 90px;margin-top: 30px;">Chart will render here!</div>
    </center>
 
    <script type="text/javascript" src="http://oss.sheetjs.com/js-xlsx/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.2/jspdf.plugin.autotable.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script>
        var table = new Tabulator("#example-table", {});

        $("#download-csv").click(function(){
        table.download("csv", "train-passenger.csv");
        });

        //trigger download of data.json file
        $("#download-json").click(function(){
        table.download("json", "train-passenger.json");
        });

        //trigger download of data.xlsx file
        $("#download-xlsx").click(function(){
        table.download("xlsx", "train-passenger.xlsx", {sheetName:"Fare Data"});
        });

       
        //trigger download of data.pdf file
        $("#download-pdf").click(function(){
            table.download("pdf", "train-passenger.pdf", {
                orientation:"portrait", //set page orientation to portrait
                title:"Train-Passenger Report", //add title to report
            });
        });

    </script>

   </body>
</html>