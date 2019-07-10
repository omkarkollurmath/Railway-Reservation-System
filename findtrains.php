<?php
session_start();


?><!DOCTYPE html>
<html>
<head>
	<title>Find Trains</title>
	
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="homestyle.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">
  <script src="jquery-3.3.1.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <style>
* {
  box-sizing: border-box;
}
   
    ul{
      display: block;
    }

    .bg-img {
    /* The image used */
    background-image: url(background2.jpg);
    min-height: 700px;
    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    position: relative;
}

  /* Add styles to the form container */
  .container{
      position: absolute;
      right: 50px;
      margin: 20px;
      max-width: 400px;
      padding: 10px;
      background-color: white;
  }

  .container-text {
    position: relative;
    text-align: center;
    color: white;
}
  /* Full-width input fields */
  input[type=text], input[type=password]{
      width: 100%;
      padding: 15px;
      margin: 5px 0 22px 0;
      border: none;
      background: #f1f1f1;
  }

   select,input[type=date]{
    width: 100%;
      padding: 15px;
      margin: 5px 0 22px 0;
      border: 1px solid transparent;
      background-color: #f1f1f1;
  }


  input[type=text]:focus, input[type=password]:focus {
      background-color: #ddd;
      outline: none;
  }

  .head{
  	font-family: "Poiret One", cursive;
  }

  /* Set a style for the submit button */
  .btn {
      background-color: blue;
      color: white;
      padding: 8px 20px;
      border: none;
      cursor: pointer;
      width: 100%;
      opacity: 0.8;
  }

  .btn:hover {
      opacity: 0.5;
  }

  .centered {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-weight: bold;
  }

  </style>

</head>
<body onload="startTime()">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <img class="navbar-brand" src="indianrail.png">

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>


  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <span>
    <ul class="navbar-nav mr-auto" >
     <?php


      if (!isset($_SESSION['uname'])) 
      {
      echo "<li class='nav-item' id='date' style='margin-left: 400px; font-size: 14px'></li> &emsp;
      <li class='nav-item' id='txt' style='font-size: 14px'></li>&emsp;&emsp;
      <li class='nav-item'><strong><a href='userlogin.html' style='color: red; text-decoration: none; font-size: 14px'>LOGIN</a></strong></li> &emsp;&emsp;
      <li class='nav-item'><strong><a href='newsignin.html' style='color: red; text-decoration: none; font-size: 14px'>REGISTER</a></strong></li>";
       }

      else{
       

       

       	echo" <li class='nav-item' id='date' style='margin-left: 400px; font-size: 14px'></li> &emsp;
      <li class='nav-item' id='txt' style='font-size: 14px'></li>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
      <li class='nav-item' id='disp' style='font-size: 14px'><b>Welcome :  ".$_SESSION['uname']." </b></li>&emsp;&emsp;&emsp;&emsp;&emsp;
      <li class='nav-item'><strong><a href='logout.php' style='color: red; text-decoration: none; font-size: 14px'>LOGOUT</a></strong></li> &emsp;&emsp;";
  }
       

  	?>
    </ul>
  
    <br>
    
    <ul class="navbar-nav mr-auto" style="margin-left: 135px;">
      
      <li class="nav-item" >
        <a class="nav-link" href="newhome.php"><img src="home1.png" width="25" height="20"><span class="sr-only">(current)</span></a>
      </li>
      &emsp;&emsp;
      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="trains" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          TRAINS
        </a>

      <?php 

       if(!isset($_SESSION['uname'])){
        echo "<div class='dropdown-menu' aria-labelledby='trains'>
           <a class='dropdown-item' href='newhome.php'>Book Ticket</a>
          <div class='dropdown-divider'></div>
          <a class='dropdown-item' href='cancelLogin.html'>Cancel Ticket</a>
          <div class='dropdown-divider'></div>
          <a class='dropdown-item' href='pnrstatus.php'>Booking Status</a>
          <div class='dropdown-divider'></div>
          <a class='dropdown-item' href='trainschedule.php'>Train Schedule</a>
          <div class='dropdown-divider'></div>
          <a class='dropdown-item' href='findtrains.php'>Find Trains</a>
        </div>";
       }

       else{

       echo "<div class='dropdown-menu' aria-labelledby='trains'>
           <a class='dropdown-item' href='newhome.php'>Book Ticket</a>
          <div class='dropdown-divider'></div>
          <a class='dropdown-item' href='cancelTicket.php'>Cancel Ticket</a>
          <div class='dropdown-divider'></div>
          <a class='dropdown-item' href='pnrstatus.php'>Booking Status</a>
          <div class='dropdown-divider'></div>
          <a class='dropdown-item' href='trainschedule.php'>Train Schedule</a>
          <div class='dropdown-divider'></div>
          <a class='dropdown-item' href='findtrains.php'>Find Trains</a>
        </div>";
       }
      ?>
      </li>

      &emsp;&emsp;

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="service" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          SERVICE AT STATIONS
        </a>
        <div class="dropdown-menu" aria-labelledby="service">
           <a class="dropdown-item" href="wifistation.html">WiFi Railway Stations</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="BOC.pdf" target="_blank" download>Battery Operated Cars</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="https://book.olacabs.com/?utm_source=2e57fc43da694ac4a5f1f0c3fa0c4f61&landing_page=bk&dsw=yes&ddal=yes" target="_blank">Book A Cab</a>
        </div>
      </li>

      &emsp;&emsp;

       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="promotion" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          PROMOTIONS
        </a>
        <div class="dropdown-menu" aria-labelledby="promotion">
           <a class="dropdown-item" href="irctcad.pdf" target="_blank" download>Advertise With IRCTC</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="https://play.google.com/store/apps/details?id=cris.org.in.prs.ima&hl=en" target="_blank">IRCTC Rail Connect App</a>
        </div>
      </li>

      &emsp;&emsp;

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="notification" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          NOTIFICATIONS
        </a>
        <div class="dropdown-menu" aria-labelledby="notification">
           <a class="dropdown-item" href="alerts.php">Alerts</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="updates.php">Updates</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="generalinformation.php">General Information</a>
        </div>
      </li>

      &emsp;

      <li id="myBtn" class="nav-link"><b>CONTACT US</b></li>

	&emsp;

