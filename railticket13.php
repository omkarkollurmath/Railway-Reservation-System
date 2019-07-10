<?php
session_start();

?>
<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/default.css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>

<style>
	
	input{
		border: 1px solid black;
	}

</style>

<body>

<form action="payment.php" class="register" method="POST" style="width: 900px;">
            <h1 style="font-size: 30px;">IRCTC Train Ticket Reservation</h1>
	<div class="row1">
                <legend>Travel Information</legend>
	<p>
<?php 
if(isset($_POST['railclass'])){
     $_SESSION['class'] = $_POST['railclass'];
}
else{
	header("Location: http://localhost:8080/frailproject/newhome.php");
}
?>

                   <label>Train No *</label>
	  <input name="TrainNo" type="text" required="required" value="<?php echo $_GET["TrainNo"]; $_SESSION['trainno'] = $_GET["TrainNo"] ?>" style="width: 200px;" disabled/>
	  <label>Train Name *</label>
                   <input name="TrainName" type="text" required="required" value="<?php echo $_GET["TrainName"]; $_SESSION['trainname'] = $_GET["TrainName"]?>" style="width: 200px;" disabled/>
                   </p><p><label>Date of journey *</label>
                   <input type="date" id="myDate" name="tdate" value="<?php echo $_SESSION['traveldate'];?>" disabled/>
	  <label style="padding-left:60px;">Class *</label>
	<input type="text" name="classes" value="<?php echo $_POST["railclass"];?>" style="width: 200px;" disabled required/>
	
	   
	<p>
	 <label>Boarding From*</label>
                   <input name="from" type="text" required="required" value="<?php echo $_GET["FromStation"]; $_SESSION['from'] = $_GET["FromStation"];?>" style="width: 200px;" disabled/>					
	  <label>To*</label>
 	  <input name="to" required="required" value="<?php echo $_GET["ToStation"]; $_SESSION['to'] = $_GET["ToStation"];?>" type="text" style="width: 200px;" disabled/>
                   </p>

    <p> <label> Seat Available : </label>

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

	$sql="SELECT 10-count(*) as seat from train_pnr_demo2 t where t.TrainId = (select tt.TrainId from traininfo tt where tt.TrainNo= '".$_SESSION['trainno']."') and t.TravelDate like '".$_SESSION['traveldate']."'";
	$result = $conn->query($sql);
	if ($result) 
	{
		?><input type="text" name="seat" id="seat" value = "<?php
		$row = $result->fetch_assoc(); 
		   echo ($row["seat"]);
			?>" disabled/><?php	
	}
		
	$conn->close();
?>  
	</p>
	 <p> <label>Mobile *</label>
                    <input name="number" required="required" type="tel" pattern="[0-9]{10}" maxlength=10/>
	   <label style="padding-left:60px;">Email ID *</label>
                    <input name="eid" required="required" type="email"/>
	  </p><p>
                   <font style="float:right;padding-right:350px;">(You will receive the ticket in this)</font>
                </p>
				<div class="clear"></div>
            </div>
            
            <div class="row2">
				<legend>Passenger Details</legend>
				<p> 
					<input type="button" value="Add Passenger" onClick="addRow('dataTable')" /> 
					<input type="button" value="Remove Passenger" onClick="deleteRow('dataTable')"  /> 
					<p>(All acions apply only to entries with check marked check boxes only.)</p>
				</p>
               <table id="dataTable" class="form" border="1">
                  <tbody>

					
                    <tr>
                      <p>
						<td><input type="checkbox" required="required" name="chk[]" checked="checked" /></td>
						<td>
							<label>Name</label>
							<input type="text" required="required" name="BX_NAME[]">
						 </td>
						 <td>
							<label for="BX_age">Age</label>
							<input type="text" required="required" class="small"  name="BX_age[]" maxlength=2>
					     </td>
						 <td>
							<label for="BX_gender">Gender</label>
							<select id="BX_gender" name="BX_gender[]" required="required" >
								<option disabled selected value style="display:none;"></option>
								<option>Male</option>
								<option>Female</option>
							</select>
						 </td>
						 </p>
                    </tr>
                    </tbody>
                </table>
				<div class="clear"></div>
            </div>
           	<br><br>
            <div class="row3">
                <legend>Further Information</legend>
				<p>The identification details are required during journey. One of the passenger booked on the ticket should have any of the identity cards ( Passport / PAN Card / Driving License / Photo ID card issued by Central / State Govt / Student Identity Card with photograph) during the journey in original. </p>
				<div class="clear"></div>
            </div>
           	
            <div class="row4">
                <legend>Terms and Mailing</legend>
                <p class="agreement">
                    <input type="checkbox" value="" required/>
                    <label>*  I accept the Terms and Conditions</label>
                </p>
                <p class="agreement">
                    <input type="checkbox" value=""/>
                    <label>I want to receive personalized offers by your Service</label>
                </p>
				
				
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

			
				$selected_val = $_POST['railclass'];  
 
 				$sql="SELECT c.classfare as total from classes c  where c.classname = '$selected_val'";
			    $result = $conn->query($sql);
			if ($result) 
			{
			$row = $result->fetch_assoc(); 
			//echo "<input type='text' name='total' id='cfare' value='".$row['total']."' disabled/>";

			}


			$conn->close();
			?>              
 	

			<p>
					<label style=""> Total Amount :</label>
					<input type="text" name="totalfare" id="cfare" value="<?php echo $row['total']?>" />	
			</p>			
				<div class="clear"></div>
            </div>
			<input class="submit" type="submit" value="Confirm &raquo;" style="margin-left: 250px;"/>
			<a class="submit" href="newhome.php"/>Back to Home Page</a>
			
			<div class="clear"></div>
        </form>
	
        
         
        <script>
        	function changeCost(){
        	var x  = document.getElementById("cfare");
        	x.value = 0;
        }


function addRow(tableID) {
	var table = document.getElementById(tableID);
	var seat = document.getElementById("seat");
	var rowCount = table.rows.length;
	var cost  = <?php echo $row['total']?>;
	
	var currfare = document.getElementById("cfare");

	if(rowCount < seat.value){

		if(rowCount < 5){
		
	    var total = (rowCount+1) * cost;
	    currfare.value = total;
	
								// limit the user from creating fields more than your limits
		var row = table.insertRow(rowCount);
		var colCount = table.rows[0].cells.length;
		for(var i=0; i<colCount; i++) {
			var newcell = row.insertCell(i);
			newcell.innerHTML = table.rows[0].cells[i].innerHTML;
		}
	}else{
		 alert("Maximum Passenger per ticket is 5.");
			   
	}
}
	else{
		alert("Required No of Seats not Available");
	}
}

function deleteRow(tableID) {
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	var cost  = <?php echo $row['total']?>;
	var currfare = document.getElementById("cfare");
	for(var i=0; i<rowCount; i++) {
		var row = table.rows[i];
		var chkbox = row.cells[0].childNodes[0];
		if(null != chkbox && true == chkbox.checked) {
			if(rowCount <= 1) { 						// limit the user from removing all the fields
				alert("Cannot Remove all the Passenger.");
				break;
			}
			table.deleteRow(i);

			rowCount--;

			var total = (rowCount) * cost;
	        currfare.value = total;
			i--;
		}
	}
}

</script>

</body>
</html>