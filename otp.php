<?php
session_start();
$otpvar=1;
if(isset($_POST['save']))
{
$rno=$_SESSION['otp'];
$urno=$_POST['otpvalue'];
if(!strcmp($rno,$urno))
{
echo "<p>Correct OTP</p>";
$otpvar=0;
}
else{
echo "<p>Invalid OTP</p>";
$optvar=1;
}
}
//resend OTP
if(isset($_POST['resend']))
{
$message="<p class='w3-text-green'>Sucessfully send OTP to your mail.</p>";
$rno=$_SESSION['otp'];
$to=$_SESSION['email'];
$subject = "IRCTC";
$txt = "OTP: ".$rno."";
mail($to,$subject,$txt);
$message="<b>Sucessfully resend OTP to your mail.</b>";
}
?>
<!DOCTYPE html>
<html>
<header>
<title>OTP</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://studentstutorial.com/div/d.css">
<style>
a{
text-decoration:none;
}
</style>
<header>
<body>
<br>
<form class="w3-container" method="post" action="">
<br>
<p><input class="w3-input w3-border w3-round" type="password" placeholder="OTP" name="otpvalue"></p>
<p ><button style="width:100%;height:40px" name="save">Submit</button></p>
<p ><button style="width:100%;height:40px" name="resend">Resend</button></p>
</form>
<div><?php
	 if(isset($message)) {
		 echo $message;
		
	 } 
?>
<?php
if($otpvar == 0){
	echo "<form method='post' action='pnrcancel.php'><label style=padding-left:30px;'> Enter PNR No. : </label><input type='text' placeholder='Enter 10 digit PNR No.' style='width: 200px; height: 30px;' name='pnr' pattern='[0-9]{10}' maxlength=10 required><p style='padding-left:155px;'><input type='submit' name='submit' value='Submit' style='width:200px;' ></p></form>";
}
?>
</div>
<br>
</body>
</html>