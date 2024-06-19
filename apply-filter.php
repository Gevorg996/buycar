<?php
include "database-connection.php";
$sql = "SELECT * FROM products WHERE 1";
$conditions = array();
if (isset($_POST['filterBrand']) && $_POST['filterBrand'] != 'Все марки') {
    $brand = $_POST['filterBrand'];
    $conditions[] = "productBrand = '$brand'";
}
if (isset($_POST['filterModel']) && $_POST['filterModel'] != 'Все модели') {
    $model = $_POST['filterModel'];
    $conditions[] = "productModel = '$model'";
}
if (isset($_POST['filterYearMin']) && $_POST['filterYearMin'] != 'Все') {
    $yearMin = $_POST['filterYearMin'];
    $conditions[] = "CAST(productYear AS SIGNED) >= '$yearMin'";
}
if (isset($_POST['filterYearMax']) && $_POST['filterYearMax'] != 'Все') {
    $yearMax = $_POST['filterYearMax'];
    $conditions[] = "CAST(productYear AS SIGNED) <= '$yearMax'";
}
if (isset($_POST['filterMileageMin']) && $_POST['filterMileageMin'] != 'Все') {
    $mileageMin = $_POST['filterMileageMin'];
    $conditions[] = "CAST(productMilage AS SIGNED) >= '$mileageMin'";
}
if (isset($_POST['filterMileageMax']) && $_POST['filterMileageMax'] != 'Все') {
    $mileageMax = $_POST['filterMileageMax'];
    $conditions[] = "CAST(productMilage AS SIGNED) <= '$mileageMax'";
}
if (isset($_POST['filterPriceMin']) && $_POST['filterPriceMin'] != 'Все') {
    $priceMin = $_POST['filterPriceMin'];
    $conditions[] = "CAST(productPrice AS SIGNED) >= $priceMin";
}
if (isset($_POST['filterPriceMax']) && $_POST['filterPriceMax'] != 'Все') {
    $priceMax = $_POST['filterPriceMax'];
    $conditions[] = "CAST(productPrice AS SIGNED) <= $priceMax";
}
if (isset($_POST['filterTransmission']) && $_POST['filterTransmission'] != 'Любой') {
    $transmission = $_POST['filterTransmission'];
    $conditions[] = "productTransmission = '$transmission'";
}
if (isset($_POST['filterFuelType']) && $_POST['filterFuelType'] != 'Любой') {
    $fuelType = $_POST['filterFuelType'];
    $conditions[] = "productFuel = '$fuelType'";
}
if (isset($_POST['filterColor']) && $_POST['filterColor'] != 'Все') {
    $color = $_POST['filterColor'];
    $conditions[] = "productColor = '$color'";
}
if (isset($_POST['filterRegion']) && $_POST['filterRegion'] != 'Любой') {
    $region = $_POST['filterRegion'];
    $conditions[] = "productArea = '$region'";
}
if (!empty($conditions)) {
    $sql .= " AND " . implode(" AND ", $conditions);
}
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo '<div class="car-container">';
    while ($row = $result->fetch_assoc()) {
        $imageNames = explode(',', $row['productImage']);
        $firstImageName = trim($imageNames[0]);
        $defaultImage = 'images/default_image.webp';
        echo '<a href="post-page.php?product_id=' . $row['productId'] . '" class="car-link">';
        echo '<div class="car">';
        echo '<img class="car-image" src="' . (empty($firstImageName) ? $defaultImage : $firstImageName) . '" alt="' . $row['productTitle'] . '">';
        echo '<div class="car-details">';
        echo '<h2 class="car-title">' . $row['productTitle'] . '</h2>';
        echo '<p class="car-price">Цена: $' . $row['productPrice'] . '</p>';
        echo '<p class="car-year">Год выпуска: ' . $row['productYear'] . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</a>';
    }
    echo '</div>';
} else {
    echo '<p class="no-cars-message">Нет доступных объявлений.</p>';
}
$conn->close();
?>