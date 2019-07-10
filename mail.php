<!DOCTYPE html>
<html>
<head>
	<title> Send Mail from Php using Smtp </title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>

<div class="container">
	<h1 class="text-center"> Sending Mail </h1>
	<h2 class="text-center">Part 1: Using sendmails </h2>
	<?php
		if(isset($_POST['sendmail'])){
			if(mail($_POST['email'],$_POST['subject'],$_POST['message'])){
				echo "Mail Sent";
			}
			else{
				echo "Failed";
			}
		}  
	?>

	<div class="row">
		<div class="col-md-9 col-md-offset-2">
			<form role="form" method="post"	enctype="multipart/form-data">
				<div class="row">
					<div class="col-sm-9 form-group">
						<label for="email">To Email:</label>
						<input type="email" class="form-control" id="email" name="email" maxlength="50"> 
					</div>
				</div>
				<div class="row">
				<div class="col-sm-9 form-group">
					<label for="name">Subject:</label>
					<input type="text" class="form-control" id="subject" name="subject" placeholder="YOUR Subject HERE" maxlength="50">
				</div>
			    </div>

				<div class="row">
				<div class="col-sm-9 form-group">
					<label for="name">MESSAGE</label>
					<textarea class="form-control" type="textarea" id="message" name="message" placeholder="YOUR MESSAGE HERE" maxlength="6000" rows="5"></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-9 form-group">
					<button type="submit" name="sendmail" class="btn btn-lg btn-success btn-block">Send</button>
				</div>
			</div>
		</form>
	</div>
</div>
</div>
</body>
</html>
