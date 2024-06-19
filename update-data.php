<?php
include 'database-connection.php';
$product_id = $_GET['product_id'];
$current_timestamp = date("Y-m-d H:i:s");
$sql = "UPDATE products SET productTime = '$current_timestamp' WHERE productId = $product_id";
if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
} else {
    header("Location: index.php");
}
$conn->close();
?>