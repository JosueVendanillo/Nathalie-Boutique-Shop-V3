<?php 
    include './db/database.php';
?>

<!-- sign up -->
<?php

  // Start session
  

            if(isset($_POST['register'])){
                // Get form data
                $username = $_POST['registerUsername'];
                $password = $_POST['registerPassword'];
                $firstname = $_POST['registerFirstName'];
                $lastname = $_POST['registerLastName'];
                $email = $_POST['registerEmail'];
                $address = $_POST['registerAddress'];

                // Check if user already exists
                $stmt = $conn->prepare("SELECT user_name, user_email FROM user_accounts WHERE user_name = ? OR user_email = ?");
                $stmt->bind_param("ss", $username, $email);
                $stmt->execute();
                $stmt->store_result();

                if ($stmt->num_rows > 0) {
                    // echo "Username or email already exists";
                    header("Location: login-form.php?msg=Username or email already exists");
                    exit();
                }

                // Insert new user
                $stmt = $conn->prepare("INSERT INTO user_accounts (`user_name`,`user_password`,`first_name`,`last_name`,`user_email`,`user_address`) 
                VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssss", $username, $password, $firstname, $lastname, $email, $address);
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    // echo 'Customer Account created sucessfully';
                    header("Location: login-form.php?msg=Customer Account created sucessfully!");
                } else {
                    echo "Failed: " . mysqli_error($conn);
                    exit();
                }
            }
        ?>


        <!-- Login -->
            <?php
           if (isset($_POST['login'])) {
            $username = mysqli_real_escape_string($conn,$_POST['loginUsername']);
            $password = mysqli_real_escape_string($conn,$_POST['loginPassword']);
            $remember_me = isset($_POST['remember_me']);
        
            // Validate username and password
            $query = "SELECT * FROM user_accounts WHERE user_name = '$username' AND user_password = '$password'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
        
            if (mysqli_num_rows($result) == 1) {
                // User has provided valid credentials
        
                // Set cookie if "Remember me" is checked
                if ($remember_me) {
                    setcookie('username', $username, time() + (3 * 60)); // Expires in 3 minutes
                    setcookie('password', $password, time() + (3 * 60)); // Expires in 3 minutes
                }

                // Redirect to home page or dashboard

                session_start();
                // Set session variables
                $_SESSION['user_id']    = $row['user_id'];
                $_SESSION['username']   = $row['user_name'];
                
                $_SESSION['fname']      = $row['first_name'];
                $_SESSION['lname']      = $row['last_name'];
                $_SESSION['email']      = $row['user_email'];
                $_SESSION['address']    = $row['user_address'];



                // Redirect to home page or dashboard
                header("Location: index.php");
                exit();

            } else {
                // User has provided invalid credentials
                // ...

                header("Location: index.php?msg=Incorrect Username or Password");
                exit();
            }
        
            // Close the database connection
            mysqli_close($conn);
        }
        
        if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
            $username = $_COOKIE['username'];
            $password = $_COOKIE['password'];
        
            // Connect to the database
            $conn = mysqli_connect($host, $user, $pass, $db);
        
            // Validate username and password
            $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
            $result = mysqli_query($conn, $query);
        
            if (mysqli_num_rows($result) == 1) {
                // User has valid cookies and is authenticated
        
                // Redirect to home page or dashboard

                // Start session
                session_start();
                // Set session variables
                $_SESSION['user_id']    = $row['user_id'];
                $_SESSION['username']   = $row['user_name'];
                
                $_SESSION['fname']      = $row['first_name'];
                $_SESSION['lname']      = $row['last_name'];
                $_SESSION['email']      = $row['user_email'];
                $_SESSION['address']    = $row['user_address'];


                // Redirect to home page or dashboard
                header("Location: index.php");
                exit();
            }
        
            // Close the database connection
            mysqli_close($conn);
        }
        
            ?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>


  <!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css"
  rel="stylesheet"
/>

</head>


