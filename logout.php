<?php
session_start();

if(session_destroy())
{
	 $_SESSION['login_user']= '';
	 $_SESSION['uname'] = '';
	 endMessage();
	 
}

function endMessage(){
	echo "<script> alert('Logout Successfull!!'); 
	     window.location.href='newhome.php'</script> ";
}
?>

