<?php

include '../db/database.php';



if(isset($_POST['submit'])) {
    // Sanitize user input
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
    $product_quantity = mysqli_real_escape_string($conn, $_POST['product_quantity']);
    $product_details = mysqli_real_escape_string($conn, $_POST['product_details']);
    $product_category = strtoupper(mysqli_real_escape_string($conn, $_POST['category'])); // uppercase letters

    // Check for file upload error
    if(isset($_FILES['product_image'])) {
        $img_name = $_FILES['product_image']['name'];
        $img_size = $_FILES['product_image']['size'];
        $tmp_name = $_FILES['product_image']['tmp_name'];
        $error = $_FILES['product_image']['error'];

        if ($error === 0) {
            if ($img_size > 5000000) { // size limit need to change
                $em = "Sorry, your file is too large.";
                header("HTTP/1.1 303 See Other");
                header("Location: add-new-item.php?error=$em");
                exit();
            } else {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
    
                $allowed_exs = array("jpg", "jpeg", "png");
    
                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                    $img_upload_path = '../uploads/' . $new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);
    
                    // Use prepared statement to insert into database
                    $stmt = $conn->prepare("INSERT INTO products (`product_name`,`product_price`,`product_quantity`,`product_details`,`product_images`,`category`) 
                                    VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("ssssss", $product_name, $product_price, $product_quantity, $product_details, $new_img_name, $product_category);
                    $stmt->execute();
    
                    if ($stmt->affected_rows > 0) {
                        header("HTTP/1.1 303 See Other");
                        header("Location: inventory.php?msg=New record created successfully");
                        exit();
                    } else {
                        echo "Failed: " . mysqli_error($conn);
                        exit();
                    }
    
                } else {
                    $em = "You can't upload files of this type";
                    header("HTTP/1.1 303 See Other");
                    header("Location: add-new-item.php?msg=You can't upload files of this type");
                    exit();
                }
            }
        } else {
            $em = "unknown error occurred!";
            header("HTTP/1.1 303 See Other");
            header("Location: add-new-item.php?msg=unknown error occurred!");
            exit();
        }
    } else {
        $em = "No file uploaded!";
        header("HTTP/1.1 303 See Other");
        header("Location: add-new-item.php?msg=No file uploaded!");
        exit();
    }
}
?>


<?php 

include 'navbar-admin.php';

?>
 
  <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

  <div class="container p-4">
        <div class="text-center mb-4">
            <h3>Add New Product</h3>
            <p class="text-muted">Complete the form below to add a new user</p>
        </div>
        <div class="">
            <form action="" method="POST" enctype="multipart/form-data" autocomplete="off" style="width: 50vw; min-width: 300px;" >
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Product Name</label>
                        <input type="text" class="form-control" name="product_name"
                        placeholder="Product Name">
                    </div>
                    <div class="col">
                        <label class="form-label">Price(₱)</label>
                        <input type="number" class="form-control" name="product_price"
                        min="0.00" max="10000.00" step="0.01"
                        placeholder="0.00">
                    </div>
                    <div class="col">
                        <label class="form-label">Quantity</label>
                        <input type="number" class="form-control" name="product_quantity"
                        placeholder="1-99">
                    </div>
                </div>
                <div class="row mb-3">
                  
                    <div class="col">
                        <label class="form-label">Product Details</label>
                        <textarea class="form-control"style="resize: none;" name="product_details"
                        placeholder="Description"></textarea>
                    </div>
                    <div class="col">
                        <div class="form-group mb-3">
                            <label for="">Item is for:</label>
                            <input type="radio" class="form-check-input" name="category" 
                            id="men" value="MEN">
                            <label for="female" class="form-input-label">Men</label>
                            
                            <input type="radio" class="form-check-input" name="category" 
                            id="women" value="WOMEN">
                            <label for="male" class="form-input-label">Women</label>

                            <input type="radio" class="form-check-input" name="category" 
                            id="unisex" value="UNISEX">
                            <label for="unisex" class="form-input-label">Unisex</label>


                            <input type="radio" class="form-check-input" name="category" 
                            id="kids" value="KIDS">
                            <label for="kids" class="form-input-label">Kids</label>
                            
                            <input type="radio" class="form-check-input" name="category" 
                            id="both" value="BOTH">
                            <label for="both" class="form-input-label">Both</label>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <!-- Choose image file button -->
                        <label for="" class="form-label">Upload Image</label>
                        <input type="file" class="form-control" name="product_image"  id="image_input" onchange="loadFile(event)" required>
                        <span style="color:red; font-size:12px;">Only jpg / jpeg/ png /gif format allowed.</span>
                        <!-- Clear image button -->
                        <input type="submit" class=" btn btn-secondary form-control" onclick="clearImage()"  value="Clear"> 
                    </div>

                    <div class="col">
                        
                            <img id="imgBox" width="250" height="250">
                            <p id="imgName"></p>

                    </div>
                </div>

                <div>
                    <button type="submit" class="btn btn-success" name="submit">Save</button>
                    <a href="inventory.php" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
  </div>

  </main>

<script>
    // display image file immediately
    var fileInput = document.getElementById("image_input");
    
    var loadFile = function(event){
        var imgBox = document.getElementById("imgBox");
        imgBox.src = URL.createObjectURL(event.target.files[0]);
        document.getElementById("imgName").innerHTML = "Selected Image: " + event.target.files[0].name;
    }
    
    var clearImage = function(){
        
    var imgBox = document.getElementById("imgBox");
    fileInput.value = null;
    imgBox.src = "";
    document.getElementById("imgName").innerHTML = "";
}

</script>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>