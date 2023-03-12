<?php 
include './db/database.php';
session_start();

    $userid = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    $fname = $_SESSION['fname'];
    $lname = $_SESSION['lname'];
    $email = $_SESSION['email'];
    $address = $_SESSION['address'];


 


    if(!isset($userid)){
        header("Location: index.php");
    }

?>