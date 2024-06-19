<?php
session_start();
$title = "Изменение информации";
$headerCss = "styles/site-header.css";
$css = "styles/update-info.css";
$footerCss = "styles/site-footer.css";
include "site-header.php";
include "database-connection.php";
if (isset($_SESSION['userId'])) {
    if (isset($_GET['product_id'])) {
        $productId = $_GET['product_id'];
        $sql = "SELECT * FROM products WHERE productId = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $productId);
            $stmt->execute();
            $result = $stmt->get_result();
            $product = $result->fetch_assoc();
            $stmt->close();
            if ($product) {
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $updatedTitle = $_POST['title'];
                    $updatedPrice = $_POST['price'];
                    $updatedYear = $_POST['year'];
                    $updatedDescription = $_POST['description'];
                    $updateSql = "UPDATE products SET productTitle = ?, productPrice = ?, productYear = ?, productDescription = ? WHERE productId = ?";
                    $updateStmt = $conn->prepare($updateSql);
                    if ($updateStmt) {
                        $updateStmt->bind_param("ssssi", $updatedTitle, $updatedPrice, $updatedYear, $updatedDescription, $productId);
                        $updateStmt->execute();
                        $updateStmt->close();
                        header("Location: view-page.php");
                        exit;
                    }
                }
                ?>
                <div class="container">
                <div class="update-container">
                    <h2>Изменение информации</h2>
                    <form method="post" action="">
                        <label for="title">Заголовок:</label>
                        <input type="text" name="title" value="<?= htmlspecialchars($product['productTitle']); ?>" required>
                        <label for="price">Цена:</label>
                        <input type="text" name="price" value="<?= htmlspecialchars($product['productPrice']); ?>" required>
                        <label for="year">Год:</label>
                        <input type="text" name="year" value="<?= htmlspecialchars($product['productYear']); ?>" required>
                        <label for="description">Описание:</label>
                        <textarea name="description" required><?= htmlspecialchars($product['productDescription']); ?></textarea>
                        <input type="submit" value="Сохранить изменения">
                    </form>
                </div>
                </div>
                <?php
            } else {
                echo "<p>Продукт не найден.</p>";
            }
        } else {
            echo "<p>Ошибка при выполнении запроса.</p>";
        }
    } else {
        echo "<p>Неверные параметры запроса.</p>";
    }
} else {
    header("Location: user-login.php");
    exit;
}
include 'site-footer.php';
?>
