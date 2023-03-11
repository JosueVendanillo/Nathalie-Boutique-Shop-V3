<?php

if(isset($_SESSION['cart'])){

    // variables from loop
  $product_id=0;
  $product_quantity = 0;
  
  foreach($_SESSION['cart'] as $key => $value){
      $product_id = $value['id'];
      $product_quantity = $value['quantity'];
  
    // echo $value['id'].$value['name'].$value['price'].$value['quantity'];
  
  }
    
  
  //current stocks in database will show here
  $current_product_quantity = 0;
  
  // Prepare the select statement
  $select_stmt = mysqli_prepare($conn, "SELECT * FROM products WHERE product_id=?");
  mysqli_stmt_bind_param($select_stmt, 'i', $product_id);
  
  // Execute the select statement
  mysqli_stmt_execute($select_stmt);
  $result = mysqli_stmt_get_result($select_stmt);
  
  // Fetch the result row
  if ($row = mysqli_fetch_assoc($result)) {
      $current_product_quantity = $row['product_quantity'];
    //   echo $row['product_id'] . ': ' . $row['product_name'] . ': '.$row['product_quantity']. '<br>';
  } else {
      throw new Exception(mysqli_error($conn));
  }
  // Close the prepared statement
  mysqli_stmt_close($select_stmt);
  
  
  // New quantity will be updated here
  $new_product_quantity=$current_product_quantity - $product_quantity ;
  
  // Prepare the update statement
  $update_stmt = mysqli_prepare($conn, "UPDATE products SET product_quantity=? WHERE product_id=?");
  mysqli_stmt_bind_param($update_stmt, 'ii', $new_product_quantity, $product_id);
  
  // Execute the update statement
  if (mysqli_stmt_execute($update_stmt)) {
    //   echo '<script>Product successfully updated</script>';
  } else {
      throw new Exception(mysqli_error($conn));
  }
  
  // Close the prepared statement
  mysqli_stmt_close($update_stmt);

}



?>