<b> <a href="feedback.php"  class="nav-link">FEEDBACK</a></b>

    </ul>
    </span>

    <div id="myModal" class="modal" style="margin-top: 100px;margin-left: 100px;margin-right: 175px;">
      <div class="modal-content">
        <span class="close" align="right">&times;</span>
        <br>
        <p>
          <div style="text-align: center; font-size: 30px; background-color: rgba(0,0,255,0.3);">YOU MAY CONTACT US ON </div>
          <br>
          <pre>
          <b>Customer Care No</b> : 0755-6610661 , 0755-3934141 (Language: Hindi and English) <br>
          <b>For Railway tickets booked through IRCTC</b>
          <b>General Information</b>
          <b>I-tickets/e-tickets</b> : care@irctc.co.in 
          <b>For Cancellation E-tickets</b> : etickets@irctc.co.in 
          For IRCTC SBI Card users who do not receive the card within 01 month from the date of application kindly call on
          the Railway SBI Card Helpline nos. at 0124-39021212 or 18001801295 (if calling from BSNL/MTNL line) or send email 
          to feedback.gesbi@ge.com. For other queries on your IRCTC SBI card account, kindly email at loyaltyprogram@irctc.co.in
          <b>Registered Office / Corporate Office 
          Indian Railway Catering and Tourism Corporation Ltd.,
          B-148, 11th Floor, Statesman House, 
          Barakhamba Road, New Delhi 110001</b>
        </pre>
        </p>
      </div>
    </div>
  </div>
    
    <img class="navbar-brand" src="irctclogo.png" width="65px" height="75px" style="margin-right: 20px;">

</nav>
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

	 $sql = "select t1.TrainNo,t1.TrainName,s1.Station_Name as TrainSrc,s2.Station_Name as TrainDest from traininfo t1, station s1,station s2 where t1.TrainSrcId=s1.Station_Id  and t1.TrainDesId=s2.Station_Id";
	$result = $conn->query($sql);

	 if ($result -> num_rows <=0) {
  	echo "Record Does Not Exist";
    	}
	
	else{ 
   	echo " <br><br><table id = 'searchtrain' border=2 width=80% align=center>";
    	echo "<tr><td align='center' style='font-weight: bold;'>Train No</td><td align='center' style='font-weight: bold;'>Train Name</td><td align='center' style='font-weight: bold;'>Source</td><td align='center' style='font-weight: bold;'>Destination</td></tr>";
   	while($row = $result->fetch_assoc()) {
        	       	echo "<tr><td align='center'>" . $row["TrainNo"]. " <td width='300px' align='center'> " . $row["TrainName"]. " <td align='center'> " .$row["TrainSrc"]. "<td align='center'> ".$row["TrainDest"]."</tr>";
		}
	 }

$conn->close();	
?>




<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


<script>
    // Get the modal
    var modal = document.getElementById('myModal');

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
      modal.style.display = "block";
    } 

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
          modal.style.display = "none";
      }
    }


    function startTime(){
      var today = new Date();
      var h = today.getHours();
      var m = today.getMinutes();
      var s = today.getSeconds();
      var dd = today.getDate();
      var mm = today.getMonth();
      var yy = today.getFullYear(); 
      var month = new Array();
          month[0] = "Jan";
          month[1] = "Feb";
          month[2] = "March";
          month[3] = "April";
          month[4] = "May";
          month[5] = "June";
          month[6] = "July";
          month[7] = "Aug";
          month[8] = "Sept";
          month[9] = "Oct";
          month[10] = "Nov";
          month[11] = "Dec";
      m = checkTime(m);
      s = checkTime(s);

      document.getElementById("date").innerHTML = dd + "-" + month[mm] + "-" + yy;
      document.getElementById("txt").innerHTML = "["+ h+ ":" + m +":"+ s + "]";
      var t = setTimeout(startTime, 500);
    }

      function checkTime(i){
        if( i < 10){
          i = "0" + i;
        }
        return i;
      }


</script>

 <script>
                    var today1 = new Date();
                    var dd1 = today1.getDate();
                    var mm1 = today1.getMonth()+1; //January is 0!

                    var yyyy1 = today1.getFullYear();
                    if(dd1<10){
                    dd1='0'+dd1;
                    } 
                    if(mm1<10){
                    mm1='0'+mm1;
                    } 
                    var hello = yyyy1+"-"+mm1+"-"+dd1;
                    

                    var x = document.getElementById("myDate");
                    x.value = hello;    


                    function checkDate(){

                        var date = document.getElementById("myDate").value;

                        if(date < hello){
                          alert("Select valid date!");
                          window.setTimeout(function ()
                         {
                            document.getElementById("myDate").focus();
                          }, 0);
                        }

                        else{
                          window.setTimeout(function ()
                          {
                            document.getElementById("myDate").blur();
                        }, 0);
                        }
                    }

        </script>
</body>
</html>