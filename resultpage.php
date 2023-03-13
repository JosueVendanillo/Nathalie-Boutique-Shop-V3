<?php 
    include './useractive.php';
    include './cart-payment-process.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Transaction Complete</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>

<style>
     body {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }
</style>
<body>

<?php
$customer_id = $_SESSION['user_id'];
$transaction_num = strtoupper(base_convert(bin2hex(random_bytes(10)),16,36));
$currentDateTime = date('Y-m-d H:i:s');
$totalPrice = $_SESSION['total_price'];
$paymentMethod = $_SESSION['payment_method_cod'];

$cart = $_SESSION['cart'];

$itemName = '';
$itemPrice = (double)0;
$itemQuantity = (int)0;


// shows the cart length and cart array contents (for testing)
// echo 'cart size: '.count($cart);
// echo var_dump($cart);


// it will show the values of cart 1 and insert to items table in database each loop
foreach($cart as $key => $value){
  $itemName = $value['name'];
  $itemPrice =$value['price'];
  $itemQuantity = $value['quantity'];

  $stmt = $conn->prepare("INSERT into items (`transaction_id`, `item_name`,`quantity`, `price`) VALUES (?,?,?,?)");
  $stmt->bind_param("ssid", $transaction_num, $itemName, $itemQuantity, $itemPrice);
  $stmt->execute();
  
    if ($stmt->affected_rows > 0) {
      // echo 'Customer Account created sucessfully';
      // echo 'items successfully inserted to database';
    } else {
      echo "Failed: " . mysqli_error($conn);
      exit();
    }
  


  // echo 'price: ' .$value['price']. 'quantity: '.$value['quantity'];
}



// cart session is set it will show the transaction complete message
if(isset($_SESSION['cart'])){

    unset($_SESSION['cart']); //used to clear the session array contents

    echo '
    <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3 text-center mt-5">
        <i class="fas fa-check-circle fa-5x text-success mb-3"></i>
        <h1 class="mb-3">Transaction Complete</h1>
        <span>Transaction Reference No.: <strong>'.$transaction_num.'</strong></span>
        <p>Your payment has been successfully processed.</p>
        <a href="products.php" class="btn btn-primary mt-3">Return to Products</a>
      </div>
    </div>
  </div>
    
    
    ';
}



// this code will instert the transaction to tranasction table in database
$stmt = $conn->prepare("INSERT into transactions (`user_id`,`transaction_id`, `date_time`,`total_amount`, `payment_method`) 
                VALUES (?,?,?,?,?)");

$stmt->bind_param("sssss", $customer_id, $transaction_num, $currentDateTime, $totalPrice, $paymentMethod);
$stmt->execute();

if ($stmt->affected_rows > 0) {
                    // echo 'Customer Account created sucessfully';
                    // echo 'items successfully added to database';
                } else {
                    echo "Failed: " . mysqli_error($conn);
                    exit();
 }


?>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>