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
            $deleteQuery = "DELETE FROM favorites WHERE favoriteUserId = $userId AND favoriteProductId = $productId";
            if ($conn->query($deleteQuery)) {
                echo 'removed';
            } else {
                echo 'error';
            }
        } else {
            $insertQuery = "INSERT INTO favorites (favoriteUserId, favoriteProductId) VALUES ($userId, $productId)";
            if ($conn->query($insertQuery)) {
                echo 'added';
            } else {
                echo 'error';
            }
        }
    }
    $conn->close();
}
?>