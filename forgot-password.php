<?php
session_start();
$title = "Восстановление пароля";
$css = "styles/forgot-password.css";
$headerCss = "styles/site-header.css";
$footerCss = "styles/site-footer.css";
include "site-header.php";
?>
<div class="container">
<h1>Восстановление пароля</h1>
<form id="forgotPasswordForm" method="post" action="send-password-email.php">
    <label for="email">Введите ваш email:</label>
    <input type="email" id="email" name="email" required><br><br>
    <button type="submit" id="sendEmail">Отправить</button><br><br>
</form>
</div>
<?php include "site-footer.php"; ?>