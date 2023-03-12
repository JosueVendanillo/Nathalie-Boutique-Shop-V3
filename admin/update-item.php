<?php

include '../db/database.php';

$id = $_GET['id'];

if (isset($_POST['submit'])) {
    // Sanitize user input
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
    $product_quantity = mysqli_real_escape_string($conn, $_POST['product_quantity']);
    $product_details = mysqli_real_escape_string($conn, $_POST['product_details']);
    $product_category = strtoupper(mysqli_real_escape_string($conn, $_POST['category'])); // uppercase letters

    // Validate file upload
    $img_name = $_FILES['product_image']['name'];
    $img_size = $_FILES['product_image']['size'];
    $tmp_name = $_FILES['product_image']['tmp_name'];
    $error = $_FILES['product_image']['error'];

    if ($error !== UPLOAD_ERR_OK) {
        throw new Exception('File upload failed: ' . $error);
    }

    if ($img_size > 5000000) { // size limit need to change
        throw new Exception('File size limit exceeded');
    }

    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
    $img_ex_lc = strtolower($img_ex);

    $allowed_exs = array("jpg", "jpeg", "png");

    if (!in_array($img_ex_lc, $allowed_exs)) {
        throw new Exception('Invalid file type');
    }

    $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
    $img_upload_path = '../uploads/' . $new_img_name;
    if (!move_uploaded_file($tmp_name, $img_upload_path)) {
        throw new Exception('File upload failed');
    }

    // UPDATE into Database
    $stmt = mysqli_prepare($conn, "UPDATE products SET product_name=?, product_price=?, product_quantity=?, product_details=?, product_images=?, category=? WHERE product_id= ?");
    mysqli_stmt_bind_param($stmt, 'ssssssi', $product_name, $product_price, $product_quantity, $product_details, $new_img_name, $product_category, $id);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if ($result) {
        header("Location: inventory.php?msg=Product updated successfully");
    } else {
        throw new Exception(mysqli_error($conn));
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>




<body>

<?php 
include 'navbar-admin.php';
?>


<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <!-- <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
      Nathalie's Boutique Inventory
  </nav> -->



  <div class="container p-4">
        <div class="text-center mb-4">
            <h3>Edit Product</h3>
            <p class="text-muted">Click update after changing any information</p>
        </div>

        <?php
        
        $edit_query = "SELECT * FROM products WHERE product_id=$id LIMIT 1";
        $result_edit_query = mysqli_query($conn,$edit_query);
        $row=mysqli_fetch_assoc($result_edit_query);
        ?>


        <div class="">
            <form action="" method="POST" enctype="multipart/form-data" autocomplete="off" style="width: 50vw; min-width: 300px;" >
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Product Name</label>
                        <input type="text" class="form-control" name="product_name"
                        value = "<?php echo $row['product_name']; ?>">
                    </div>
                    <div class="col">
                        <label class="form-label">Price(₱)</label>
                        <input type="number" class="form-control" name="product_price"
                        min="0.00" max="10000.00" step="0.01"
                        value = "<?php echo $row['product_price']; ?>">
                    </div>
                    <div class="col">
                        <label class="form-label">Quantity</label>
                        <input type="number" class="form-control" name="product_quantity"
                        value = "<?php echo $row['product_quantity']; ?>">
                    </div>
                </div>
                <div class="row mb-3">

                    <div class="col">
                        <label class="form-label">Product Details</label>
                        <textarea class="form-control"style="resize: none;" name="product_details"
                        ><?php echo $row['product_details'];?></textarea>
                    </div>
                    <div class="col">
                        <div class="form-group mb-3">
                            <label for="">For:</label>

                            <input type="radio" class="form-check-input" name="category" 
                            id="male" value="male" <?php echo ($row['category']==='MALE') ? "checked":"";?>>
                            <label for="female" class="form-input-label">Male</label>

                            <input type="radio" class="form-check-input" name="category" 
                            id="female" value="female" <?php echo ($row['category']==='FEMALE') ? "checked":"";?>>
                            <label for="male" class="form-input-label">Female</label>

                            <input type="radio" class="form-check-input" name="category" 
                            id="both" value="both" <?php echo ($row['category']=='BOTH')? "checked":"";?>>
                            <label for="both" class="form-input-label">Both</label>
                        </div>
                    </div>

                    
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <!-- Choose image file button -->
                        <label for="" class="form-label">Upload Image</label>
                        <input type="file" class="form-control" name="product_image" id="image_input" onchange="loadFile(event)" 
                        value="<?php echo $row['product_images']?>"required>
                        <span style="color:red; font-size:12px;">Only jpg / jpeg/ png /gif format allowed.</span>
                        <!-- Clear image button -->
                        <input type="submit" class=" btn btn-secondary form-control" onclick="clearImage(event)"  value="Clear"> 
                    </div>
                    <div class="col">
                        <img src="uploads/<?= $row['product_images']?>"  id="imgBox" width="250" height="250">
                        <br>
                        <p id="imgName"><?= $row['product_images']?></p>
                    </div>

                  
   
                
                </div>

                <div>
                    <button type="submit" class="btn btn-success" name="submit">Save</button>
                    <a href="inventory.php" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
  </div>

 


<script>
  function loadFile(event) {
    var image = document.getElementById('imgBox');
    image.src = URL.createObjectURL(event.target.files[0]);
    document.getElementById("imgName").innerHTML = "Selected Image: " + event.target.files[0].name;
  }

  function clearImage() {
    var image = document.getElementById('imgBox');
    image.src = "";
    document.getElementById("imgName").innerHTML = "";
  }
</script>


</main>   
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>