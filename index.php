<?php
include './db/database.php';
?>

<!-- signup -->
<?php
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
                    header("Location: index.php?msg=Username or email already exists");
                    exit();
                }
                
                
                // encrypt the password for protection if someone viewed the database
                // $password_hash = password_hash($_POST['registerPassword'],PASSWORD_DEFAULT);
                // $password_hash = $_POST['registerPassword'];
                
                // Insert new user
                $stmt = $conn->prepare("INSERT INTO user_accounts (`user_name`,`user_password`,`first_name`,`last_name`,`user_email`,`user_address`) 
                VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssss", $username, $password, $firstname, $lastname, $email, $address);
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    // echo 'Customer Account created sucessfully';
                    header("Location: index.php?msg=Customer Account created sucessfully!");
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
                 header("Location: index-with-session.php");
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
             // $conn = mysqli_connect($host, $user, $pass, $db);
         
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
                 header("Location: index-with-session.php");
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
        <title>Document</title>

        
        <link href="https://fonts.googleapis.com/css2?
        family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
        
		

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
		
		
		
		
		<!-- Landingpage css -->
        <link rel="stylesheet" href="./assets/css/landingpage.css">
        <!-- Loginform css -->
        <!-- <link rel="stylesheet" href="assets/css/loginform.css"> -->
        <!-- Products page -->
        <!-- <link rel="stylesheet" href="../assets/css/productspage.css"> -->
		<!-- Login Modal -->
		<link rel="stylesheet" href="../Nathalie Shop V3/assets/css/loginmodal.css">


</head>



<body>


<div style="position: absolute;left:0;right: 0;margin-left: 40%;margin-right: 0; width: 25%;z-index:1;">
            <!-- Alert for sign up-->
            <?php
                if(isset($_GET['msg'])){
                    $msg = $_GET['msg'];
                    $countdown = 5; // Countdown time in seconds
                    $alertType = '';
                    $alertText = '';

                    switch($msg){
                        case 'username_exists':
                            $alertType = 'warning';
                            $alertText = 'Username or email already exists';
                            break;
                        case 'account_created':
                            $alertType = 'success';
                            $alertText = 'Customer Account created sucessfully!';
                            break;
                        case 'incorrect_password':
                            $alertType = 'danger';
                            $alertText = 'Incorrect password';
                            break;
                        case 'user_not_found':
                            $alertType = 'danger';
                            $alertText = 'User not found';
                            break;
                        default:
                            // Unknown message, do nothing
                            break;
                    }

                    if($alertType !== ''){
                        echo '
                        <div class="alert alert-' . $alertType . ' alert-dismissible fade show" role="alert">
                            ' . $alertText . '
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <<div id="countdown" style="font-weight: bold;"></div>
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
                                window.location.href=\'http://localhost:8080/nathalie%20shop%20V3/index.php\';
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

        </div>


<!-- Modal Here -->
<div id="myModal" class="modal">
    

  <!-- Modal content -->
  <div class="modal-content">


    <span class="close">&times;</span>
	<!-- Modal body -->
		<div class="d-flex  justify-content-center">

      

                            <div class="flex-column ">

                                    <div class=" d-flex justify-content-center align-items-center">
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
                                                        <input type="text" id="loginUsername" class="form-control" name="loginUsername"  required/>
                                                        <label class="form-label" for="loginName">Username</label>
                                                    </div>

                                                    <!-- Password input -->
                                                    <div class="form-outline mb-4">
                                                        <input type="password" id="loginPassword" class="form-control" name="loginPassword" required/>
                                                        <label class="form-label" for="loginPassword">Password</label>
                                                    </div>

                                                    <!-- 2 column grid layout -->
                                                    <div class="row mb-4">
                                                        <div class="col-md-6 d-flex justify-content-center">
                                                        <!-- Checkbox -->
                                                        <div class="form-check mb-3 mb-md-0">
                                                            <input class="form-check-input" type="checkbox" value="" id="loginCheck" checked  required/>
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
                                                                <input type="text" id="registerFirstName" class="form-control" name="registerFirstName" required/>
                                                                <label class="form-label" for="registerName">Firstname</label>
                                                            </div>
                                                            <div class="form-outline mb-4">
                                                                <input type="text" id="registerLastName" class="form-control" name="registerLastName" required/>
                                                                <label class="form-label" for="registerName">Lastname</label>
                                                            </div>

                                                            <!-- Username input -->
                                                            <div class="form-outline mb-4">
                                                                <input type="text" id="registerUsername" class="form-control" name="registerUsername" required/>
                                                                <label class="form-label" for="registerUsername">Username</label>
                                                            </div>

                                                            <!-- Email input -->
                                                            <div class="form-outline mb-4">
                                                                <input type="email" id="registerEmail" class="form-control" name="registerEmail" required/>
                                                                <label class="form-label" for="registerEmail">Email</label>
                                                            </div>

                                                            <!-- Password input -->
                                                            <div class="form-outline mb-4">
                                                                <input type="password" id="registerPassword" class="form-control" name="registerPassword" required/>
                                                                <label class="form-label" for="registerPassword">Password</label>
                                                            </div>

                                                            <!-- Repeat Password input -->
                                                            <div class="form-outline mb-4">
                                                                <input type="text" id="registerAddress" class="form-control" name="registerAddress" required/>
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
                
       </div>
          <!-- End of  Modal body -->
  </div>
  <!-- End of Modal content -->
</div>

  <!--End of  Modal  -->


<header class="">
    <div class="navbar px-5 " >
        <div class="logo">
            <a href="index.php"><img src="./assets/img/products/logo.jpg" width="180px"> </a>
        </div>
        
    
        
        <nav>
            <ul >
                <li><a href="index.php" style="background: #ad1845; color:white;">Home</a></li>
                <li>
                    
                    <a href="products.php"> Products </a>
                </li>
                <li class="dropdown">
                    <a id="myBtn" style="color:#ad1845" onMouseOver="this.style.color='white'"  onMouseOut="this.style.color='#ad1845'">Login</a>
                </li>
            </ul>
        </nav>
        <a href="index.php"><img src="./assets/img/products/cart.png" width="30px" height="30px"></a>
    </div>
</header>



<div class="container" style="margin-top: 50px ;">
    <div class="row">
    	<div class="col-2">
    		<h1>Give Your Kids A Happy <br>Smile In Their Faces!</h1>
    		<p>The smile in their faces is adorable nothing can beat if your kids are happy<br>with what they're wearing.</p>
    		<a href="loginform.php" class="btn">Explore Now &#8594;</a>
    	</div>
    	<div class="col-2">
    		<img src="./assets/img/products/bg1.jpg">
    	</div>
    </div>


    <!-------- featured products ----------->
    <h1 class="title">" Featured Products "</h1>
    <div class="categories">
    	<div class="small-container">
    	<div class="row">                                                                
    		<div class="col-3">
    			<img src="./assets/img/products/cat1.jpg">
    			<h4>Anna Dress 1</h4>
    			<div class="rating">
                    <i class="fa fa-star"></i>
				    <i class="fa fa-star"></i>
				    <i class="fa fa-star"></i>
				    <i class="fa fa-star"></i>
				    <i class="fa fa-star-o"></i>
                </div>
    			<p>₱789</p>
    		</div>
    		<div class="col-3">
    			<img src="./assets/img/products/cat2.jpg">
    			<h4>Sleeping Beauty Dress</h4>
    			<div class="rating">
                    <i class="fa fa-star"></i>
				    <i class="fa fa-star"></i>
				    <i class="fa fa-star"></i>
				    <i class="fa fa-star"></i>
				    <i class="fa fa-star-o"></i>
                </div>
    			<p>₱750</p>
    		</div>
    		<div class="col-3">
    			<img src="./assets/img/products/cat3.jpg">
    			<h4>Anna Dress 2</h4>
    			<div class="rating">
                    <i class="fa fa-star"></i>
				    <i class="fa fa-star"></i>
				    <i class="fa fa-star"></i>
				    <i class="fa fa-star"></i>
				    <i class="fa fa-star-o"></i>
				</div>
    			<p>₱779</p>
    		</div>
    		<div class="col-3">
    			<img src="./assets/img/products/edits/tatiana.jpg">
    			<h4>Tatiana Dress </h4>
    			<div class="rating">
                    <i class="fa fa-star"></i>
				    <i class="fa fa-star"></i>
				    <i class="fa fa-star"></i>
				    <i class="fa fa-star"></i>
				    <i class="fa fa-star-o"></i>
				</div>
    			<p>₱769</p>
    		</div>
    		<div class="col-3">
    			<img src="./assets/img/products/edits/moana.jpg">
    			<h4>Anna Dress 2</h4>
    			<div class="rating">
                    <i class="fa fa-star"></i>
				    <i class="fa fa-star"></i>
				    <i class="fa fa-star"></i>
				    <i class="fa fa-star"></i>
				    <i class="fa fa-star-o"></i>
				</div>
    			<p>₱779</p>
    		</div>
    		<div class="col-3">
    			<img src="./assets/img/products/edits/snowwhite.jpg">
    			<h4>Anna Dress 2</h4>
    			<div class="rating">
                    <i class="fa fa-star"></i>
				    <i class="fa fa-star"></i>
				    <i class="fa fa-star"></i>
				    <i class="fa fa-star"></i>
				    <i class="fa fa-star-o"></i>
				</div>
    			<p>₱799</p>
    		</div>
    	</div>
    	</div>

    </div>


    <div class="explore-products-container" >
        <a href="loginform.php" class="explore-products"> Explore more products</a>
    </div>


	<div style="margin-top:50px;">


		<h1 class="title">" Satisfied Customers "</h1>
		<div class="testimonial">
			<div class="small-container">
				<div class="row">
					<div class="col-3">
						<img src="./assets/img/products/feed1.jpg">
						<div class="rating">
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star-half-o"></i>
						</div>
						
					</div>
					<div class="col-3">
						<img src="./assets/img/products/feed2.jpg">    
                     <div class="rating">
						 <i class="fa fa-star"></i>
						 <i class="fa fa-star"></i>
						 <i class="fa fa-star"></i>
						 <i class="fa fa-star"></i>
						 <i class="fa fa-star-half-o"></i>
						</div>
					</div>
					<div class="col-3">
						<img src="./assets/img/products/feed3.jpg"> 
						<div class="rating">
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star-half-o"></i>
						</div>
					</div>
            </div>
        </div>
    </div>
</div>
	
</div>



<?php
include('./includes/scripts.php');
include('./includes/footer.php');
?>
        <script src="./assets/js/loginmodal.js"></script>
		<!-- MDB -->
		<script
		type="text/javascript"
		src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"
		></script>
		
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		</body>
    </html>