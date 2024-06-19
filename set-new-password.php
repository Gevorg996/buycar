<?php
session_start();
$title = "Восстановление пароля";
$css = "styles/set-new-password.css";
$headerCss = "styles/site-header.css";
$footerCss = "styles/site-footer.css"; 
include "site-header.php";
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    echo '<div class="error-container">';
    echo '<p class="error-message">' . $error . '</p>';
    echo '</div>';
    unset($_SESSION['error']);
}
?>
<div class="container">
<h1>Введите новый пароль</h1>
<form id="newPasswordForm" method="post" action="set-new-password-controller.php">    
    <label for="password">Пароль:</label>
    <input type="password" id="newPassword" name="newPassword" required><br><br>
    <label for="repeatPassword">Повторите пароль:</label>
    <input type="password" id="repeatNewPassword" name="repeatNewPassword" required><br><br>
    <button type="submit">Изменить</button><br><br>
</form>
</div>
<?php include "site-footer.php"; ?>