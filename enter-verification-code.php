<?php
session_start();
$title = "Восстановление пароля";
$headerCss = "styles/site-header.css";
$footerCss = "styles/site-footer.css";
$css = "styles/forgot-password.css";
include "site-header.php";
?>
<div class="container">
<h1>Восстановление пароля</h1>
<?php
if (isset($_SESSION['error_message'])) {
    echo '<p class="error-message">' . $_SESSION['error_message'] . '</p>';
    unset($_SESSION['error_message']);
}
?>
<form method="post" action="verify-code.php" id="code">
    <label for="code">Введите 4-значный код, отправленный на ваш email:</label>
    <input type="text" id="codeinp" name="code" required pattern="\d{4}" title="Введите 4-значный код"><br><br>
    <button type="submit" id="submitCodeButton">Подтвердить код</button><br><br>
</form>
</div>
<?php include "site-footer.php"; ?>