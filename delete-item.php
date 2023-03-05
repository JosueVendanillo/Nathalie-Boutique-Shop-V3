<?php

include './db/database.php';

$id = mysqli_real_escape_string($conn, $_GET['id']);
$sql = "DELETE FROM products WHERE product_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
$result = mysqli_stmt_execute($stmt);

if ($result) {
    header("Location: inventory.php?msg=Record deleted successfully");
} else {
    echo "Failed: " . mysqli_error($conn);
}

?>