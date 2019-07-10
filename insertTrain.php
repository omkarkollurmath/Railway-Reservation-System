<?php

	session_start();

?>


<!DOCTYPE html>
<html>
<head>
	<title>Insert Train</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Monda" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">
</head>

<style>

	.container{
		 position: absolute;
	  left: 340px;
	  margin-top: 40px;
	  padding: 20px;
	  background-color: white;
	  width: 720px;
	  border: 3px solid #3D3175;
	}

	label,legend{
		font-size: 16px;	
		font-family: 'Roboto', sans-serif;
		font-weight: bold;
	}


	input[type=text]{
		font-size: 12px;	
		font-family: 'Monda', sans-serif;
		width:35%;
		height: 30px;
		border: 1px solid;
		padding-left: 5px;
	}

	.btn,.newBtn,.btn1{
		width: 120px;
		background-color: green;
		font-size: 14px;	
		color: white;
		font-family: 'Monda', cursive;
	}


	.btn:hover{
		opacity: 0.8;
	}

	.stationForm{
		width: 100%;
		height: auto;
	}

	table{

		border: 2px solid;
	}

	tr{
		border: none;
	}
	td{
		border-bottom: 1px solid;
	}



</style>

<body>


	<h1 style="margin-left: 620px;font-family: 'Poiret One', cursive;"> Add New Train </h1>

	<div class="container">
	<form method="post" action="insertNewTrain.php">

		<label>Train Name</label><br><br>
		<input type="text" name="tname" placeholder="Enter Train Name" required/><br><br>
		<label>Train No</label><br><br>
		<input type="text" name="tno" placeholder="Enter Train No" minlength="5" maxlength="5" required/><br><br>
		<label>Source Station </label><br><br>
		<input type="text" name="src" placeholder="Enter Source Station" required/><br><br>
		<label>Desination Station</label><br><br>
		<input type="text" name="dest" placeholder="Enter Destination Station" required/><br><br>
		<label>Classes Available </label><br><br>
		<input type="checkbox" name="class[]" value="FIRST AC">FIRST AC<br/>
		<input type="checkbox" name="class[]" value="SECOND AC">SECOND AC<br/>
		<input type="checkbox" name="class[]" value="FIRST CLASS">FIRST CLASS<br/>		
		<input type="checkbox" name="class[]" value="THIRD AC">THIRD AC<br/>
		<input type="checkbox" name="class[]" value="3rd AC ECONOMY">3rd AC ECONOMY<br/>
		<input type="checkbox" name="class[]" value="AC CHAIR CAR">AC CHAIR CAR<br/>	
		<input type="checkbox" name="class[]" value="SLEEPER CLASS">SLEEPER CLASS<br/>
		<input type="checkbox" name="class[]" value="SECOND SEATING">SECOND SEATING<br/>	
		<br>
		<div class="row2">
				<legend>Train Details</legend>
				<p> 
					<input type="button" class="newBtn" value="Add Station" onClick="addRow('dataTable')" /> 
					<input type="button" class="newBtn" value="Remove Station" onClick="deleteRow('dataTable')"  /> 
					<p><strong>(All acions apply only to entries with check marked check boxes only.)</strong></p>
				</p>
               <table id="dataTable" class="stationForm" border="1">
                  <tbody>

					<tr>
                      <p>
						<td><input type="checkbox" required="required" name="chk[]" checked="checked" /></td>
						<td>
							<label for="StationName">Station Name</label>
							<input type="text" required="required" name="StationName[]" style="width: 100px;">
						 </td>
						 <td>
							<label for="StationCode">Station Code</label>
							<input type="text" required="required" name="StationCode[]" style="width: 100px;">
						 </td>
						 <td>
							<label for="ArrTime">Arrival Time</label>
							<input type="text" required="required" class="small"  name="ArrTime[]" style="width: 100px;">
					     </td>
						 <td>
							<label for="DeptTime">Departure Time</label>
							<input type="text" required="required" class="small"  name="DeptTime[]" style="width: 100px;">
						 </td>
						 <td>
							<label for="Latitude">Latitude</label>
							<input type="text" required="required" class="small"  name="Lat[]" style="width: 100px;">
						 </td>
						 <td>
							<label for="Longitude">Longitude</label>
							<input type="text" required="required" class="small"  name="Long[]" style="width: 100px;">
						 </td>
						 </p>
                    </tr>

                    </tbody>
                </table>
				
            </div>
            <br><br>
            <button class="btn" id="btn-validate" onClick="return check('dataTable')">SUBMIT</button>
            <a href="adminhome.php" class="btn1" style="margin-left: 150px; text-decoration: none; padding: 5px;">Go To Home Page </a>
	</form>
    </div>


    <script>
        


function addRow(tableID) {
var table = document.getElementById(tableID);
var rowCount = table.rows.length;
var row = table.insertRow(rowCount);
var colCount = table.rows[0].cells.length;
for(var i=0; i<colCount; i++) {
var newcell = row.insertCell(i);
newcell.innerHTML = table.rows[0].cells[i].innerHTML;
}

}

function deleteRow(tableID) {
var table = document.getElementById(tableID);
var rowCount = table.rows.length;
for(var i=0; i<rowCount; i++) {
var row = table.rows[i];
var chkbox = row.cells[0].childNodes[0];
if(null != chkbox && true == chkbox.checked) {
if(rowCount <= 2) { 						// limit the user from removing all the fields
alert("Cannot Remove all the Stations.You need to have altleast Two Stations.");
break;
}
table.deleteRow(i);
rowCount--;
i--;
}
}
}


function check(tableID){

	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;

	if(rowCount < 2){
		alert("Please Enter All Station Details");
		return false;
	}

	else
	{
			return true;
	}
}

</script>


</body>
</html>