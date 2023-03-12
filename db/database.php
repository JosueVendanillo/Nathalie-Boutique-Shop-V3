<?php 
$mysqlusername="root";
$mysqlpassword="Password123!";
$mysqlhostname="localhost";
$dbname="nathalieshop_db";



$conn=new mysqli($mysqlhostname,$mysqlusername,$mysqlpassword,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }


  

?>


