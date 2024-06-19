<?php
session_start();
include "database-connection.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $newPassword = $conn->real_escape_string($_POST['newPassword']);
    $repeatNewPassword = $conn->real_escape_string($_POST['repeatNewPassword']);
    if ($newPassword !== $repeatNewPassword) {
        $_SESSION['error'] = "Пароли не совпадают";
        header("Location: set-new-password.php");
        exit();
    }
    $passwordPattern = '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d!$%&*#=+\-.,_:\s]{8,}$/';
    if (!preg_match($passwordPattern, $newPassword)) {
        $_SESSION['error'] = "Пароль не соответствует требованиям";
        header("Location: set-new-password.php");
        exit();
    }
    $userEmail = $_SESSION['userEmail'];
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $updatePasswordQuery = "UPDATE users SET userPassword = '$hashedPassword' WHERE userEmail = '$userEmail'";
    if ($conn->query($updatePasswordQuery)) {
        unset($_SESSION['userEmail']);
        header("Location: user-login.php");
        exit();
    } else {
       header("Location: set-new-password.php");
        exit();
    }
} else {
    header("Location: set-new-password.php");
    exit();
}
$conn->close();
?>