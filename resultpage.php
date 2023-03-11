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


$randomString = strtoupper(base_convert(bin2hex(random_bytes(10)),16,36));

// echo strlen( '# of strings'.$randomString);

if(isset($_SESSION['cart'])){

    unset($_SESSION['cart']);

    echo '
    <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3 text-center mt-5">
        <i class="fas fa-check-circle fa-5x text-success mb-3"></i>
        <h1 class="mb-3">Transaction Complete</h1>
        <span>Transaction Reference No.: <strong>'.$randomString.'</strong></span>
        <p>Your payment has been successfully processed.</p>
        <a href="products.php" class="btn btn-primary mt-3">Return to Products</a>
      </div>
    </div>
  </div>
    
    
    ';
}


// var_dump($_SESSION['cart']);

?>





<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>