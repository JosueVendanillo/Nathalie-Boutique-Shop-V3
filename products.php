<?php
	// include 'db/database.php';
    // include './includes/header.php';
	// include('./includes/navbar.php');

	include 'useractive.php';

?>



<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Products - Nathalie's Boutique Shop</title>

        
        <link href="https://fonts.googleapis.com/css2?
        family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
         <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-LZMmv1rwus7gupN2JiQ7fNkx6gXdIbYiOk/uFW81TdyT9zVRskQnKNmFlgm6U/ljPY4ySm4Ufhq3Ez8+1CewHg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Landingpage css -->
        <link rel="stylesheet" href="./assets/css/landingpage.css">
        <!-- Loginform css -->
        <link rel="stylesheet" href="assets/css/loginform.css">
        <!-- Products page -->
        <link rel="stylesheet" href="../assets/css/productspage.css">

</head>

<style>

  body{
    margin: 0;
    padding: 0;
    overflow: hidden;
  }


/* product modal CSS */
.modal {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: hidden;
  background-color: rgba(0, 0, 0, 0.4);
  
}

.modal-content {
  background-color: #fefefe;
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  padding: 50px;
  border: 1px solid #888;
  width:40%;
  height:70%;
  border-radius: 50px;
}

.close {
  color: #aaa;
  float: right;
  font-size: 24px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
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



/* Product search bar */

.products-search-container {
  background-color: #ffd6ff;
  margin: 130px 100px 0 100px;
  display: flex;
  border-radius: 5px;
  align-items: center;
  padding-left: 15px;
}

input {
  width: 240px;
  padding: 5px;
  border-radius: 5px;
  outline: none;
  background: white;
  font-size: 18px;
}

button {
  border: none;
  background-color: #FF6F61;
  color: white;
  padding: 8px 15px;
  border-radius: 5px;
  margin-left: 10px;
  cursor: pointer;
}

.products-search-container form {
  display: flex;
  align-items: center;
}


.product-header-container{
  background-color: #ffd6ff;
  margin: 10px 100px 0 100px;
  /* display: flex; */
  border-radius: 5px;
 
 
}


.product-page{
  background: #eaf4f4;
  margin: 10px 100px 0 100px;
  padding: 15px;
  height: 75%;
  border-radius: 5px;
  display: flex; 
  flex-direction: row;
  width: auto;
  flex-wrap: wrap;
}


.product-box {
  position: relative;
  padding: 15px;
  border: 1px solid none;
}
.product-box:hover{
	padding: 10px;
	border: 1px solid var(--text-color);
	transition: 0.4s;
}

.product-img{
	width: 150px;
	height: 150px;
	margin-bottom: 0.5rem;
}
.product-title {
	font-size: 1.1rem;
	font-weight: 600;
  text-align: center;
	text-transform: uppercase;
	margin-bottom: 0.5rem;
	color: #ad1845;
  word-wrap: break-word;
}

.price{
	font-weight: 300;
  font-size: 1rem;
}
.stocks{
	font-weight: 300;
  font-size: 1rem;
  float:right;
}


.rating .fa{
    color: orange;
    font-size: 15px;

}



  </style>
    
 





<body>

<div id="productModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">

    <span class="close">&times;</span>
	<!-- Modal body -->
		<div class="d-flex  justify-content-center">


		</div>

  </div>

</div>
	


<header class="">
    <div class="navbar px-5">
        <div class="logo">
            <a href="main.html"><img src="./assets/img/products/logo.jpg" width="180px"> </a>
        </div>

        <nav>
            <ul>
                <li><a href="index-with-session.php">Home</a></li>
                <li><a href="products.php" style="background: #ad1845; color:white;">Products</a></li>
                <li class="dropdown">
					<a  id="myBtn" style="color:#ad1845" onMouseOver="this.style.color='white'"  onMouseOut="this.style.color='#ad1845'">

					<?php 
							if(!empty($username)){
								echo 'Welcome'.','.$_SESSION['username'];
							}else{
								echo '<a href="login-form.php">Login</a>';
							}	
								
					
					?>

					</a>

                    <div class="dropdown-content">
                        <?php

								if(isset($_SESSION['username'])){
									// echo '<a href="login-form.php">Login</a>';
									echo '<a href="profile.php">Profile</a>';
									echo '<a href="logout.php">Logout</a>';
									
								} 
                        ?>
                    </div>

                </li>
            </ul>
        </nav>
        <a href="index.html"><img src="./assets/img/products/cart.png" width="30px" height="30px"></a>
    </div>
</header>





<!-- Content here -->
<div class="products-search-container">
  <!-- Search bar -->
  <form action="" method="GET">
    <input type="text" name="search" placeholder="Search products">
    <button type="submit">Search</button>
  </form>
</div>


<div class="product-header-container" style="overflow: hidden;">
		<div class="product-page" >
			<?php 
				// Get the search keyword if submitted
				$search = isset($_GET['search']) ? $_GET['search'] : '';

				// Get the current page number from the query string
				$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
				// Number of products per page
				$limit = 16;
				// Calculate the offset based on the page number and limit
				$offset = ($page - 1) * $limit;

				// Build the query based on the search keyword
				$query = "SELECT * FROM products";
				if (!empty($search)) {
				$query .= " WHERE product_name LIKE '%$search%'";
				}
				$query .= " LIMIT $limit OFFSET $offset";

				$result = mysqli_query($conn,$query);
				
				while($row = mysqli_fetch_assoc($result)){
				$productId = $row['product_id'];
				$productName = $row['product_name'];
				$productPrice = $row['product_price'];
				$productQty = $row['product_quantity'];
				$productDetails = $row['product_details'];   
				$productImg = $row['product_images'];  
			?>
			<!-- Show Products here-->
			<div class="product-box" >
				<img src="uploads/<?= $productImg ?>" class="product-img">
				<h2 class="product-title"><?php echo $productName?></h2>
				<span class="price"><strong>₱</strong><?php echo $productPrice?></span>
				<span class="stocks"><strong>Stock:</strong><?php echo $productQty?></span>
				<div class="rating">
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star-o"></i>
				</div>
				<button class="btn btn-success" id="myBtn">View</button>
			</div>
			<?php }?>
	
		</div>


		<div style="display:flex; justify-content: center;">
			<!-- Pagination links -->
			<div class="pagination" style=" margin-left: 25px;">
				<?php 
				// Count the total number of products
				$count_query = "SELECT COUNT(*) AS count FROM products";
				if (!empty($search)) {
					$count_query .= " WHERE product_name LIKE '%$search%'";
				}
				$count_result = mysqli_query($conn, $count_query);
				$count_row = mysqli_fetch_assoc($count_result);
				$total_products = $count_row['count'];

				// Calculate the total number of pages
				$total_pages = ceil($total_products / $limit);

				// Show the pagination links
				for ($i = 1; $i <= $total_pages; $i++) {
					$active = ($i == $page) ? 'active' : '';
					echo "<button onclick=\"window.location.href='?page=$i";
					if (!empty($search)) {
						echo "&search=$search";
					}
					echo "'\" class='$active' style='margin-left: 10px; padding:15px; border-radius=50px;'>$i</button>";
				}
				?>
			</div>
		</div>
			
</div>

<!-- footer -->
<!-- <?php
include('./includes/scripts.php');
include('./includes/footer.php');
?> -->

<script src="../Nathalie Shop V3/assets/js/productModal.js"> </script>
         
		</body>
    </html>