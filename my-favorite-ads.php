<?php
session_start();
$title = "избранные объявления";
$css = "styles/my-favorite-ads.css";
$headerCss = "styles/site-header.css";
$footerCss = "styles/site-footer.css";
include "site-header.php";
include "database-connection.php";
?>
<div class="container">
<?php
if (!isset($_SESSION['userId'])) {
    header("Location: user-login.php");
    exit();
}
$userid = $_SESSION['userId'];
$sql = "SELECT favoriteProductId FROM favorites WHERE favoriteUserId = $userid";
$result = mysqli_query($conn, $sql);
$favoriteProducts = [];
while ($row = mysqli_fetch_assoc($result)) {
    $favoriteProducts[] = $row['favoriteProductId'];
}
if (!empty($favoriteProducts)) {
    $favoriteProductsStr = implode(',', $favoriteProducts);
    $sql = "SELECT * FROM products WHERE productId IN ($favoriteProductsStr)";
    $result = mysqli_query($conn, $sql);
       echo '<div class="favor-container">';
        while ($row = $result->fetch_assoc()) {
        $imageNames = explode(',', $row['productImage']);
        $firstImageName = trim($imageNames[0]);
        $defaultImage = 'images/default_image.webp';
        echo '<a href="post-page.php?product_id=' . $row['productId'] . '" class="favorite-car">';
        echo '<div class="favor">';
        echo '<div class="favor-image-container">';
        echo '<img class="favor-image" src="' . (empty($firstImageName) ? $defaultImage : $firstImageName) . '" alt="' . $row['productTitle'] . '">';
        echo '</div>';
        echo '<div class="favor-details">';
        echo '<h2 class="favor-title">' . $row['productTitle'] . '</h2>';
        echo '<p class="favor-year">Год выпуска: ' . $row['productYear'] . '</p>';
        echo '<p class="favor-price">Цена: $' . $row['productPrice'] . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</a>';
    }
        echo '</div>';
} else {
    echo "<div class='no-favorites-message'>У вас нет избранных объявлении.</div>";
}
mysqli_close($conn);
?>
</div>
<?php include "site-footer.php"; ?>