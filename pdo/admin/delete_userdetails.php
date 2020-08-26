<?php
session_start();
include_once "../includes/database.php";
$ID=$_REQUEST['id'];
$query=$connection->prepare("DELETE FROM accounts  WHERE ID=:id");
$query->execute([':id'=>$ID]);
header('location:userdetails.php' );

// mysqli_query($databaseConnection , $query);
// header('location:userdetails.php');
?>