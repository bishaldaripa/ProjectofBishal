<?php
$databaseServername="localhost";  //server name (default)
$databaseUsername="root";  //database user name (default)
$databasePassword="password"; //database password (default)
$databaseName="project2";  //database name (user defined)
$databaseConnection= mysqli_connect($databaseServername , $databaseUsername , "" , $databaseName);  //mysqli_connect function creates new connection to the mysql server
?>