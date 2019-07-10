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
    
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
      <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">

      <script src="js/fusioncharts.js"></script> 
      <script type="text/javascript" src="js/themes/fusioncharts.theme.candy.js"></script>
      <link href="tabulator-master/dist/css/tabulator.min.css" rel="stylesheet">
      <script type="text/javascript" src="tabulator-master/dist/js/tabulator.min.js"></script>
      
 
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
  
  <style>

  #chart{
    width:400px;
    height: 400px;
  }

  .container{
    width:500px;
    margin-left: 400px;
    margin-top: 50px;
    border : 2px solid black;
    padding:10px;
  }


  p{
        font-family: "Poiret One", cursive;
        font-weight: bold;
   }

   .btn{
    width: 120px;
    background-color: green;
    font-size: 14px;  
    color: white;
    font-family: 'Monda', cursive;
  }


  .btn:hover{
    opacity: 0.8;
  }

  </style>
   </head>
   <body>

    <p style="margin-left: 550px;font-size: 26px;"> TRAIN-CLASS DETAILS <span style="margin-left: 350px;font-size: 15px;"><a href="adminhome.php" style="text-decoration: none;font-family: Verdana">Go Back </a></span></p><br><br>
   
    <div class="container">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label>Train No :</label>
    <input type="text" name="no" minlength="5" maxlength="5" placeholder="Enter Train No" required><br><br>
    <label>Date Of Journey: </label>
    <input type="date" name="date" placeholder="Enter Date" required><br><br>
     <button class="btn" name="submit">SUBMIT</button>
    </form>
    </div>
    <?php

      if(isset($_POST['submit'])){
      // Form the SQL query that returns the top 10 most populous countries
      $strQuery = "SELECT distinct(t.Class) as class , count(t.Class) as count FROM train_pnr_demo2 t  where t.TrainId = (select ts.TrainId from traininfo ts where ts.TrainNo = '".$_POST['no']."') and t.TravelDate like '".$_POST['date']."' group by t.Class";

      // Execute the query, or else return the error message.
      $result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

      // If the query returns a valid response, prepare the JSON string
      if ($result) {
          // The `$arrData` array holds the chart attributes and data
          $arrData = array(
              "chart" => array(
                  "caption" => "CLASSES-PASSENGERS",
                  "xAxisName" => "Class",
                  "yAxisName" => "Passenger Count",
                  "showValues" => "1",
                  "theme" => "fusion"
                )
            );

          $arrData["data"] = array();

          echo "<br><br><br>";
          echo "<div class='buttons'>";
          echo "<input type='button' id='download-pdf' value='DOWNLOAD PDF'> ";
          echo "<input type='button' id='download-csv' value='DOWNLOAD CSV'> ";
          echo "<input type='button' id='download-json' value='DOWNLOAD JSON'> ";
          echo "<input type='button' id='download-xlsx' value='DOWNLOAD XLSX'> ";

          echo "</div>";
          echo "<table id='example-table' style='float:right;margin-top: 90px;border:1px solid black'>";
          echo "<tr><th>Class Name</th><th>Passenger Count</th></tr>";

  // Push the data into the array
          while($row = mysqli_fetch_array($result)) {
            array_push($arrData["data"], array(
                "label" => $row["class"],
                "value" => $row["count"]
                )
            );
            echo "<tr> <td>".$row["class"]."</td><td>".$row["count"]."</td>"; 
          }

          echo "<table>";
          /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

          $jsonEncodedData = json_encode($arrData);

  
          $columnChart = new FusionCharts("doughnut3D", "myFirstChart" , 600, 600, "chart-1", "json", $jsonEncodedData);

      
          $columnChart->render();

          
          $dbhandle->close();
      }
    }
    ?>

    <br>
    <br>
    <br>
    
    <center>
        <div id="chart-1" style="float:left; margin-left: 90px;margin-top: 30px;"></div>
    </center>

    <script type="text/javascript" src="http://oss.sheetjs.com/js-xlsx/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.2/jspdf.plugin.autotable.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script>
        var table = new Tabulator("#example-table", {});

        $("#download-csv").click(function(){
        table.download("csv", "trainDetails.csv");
        });

        //trigger download of data.json file
        $("#download-json").click(function(){
        table.download("json", "trainDetails.json");
        });

        //trigger download of data.xlsx file
        $("#download-xlsx").click(function(){
        table.download("xlsx", "trainDetails.xlsx", {sheetName:"Fare Data"});
        });

       
        //trigger download of data.pdf file
        $("#download-pdf").click(function(){
            table.download("pdf", "trainDetails.pdf", {
                orientation:"portrait", //set page orientation to portrait
                title:"Train  Details", //add title to report
            });
        });

    </script>
   </body>
</html>