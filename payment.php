<?php

  session_start();

  $BX_NAME=$_POST['BX_NAME'];
 $BX_Age = $_POST['BX_age'];
 $BX_Gender = $_POST['BX_gender'];
 $fare = $_POST['totalfare'];
 $eid = $_POST['eid'];
 $number= $_POST['number']; 

 $_SESSION['Pname'] = $BX_NAME;
 $_SESSION['Page'] = $BX_Age;
 $_SESSION['Pgender'] = $BX_Gender;
  $_SESSION['Mnumber'] = $number;
 $_SESSION['email'] = $eid;
 $_SESSION['fare'] = $fare;
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<style>
body {
  font-family: Arial;
  font-size: 17px;
  padding: 8px;
}

* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-50 {
  padding:0 16px;
}

.container {
  background-color: #f2f2f2;
  padding: 5px 400px 15px 400px;
  border-left: 200px lightgrey;
  border-right: 200px lightgrey;
  border-radius: 3px;
}

input[type=text] {
  width: 500px;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: #4CAF50;
  color: white;
  padding:12px;
  margin: 10px 0;
  border: none;
  width: 500px;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: #45a049;
}

a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}



/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
}
</style>
</head>
<body>

	
    <div class="container">
	
      <form action="Fpnrtrain.php" method="POST" class="myForm">
 
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" placeholder="Name" required/>
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="1111222233334444" pattern="[0-9]{16}" maxlength=16  required/>
            <div class="row">
	 <div style="padding-left:20px;">
                 <label for="expmonth">Exp Month</label>
               <select style="width:175px;height:40px;">
	  <option value="1">01</option>
	  <option value="2">02</option>
	  <option value="3">03</option>
	  <option value="4">04</option>
	  <option value="5">05</option>
	  <option value="6">06</option>
	  <option value="7">07</option>
	  <option value="8">08</option>
	  <option value="9">09</option>
	  <option value="10">10</option>
	  <option value="11">11</option>
	  <option value="12">12</option>
	</select>
                  </div>
                 <div style="padding-left:30px;">
                 <label for="expyear">Exp Year</label>
                 <select style="width:175px;height:40px;">
	  <option value="18">2018</option>
	  <option value="19">2019</option>
	  <option value="20">2020</option>
	  <option value="21">2021</option>
	  <option value="22">2022</option>
	  <option value="23">2023</option>
	  <option value="24">2024</option>
	  <option value="25">2025</option>
	</select>
                 </div><p style="padding-left:20px;">
              <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="CVV" pattern="[0-9]{4}" maxlength=4 required/>
	</p>
	<p style="padding-left:20px;">
	
        <input type="submit" value="Continue to checkout" class="btn"/></p>

      </form>
	
    </div>
  <span id="result"></span>
</body>
</html>
