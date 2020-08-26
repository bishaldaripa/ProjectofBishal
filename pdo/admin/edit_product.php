<?php
session_start();
include_once "../includes/database.php";
$ID=$_GET['id'];
$sql = 'SELECT * FROM product WHERE Product_ID=:id';
$statement = $connection->prepare($sql);
$statement->execute([':id' => $ID ]);
$fetch = $statement->fetch(PDO::FETCH_OBJ);
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
    $query= "UPDATE product SET  title=:title, description=:des , prize=:prize , img_file=:img  WHERE Product_ID=:id ";
   $statement=$connection->prepare($query);
    if ($statement->execute([':title'=>$title,':des'=>$description,':prize'=>$prize,':img'=>$img_file , ':id'=>$ID])) { 
        header("location: ../includes/product.php");
    }
    
}
// $ID=$_REQUEST['id'];
// $pro= "select * from product where Product_ID='$ID'";
// // echo "$pro";
// $txt= mysqli_query($databaseConnection , $pro);
// // var_dump($txt);
// $fetch= mysqli_fetch_array($txt);
// // var_dump($fetch);
?>
<html>
<head>
    <title>Add_Product</title>
    <link rel="stylesheet" type="text/css" href="../Bootstrap/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="../Bootstrap/js/bootstrap.min.js">
    </script>
</head>
<body>
<!-- title , description,prize,product_image -->
<!-- enctype="multipart/form-data (this attribute is required for file uploading purpose) -->
<form method="POST" enctype="multipart/form-data" >
    <div>
       <input type="text" name="title" placeholder="Title" value="<?php echo $fetch->title?>">
    </div>
    <div>
    <input type="text" name="description" placeholder="Description" value="<?php echo $fetch->description?>">
    </div>
    <div>
    <input type="text" name="prize" placeholder="Prize" value="<?php echo $fetch->prize?>">
    </div>
    </div>
        <input  placeholder="CHOOSE FILE" type="file" name="Image" value="<?php echo $fetch->img_file?>">
    </div> 
    <div>
    <button type="Submit"> update </button>
    </div>
</form>
</body>
</html>