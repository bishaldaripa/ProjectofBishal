
<?php
require '../includes/database.php';
$id = $_GET['id'];
$sql = 'SELECT * FROM accounts WHERE ID=:id';
$statement = $connection->prepare($sql);
$statement->execute([':id' => $id ]);
$person = $statement->fetch(PDO::FETCH_OBJ);
if($_SERVER['REQUEST_METHOD']== 'POST'){
	$YourName=$_REQUEST['YourName'];
	$YourEmail=$_REQUEST['YourEmail'];
	$Phone=$_REQUEST['Phone'];
	$Job=$_REQUEST['Job'];
	$Createpassword=$_REQUEST['Createpassword'];
	$Repeatpassword=$_REQUEST['Repeatpassword'];
$sql = 'UPDATE accounts SET YourName=:name, YourEmail=:email , Phone=:phone , Job=:job , Createpassword=:cpass , Repeatpassword=:rpass WHERE ID=:id';
$statement = $connection->prepare($sql);
if ($statement->execute([':name' => $YourName, ':email' => $YourEmail, ':phone' =>$Phone , ':job' =>$Job , ':cpass' =>$Createpassword , ':rpass' =>$Repeatpassword , ':id' => $id])) {
header("Location: userdetails.php");
}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>

</head>
<body>
<?php 
include_once "../includes/navigation.php"
?>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">


<div class="container">

<hr>





<div class="card bg-light">
<article class="card-body mx-auto" style="max-width: 400px;" >
	<h4 class="card-title mt-3 text-center">Create Account</h4>
	<p class="text-center">Get started with your free account</p>
	
	<p class="divider-text">
        <span class="bg-light">OR</span>
    </p>
	<form method="POST">
	<div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
        <input name="YourName" class="form-control" placeholder="Full name" type="text" value="<?php echo $person ->YourName ?>">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
		 </div>
        <input name="YourEmail" class="form-control" placeholder="Email address" type="email" value="<?php echo $person->YourEmail?>">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
		</div>
		<select class="custom-select" style="max-width: 120px;">
		    <option selected="">+971</option>
		    <option value="1">+972</option>
		    <option value="2">+198</option>
		    <option value="3">+701</option>
		</select>
    	<input name="Phone" class="form-control" placeholder="Phone number" type="text" value="<?php echo $person->Phone?>">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-building"></i> </span>
		</div>
		<select class="form-control" name="Job" >
			<option selected="" value="<?php echo $person->Job?>"> Select job type</option>
			<option>Designer</option>
			<option>Manager</option>
			<option>Accaunting</option>
		</select>
	</div> <!-- form-group end.// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
        <input class="form-control" placeholder="Create password" type="password" name="Createpassword" value="<?php echo $person->Createpassword?>">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
        <input class="form-control" placeholder="Repeat password" type="password" name="Repeatpassword" value="<?php echo $person->Repeatpassword?>">
    </div> <!-- form-group// -->                                      
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block"> Create Account  </button>
    </div> <!-- form-group// -->      
    <p class="text-center">Have an account? <a href="login.php">Log In</a> </p>                                                                 
</form>
</article>
</div> <!-- card.// -->

</div> 
<!--container end.//-->
</body>
</html>