<?php

if(empty($_POST['username'])){
    die("Username is required");
}

if(empty($_POST['password'])){
    die("password is required");
}

if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    die("Valid email is required");
}

if(strlen($_POST['password']) < 8){
    die ("Password must contain at least 8 characters");
}


// requires the password to have at least 1 uppercase letter , 1 number , 1 symbol
if(! preg_match("/[A-Z]/i", $_POST['password']) 
    || ! preg_match("/[^\w]/i", $_POST['password']) 
    || ! preg_match("/[0-9]/", $_POST['password'])){
    die("Password must contain at least one uppercase letter, symbol, number ");
}
// else{
//     echo"Strong password";
// }


// will check the input textbox gender 
// if(! strlen($_POST['gender']) == "FEMALE" || ! strlen($_POST['gender']) == "MALE"){
//     die ("Input must be MALE or FEMALE only.");
// }



$password_hash = password_hash($_POST['password'],PASSWORD_DEFAULT);


//user account creation occurs here
$mysqli = require __DIR__. "/db/config.php";

$sql = "INSERT INTO users (username, user_password, firstname, lastname, phonenumber, birthdate, gender, email, useraddress) VALUES (?,?,?,?,?,?,?,?,?)" ;

$stmt = $mysqli->stmt_init();


if( ! $stmt->prepare($sql)){
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("sssssssss",
                    $_POST['username'],
                    $password_hash,
                    $_POST['firstname'],
                    $_POST['lastname'],
                    $_POST['phonenumber'],
                    $_POST['birthdate'],
                    $_POST['gender'],
                    $_POST['email'],
                    $_POST['address']);

if($stmt->execute()){
    echo "Signup Successful";

}
else{
    die($mysqli-> error . " ". $mysqli->errno);
}

// print_r($_POST);
// var_dump($password_hash);

?>