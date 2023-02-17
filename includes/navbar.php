<div class="header">
    <!-- container of the modal -->
        <div class="container">
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
                                           
                                            <button class="tablink" onclick="openPage('signup', this, 'red')">Sing up</button>
                                        </div>
                                        <!-- Login Form -->
                                    <div id="login" class="tabcontent">

                                    

                                    <form method="post" action="login.php">
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
                                        <!-- <div class="signup_link">
                                        Not a member? <a href="signupform.php">Signup</a>
                                        </div> -->


                                    </div>
                                     <!-- Signup Form -->
                                    <div id="signup" class="tabcontent">
                                    <label for="name">Name</label>
                                            <input type="text" id="name" name="name" required>
                                            <label for="email">Email</label>
                                            <input type="email" id="email" name="email" required>
                                            <label for="password">Password</label>
                                            <input type="password" id="password" name="password" required>
                                            <button type="submit" class="btn">Sign Up</button>
                                    </div>
                                </div>

                                
                            </div>              
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
                                        <li><a href="main.html">Home</a></li>
                                        <li><a href="index.html">Products</a></li>
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