<?php
session_start();
include "database-connection.php";   
if ($_SERVER["REQUEST_METHOD"] == "POST") {
     if (!isset($_POST['csrf_token_login']) || $_POST['csrf_token_login'] !== $_SESSION['csrf_token_login']) {
        $_SESSION['errorMessage'] = "Ошибка CSRF токена для авторизации. Пожалуйста, повторите попытку.";
        header("Location: user-login.php");
        exit();
    }
    $email = $_POST["email"];
    $password = $_POST["password"];
    $query = "SELECT * FROM users WHERE userEmail = '$email' LIMIT 1";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $user = mysqli_fetch_assoc($result);
        if ($user && password_verify($password, $user["userPassword"])) {
            $_SESSION['userId'] = $user['userId'];
            unset($_SESSION['csrf_token_login']);
            header("Location: post-ad.php");
            exit();
        } else {
            $_SESSION['errorMessage'] = "Неверный email или пароль. Попробуйте еще раз.";
            header("Location: user-login.php");
        }
    } else {
        $_SESSION['errorMessage'] = "Произошла ошибка. Пожалуйста, повторите попытку позже.";
        header("Location: user-login.php");
    }
}
?>