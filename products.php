<?php
	include 'useractive.php';

?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Products - Nathalie's Boutique Shop</title>

        
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-LZMmv1rwus7gupN2JiQ7fNkx6gXdIbYiOk/uFW81TdyT9zVRskQnKNmFlgm6U/ljPY4ySm4Ufhq3Ez8+1CewHg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        <!-- Landingpage css -->
        <link rel="stylesheet" href="./assets/css/landingpage.css">
       
        <!-- Products page -->
        <link rel="stylesheet" href="./assets/css/productpage.css">
        <!-- Products page -->
        <link rel="stylesheet" href="./assets/css/productModal.css">

</head>


<body>


	


<header class="">
    <div class="navbar px-5">
        <div class="logo">
            <a href="index-with-session.php"><img src="./assets/img/products/logo.jpg" width="180px"> </a>
        </div>

        <nav>
            <ul>
                <li><a href="index-with-session.php">Home</a></li>
                <li><a href="products.php" style="background: #ad1845; color:white;">Products</a></li>
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

<!-- main content -->
<div class="d-flex flex-row fixed " style="margin:5% 2% 6% 2%">

<!-- box 1 -->
  <div class="box1  p-3 " style="flex: 0 0 75%;">

                      <!-- Content here -->
              <div class="products-search-container">
                <!-- Search bar -->
                <form action="" method="GET">
                  <input type="text" name="search" placeholder="Search products">
                  <button type="submit">Search</button>
                </form>
              </div>
  
  
              <div class="product-header-container" >
              <div class="product-page">
  <?php 
    // Get the search keyword if submitted
    $search = isset($_GET['search']) ? $_GET['search'] : '';

    // Get the current page number from the query string
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    // Number of products per page
    $limit = 11;
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
    <form method="POST" action="products.php?id=<?=$row['product_id'] ?> ">
      <img src="uploads/<?= $productImg ?>" class="product-img" style="display: block; margin: auto;">
      <h2 class="product-title"><?php echo $productName?></h2>

      <div style="overflow: hidden;">
          <span class="price" style="display: inline-block; float: left;"><strong>₱</strong><?php echo $productPrice?></span>

          <?php if ($productQty == 0) { ?>
            <span class="out-of-stock" style="display: inline-block; float: right;">Out of Stock</span>
          <?php } else { ?>
            <span class="stocks" style="display: inline-block; float: right;"><strong>Stock:</strong><?php echo $productQty?></span>
          <?php } ?>
      </div>
     
      <input type="hidden" name="name" value="<?php echo $productName?>">
      <input type="hidden" name="price" value="<?php echo $productPrice?>">
  
      <div class="product-quantity-container">
        <button type="button" class="quantity-button minus-button" <?php if ($productQty == 0) { ?>disabled style="background-color: gray;"<?php } ?>>-</button>
        <input type="number" name="quantity" value="1" min="1" max="<?php echo $productQty ?>" <?php if ($productQty == 0) { ?>disabled style="background-color: gray;"<?php } ?>>
        <button type="button" class="quantity-button plus-button" <?php if ($productQty == 0) { ?>disabled style="background-color: gray;"<?php } ?>>+</button>
      </div>
      
      <?php if ($productQty == 0) { ?>
        <input type="submit" class=" btn-secondary " value="Out of Stock" disabled>
      <?php } else { ?>
        <input type="submit" class=" btn-success " name="add-cart-button" value="Add to Cart">
      <?php } ?>
    </form>
  </div>
  <?php } ?>
