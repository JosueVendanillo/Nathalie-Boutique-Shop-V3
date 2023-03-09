<?php 
 
 include 'useractive.php';
?>


<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home - Nathalie's Boutique Shop</title>

        
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

   
</head>

<style>

body{
    margin: 0;
    padding: 0;
  
  }
    
/* dropdown navbar a link - user session*/
.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
	border-radius: 0px 0px 15px 15px;
    display: none;
    position: absolute;
    z-index: 1;
    background-color: #ad1845;
    min-width: 100%;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    padding: 12px 0; /* remove left and right padding */
}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown-content a {
    color: white;
    display: block;
    padding: 8px 16px;
    text-decoration: none;
    white-space: nowrap; /* prevent line breaks */
    text-align: center;
}

.dropdown-content a:hover {
    background-color: whitesmoke;
    color: black;
}



	
</style>



<body>



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
                              window.location.href=\'http://localhost:8080/nathalie%20shop%20V3/index-with-session.php\';
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


  



<header class="">
    <div class="navbar px-5">
        <div class="logo">
            <a href="index-with-session.php"><img src="./assets/img/products/logo.jpg" width="180px"> </a>
        </div>

        <nav >
            <ul>
                <li><a href="index-with-session.php" style="background: #ad1845; color:white;">Home</a></li>
                <li><a href="products.php">Products</a></li>
                <li class="dropdown">
                  <?php if(!isset($_SESSION['username'])) : ?>
                    <a  style="color:#ad1845" >
                      <a href="login-form.php">Login</a>
                    </a>
                  <?php else: ?>
                    <a  style="color:#ad1845; " onMouseOver="this.style.color='white'" onMouseOut="this.style.color='#ad1845'">
                      <span onMouseOver="this.style.color='white'" onMouseOut="this.style.color='#ad1845'">
                        Welcome, <?php echo $_SESSION['username']; ?>
                      </span>
                    </a>
                  <?php endif; ?>

                  <div class="dropdown-content">
                    <?php
                      if(isset($_SESSION['username'])) {
                        echo '<a href="profile.php">Profile</a>';
                        echo '<a href="logout.php">Logout</a>';
                      } 
                    ?>
                  </div>
                </li>
            </ul>
        </nav>
        <a href="user-cart.php"><img src="./assets/img/products/cart.png" width="30px" height="30px"></a>
    </div>
</header>



<div class="container" style="margin-top: 50px ;">
    <div class="row">
    	<div class="col-2">
    		<h1>Give Your Kids A Happy <br>Smile In Their Faces!</h1>
    		<p>The smile in their faces is adorable nothing can beat if your kids are happy<br>with what they're wearing.</p>
    		<a href="products.php" class="btn">Explore Now &#8594;</a>
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
        <a href="products.php" class="explore-products"> Explore more products</a>
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






		<!-- MDB -->
		<script
		type="text/javascript"
		src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"
		></script>
		
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		
    
</body>
</html>