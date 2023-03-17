<?php 
$mysqlusername="root";
$mysqlpassword="Password123!";
$mysqlhostname="localhost";
// $dbname="nathalieshop_db";


$conn=new mysqli($mysqlhostname,$mysqlusername,$mysqlpassword);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }


// in this part the the database and tables will automatically create upon the execution/running of the web app.

// Create database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS nathalieshop_db";
if ($conn->query($sql) !== TRUE) {
    echo "Error creating database: " . $conn->error;
}

// Select database
$conn->select_db("nathalieshop_db");

// Create user_accounts table
$sql = "CREATE TABLE IF NOT EXISTS user_accounts (
    user_id int NOT NULL AUTO_INCREMENT,
    user_name varchar(45) NOT NULL,
    user_password varchar(255) NOT NULL,
    first_name varchar(128) NOT NULL,
    last_name varchar(128) NOT NULL,
    user_email varchar(255) NOT NULL,
    user_address varchar(255) NOT NULL,
    user_role tinyint NOT NULL DEFAULT '0',
    PRIMARY KEY (user_id)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
if ($conn->query($sql) !== TRUE) {
    echo "Error creating user_accounts table: " . $conn->error;
}

// Query the database to check if the data already exists
$sql = "SELECT * FROM user_accounts WHERE user_name = 'administrator'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Delete the existing data
    $sql = "DELETE FROM user_accounts WHERE user_name = 'administrator'";
    if ($conn->query($sql) !== TRUE) {
        echo "Error deleting existing user from user_accounts table: " . $conn->error;
    }
}

// Insert the data
$sql = "INSERT INTO user_accounts (
    user_id,
    user_name,
    user_password,
    first_name,
    last_name,
    user_email,
    user_address,
    user_role
) VALUES (
    1,
    'administrator',
    'administrator',
    'admin',
    'admin',
    'admin@admin.com',
    'admin',
    1
)";

if ($conn->query($sql) !== TRUE) {
    echo "Error inserting default user into user_accounts table: " . $conn->error;
}


// Create products table
$sql = "CREATE TABLE IF NOT EXISTS products (
    product_id int NOT NULL AUTO_INCREMENT,
    product_name varchar(45) NOT NULL,
    product_price decimal(10,0) NOT NULL DEFAULT '0',
    product_quantity int NOT NULL DEFAULT '0',
    product_details varchar(255) NOT NULL,
    product_images varchar(255) NOT NULL,
    category varchar(45) NOT NULL,
    PRIMARY KEY (product_id)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
if ($conn->query($sql) !== TRUE) {
    echo "Error creating products table: " . $conn->error;
}

// Create transactions table
$sql = "CREATE TABLE IF NOT EXISTS transactions (
    id int NOT NULL AUTO_INCREMENT,
    user_id int DEFAULT NULL,
    transaction_id varchar(255) NOT NULL,
    date_time datetime NOT NULL,
    total_amount decimal(10,2) NOT NULL,
    payment_method varchar(255) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
if ($conn->query($sql) !== TRUE) {
    echo "Error creating transactions table: " . $conn->error;
}



// Create items table
$sql = "CREATE TABLE IF NOT EXISTS items (
  id int NOT NULL AUTO_INCREMENT,
  transaction_id varchar(255) NOT NULL,
  item_name varchar(255) NOT NULL,
  quantity int NOT NULL,
  price decimal(10,2) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";


if ($conn->query($sql) !== TRUE) {
    echo "Error creating transactions table: " . $conn->error;
}






?>