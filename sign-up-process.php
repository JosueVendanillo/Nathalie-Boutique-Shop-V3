<?php
   // Connect to database
   include './db/database.php';

if(isset($_POST['submit'])){
    // Get form data
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $address = $_POST['address'];

    // Validate form data
    if(empty($username) || empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($address)){
        // Display error message if any field is empty
        echo "Please fill all the fields!";
    }
    else {
        // Password validation
        if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/\d/', $password) || !preg_match('/[!@#$%^&*()\-_=+{}\[\]\\|;:\'",.<>\/?~]/', $password)) {
            echo "Password must contain at least 8 characters, 1 uppercase letter, 1 number and 1 symbol!";
        } else {
            // All fields are valid, proceed with the form submission
           
  
            // Check if the username is already taken
            $query = "SELECT * FROM users WHERE username='$username'";
            $result = mysqli_query($conn, $query);

            if(mysqli_num_rows($result) > 0){
                // Display error message if the username is already taken
                echo "Username already exists!";
            }
            else {
                // Insert form data into the database
                $query = "INSERT INTO users_account (user_name, user_password, first_name, user_email, user_address) VALUES ('$username', '$firstname', '$lastname', '$email', '$password', '$address')";
                if(mysqli_query($conn, $query)){
                    // Display success message with countdown timer and close button
                    echo 'Success created';
                
                        header("Location: http://localhost:8080/nathalie%20shop%20V3/index.php?msg='Account successfully created'");
                }
                else {
                    // Display error message if there's an error with the database query
                    echo "Error: " . mysqli_error($conn);
                }
        }
        // mysqli_close($conn);


        }
    }
   
    
}

?>

<style>

/* Close button */
.closebtn {
  color: white;
  float: right;
  font-size: 22px;
  font-weight: bold;
  cursor: pointer;
}

.closebtn:hover {
  color: black;
}

</style>

