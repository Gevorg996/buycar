<?php
session_start();
include "database-connection.php";
if (!isset($_SESSION['userId'])) {
    header("Location: user-login.php");
    exit();
}

$user_id = $_SESSION['userId'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $requiredFields = array("sell_buy", "marz", "title", "description", "car_make", "car_model", "price", "currency", "year", "engine_type", "engine_size", "transmission", "drive_type", "km_mile", "unit_select", "steering_wheel", "color");
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            echo "Пожалуйста, заполните все обязательные поля.";
            exit();
        }
    }
    
    $sell_buy = htmlspecialchars($_POST["sell_buy"]);
    $marz = htmlspecialchars($_POST["marz"]);
    $title = htmlspecialchars($_POST["title"]);
    $description = htmlspecialchars($_POST["description"]);
    $car_make = htmlspecialchars($_POST["car_make"]);
    $car_model = htmlspecialchars($_POST["car_model"]);
    $price = htmlspecialchars($_POST["price"]);
    $currency = htmlspecialchars($_POST["currency"]);
    $year = htmlspecialchars($_POST["year"]);
    $engine_type = htmlspecialchars($_POST["engine_type"]);
    $engine_size = htmlspecialchars($_POST["engine_size"]);
    $transmission = htmlspecialchars($_POST["transmission"]);
    $drive_type = htmlspecialchars($_POST["drive_type"]);
    $km_mile = htmlspecialchars($_POST["km_mile"]);
    $unit_select = htmlspecialchars($_POST["unit_select"]);
    $steering_wheel = htmlspecialchars($_POST["steering_wheel"]);
    $color = htmlspecialchars($_POST["color"]);
    $imagePaths = [];
    if (!empty($_FILES['file']['name'][0])) {
        $uploadDir = 'uploads/';
        foreach ($_FILES['file']['tmp_name'] as $key => $tmpName) {
            $originalFilename = $_FILES['file']['name'][$key];
            $fileExtension = strtolower(pathinfo($originalFilename, PATHINFO_EXTENSION));
            $filename = uniqid() . '.' . $fileExtension;
            $imagePath = $uploadDir . $filename;
            $allowedFormats = array('jpg', 'jpeg', 'png', 'gif', 'heic', 'webp', 'svg');
            if (!in_array($fileExtension, $allowedFormats)) {
                echo "Неподдерживаемый формат файла.";
                exit();
            }
            $maxFileSize = 20 * 1024 * 1024; // 20MB
            if ($_FILES['file']['size'][$key] > $maxFileSize) {
                echo "Размер файла слишком большой.";
                exit();
            }
            if (move_uploaded_file($tmpName, $imagePath)) {
                $imagePaths[] = $imagePath;
            } else {
                echo "Не удалось переместить загруженный файл. Ошибка: " . $_FILES['file']['error'][$key];
                exit();
            }
        }
    }
    
    $imagePathsStr = implode(',', $imagePaths);
    $query = "INSERT INTO products (userId, productArea, productStatus, productTitle, productBrand, productModel, productPrice, productCurrency, productYear, productFuel, productEngine, productTransmission, productDrive, productMilage, productMilageType, productSteering, productColor, productDescription, productImage)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("issssssssssssssssss", $user_id, $marz, $sell_buy, $title, $car_make, $car_model, $price, $currency, $year, $engine_type, $engine_size, $transmission, $drive_type, $km_mile, $unit_select, $steering_wheel, $color, $description, $imagePathsStr);
    if ($stmt->execute()) {
        echo 'success';
        exit();
    } else {
        echo "Не удалось добавить продукт: " . mysqli_error($conn);
    }
    $stmt->close();
}
$conn->close();
?>