</div>

              </div>

                <div class="pagination-container" >
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
  <!-- end of box 1 -->

                              <?php 
                              
                              if(isset($_POST['add-cart-button'])){

                                if(isset($_SESSION['cart'])){

                                    $session_array_id = array_column( $_SESSION['cart'],'id');

                                      if(!in_array($_GET['id'],$session_array_id)){

                                        $session_array = array(
                                          'id' => $_GET['id'],
                                          'name' => $_POST['name'],
                                          'price' => $_POST['price'],
                                          'quantity' => $_POST['quantity'],
                                        );
                                        $_SESSION['cart'][] = $session_array;
                                      }

                                }else{

                                  $session_array = array(
                                    'id' => $_GET['id'],
                                    'name' => $_POST['name'],
                                    'price' => $_POST['price'],
                                    'quantity' => $_POST['quantity'],
                                  );

                                  $_SESSION['cart'] = array($session_array);

                                }

                              }
                              
                              ?>

                <!-- box 2 -->
                <div class="box2  p-3  " style="flex: 0 0 27%;">

                                <div class="cart-title-container">
                                  <h4> Cart</h4>
                                </div>
                                  <div class="cart-body">
                                    <!-- Cart Contents -->
                                    <table class="table table-bordered table striped">
                                      <thead>
                                        <tr>
                                          <th scope="col">#</th>
                                          <th scope="col">Item</th>
                                          <th scope="col">Price</th>
                                          <th scope="col">Qty</th>
                                          <th scope="col">Subtotal</th>
                                          <th scope="col">Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>

                                        <?php

                                        $output = '';
                                        $total_price = 0;
                                        $isArrayEmpty = true;  // if true the Checkout button will be disabled. if not the button will enabled
                                        $arrayCounter = 0; // of the counter is 0 the remove all button will be hidden, if > 1 the button will show
                                      

                                        if (!empty($_SESSION['cart'])) {
                                          foreach ($_SESSION['cart'] as $key => $value) {
                                            if ($value['price'] && $value['quantity']) {
                                              $subtotal = $value['price'] * $value['quantity'];
                                              $total_price += $subtotal;
                                              $arrayCounter++;
                                              
                                              $output .= '
                                                <tr>
                                                  <th scope="row">' . $value['id'] . '</th>
                                                  <td>' . $value['name'] . '</td>
                                                  <td>' . $value['price'] . '</td>
                                                  <td>' . $value['quantity'] . '</td>
                                                  <td>' . '₱' . number_format($subtotal, 2, '.') . '</td>
                                                  <td>
                                                    <a class="remove_button text-white" href="products.php?remove='.$value['id'].'">
                                                      Remove
                                                    </a>
                                                  </td>
                                                </tr>
                                              ';
                                            }
                                          }
                                          $isArrayEmpty = false; // array is not empty now
                                            echo $output;
                                        } 

                                              if(isset($_GET['remove'])){
                                                    $removed = false;
                                                      if(isset($_GET['remove'])){

                                                        foreach($_SESSION['cart'] as $key => $value){
                                                    
                                                            if($value['id'] == $_GET['remove']){
                                                                unset($_SESSION['cart'][$key]);
                                                                $removed = true;
                                                            }
                                                        }
                                                      }

                                                      if($_GET['remove'] == 'remove_all_items'){
                                                      
                                                          if (isset($_GET['remove']) == 'remove_all_items') {
                                                                unset($_SESSION['cart']);
                                                                $removed = true;
                                                              } 
                                                      }

                                                      if($removed){
                                                          echo '<script>location.href = \'products.php\';</script>';
                                                      }
                                              }
                                        ?>
                                      </tbody>
                                    </table>
                                  </div>
                                  <!-- end of cart body -->


                <div class="pt-4">
                  <?php 
                    if($arrayCounter > 1){
                      echo '
                                <a href="products.php?remove=remove_all_items" class="remove_button text-white" >
                                    Remove All
                                </a>
                            ';
                    }
                  ?>

                </div>
                            <?php
                                        
                                        $isEmptyAddress = empty($_POST['address']);
                                        $isEmptyPhone = empty($_POST['phone']);
                                        
                              ?>
                          <div class="checkout-container d-flex justify-content-between align-items-center">
                              <div class="total-price d-flex flex-column">
                                  <strong>Total price:</strong> <?php echo '₱' . number_format($total_price, 2); ?>
                              </div>
                                  
                                <?php

                                  if($isArrayEmpty){
                                    
                                    echo '<button type="button" class="btn-secondary" disabled aria-disabled="true">Checkout</button>';
                                  }else{
                                    echo '<a href="./checkout-page.php"><button type="button" class="remove_button btn-primary" name="checkout"">Checkout</button></a>';
                                  }
                  
                                  ?>


                                
                            </div>

                                  
                </div>
                <!-- end of box 2 -->
</div>
<!-- end of main content -->

  

    

<!-- footer -->
<!-- <?php
include('./includes/scripts.php');
include('./includes/footer.php');
?> -->

<script src="../Nathalie Shop V3/assets/js/productModal.js"> </script>

<script>
// Get all the quantity containers and input fields
const quantityContainers = document.querySelectorAll('.product-quantity-container');
const quantityInputs = document.querySelectorAll('input[name="quantity"]');

// Loop over each container
quantityContainers.forEach((quantityContainer, index) => {
  // Get the plus and minus buttons for this container
  const minusButton = quantityContainer.querySelector('.minus-button');
  const plusButton = quantityContainer.querySelector('.plus-button');

  // Get the current product quantity
  const maxQuantity = parseInt(quantityInputs[index].getAttribute('max'));

  // Add click event listeners to the buttons
  minusButton.addEventListener('click', () => {
    // Decrease the quantity by 1, but do not go below 1
    quantityInputs[index].value = Math.max(parseInt(quantityInputs[index].value) - 1, 1);
  });

  plusButton.addEventListener('click', () => {
    // Increase the quantity by 1, but do not exceed the maximum quantity
    quantityInputs[index].value = Math.min(parseInt(quantityInputs[index].value) + 1, maxQuantity);
  });

  // Add input event listener to the input field
  quantityInputs[index].addEventListener('input', () => {
    // Update the value if it exceeds the maximum quantity
    if (parseInt(quantityInputs[index].value) > maxQuantity) {
      quantityInputs[index].value = maxQuantity;
    }
  });
});
</script>







         
		</body>
    </html>