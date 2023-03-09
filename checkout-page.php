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
       
        <!-- Paymentpage page -->
        <link rel="stylesheet" href="./assets/css/paymentpage.css">
       

</head>

<style>
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


<div class="" style="margin:7% 2% 5% 2%;">

                        <!-- Content here -->
                        <div class="payment-header-container" >
                                            <h1>PAYMENT METHOD</h1>
                                        </div>

                                    <div class="d-flex flex-row py-2">

                                        <!-- box1 -->
                                        <div class="box2 px-3" style="flex: 0 0 50%;">
                                        
                                
                                                <div class="tabs-container" >
                                                                <h2>Select a Payment Method</h2>
                                                                    <ul class="nav nav-tabs">
                                                                        <li class="nav-item">
                                                                        <a class="nav-link active" data-bs-toggle="tab" href="#cash-on-delivery">CASH ON DELIVERY</a>
                                                                        </li>
                                                                        <li class="nav-item">
                                                                        <a class="nav-link" data-bs-toggle="tab" href="#gcash-paymaya">BANK TRANSFER/GCASH/PAYMAYA</a>
                                                                        </li>
                                                                        
                                                                    </ul>

                                                                    <div class="tab-content">
                                                                        <div class="tab-pane fade show active" id="cash-on-delivery">
                                                                        <!-- <p>This is the Cash on Delivery tab content.</p> -->
                                                                        <div class="cash-on-delivery">
                                                                            <h2>Cash on Delivery</h2>
                                                                            <form>
                                                                                <label for="fullname">Name</label>
                                                                                <input type="text" id="fullname" name="fullname" value="<?= $fname .' '. $lname ?>" disabled>

                                                                                <label for="email">Email</label>
                                                                                <input type="email" id="email" name="email" value="<?= $email ?>" disabled>

                                                                                <label for="address">Address</label>
                                                                                <input type="text" id="address" name="address" value="<?= $address ?>" disabled>

                                                                                <label for="phone">Contact Number</label>
                                                                                <input type="tel" id="phone" name="phone"  required>

                                                                                <label for="total">Total Amount</label>
                                                                                <input type="text" id="total" name="total" placeholder="Enter the total amount" required>

                                                                                <button type="submit">Place Order</button>
                                                                            </form>
                                                                            </div>



                                                                        </div>
                                                                        <div class="tab-pane fade" id="gcash-paymaya">
                                                                        <!-- <p>This is the BANK TRANSFER/GCASH/PAYMAYA tab content.</p> -->
                                                                        TEST
                                                                        </div>
                                                                       
                                                                    </div>

                                                </div>
                                        </div>

                                         <!-- box2 -->
                                         <div class="box1 p-3 h-100" style="flex: 0 0 50%;">
                                        
                                        <div class="payment-body-container">
                                            <h1>CART</h1>
                                            
                                        
                                                        <div class="cart-checkout-container"  >
                                                                    <div style="height:300px;overflow-y: scroll;">
                                                                        <table class="table table-bordered table striped">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th scope="col">#</th>
                                                                                        <th scope="col">Item</th>
                                                                                        <th scope="col">Price</th>
                                                                                        <th scope="col">Qty</th>
                                                                                        <th scope="col">Subtotal</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php
                                                                                        $output = '';
                                                                                        $total_price = 0;
                                                                                        if (!empty($_SESSION['cart'])) {
                                                                                            foreach ($_SESSION['cart'] as $key => $value) {
                                                                                                $subtotal = $value['price'] * $value['quantity'];
                                                                                                $total_price += $subtotal;
                                                                                                $output .= '
                                                                                                    <tr>
                                                                                                        <th scope="row">' . $value['id'] . '</th>
                                                                                                        <td>' . $value['name'] . '</td>
                                                                                                        <td>' . $value['price'] . '</td>
                                                                                                        <td>' . $value['quantity'] . '</td>
                                                                                                        <td>' . '₱' . number_format($subtotal, 2, '.') . '</td>
                                                                                                    </tr>
                                                                                                ';
                                                                                            }
                                                                                            
                                                                                            echo $output;
                                                                                        } 
                                                                                    ?>
                                                                                </tbody>
                                                                            </table>

                                                                    </div>
                                                                    

                                                                    <div class="container"> 
                                                                                <div class="">
                                                                                    <?php 
                                                                                    if(isset($_POST['address']) && isset($_POST['phone'])){
                                                                                        echo ' <div><strong>Address:</strong> <span>'.$_POST['address'] .'</span></div>';
                                                                                        echo ' <div><strong>Contact No.:</strong> <span>'.$_POST['phone'] .'</span></div>';
                                                                                        
                                                                                    }   
                                                                                    ?>
                                                                                </div>
                                                                                <div class="d-flex flex-col justify-content-end mt-5">
                                                                                    <div class="flex-col">
                                                                                        <?php 
                                                                                             echo '<h4>Total Price: '.'₱'.number_format($total_price).' </h4>'
                                                                                        ?>
                                                                                        <div class="d-flex flex-row justify-content-around">
                                                                                            <button class="btn-success p-1">Confirm</button>
                                                                                            <button class="btn-secondary p-1">Cancel</button>
                                                                                        </div>
                                                                                    </div>

                                                                                  
                                                                                </div>
                                                                    </div>
                                                        </div>

                                                <!--End of cart checkout container  -->
                                        </div>
                                        <!-- End of payment body container -->

                                </div>
                            <!-- End of Box1 -->




                                    </div>
</div>











    

<!-- footer -->
<!-- <?php
include('./includes/scripts.php');
include('./includes/footer.php');
?> -->


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
         
		</body>
    </html>