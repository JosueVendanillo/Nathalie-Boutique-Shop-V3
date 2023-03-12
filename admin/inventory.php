<?php 



include '../admin/navbar-admin.php';

?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 pt-5">
  

  <div class="container">
    <!-- Bootstrap Alert from Add,Update and Delete-->
        <?php
                if(isset($_GET['msg'])){
                    $msg = $_GET['msg'];
                    $countdown = 5; // Countdown time in seconds
                    
                    echo '
                      <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        ' . $msg . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <div id="countdown" style="font-weight: bold;"></div>
                      </div>
                      <script>
                        var countdown = ' . $countdown . ';
                        var countdownElem = document.getElementById("countdown");
                    
                        var intervalId = setInterval(function() {
                          countdown--;
                          countdownElem.innerHTML = "This alert will disappear in " + countdown + " seconds.";
                    
                          if (countdown == 0) {
                            clearInterval(intervalId);
                            removeAlert();
                          }
                        }, 1000);
                    
                        function removeAlert() {
                          document.querySelector(\'.alert\').remove();
                          window.location.href=\'http://localhost:8080/nathalie%20shop%20V3/admin/inventory.php\';
                        }
                        
                        document.querySelector(\'.btn-close\').addEventListener("click", function() {
                          clearInterval(intervalId);
                          removeAlert();
                        });
                      </script>
                    ';
                }
        ?>


            
        <a href="add-new-item.php" class="btn btn-dark mb-3">Add New</a>


        <form method="GET">
            <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search Products" name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : '' ?>">
        <button class="btn btn-outline-secondary" type="submit">Search</button>
    </div>
</form>

<?php
    // number of items to display per page
    $items_per_page = 5;

    // current page number, default to 1
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

    // calculate the offset
    $offset = ($current_page - 1) * $items_per_page;

    // search keyword
    $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

    // query to get the total number of items
    $total_query = "SELECT COUNT(*) as total FROM products WHERE product_name LIKE '%$search%'";
    $total_result = mysqli_query($conn, $total_query);
    $total_rows = mysqli_fetch_assoc($total_result)['total'];

    // query to get the items for the current page
    $query_inventory = "SELECT * FROM products WHERE product_name LIKE '%$search%' LIMIT $items_per_page OFFSET $offset";
    $result_query = mysqli_query($conn, $query_inventory);

    // calculate the total number of pages
    $total_pages = ceil($total_rows / $items_per_page);
?>

<table class="table table-hover text-center" style="height: 500px; overflow-y: auto;">
    <thead class="table-dark">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Category</th>
            <th scope="col">Product Image</th>
            <th scope="col">Product</th>
            <th scope="col">Price</th>
            <th scope="col">Qty</th>
            <th scope="col">Details</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result_query)): ?>
            <tr>
                <th scope="row"><?php echo $row['product_id'] ?></th>
                <td><?php echo strtoupper($row['category']) ?></td>
                <td>
                    <div>
                        <img src="../uploads/<?=$row['product_images']?>" width="100" height="100">
                    </div>
                </td>
                <td><?php echo $row['product_name'] ?></td>
                <td><?php echo 'Php' . ' ' . $row['product_price'] ?></td>
                <td><?php echo $row['product_quantity'] ?></td>
                <td><?php echo $row['product_details'] ?></td>
                <td>
                    <a href="update-item.php?id=<?php echo $row['product_id'] ?>" class="btn btn-secondary" id="editBtn">Edit</a>
                    <a href="delete-item.php?id=<?php echo $row['product_id'] ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <li class="page-item <?php echo $i == $current_page ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?php echo $i ?>"><?php echo $i ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>
  </div>
  

        </main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>