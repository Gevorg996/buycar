<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userCode = $_POST['code'];
    $userCode = trim($_POST['code']);
    $userCode = preg_replace("/[^0-9]/", "", $userCode);
    $verificationCode = $_SESSION['verificationCode'];
    if ($userCode === $verificationCode) {
        header("Location: set-new-password.php");
        unset($_SESSION['verificationCode']);
    } else {
        $_SESSION['error_message'] = "Неверный код. Пожалуйста, введите правильный 4-значный код.";
        header("Location: enter-verification-code.php");
    }
}
?>