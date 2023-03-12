<?php

include './db/database.php';




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="./assets/css/adminpage.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<style>
</style>


<body>

<!-- Create Modal -->

 <!-- container of the modal -->
 <div class="container">
            <!-- modal -->
            <div id="loginModal" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                                <div class="modal-header">
                                    <h2>Add Products</h2>
                                    <span class="close">&times;</span>
                                </div>
                                <div class="modal-body"  >

                                <form method="POST" action="process-addProducts.php" enctype="multipart/form-data" autocomplete="off" >
                                    <div class="parent">
                                        <div class="div1">
                                            <label for="Product_Name">Product Name</label>
                                            <input type="text" name="product_name">
                                        </div>

                                        <div class="div2"> 
                                            <label for="Product_Price">Price</label>
                                            <span>Php</span>
                                            <input type="number" name="product_price" min="0.00" max="10000.00" step="0.01">
                                        </div>
                                        <div class="div3"> 
                                            <label for="Product_Qty">Qty</label>
                                            <input type="number" name="product_qty">
                                        </div>
                                        <div class="div4"> 
                                            <label for="Product_Qty">Product Details</label>
                                            <textarea style="resize: none;" name="product_details"></textarea>
                                        </div>
                                        <div class="div5">

                                            <!-- <label for="Product_Qty">Product Image</label> -->
                                            <!-- <input type="file" id="myFile" name="upload_Image"> -->

                                                
                                                    <label for="Product_Qty">Product Image</label>
                                                    <input type="file" 
                                                            name="my_image">

                                                    <input type="submit" 
                                                            name="submit"
                                                            value="Upload">
                                                    
                                                
                                            
                                        </div>
                                        <!-- <div class="div6"> </div> -->
                                    </div>
                                    <button class="btn btn-primary" type="submit" name="submit">Add product</button>
                                    </form>
                                </div>  
                                <!-- End of modal body -->
                        </div>         
                </div>
                 <!-- End of modal -->
</div>
    <!-- End of modal container  -->


<div class="" style="padding: 15px 15px; position: absolute;">
    <button type="button" class="btn btn-primary" id="loginBtn">Add</button>
</div>

<?php 


include "process-edit-product.php";
$updateQuery = "SELECT * FROM products WHERE product_id=$id LIMIT 1";
$result_updateQuery = mysqli_query($conn,$updateQuery);
$update_result_row = mysqli_fetch_assoc($result_updateQuery);
?>


<!-- Edit/Update Modal -->

<!-- container of the modal -->
<div class="container">
         <!-- modal -->
         <div id="updateModal" class="modal">
             <!-- Modal content -->
             <div class="modal-content">
                                <div class="modal-header">
                                    <h2>Add Products</h2>
                                    <span class="close">&times;</span>
                                </div>

                            

                                <div class="modal-body"  >
                                        <form method="POST" action="process-addProducts.php" enctype="multipart/form-data" autocomplete="off" >
                                            <div class="parent">
                                                <div class="div1">
                                                    <label for="Product_Name">Product Name</label>
                                                    <input type="text" 
                                                    name="product_name"
                                                    value="<?php echo $updateQuery_row['product_name']?>">
                                                </div>

                                                <div class="div2"> 
                                                    <label for="Product_Price">Price</label>
                                                    <span>Php</span>
                                                    <input type="number" name="product_price" 
                                                    min="0.00" max="10000.00" step="0.01"
                                                    value="<?php echo $updateQuery_row['product_price']?>">
                                                </div>
                                                <div class="div3"> 
                                                    <label for="Product_Qty">Qty</label>
                                                    <input type="number" 
                                                    name="product_qty"
                                                    value="<?php echo $updateQuery_row['product_qty']?>">
                                                </div>
                                                <div class="div4"> 
                                                    <label for="Product_Qty">Product Details</label>
                                                    <textarea style="resize: none;" 
                                                    name="product_details"
                                                    value="<?php echo $updateQuery_row['product_details']?>"></textarea>
                                                </div>
                                                <div class="div5">

                                                    <!-- <label for="Product_Qty">Product Image</label> -->
                                                    <!-- <input type="file" id="myFile" name="upload_Image"> -->

                                                        
                                                            <label for="Product_Qty">Product Image</label>
                                                            <input type="file" 
                                                                    name="my_image">

                                                            <input type="submit" 
                                                                    name="submit"
                                                                    value="Upload">
                                                            
                                                        
                                                    
                                                </div>
                                                <!-- <div class="div6"> </div> -->
                                            </div>
                                            <button class="btn btn-success" type="submit" name="submit">Update product</button>
                                            </form>

                                </div> 
                                
             </div>
             <!-- end of modal content -->
         </div>
        <!-- end of modal -->
</div>
<!-- end of container modal -->








<!-- Query to Fetch data to table from database -->
<?php 
$query_inventory = "SELECT * FROM products ";
$result_query=mysqli_query($conn,$query_inventory); 
?>


<div class="container">

<?php if(isset($_GET['msg'])){ 
        $msg = $_GET['msg'];
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        '.$msg.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>';
    
    
    ?>
    		


            <div class="row">
                <div class="col m-auto">
                    <div class="card mt-5">
                        <table class="table table-hover table-bordered text-center">
                        <thead>
                            <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Product Image</th>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Details</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                            </tr>
                        </thead>
                            <?php       
  
                                while($row=mysqli_fetch_assoc($result_query))
                                    {
                                        $productId = $row['product_id'];
                                        $productName = $row['product_name'];
                                        $productPrice = $row['product_price'];
                                        $productQty = $row['product_quantity'];
                                        $productDetails = $row['product_details'];   
                                        $productImg = $row['product_images'];      
                            ?>
                            <tbody>
                            <tr>
                                        <td><?php echo $productId ?></td>
                                        <td>
                                            <div>
                                                <img src="uploads/<?= $row['product_images'] ?>" width="100" height="100">
                                            </div>
                                        </td>
                                        <td><?php echo $productName ?></td>
                                        <td><?php echo 'Php'.' '.$productPrice ?></td>
                                        <td><?php echo $productQty ?></td>
                                        <td><?php echo $productDetails ?></td>
                                        <td>
                                            <a href="process-edit-product.php?id=<?php echo $row['product_id']?>" class="btn btn-secondary" id="editBtn">Edit</a>
                                        </td>
                                        <td><a href="process-delete-product.php?id=<?php echo $row['product_id']?>" class="btn btn-danger">Delete</a></td>
                                    </tr>        
                            <?php 
                                } }  
                            ?>  

                            </tbody>
                        </table>

            </div>
        </div>
    </div>
</div>
  

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
<script>
// Get the login modal and the login button
var modal = document.getElementById("loginModal");
var loginBtn = document.getElementById("loginBtn");

// Get the close button for the modal and close the modal when clicked
var closeBtn = document.getElementsByClassName("close")[0];
closeBtn.onclick = function() {
  modal.style.display = "none";
}

// Show the login modal when the login button is clicked
loginBtn.onclick = function() {
  modal.style.display = "block";
}

// Close the modal if the user clicks outside of it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
<script src="./assets/js/updateModal.js"></script>
</html>