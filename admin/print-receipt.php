<?php 
include '../db/database.php';



$transaction_id = $_GET['id'];


?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Receipt</title>
    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }




        .receipt {
            width: 80%; /* adjust the width as needed */
            margin: auto;
            font-family: Arial, sans-serif;
            font-size: 16px; /* adjust the font size as needed */
            line-height: 20px;
            text-align: center;
            padding: 20px; /* adjust the padding as needed */
            border: 1px solid #ccc;
            }

        .receipt h2 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .receipt .date {
            margin-bottom: 10px;
        }
        .receipt table {
            width: 100%;
            margin-bottom: 10px;
            border-collapse: collapse;
        }
        .receipt table th, .receipt table td {
            border: 1px solid #ccc;
            padding: 5px;
        }
        .receipt table th {
            background-color: #eee;
        }
        .receipt .total {
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>
<body>

        <?php $show_transaction = "SELECT * FROM transactions WHERE transaction_id= '$transaction_id'";
            $result_transactions = mysqli_query($conn, $show_transaction);
           

            if($rows = mysqli_fetch_assoc($result_transactions)){

      

        ?>


    <div class="receipt">
        <h2>Receipt</h2>
        <div>Transaction ID: <strong><?php echo $rows['transaction_id'];?></strong></div>
        <div>Customer Name: <strong><?php echo $rows['user_id'];?></strong></div>
        <div>Transaction Date: <strong><?php echo $rows['date_time'];?></strong></div>       
        <div>Payment Method: <strong><?php echo $rows['payment_method']?></strong></div>

        <?php }?>
        <div class="date"> Receipt Date: <?php echo date('F j, Y, g:i a'); ?></div>
        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php 


$show_items = "SELECT * FROM items WHERE transaction_id= '$transaction_id'";
$result_items = mysqli_query($conn, $show_items);


$totalpayment = 0;

while($row_items = mysqli_fetch_assoc($result_items)):
    
$totalpayment += $row_items['price'];
                    echo '
                        <tr>
                            <td>'.$row_items['item_name'].'</td>
                            <td>'.$row_items['quantity'].'</td>
                            <td>'.($row_items['quantity']* $row_items['price']).'</td>
                        </tr>';
                endwhile;
                ?>
            </tbody>
        </table>
        <div class="total">Total: <?php echo 'Php' . ' ' .  $totalpayment; ?></div>

        <button id="print-btn" style="width:100px;padding:10px;">Print</button>
        <button id="download-btn" style="width:100px;padding:10px;">Download</button>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const printBtn = document.getElementById('print-btn');
            printBtn.addEventListener('click', function() {
                window.print();
            });
        });

        const downloadBtn = document.getElementById('download-btn');

        downloadBtn.addEventListener('click', function() {
        const html = document.documentElement.outerHTML;
        const blob = new Blob([html], { type: 'text/html' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'receipt.html';
        a.click();
        URL.revokeObjectURL(url);
        });

    </script>
</body>
</html>