<style>
    body{
        margin: 0;
        padding: 0;
      
        overflow: hidden;
        background: #ffc8dd;
       

    }

    .container{
        position: relative;
        margin-top: 100px;
        height: 100%;
        /* background: whitesmoke; */
        
    }



</style>


<body>

 
            <div class="container ">

            <!-- Alert for sign up-->
            <?php
                if(isset($_GET['msg'])){
                    $msg = $_GET['msg'];
                    $countdown = 5; // Countdown time in seconds

                    if($msg === 'Customer Account created sucessfully!'){

                        echo '
                          <div class="alert alert-success alert-dismissible fade show" role="alert">
                            ' . $msg . '
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <div id="countdown" style="font-weight: bold;"></div>
                          </div>
                          <script>
                            var countdown = ' . $countdown . ';
                            var countdownElem = document.getElementById("countdown");
                        
                            var intervalId = setInterval(function() {
                              countdown--;
                              countdownElem.innerHTML = "This alert will disappear in " + countdown + " seconds.";
                        
                              if (countdown == 0) {
                                clearInterval(intervalId);
                                removeAlert();
                              }
                            }, 1000);
                        
                            function removeAlert() {
                              document.querySelector(\'.alert\').remove();
                              window.location.href=\'http://localhost:8080/nathalie%20shop%20V3/login-form.php\';
                            }
                            
                            document.querySelector(\'.btn-close\').addEventListener("click", function() {
                              clearInterval(intervalId);
                              removeAlert();
                            });
                          </script>
                        ';
                    } else if($msg === 'Username or email already exists!'){
                        echo '
                          <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            ' . $msg . '
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <div id="countdown" style="font-weight: bold;"></div>
                          </div>
                          <script>
                            var countdown = ' . $countdown . ';
                            var countdownElem = document.getElementById("countdown");
                        
                            var intervalId = setInterval(function() {
                              countdown--;
                              countdownElem.innerHTML = "This alert will disappear in " + countdown + " seconds.";
                        
                              if (countdown == 0) {
                                clearInterval(intervalId);
                                removeAlert();
                              }
                            }, 1000);
                        
                            function removeAlert() {
                              document.querySelector(\'.alert\').remove();
                              window.location.href=\'http://localhost:8080/nathalie%20shop%20V3/login-form.php\';
                            }
                            
                            document.querySelector(\'.btn-close\').addEventListener("click", function() {
                              clearInterval(intervalId);
                              removeAlert();
                            });
                          </script>
                        ';
                    }else if($msg === 'Incorrect Username or Password'){

                        echo '
                          <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            ' . $msg . '
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <div id="countdown" style="font-weight: bold;"></div>
                          </div>
                          <script>
                            var countdown = ' . $countdown . ';
                            var countdownElem = document.getElementById("countdown");
                        
                            var intervalId = setInterval(function() {
                              countdown--;
                              countdownElem.innerHTML = "This alert will disappear in " + countdown + " seconds.";
                        
                              if (countdown == 0) {
                                clearInterval(intervalId);
                                removeAlert();
                              }
                            }, 1000);
                        
                            function removeAlert() {
                              document.querySelector(\'.alert\').remove();
                              window.location.href=\'http://localhost:8080/nathalie%20shop%20V3/login-form.php\';
                            }
                            
                            document.querySelector(\'.btn-close\').addEventListener("click", function() {
                              clearInterval(intervalId);
                              removeAlert();
                            });
                          </script>
                        ';

                    }
                }
        ?>

                    <div class="d-flex justify-content-center">

                                <div class=" border rounded-2 p-5 border-secondary bg-light">

                                    <div class=" d-flex flex-column justify-content-center align-items-center">
                                        <img src="./assets/img/background/logo.jpg" alt="" class="img-fluid mb-3" width="200px" height="200px">
                                        <h4 class="mb-3 ">Customer Portal</h4>
                                    </div>
                                


                                    <!-- Pills navs -->
                                    <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="#pills-login" role="tab"
                                        aria-controls="pills-login" aria-selected="true">Login</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="tab-register" data-mdb-toggle="pill" href="#pills-register" role="tab"
                                        aria-controls="pills-register" aria-selected="false">Register</a>
                                    </li>
                                    </ul>
                                    <!-- Pills navs -->

                                    <!-- Pills content -->
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">

                                            <form method="POST" action="" autocomplete="off" >
                                                    <!-- Email input -->
                                                    <div class="form-outline mb-4">
                                                        <input type="text" id="loginUsername" class="form-control" name="loginUsername"/>
                                                        <label class="form-label" for="loginName">Username</label>
                                                    </div>

                                                    <!-- Password input -->
                                                    <div class="form-outline mb-4">
                                                        <input type="password" id="loginPassword" class="form-control" name="loginPassword"/>
                                                        <label class="form-label" for="loginPassword">Password</label>
                                                    </div>

                                                    <!-- 2 column grid layout -->
                                                    <div class="row mb-4">
                                                        <div class="col-md-6 d-flex justify-content-center">
                                                        <!-- Checkbox -->
                                                        <div class="form-check mb-3 mb-md-0">
                                                            <input class="form-check-input" type="checkbox" value="" id="loginCheck" checked />
                                                            <label class="form-check-label" for="loginCheck"> Remember me </label>
                                                        </div>
                                                        </div>

                                                        <div class="col-md-6 d-flex justify-content-center">
                                                        <!-- Simple link -->
                                                        <a href="#!">Forgot password?</a>
                                                        </div>
                                                    </div>

                                                    <!-- Submit button -->
                                                    <button type="submit" class="btn btn-primary btn-block mb-4" name="login">Sign in</button>

                                                    
                                                    <div class="text-center">
                                                        <p>All right reserved 2023.</p>
                                                    </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
                                            <form action="" method="POST" autocomplete="off" >
                                                            <!-- Name input -->
                                                            <div class="form-outline mb-4">
                                                                <input type="text" id="registerFirstName" class="form-control" name="registerFirstName"/>
                                                                <label class="form-label" for="registerName">Firstname</label>
                                                            </div>
                                                            <div class="form-outline mb-4">
                                                                <input type="text" id="registerLastName" class="form-control" name="registerLastName"/>
                                                                <label class="form-label" for="registerName">Lastname</label>
                                                            </div>

                                                            <!-- Username input -->
                                                            <div class="form-outline mb-4">
                                                                <input type="text" id="registerUsername" class="form-control" name="registerUsername"/>
                                                                <label class="form-label" for="registerUsername">Username</label>
                                                            </div>

                                                            <!-- Email input -->
                                                            <div class="form-outline mb-4">
                                                                <input type="email" id="registerEmail" class="form-control" name="registerEmail"/>
                                                                <label class="form-label" for="registerEmail">Email</label>
                                                            </div>

                                                            <!-- Password input -->
                                                            <div class="form-outline mb-4">
                                                                <input type="password" id="registerPassword" class="form-control" name="registerPassword"/>
                                                                <label class="form-label" for="registerPassword">Password</label>
                                                            </div>

                                                            <!-- Repeat Password input -->
                                                            <div class="form-outline mb-4">
                                                                <input type="text" id="registerAddress" class="form-control" name="registerAddress"/>
                                                                <label class="form-label" for="registerAddress">Address</label>
                                                            </div>

                                                            <!-- Checkbox -->
                                                            <div class="form-check d-flex justify-content-center mb-4">
                                                                <input class="form-check-input me-2" type="checkbox" value="" id="registerCheck" name="remember_me"checked
                                                                aria-describedby="registerCheckHelpText" />
                                                                <label class="form-check-label" for="registerCheck">
                                                                I have read and agree to the terms
                                                                </label>
                                                            </div>

                                            <!-- Submit button -->
                                            <button type="submit" class="btn btn-primary btn-block mb-3" name="register">Sign in</button>
                                            
                                            </form>
                                        </div>
                                    </div>
                                    <!-- Pills content -->
                                </div>
                                <!-- End of container 2 -->
                
                    </div>
            </div>



    
<!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"
></script>
</body>
</html>