<?php
session_start();
include "database-connection.php";
function verifyCSRFToken($token) {
    return isset($_SESSION['csrf_token']) && $_SESSION['csrf_token'] === $token;
}
function cleanInput($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $csrf_token = cleanInput($_POST['csrf_token']);
    if (!verifyCSRFToken($csrf_token)) {
        $response["success"] = false;
        $response["message"] = "Недопустимый CSRF токен.";
        header("Content-Type: application/json");
        echo json_encode($response);
        exit();
    }
    $name = cleanInput($_POST['name']);
    $email = cleanInput($_POST['email']);
    $password = cleanInput($_POST['password']);
    $phone = cleanInput($_POST['phone']);
    if (empty($name) || empty($email) || empty($password) || empty($phone)) {
        $response["success"] = false;
        $response["message"] = "Пожалуйста, заполните все поля.";
        header("Content-Type: application/json");
        echo json_encode($response);
        exit();
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response["success"] = false;
        $response["message"] = "Введите корректный адрес почты.";
        header("Content-Type: application/json");
        echo json_encode($response);
        exit();
    }
    if (strlen($password) < 8 || !preg_match("/[A-Za-z]/", $password) || !preg_match("/\d/", $password)) {
        $response["success"] = false;
        $response["message"] = "Пароль должен содержать минимум 8 символов, хотя бы одну цифру и одну букву латинского алфавита.";
        header("Content-Type: application/json");
        echo json_encode($response);
        exit();
    }
    if (!preg_match("/^\d{0,16}$/", $phone)) {
        $response["success"] = false;
        $response["message"] = "Введите корректный номер телефона (без пробелов и дефисов).";
        header("Content-Type: application/json");
        echo json_encode($response);
        exit();
    }
    $checkEmailQuery = "SELECT COUNT(*) FROM users WHERE userEmail = ?";
    $checkEmailStmt = $conn->prepare($checkEmailQuery);
    $checkEmailStmt->bind_param("s", $email);
    $checkEmailStmt->execute();
    $emailAlreadyExists = ($checkEmailStmt->get_result()->fetch_row()[0] > 0);
    $checkEmailStmt->close();
    if ($emailAlreadyExists) {
        $response["success"] = false;
        $response["message"] = "почта уже зарегистрирован.";
        header("Content-Type: application/json");
        echo json_encode($response);
        exit();
    }
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (userName, userEmail, userPassword, userPhone) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $passwordHash, $phone);
    $response = array();
    if ($stmt->execute()) {
        $response["success"] = true;
        $response["message"] = "Регистрация успешно завершена!";
        $response["redirect"] = "user-login.php";
    } else {
        $response["success"] = false;
        $response["message"] = "Ошибка регистрации: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
    header("Content-Type: application/json");
    echo json_encode($response);
    unset($_SESSION['csrf_token']);
} else {
    header("Location: user-registration.php");
    exit();
}
?>