<?php
session_start();
$rndno=rand(100000, 999999);//OTP generate
$message = urlencode("otp number.".$rndno);
$to=$_POST['email'];
$subject = "OTP";
$txt = "OTP: ".$rndno."";
$headers = "From: prailproject@gmail.com";
mail($to,$subject,$txt,$headers);
if(isset($_POST['submit']))
{
$_SESSION['email']=$_POST['email'];
$_SESSION['otp']=$rndno;
header( "Location: otp.php" ); 
} ?>

