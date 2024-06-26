$(document).ready(function() {
const form = $("#registrationForm");
const captchaResult = generateCaptcha();
form.on("submit", function(event) {
    event.preventDefault();
    const name = $("#name").val();
    const email = $("#email").val();
    const password = $("#password").val();
    const repeatPassword = $("#repeatPassword").val();
    const phone = $("#phone").val();
    const acceptTerms = $("#acceptTerms").prop("checked");
    const csrf_token = $("#csrf_token").val();
    const userAnswer = parseInt($("#captcha").val());
    clearErrors();
    if (!acceptTerms) {
        displayError("Вы должны принять условия использования.");
        return;
    }
    if (password !== repeatPassword) {
        displayError("Пароли не совпадают.");
        return;
    }
    if (!validateName(name)) {
        displayError("Введите корректное имя без пробелов. Допустимы только буквы");
        return;
    }
    if (!validateEmail(email)) {
        displayError("Введите корректный адрес почты.");
        return;
    }
    if (!validatePassword(password)) {
        displayError("Пароль должен содержать минимум 8 символов, хотя бы одну цифру и одну букву латинского алфавита.");
        return;
    }
    if (!validatePhone(phone)) {
        displayError("Введите корректный номер телефона (без пробелов и дефисов).");
        return;
    }
    if (userAnswer !== captchaResult) {
        displayError("Неправильный ответ на задачу.");
        return;
    }
    $.ajax({
        type: "POST",
        url: "registration-controller.php",
        data: {
            name: name,
            email: email,
            password: password,
            phone: phone,
            csrf_token: csrf_token
        },
        dataType: "json",
        success: function(result) {
            if (result.success) {
                if (result.redirect) {
                    window.location.href = result.redirect;
                } else {
                    alert("Регистрация успешно завершена!");
                }
            } else {
                displayError(result.message);
            }
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
});
function validateName(name) {
    name = name.trim();
    const namePattern = /^[A-Za-zА-Яа-яԱ-Ֆա-ֆև]+$/;
    return namePattern.test(name);
}
function validateEmail(email) {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(email);
}
function validatePassword(password) {
    const passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d!$%&*#=+\-.,_:\s]{8,}$/;
    return passwordPattern.test(password);
}
function validatePhone(phone) {
    const phonePattern = /^[0-9]\d{0,16}$/;
    return phonePattern.test(phone);
}
function generateCaptcha() {
    const num1 = Math.floor(Math.random() * 10);
    const num2 = Math.floor(Math.random() * 10);
    const result = num1 * num2;
    const captchaEquation = `...${num1}. .*. .${num2}. .=..?..`;
    $("#captcha-equation").text(captchaEquation);
    return result;
}
function clearErrors() {
    const errorContainer = document.getElementById("errorMessages");
    errorContainer.innerHTML = "";
}
function displayError(message) {
    const errorContainer = document.getElementById("errorMessages");
    const errorMessage = document.createElement("div");
    errorMessage.classList.add("error-message");
    errorMessage.textContent = message;
    errorContainer.appendChild(errorMessage);
}

});