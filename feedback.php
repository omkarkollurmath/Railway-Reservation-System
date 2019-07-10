<!DOCTYPE html>
<html>
<head>
    <title>CONTACT US</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<style> 

.box{	
    position: static;
    border: 3px solid #73AD21;
    width:750px;
    height:325px;
    margin-top: 10px;
    border-radius: 10px;
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: 30px;
}
</style>
</head>
<body>



<div class="container">
     <br><br><br><br><br><br>
     <div class="box">
      <label style="font-size:20px;padding-left:250px;">FEEDBACK FORM</label>
    <form action="feedbackinsert.php" method="POST">
        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
       <div class="form-group">
            <label>Rate Us:</label>
            <input type="number" min="0" max="100" class="form-control" name="rating" maxlength=3 required>
        </div>
        <div class="form-group">
            <label>Any Suggestions to improve our Services:</label>
            <textarea class="form-control" name="message" ></textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-success" type="submit">Submit</button>
        </div>
    </form>
</div>
</div>

</body>
</html>