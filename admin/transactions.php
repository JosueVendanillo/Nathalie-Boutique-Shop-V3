<?php 

// include '../admin/admin_session.php';
include '../admin/navbar-admin.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions</title>

       <!-- Bootstrap CSS -->
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-LZMmv1rwus7gupN2JiQ7fNkx6gXdIbYiOk/uFW81TdyT9zVRskQnKNmFlgm6U/ljPY4ySm4Ufhq3Ez8+1CewHg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<div class="col-md-9">
<main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-4 pt-5">
  

  <div class="container">
   
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

    // Set variables
    $transaction_id = "";

    // query to get the total number of items
    $total_query = "SELECT COUNT(*) as total FROM transactions WHERE transaction_id LIKE '%$search%'";
    $total_result = mysqli_query($conn, $total_query);
    $total_rows = mysqli_fetch_assoc($total_result)['total'];

    // query to get the items for the current page
    $query_transactions = "SELECT * FROM transactions WHERE transaction_id LIKE '%$search%' LIMIT $items_per_page OFFSET $offset";
    $result_query = mysqli_query($conn, $query_transactions);
    
    // calculate the total number of pages
    $total_pages = ceil($total_rows / $items_per_page);
?>

<table class="table table-hover text-center" style="height: auto; overflow-y: auto;">
    <thead class="table-dark">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Transaction No.</th>
            <th scope="col">Customer Name</th>
            <th scope="col">Items</th>
            <th scope="col">Total Payment</th>
            <th scope="col">Transaction Date</th>
            <th scope="col">Payment Method</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result_query)){ 
            $transaction_id = $row['transaction_id'];
            $totalpayment = $row['total_amount'];
            $transactionDate = $row['date_time'];
            $paymentMethod = $row['payment_method'];
        ?>
            <tr>
                <th scope="row"><?= $row['id'] ?></th>
                <td><?php echo strtoupper($transaction_id); ?></td>
                <td><?php echo strtoupper($row['user_id']) ?></td>
                <td>
                    <?php 
                    $show_items = "SELECT * FROM items WHERE transaction_id= '$transaction_id'";
                    $result_items = mysqli_query($conn, $show_items);

                    while($row_items = mysqli_fetch_assoc($result_items)):
                        echo '
                            <div>
                                <ol>'
                                    .$row_items['quantity'].' x '.$row_items['item_name'].' = '.($row_items['quantity']* $row_items['price']);
                                '</ol>
                            </div>';
                    endwhile;
                    ?>
                </td>
                <td><?php echo 'Php' . ' ' .  $totalpayment; ?></td>
                <td><?php echo $transactionDate; ?></td>
                <td><?php echo $paymentMethod; ?></td>
                <td>
                    <a href="print-receipt.php?id=<?php echo $row['transaction_id'] ?>" class="btn btn-secondary" target="_blank" id="printBtn">Print</a>
                </td>


            </tr>
        <?php } ?>
    </tbody>
</table>

<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <li class="page-item <?php echo $i == $current_page ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?php echo $i ?>&search=<?php echo $search ?>"><?php echo $i ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>

</nav>
  </div>
  

        </main>
</div>

<script>
function printReceipt(transactionId) {
    // Open a new window with the receipt content
    var receiptWindow = window.open('', 'Receipt', 'width=300,height=400');
    var receiptContent = '<html><head><title>Receipt</title></head><body>';

    // Add the transaction details to the receipt content
    receiptContent += '<h2>Transaction Details</h2>';
    receiptContent += '<p><strong>Transaction ID:</strong> ' + transactionId + '</p>';
    receiptContent += '<p><strong>Customer Name:</strong> <?php echo strtoupper($row['user_id']) ?></p>';
    receiptContent += '<p><strong>Transaction Date:</strong> <?php echo $transactionDate ?></p>';
    receiptContent += '<p><strong>Payment Method:</strong> <?php echo $paymentMethod ?></p>';

    // Add the items to the receipt content
    receiptContent += '<h2>Items</h2>';
    receiptContent += '<ul>';
    <?php 
    $show_items = "SELECT * FROM items WHERE transaction_id= $transaction_id";
    $result_items = mysqli_query($conn, $show_items);
    while($row_items = mysqli_fetch_assoc($result_items)):
    ?>
    receiptContent += '<li><?php echo $row_items['quantity'] ?> x <?php echo $row_items['item_name'] ?> = <?php echo ($row_items['quantity']* $row_items['price']) ?></li>';
    <?php endwhile; ?>
    receiptContent += '</ul>';

    receiptContent += '<h2>Total Payment</h2>';
    receiptContent += '<p><?php echo "Php " . $totalpayment ?></p>';

    receiptContent += '</body></html>';

    // Write the receipt content to the new window
    receiptWindow.document.write(receiptContent);

    // Print the receipt
    receiptWindow.print();
}
</script>

</body>
</html>