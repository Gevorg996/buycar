<?php
session_start();
$css = "styles/post-page.css";
$headerCss = "styles/site-header.css";
$footerCss = "styles/site-footer.css";
include "database-connection.php";
?>
<div class="container">
<div class="table-container">
<?php
$productId = $_GET['product_id'];
if (isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];
} else {
    $userId = null;
}
$query = "SELECT p.productId, p.productStatus, p.productArea, p.productTitle, p.productBrand, p.productModel, p.productPrice, p.productCurrency, p.productYear, p.productFuel, p.productEngine, p.productTransmission, p.productDrive, p.productMilage, p.productMilageType, p.productSteering, p.productColor, p.productDescription, p.productImage, u.userName, u.userEmail, u.userPhone FROM products p
INNER JOIN users u ON p.userId = u.userId
WHERE p.productId = $productId";
$result = $conn->query($query);
if ($result) {
    $row = $result->fetch_assoc();
    $title = $row['productBrand'] . ' ' . $row['productModel'] . ' ' . $row['productYear'] . ' ' . 'год' . ' ' . $row['productPrice'] . ' ' . $row['productCurrency'];
    include "site-header.php";
} else {
    echo "Ошибка выполнения запроса: " . $conn->error;
}
$conn->close();
?>
<div class="gallery">
    <?php
    $images = explode(',', $row['productImage']);
    foreach ($images as $index => $image) {
        echo '<img class="product-image' . ($index === 0 ? ' active' : '') . '" data-index="' . $index . '" src="' . $image . '" alt="Изображение ' . ($index + 1) . '">';
    }
    ?>
</div>
<button id="prevImageButton" class="image-button">←</button>
<button id="nextImageButton" class="image-button">→</button>
<div class="product-container">
    <div class="title-container">
        <h1><?= $row['productTitle'] ?></h1>
    </div>
    <div class="button-container">
        <div id="responseMessage"></div>
        <button id="likeButton" class="like-button" data-product-id="<?= $productId ?>" data-user-id="<?= $userId ?>">Нравится</button>
    </div>
</div>
<table>
    <tr>
        <td>Статус</td>
        <td><?= $row['productStatus'] ?></td>
    </tr>
    <tr>
        <td>Местоположение</td>
        <td><?= $row['productArea'] ?></td>
    </tr>
    <tr>
        <td>Марка</td>
        <td><?= $row['productBrand'] ?></td>
    </tr>
    <tr>
        <td>Модель</td>
        <td><?= $row['productModel'] ?></td>
    </tr>
    <tr>
        <td>Цена</td>
        <td><?= $row['productPrice'] . ' ' . $row['productCurrency'] ?></td>
    </tr>
    <tr>
        <td>Год выпуска</td>
        <td><?= $row['productYear'] ?></td>
    </tr>
    <tr>
        <td>Топливо</td>
        <td><?= $row['productFuel'] ?></td>
    </tr>
    <tr>
        <td>Двигатель</td>
        <td><?= $row['productEngine'] ?></td>
    </tr>
    <tr>
        <td>Трансмиссия</td>
        <td><?= $row['productTransmission'] ?></td>
    </tr>
    <tr>
        <td>Привод</td>
        <td><?= $row['productDrive'] ?></td>
    </tr>
    <tr>
        <td>Пробег</td>
        <td><?= $row['productMilage'] . ' ' . $row['productMilageType'] ?></td>
    </tr>
    <tr>
        <td>Руль</td>
        <td><?= $row['productSteering'] ?></td>
    </tr>
    <tr>
        <td>Цвет</td>
        <td><?= $row['productColor'] ?></td>
    </tr>
    <tr>
        <td>Описание</td>
        <td><?= $row['productDescription'] ?></td>
    </tr>
    <tr>
        <td>Продавец</td>
        <td><h2><?= $row['userName'] ?></h2></td>
    </tr>
    <tr>
        <td>Номер объявления</td>
        <td><?= $row['productId'] ?></td>
    </tr>
    <tr>
    <td>Телефон</td>
    <td><a href="tel:<?= $row['userPhone'] ?>"><?= $row['userPhone'] ?></a></td>
</tr>
</table>
</div>
</div>
<?php include 'site-footer.php'; ?>
<script src="js/jquery.js"></script>
<script src="js/favorite-controller.min.js"></script>
<script src="js/post-page.min.js"></script>
</body>
</html>