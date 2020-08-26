 <?php
session_start();
include_once "../includes/database.php";
$id=$_REQUEST['id'];
$query=$connection->prepare("DELETE FROM product  WHERE Product_ID=:id");
$query->execute([':id'=>$id]);
header('location:../includes/product.php');

?>