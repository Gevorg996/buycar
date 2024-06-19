<?php
session_start();
include "database-connection.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['productId'];
    $userId = $_POST['userId'];
    if (!isset($_SESSION['userId'])) {
        echo 'unauthorized';
    } else {
        $query = "SELECT * FROM favorites WHERE favoriteUserId = $userId AND favoriteProductId = $productId";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            echo 'favorite';
        } else {
            echo 'unfavorite';
        }
    }
$conn->close();
}
?>