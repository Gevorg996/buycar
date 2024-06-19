<?php
session_start();
$title = "Авторизация";
$css = "styles/user-login.css";
$headerCss = "styles/site-header.css";
$footerCss = "styles/site-footer.css";
include "site-header.php";
function generateCsrfTokenForLogin() {
    $token = bin2hex(random_bytes(32));
    $_SESSION['csrf_token_login'] = $token;
    return $token;
}
$errorMessage = isset($_SESSION['errorMessage']) ? $_SESSION['errorMessage'] : "";
unset($_SESSION['errorMessage']);
?>
<div class="site-content">
<div class="login-container">
    <h1>Авторизация</h1>
    <?php if (!empty($errorMessage)): ?>
    <p class="error-message"><?php echo $errorMessage; ?></p>
    <?php endif; ?>
    <form method="post" action="login-controller.php">
        <label for="username">Почта:</label>
        <input type="email" id="username" name="email" required>
        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required>
        <input type="hidden" name="csrf_token_login" value="<?php echo generateCsrfTokenForLogin(); ?>">
        <button type="submit">Авторизация</button><br><br>
        <a href="forgot-password.php">Забыли пароль?</a><br>
        <a href="user-registration.php">Зарегистрироваться</a>
    </form>
</div>    
</div>
<?php include 'site-footer.php'; ?>
</body>
</html>