



<div class="header">
    <!-- container of the modal -->
        <div class="container">


        <?php 
                if(isset($_GET['msg'])){
                    $msg = $_GET['msg'];
                    $countdown = 5; // Countdown time in seconds
                    
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
                          window.location.href=\'http://localhost:8080/nathalie%20shop%20V3/inventory.php\';
                        }
                        
                        document.querySelector(\'.btn-close\').addEventListener("click", function() {
                          clearInterval(intervalId);
                          removeAlert();
                        });
                      </script>
                    ';
                }
            ?>


            <!-- modal -->
            <div id="loginModal" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                                <div class="modal-header">
                                    <!-- <h2>Login/Sign Up</h2> -->
                                    <span class="close">&times;</span>
                                </div>

                                <div class="modal-body"  >
                                        <div class="tab" style="display:flex; justify-content: center;">
                                            <!-- <a class="tablinks" onclick="openTab(event, 'login')">Login</a> -->
                                            <!-- <a class="tablinks" onclick="openTab(event, 'signup')">Sign Up</a> -->
                                            <button class="tablink" onclick="openPage('login', this, 'green')" id="defaultOpen">Login</button>
                                           
                                            <button class="tablink" onclick="openPage('signup', this, 'red')">Sign up</button>
                                        </div>
                                        <!-- Login Form -->
                                        <div id="login" class="tabcontent">

                                            <form method="post" action="process-login.php">
                                                <div class="txt_field">
                                                    <input type="text" required>
                                                    <span></span>
                                                    <label>Username</label>
                                                </div>
                                                <div class="txt_field">
                                                    <input type="password" required>
                                                    <span></span>
                                                    <label>Password</label>
                                                </div>
                                            
                                                <div class="pass"> 
                                                    <a class="pass" href="pages/forgotpassword.php">Forgot Password?</a>
                                                </div>
                                                
                                                <input type="submit" value="Login">

                                            </form>
                                        </div>
                                     <!-- Signup Form -->
                                        <div id="signup" class="tabcontent">
                                            <form action="" method="POST">
                                                <div class="parent">
                                                <!-- first col -->
                                                    <div class="signup-col-grid-1"> 
                                                        <div class="txt_field">
                                                            <input type="text" name="username" required>
                                                            <span></span>
                                                            <label>Username</label>
                                                        </div>
                                                        <div class="txt_field">
                                                            <input type="text" name="firstname" required>
                                                            <span></span>
                                                            <label>First name</label>
                                                        </div>
                                                        <div class="txt_field">
                                                            <input type="Email" name="email" required>
                                                            <span></span>
                                                            <label>E-mail</label>
                                                        </div>
                                                    </div>
                                                
                                                    <!-- second col -->
                                                    <div class="signup-col-grid-2"> 
                                                        <div class="txt_field">
                                                            <input type="password" name="password" required>
                                                            <span></span>
                                                            <label>Password</label>
                                                        </div>
                                                        <div class="txt_field">
                                                            <input type="text" name="lastname" required>
                                                            <span></span>
                                                            <label>Last name</label>
                                                        </div>
                                                        <div class="txt_field">
                                                            <input type="text" name="address" required>
                                                            <span></span>
                                                            <label>Address</label>
                                                        </div>
                                                    </div>
                                                    <input type="submit" class="sign-up-btn">Sign up</button>
                                                </form>
                                        </div>    

                                    </div>
                                    <!-- End of modal body -->
                                       
                            </div>  
                            <!-- end of modal content -->
                </div>
                 <!-- End of modal -->
        </div>
    <!-- End of modal container  -->
                    <header>
                            <div class="navbar">
                                <div class="logo">
                                    <a href="main.html"><img src="./assets/img/products/logo.jpg" width="180px"> </a>
                                </div>
                                <nav>
                                    <ul>
                                        <li><a href="index.php">Home</a></li>
                                        <li><a href="products.php">Products</a></li>
                                        <li>
                                            
                                        <a id="loginBtn">Login</a> 
                                        <!-- <button id="loginBtn">Login</button> -->
                                    
                                        </li>
                                    </ul>
                                </nav>
                                <a href="index.html"><img src="./assets/img/products/cart.png" width="30px" height="30px"></a>
                            </div>
                    </header>

                    
        </div>

        
    </div>