<?php
session_start();

require 'vendor/autoload.php';

require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require 'vendor/phpmailer/phpmailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    echo $email;
    if ($email) {
        $verificationCode = sprintf("%04d", mt_rand(0, 9999));
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'SMTP.mail.ru';
        $mail->SMTPAuth = true;
        $mail->Username = 'infobuycar@mail.ru';
        $mail->Password = 'gaMCnyiYR6r75SnBkNU7';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('infobuycar@mail.ru', 'buycar.am');
        $mail->addAddress($email);

        $mail->Subject = 'Восстановление пароля';
        $mail->Body = 'Ваш 4-значный код для восстановления пароля: ' . $verificationCode;

        try {
            $mail->send();
            $_SESSION['userEmail'] = $email;
            $_SESSION['verificationCode'] = $verificationCode;
            header('Location: enter-verification-code.php');
            exit;
        } catch (Exception $e) {
            echo 'Mailer Error: ' . $e->getMessage();
        }
    } else {
        echo 'Неправильный формат email адреса.';
    }
}
?>
