<?php
session_start();
include 'database-connection.php';
if (isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];
    if (isset($_GET['product_id'])) {
        $productId = $_GET['product_id'];
        if (is_dir("uploads")) {
            $sql_select_images = "SELECT productImage FROM products WHERE productId = ?";
            $stmt_select_images = $conn->prepare($sql_select_images);
            if ($stmt_select_images) {
                $stmt_select_images->bind_param("i", $productId);
                $stmt_select_images->execute();
                $stmt_select_images->bind_result($imagePath);
                $imagePathsToDelete = [];
                while ($stmt_select_images->fetch()) {
                    $imageNames = explode(',', $imagePath);
                    foreach ($imageNames as $imageName) {
                        $imagePathsToDelete[] = $imageName;
                    }
                }
                $stmt_select_images->close();

                foreach ($imagePathsToDelete as $imagePath) {
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
                $sql_delete_product = "DELETE FROM products WHERE productId = ? AND userId = ?";
                $stmt_delete_product = $conn->prepare($sql_delete_product);
                if ($stmt_delete_product) {
                    $stmt_delete_product->bind_param("ii", $productId, $userId);
                    $stmt_delete_product->execute();                    
                    if ($stmt_delete_product->affected_rows > 0) {
                        header("Location: view-page.php");
                        exit;
                    } else {
                        echo "Advertisement not found or you don't have permission to delete it.";
                    }                    
                    $stmt_delete_product->close();
                } else {
                    echo 'Error preparing the SQL statement: ' . $conn->error;
                }
            } else {
                echo 'Error preparing the SQL statement: ' . $conn->error;
            }
        } else {
            echo "The 'uploads' directory does not exist.";
        }
    } else {
        echo 'Product ID not provided in the URL.';
    }
} else {
    header("Location: user-login.php");
    exit;
}
?>