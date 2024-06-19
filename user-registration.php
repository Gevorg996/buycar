<?php
session_start();
$title = "Регистрация";
$css = "styles/user-registration.css";
$headerCss = "styles/site-header.css";
$footerCss = "styles/site-footer.css";
include "site-header.php";
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];
?>

<h1>Регистрация</h1>
<form id="registrationForm" method="post">
    <label for="name">Имя:</label>
    <input type="text" id="name" name="name" required><br><br>
    <label for="email">Почта (ваш логин):</label>
    <input type="email" id="email" name="email" required><br><br>
    <label for="password">Пароль:</label>
    <input type="password" id="password" name="password" required><br><br>
    <label for="repeatPassword">Повторите пароль:</label>
    <input type="password" id="repeatPassword" name="repeatPassword" required><br><br>
    <label for="phone">Номер телефона:</label>
    <input type="tel" id="phone" name="phone" placeholder="077000000" required><br><br>
    <input type="checkbox" id="acceptTerms" name="acceptTerms" required>
    <label for="acceptTerms">Я подтверждаю, что ознакомлен(а) с условиями использования в разделе <a href="about-us.php">информация о нас</a> и принимаю их.</label><br><br>
    <label for="captcha">Введите результат:</label>
    <span id="captcha-equation"></span>
    <input type="number" id="captcha" name="captcha" required inputmode="numeric"><br><br>
    <input type="hidden" id="csrf_token" name="csrf_token" value="<?php echo $csrf_token; ?>">
    <button type="submit">Зарегистрироваться</button><br><br>
    <div id="errorMessages" class="error-messages"></div>
</form>
<?php include 'site-footer.php'; ?>
<script src="js/jquery.js"></script>
<script src="js/user-registration.min.js"></script>
</body>
</html>