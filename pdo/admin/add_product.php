<?php
session_start();
include_once "../includes/database.php";
if($_SERVER['REQUEST_METHOD']=='POST'){
	$title=$_REQUEST['title'];
	$description=$_REQUEST['description'];
	$prize=$_REQUEST['prize'];	
	$img_name=$_FILES['Image']['name'];
	$img_size=$_FILES['Image']['size'];
	$temp_location=$_FILES['Image']['tmp_name'];
	$directory='../product_image/';
	$img_file= $directory . $img_name;
	move_uploaded_file($temp_location, $img_file);
	$query= "insert into product(title,description,prize,img_file) values (:title,:des,:prize,:img)";
	$statement=$connection->prepare($query);
	if ($statement->execute([':title'=>$title,':des'=>$description,':prize'=>$prize,':img'=>$img_file])) {
	echo "data inserted successfully";	
	}
}
?>
<html>
<head>
	<title>Add_Product</title>
	<link rel="stylesheet" type="text/css" href="../css/add.css">
	<link rel="stylesheet" type="text/css" href="../Bootstrap/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="../Bootstrap/js/bootstrap.min.js">
	</script>
</head>
<body class="bdy">
<!--  <form class="form-inline ml-auto" action="add_search.php" method="POST">
      <div class="md-form my-0">
        <input class="form-control" type="text" placeholder="Search" aria-label="Search" name="search">
      </div>
      <button href="#!" class="btn btn-outline-white btn-md my-0 ml-sm-2" type="submit">Search</button>
    </form>
 -->

<form method="POST" enctype="multipart/form-data"  class="frm">
	<div id="dd">
	   <input type="text" name="title" placeholder="Title" id="bttn">
	</div>
	<div id="dd">
	<input type="text" name="description" placeholder="Description" id="bttn">
	</div>
	<div id="dd">
	<input type="text" name="prize" placeholder="Prize" id="bttn">
	</div>
	</div id="dd">
        <input  placeholder="CHOOSE FILE" type="file" name="Image" >
    </div> 
    <div id="dd">
    <button type="Submit" id="sub"> Submit </button>
    </div>
</form>
</body>
</html>