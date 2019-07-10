      <?php
      session_start();
      echo "<p><font face='Verdana' size='4rt'>WELCOME : </font>".$_SESSION["uname"]."</p>";
      if(isset($_POST["from"])){

        if(isset($_POST["tdate"])){
      $_SESSION['traveldate'] = $_POST["tdate"];
      echo "<p>Showing Results for Date : ".$_SESSION['traveldate']."</p>";
      }

      else{
        $_POST["tdate"] = $_SESSION["traveldate"];
      }
    }
      else{
        echo "<script> window.location.href='newhome.php'; </script>";
      }
      ?>

      
      <!DOCTYPE html>
      <html>
      <head>
      <title>BOOK TICKET</title>
      <link href="https://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Special+Elite" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Overlock" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

      <style>

      .autocomplete {
      /*the container must be positioned relative:*/
      position: relative;
      display: inline-block;
      }

      .autocomplete-items {
      position: absolute;
      border: 1px solid #d4d4d4;
      border-bottom: none;
      border-top: none;
      z-index: 99;
      /*position the autocomplete items to be the same width as the container:*/
      top: 100%;
      left: 0;
      right: 0;
      }

      .autocomplete-items div {
      padding: 10px;
      cursor: pointer;
      background-color: #fff; 
      border-bottom: 1px solid #d4d4d4; 
      }

      .autocomplete-items div:hover {
      /*when hovering an item:*/
      background-color: #e9e9e9; 
      }

      .autocomplete-active {
      /*when navigating through the items using the arrow keys:*/
      background-color: DodgerBlue !important; 
      color: #ffffff; 
      }
      </style>
      <style>


      .container{
      background-color: #f1f1f1;
      }

      label{
      font-family: 'Roboto', sans-serif;
      font-size: 18px;
      }



      input[type=text]{
      border: 2px solid black;
      height: 25px;
      width: 200px;
      font-family: 'Roboto', sans-serif;
      font-size: 14px;
      padding: 10px;
      }

      #bookticket {
      font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;
      border: 1px solid black;
      }

      #bookticket td, #bookticket th {
      border: 1px solid #ddd;
      padding: 8px;
      }


      #bookticket tr:not(:first-child):hover  {background-color: #ddd;}

      #bookticket th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
      background-color: #4CAF50;
      color: white;
      }

      #checkStation{
      padding: 35px;
      border: 2px solid black;
      }

      .btn{
      font-family: 'Roboto', sans-serif;
      font-size: 14px;
      margin-bottom: -20px;
      background-color: white;
      width: 120px;
      height: 40px;
      font-weight: bold;
      border: 2px solid green;
      }

      .btn:hover{
      background-color: green;
      opacity: 0.7;
      }


      </style>

      <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 70%;
        width:50%;
      }
      /* Optional: Makes the sample page fill the window. */
      #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
        float:left;
      }

     
    </style>
      </head>
      <body>

      <div class="container">
      <form id="checkStation" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

      <span class="autocomplete">
      <label>Source : </label>
      <input id="FromStation" type="text" name="from" value =  "<?php echo $_POST['from']; ?>"  placeholder="From Station..." autocomplete="off" style="width:250px;height:40px;"  required/>
      </span>
      &emsp;&emsp;&emsp;&emsp;
      <span class="autocomplete">
      <label>Destination: </label>
      <input id="ToStation" type="text" name="to" value = "<?php echo $_POST['to']; ?>" placeholder="To Station..." autocomplete="off" style="width:250px;height:40px;" required/>
      </span>
      &emsp;&emsp;&emsp;&emsp;
      <button  class="btn">Modify Search</button>

      </form>
      </div>

      <hr>

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

      echo "<p> <font face='Roboto'  size='4px' >Showing Trains from " .$_POST['from']." to " .$_POST['to']."</font></p><br>";

      $res = "select a.Latitude as aLat,a.Longitude as aLng,b.Latitude as bLat,b.Longitude as bLng from map7 a,map7 b where a.info like '".$_POST['from']."' and  b.info like '".$_POST['to']."' ";

      $ans = $conn->query($res);

      $row = mysqli_fetch_assoc($ans);

      $sLat = $row['aLat'];
      $sLng = $row['aLng'];
      $dLat = $row['bLat'];
      $dLng = $row['bLng'];

      $sql = "select t.TrainNo , t.TrainName , t1.DepartTime ,t2.ArrTime from routetable3 t1, routetable3 t2 ,traininfo t where t1.StationId in (select s1.Station_Id from station s1 where s1.Station_Name = '".$_POST['from']."' ) and t2.StationId in (select s2.Station_Id from station s2 where s2.Station_Name like '".$_POST['to']."' ) and t1.TrainId = t2.TrainId and t.TrainId = t1.TrainId and t2.SrNo>t1.SrNo;";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
      // output data of each row
      echo "<div id='map'></div> <br>";
      echo "<table id = 'bookticket'>";
      echo "<tr><td style='font-weight: bold;'>TrainNo</td><td align='center' style='font-weight: bold;'>TrainName</td><td style='font-weight: bold;'>From Station</td><td style='font-weight: bold;'>To Station</td><td style='font-weight: bold;'>Departure Time</td><td style='font-weight: bold;'>Arrival Time</td><td style='font-weight: bold;'>Seat Available</td><td style='font-weight: bold;'>Classes</td><td></td></tr>";
      while($row = $result->fetch_assoc()) {
        
        $sql1="SELECT 10-count(*) as seat from train_pnr_demo2 t where t.TrainId = (select tt.TrainId from traininfo tt where tt.TrainNo= '".$row['TrainNo']."') and t.TravelDate = '".$_SESSION['traveldate']."'";
        $result1 = $conn->query($sql1);

       

        if($result1){
        $row1 = $result1->fetch_assoc();
        if($row1["seat"] > 0){
        echo "<tr><td>" . $row["TrainNo"]. " <td width='100px'> " . $row["TrainName"]. " <td> " .$_POST['from']. "<td> " .$_POST['to']. "<td>" .$row["DepartTime"]. "<td>" .$row["ArrTime"]."<td>".$row1["seat"]."</td><td>";


           $sql="SELECT c.classname from classes c where c.classid in(select t.ClassId from t_class2 t where t.TrainId =(select tt.TrainId from traininfo tt where tt.TrainNo='".$row['TrainNo']."'))";
           $result2 = $conn->query($sql); 
  $_SESSION['deptime']=$row['DepartTime'];
  $_SESSION['arrtime']=$row['ArrTime'];
  


           if ($result2) 
          { 

          echo "<form  method='post' action='railticket13.php?TrainNo=".$row["TrainNo"]." &TrainName=".$row["TrainName"]." &FromStation=".$_POST["from"]." &ToStation=".$_POST["to"]." '>
          <select name='railclass' id='railclass'>";
          while($row2 = $result2->fetch_assoc()){
            echo "<option value='".$row2['classname']."'>";
            echo $row2["classname"];
            echo "</option>";
          }
          echo "</select>";
          $date = new DateTime('',new DateTimeZone('Asia/Kolkata'));

          $tdate = strtotime($_SESSION['traveldate']);
          $dtime = strtotime($_SESSION['deptime']);

          if(($date->format('Y-m-d') == date('Y-m-d', $tdate))){

            $hdiff = date('H',$dtime) - $date->format('H');
            $mdiff = date('i',$dtime) - $date->format('i');


            if($hdiff >= 0){

                if($hdiff == 0 and $mdiff < 0){

                 echo "</td><td><input type='submit' value='Book Ticket' disabled/></td></form></tr>";
                }
                else{
                  echo "</td><td><input type='submit' value='Book Ticket'></td></form></tr>";
                }

            }

            else{

                echo "</td><td><input type='submit' value='Book Ticket' disabled/></td></form></tr>";

            }
          }

            else{

               echo "</td><td><input type='submit' value='Book Ticket'></td></form></tr>";
            }   
          }

          }

          }
          }
          }

       

      else {
      echo "No Records Found.";
      echo "<script>document.getElementById('map') = '';</script>";
      }
      $conn->close();
      ?>

      <script>
      function modifySearch(){
      unset($_POST["from"]);
      unset($_POST["to"]);
      }
      </script>
      <script>
      function autocomplete(inp, arr) {
      /*the autocomplete function takes two arguments,
      the text field element and an array of possible autocompleted values:*/
      var currentFocus;
      /*execute a function when someone writes in the text field:*/
      inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
      });
      /*execute a function presses a key on the keyboard:*/
      inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
      });
      function addActive(x) {
      /*a function to classify an item as "active":*/
      if (!x) return false;
      /*start by removing the "active" class on all items:*/
      removeActive(x);
      if (currentFocus >= x.length) currentFocus = 0;
      if (currentFocus < 0) currentFocus = (x.length - 1);
      /*add class "autocomplete-active":*/
      x[currentFocus].classList.add("autocomplete-active");
      }
      function removeActive(x) {
      /*a function to remove the "active" class from all autocomplete items:*/
      for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
      }
      }
      function closeAllLists(elmnt) {
      /*close all autocomplete lists in the document,
      except the one passed as an argument:*/
      var x = document.getElementsByClassName("autocomplete-items");
      for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
      }
      }
      /*execute a function when someone clicks in the document:*/
      document.addEventListener("click", function (e) {
      closeAllLists(e.target);
      });
      }

      /*An array containing all the country names in the world:*/
      var station = ["ABU ROAD",
      'ADONI',
      'AGRA CANTT',
      'AHMADNAGAR',
      'AHMEDABAD JN',
      'AJMER',
      'AKOLA JN',
      'AMBUR',
      'ANAND JN',
      'ANANTAPUR',
      'ANDHERI',
      'ANKLESHWAR JN',
      'ARAKKONAM',
      'ARALVAYMOLI',
      'ASALPUR JOBNER',
      'BADNERA JN',
      'BALHARSHAH',
      'BALUGAN',
      'BANDRA TERMINUS',
      'BANGALORE CANT',
      'BANGALORE EAST',
      'BANGARAPET',
      'BARI BRAHMAN',
      'BEAWAR',
      'BELAMPALLI',
      'BELAPUR',
      'BHANDARA ROAD',
      'BHAROLI JN.',
      'BHARUCH JN',
      'BHATINDA JN',
      'BHOGPUR SIRWAL',
      'BHOPAL  JN',
      'BHUBANESWAR',
      'BHUSAVAL JN',
      'BIDADI',
      'BIKANER JN',
      'BILASPUR JN',
      'BORIVALI',
      'BRAHMAPUR',
      'BRAJRAJNAGAR',
      'BUDHI',
      'CHAKDAYALA',
      'CHAKRADHARPUR',
      'CHAMPA',
      'CHANDRAPUR',
      'CHANNAPATNA',
      'CHENGALPATTU',
      'CHENNAI CENTRAL',
      'CHENNAI EGMORE',
      'CHHAN ARORIAN',
      'CHHAPI',
      'CHITTOR',
      'COIMBATORE JN',
      'DAHANU ROAD',
      'DASUYA',
      'DAUND JN',
      'DESHNOK',
      'DHARMAPURI',
      'DHARMAVARAM JN',
      'DINDIGUL JN',
      'DUDHANI',
      'DURG',
      'ERANIEL',
      'ERODE JN',
      'FALNA',
      'FARIDKOT',
      'FIROZPUR CANT',
      'GANAGAPUR ROAD',
      'GANGSAR JAITU',
      'GAURIBIDANUR',
      'GHAGWAL',
      'GONDIA JN',
      'GOOTY',
      'GOTAN',
      'GUDIYATTAM',
      'GUDUR JN',
      'GULBARGA',
      'GUNTAKAL JN',
      'GWALIOR JN.',
      'HANUMANGARH JN',
      'HINDUPUR',
      'HIRA NAGAR',
      'HOSUR',
      'HOWRAH JN',
      'HYDERABAD DECAN',
      'JAIPUR',
      'JALANDHAR CITY',
      'JALGAON JN',
      'JAMMU TAWI',
      'JAWAI BANDH',
      'JAWALI',
      'JHANSI JN',
      'JHARSUGUDA JN',
      'JODHPUR JN',
      'JOLARPETTAI',
      'KADAMBUR',
      'KALLURU',
      'KALOL',
      'KALYAN JN',
      'KAPURTHALA',
      'KATHUA',
      'KATPADI JN',
      'KAZIPET JN',
      'KENGERI',
      'KHARAGPUR JN',
      'KHURDA ROAD JN',
      'KISHANGARH',
      'KODAIKANAL ROAD',
      'KOLLAM JN',
      'KOPARGAON',
      'KOT KAPURA',
      'KOTA JN',
      'KOVILPATTI',
      'KRISHNA',
      'KRISHNARAJAPURM',
      'KSR BENGALURU',
      'KULITTHURAI',
      'KUPPAM',
      'KURDUVADI',
      'LALGARH JN',
      'LOHIAN KHAS JN',
      'LOKMANYATILAK',
      'LUNI JN',
      'LUNKARANSAR',
      'MADDUR',
      'MADHOPUR PUNJAB',
      'MADURAI JN',
      'MADURANTAKAM',
      'MAHESANA JN',
      'MAKHU',
      'MALKAPUR',
      'MALLANWALA KHAS',
      'MALUR',
      'MANCHERAL',
      'MANDI DABWALI',
      'MANDYA',
      'MANIYACHCHI JN',
      'MANMAD JN',
      'MANTHRALAYAM RD',
      'MARWAR JN',
      'MARWAR MUNDWA',
      'MATHURA JN',
      'MELMARUVATTUR',
      'MERTA ROAD JN',
      'MORI BERA',
      'MUKERIAN',
      'MUKUNDARAYAPURM',
      'MUMBAI CENTRAL',
      'MYSORE JN',
      'NADIAD JN',
      'NAGARCOIL JN',
      'NAGAUR',
      'NAGDA JN',
      'NAGPUR',
      'NANA',
      'NANGUNERI',
      'NARAINA',
      'NAVSARI',
      'NELLORE',
      'NEW DELHI',
      'NEYYATTINKARA',
      'NOKHA',
      'NORTH PANAKUDI',
      'OMALUR',
      'PALANPUR JN',
      'PALASA',
      'PALI MARWAR',
      'PANDAVAPURA',
      'PARASSALA',
      'PATHANKOT',
      'PATHANKOT CANTT',
      'PERAMBUR',
      'PHULERA JN',
      'PILI BANGAN',
      'PIPAR ROAD JN',
      'PUNE JN',
      'RAICHUR',
      'RAIGARH',
      'RAIL COACH FACTORY',
      'RAIPUR JN',
      'RAJ NANDGAON',
      'RAJAMUNDRY',
      'RAMANAGARAM',
      'RAMGUNDAM',
      'RANI',
      'RATLAM JN',
      'RENIGUNTA JN',
      'ROURKELA',
      'SABARMATI BG',
      'SAI P NILAYAM',
      'SALEM JN',
      'SAMALKOT JN',
      'SAMBA',
      'SANGARIA',
      'SATUR',
      'SECUNDERABAD JN',
      'SHAHABAD',
      'SHEGAON',
      'SHOLINGHUR',
      'SHRIRANGAPATNA',
      'SIDDHPUR',
      'SIROHI ROAD',
      'SIRPUR KAGAZNGR',
      'SOJAT ROAD',
      'SOLAPUR JN',
      'SOMESAR',
      'SRIKAKULAM ROAD',
      'SUJANPUR',
      'SULTANPUR LODI',
      'SURAT',
      'SURATGARH JN',
      'SWARUPGANJ',
      'TAMBARAM',
      'TANDA URMAR',
      'TATANAGAR JN',
      'THANE',
      'TINDIVANAM',
      'TIRUCHCHIRAPALI',
      'TIRUMANGALAM',
      'TIRUNELVELI',
      'TIRUPATI',
      'TIRUPPUR',
      'TIRUVALLUR',
      'TUMSAR ROAD',
      'UNJHA',
      'VADODARA JN',
      'VALLIYUR',
      'VANIYAMBADI',
      'VAPI',
      'VARKALA',
      'VIJAYAWADA JN',
      'VIJIYPUR JAMMU',
      'VILLUPURAM JN',
      'VIRUDUNAGAR JN',
      'VISAKHAPATNAM',
      'VIZIANAGRAM JN',
      'VRIDHACHALAM JN',
      'WADI',
      'WALAJAH ROAD JN',
      'WARDHA JN',
      'WHITEFIELD',
      'YADGIR'
      ];

      /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
      autocomplete(document.getElementById("FromStation"), station);
      autocomplete(document.getElementById("ToStation"), station);

      </script>

       <script>
      function initMap() {
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var directionsService = new google.maps.DirectionsService;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 14,
          center: {lat: 18, lng: 72},
        });

        directionsDisplay.setMap(map);

        calculateAndDisplayRoute(directionsService, directionsDisplay);
        document.getElementById('mode').addEventListener('change', function() {
          calculateAndDisplayRoute(directionsService, directionsDisplay);
        });
      }

      function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        
        directionsService.route({
          origin: {lat: <?php echo $sLat; ?>, lng: <?php echo $sLng; ?>},  // Haight.
          destination: {lat: <?php echo $dLat; ?>, lng: <?php echo $dLng; ?>},  // Ocean Beach.
          // Note that Javascript allows us to access the constant
          // using square brackets and a string value as its
          // "property."
           travelMode: 'TRANSIT',
           transitOptions: {
           modes: ['TRAIN']
           }

        }, function(response, status) {
          if (status == 'OK') {
            directionsDisplay.setDirections(response);
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=*****&callback=initMap">
    </script>



      </body>
      </html>

