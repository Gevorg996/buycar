<?php
session_start();
$title = "добавить новое объявление";
$css = "styles/post-ad.css";
$headerCss = "styles/site-header.css";
$footerCss = "styles/site-footer.css";
include "site-header.php";
include "user-auth.php";
include "database-connection.php";
$query = "SELECT * FROM brand";
$result = mysqli_query($conn, $query);
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">
<form method="POST" action="" id="addSendForm" class="dropzone" enctype="multipart/form-data">
    <h2>Добавить новое объявление </h2>    
    <label for="sell_buy">Статус объявлений:</label>
    <select id="sell_buy" name="sell_buy" required>
        <option value="Продажа">Продажа</option>
        <option value="Аренда">Аренда</option>
        <option value="Покупка">Покупка</option>
    </select><br>
    <label for="marz">Регион:</label>
    <select id="marz" name="marz" required>
        <option value="" selected disabled>Выберите регион</option>
        <option value="Ереван">Ереван</option>
        <option value="Арагацотн">Арагацотн</option>
        <option value="Арарат">Арарат</option>
        <option value="Армавир">Армавир</option>
        <option value="Гегаракуник">Гегаракуник</option>
        <option value="Котайк">Котайк</option>
        <option value="Лори">Лори</option>
        <option value="Ширак">Ширак</option>
        <option value="Сюник">Сюник</option>
        <option value="Тавуш">Тавуш</option>
        <option value="Вайоц Дзор">Вайоц Дзор</option>
        <option value="Вне Армении">Вне Армении</option>
    </select><br>
    <label for="title">Заголовок:</label>
    <input type="text" id="title" name="title" placeholder="Максимально 50 символов" maxlength="50" required><br>
    <label for="car_make">Марка автомобиля:</label>
    <input type="text" id="search_make" placeholder="Поиск марки автомобиля">
    <select id="car_make" name="car_make" required>
        <option value="" selected disabled>Выберите марку автомобиля</option>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . htmlspecialchars($row['brandName']) . "'>" . htmlspecialchars($row['brandName']) . "</option>";
        }
        ?>
    </select><br>
    <label for="car_model">Модель автомобиля:</label>
    <select id="car_model" name="car_model" required></select><br>
    <label for="price">Цена:</label>
    <div class="input-group">
        <input type="number" id="price" name="price" required>
        <select id="currency" name="currency" required>
            <option value="USD">USD</option>
            <option value="AMD">AMD</option>
        </select>
    </div>    
    <label for="year">Год выпуска:</label>
    <select name="year" id="year" required>
        <?php
            for ($year=2024; $year>=1900; $year--) { 
                echo "<option value='$year'>$year</option>";
            }
        ?>
    </select><br>
    <label for="engine_type">Тип двигателя:</label>
    <select id="engine_type" name="engine_type" required>
        <option value="Бензиновый">Бензиновый</option>
        <option value="Дизельный">Дизельный</option>
        <option value="Гибридный">Гибридный</option>
        <option value="Электрический">Электрический</option>
    </select><br>
    <label for="engine_size">Объем двигателя:</label>
    <select id="engine_size" name="engine_size" required>
      <?php
      for ($i = 0.6; $i <= 8.5; $i += 0.1) {
        echo '<option value="' . number_format($i, 1) . '">' . number_format($i, 1) . '</option>';
      }
      ?>
    </select><br>    
    <label for="transmission">Трансмиссия:</label>
    <select id="transmission" name="transmission" required>
        <option value="Механическая">Механическая</option>
        <option value="Автоматическая">Автоматическая</option>
        <option value="Роботизированная">Роботизированная</option>
        <option value="Вариативная">Вариативная</option>
    </select><br>
    <label for="drive_type">Тип привода:</label>
    <select id="drive_type" name="drive_type" required>
        <option value="Передняя">Передняя</option>
        <option value="Задняя">Задняя</option>
        <option value="Полный привод">Полный привод</option>
    </select><br>
    <label for="km_mile">Пробег (км/миль):</label>
    <div class="measurement-block">
        <input type="number" id="km_mile" name="km_mile" required>
        <label for="unit_select"></label>
        <select id="unit_select" name="unit_select" required>
            <option value="КM">КM</option>
            <option value="Мил">Мил</option>
        </select>
    </div>
    <label for="steering_wheel">Руль:</label>
    <select id="steering_wheel" name="steering_wheel" required>
      <option value="Левый">Левый</option>
      <option value="Правый">Правый</option>
    </select><br>
     <label for="color">Цвет:</label>
    <select id="color" name="color" required>
      <option value="" selected disabled>Выберите цвет автомобиля</option>
      <option value="Белый">Белый</option>
      <option value="Черный">Черный</option>
      <option value="Серый">Серый</option>
      <option value="Серебристый">Серебристый</option>
      <option value="Синий">Синий</option>
      <option value="Красный">Красный</option>
      <option value="Желтый">Желтый</option>
      <option value="Зеленый">Зеленый</option>
      <option value="Оранжевый">Оранжевый</option>
      <option value="Фиолетовый">Фиолетовый</option>
      <option value="Коричневый">Коричневый</option>
      <option value="Бордовый">Бордовый</option>
      <option value="Бежевый">Бежевый</option>
      <option value="Розовый">Розовый</option>
    </select><br>
    <label for="description">Описание:</label>
    <textarea id="description" name="description" placeholder="макс 255" maxlength="255" required></textarea><br>
    <div class="fallback">
        <input name="file" type="file" multiple required />
    </div>
    <div id="error-message" style="color: red;"></div>
    <input type="submit" id="submit-button" value="Добавить объявление">
</form>
<?php include 'site-footer.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
<script>
Dropzone.options.addSendForm = {
    url: 'save-post.php',
    autoProcessQueue: false,
    uploadMultiple: true,
    parallelUploads: 10,
    maxFiles: 10,
    acceptedFiles: 'image/*',
    maxFilesize: 20,
    dictInvalidFileType: "Недопустимый тип файла",
    dictFileTooBig: "Файл слишком большой ({{filesize}} МБ). Максимальный размер: {{maxFilesize}} МБ",
    dictMaxFilesExceeded: "Вы не можете загрузить больше файлов",
    dictDefaultMessage: "<span style='color: white'>Перетащите изображения сюда или нажмите для выбора (до 10 штук)</span>",
    init: function() {
        let myDropzone = this;
        $('#submit-button').on("click", function(e) {
            e.preventDefault();
            let isValid = true;
            $('#addSendForm input[required], #addSendForm select[required], #addSendForm textarea[required]').each(function() {
                if (!$(this).val()) {
                    isValid = false;
                    $(this).addClass('invalid-field');
                } else {
                    $(this).removeClass('invalid-field');
                }
            });

            if (!isValid) {
                $('#error-message').text('Пожалуйста, заполните все обязательные поля.');
                return false;
            }

            myDropzone.processQueue();
        });
    },
    success: function(file, response) {
        window.location.href = 'index.php';
    },
    accept: function(file, done) {
        if (file.type !== 'image/jpeg' && file.type !== 'image/png' && file.type !== 'image/jpg' && file.type !== 'image/gif' && file.type !== 'image/heic' && file.type !== 'image/svg' && file.type !== 'image/webp') {
            done('Недопустимый формат изображения. Пожалуйста, выберите файл JPEG или PNG.');
        } else {
            done();
        }
    }
};
</script>
<script src="js/jquery.js"></script>
<script src="js/post-ad.min.js"></script>
<script src="js/search.min.js"></script>
</body>
</html>
