<?php
    include('./includes/header.php');
	include('./includes/navbar.php');

	include 'db/database.php';
?>
<body>

<!-- Content here -->

<div class="products-search-container">
  <!-- Search bar -->
  <form action="" method="GET">
    <input type="text" name="search" placeholder="Search products">
    <button type="submit">Search</button>
  </form>
</div>


<div class="product-header-container" style="overflow: hidden;">
		<div class="product-page">
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
			<div class="product-box">
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
         
		</body>
    </html>