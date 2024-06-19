<?php
session_start(); 
$title = "продажа покупка аренда автомобилей мотоциклов";
$css = "styles/home.css";
$headerCss = "styles/site-header.css";
$footerCss = "styles/site-footer.css";
include "site-header.php";
include "database-connection.php";
?>
<main>
    <div class="block">
        <img src="images/laptop.webp" alt="laptop.webp">
        <div class="text">
            Мы гарантируем безопасность ваших данных. Ваши личные сведения находятся под надежной защитой.
        </div>
    </div>
    <div class="block">
        <div class="text">
            Наше сообщество - это место, где каждый может чувствовать себя как дома. Мы ценим каждого участника и стремимся создать дружественную обстановку.
        </div>
        <img src="images/people.webp" alt="people.webp">
    </div>
    <div class="block">
        <img src="images/tesla.webp" alt="tesla.webp">
        <div class="text">
            BuyCar.am - ваш шанс продать свой автомобиль быстро и без хлопот. Присоединяйтесь к нам!
        </div>
    </div>
    <div class="block">
        <div class="text">
            Приобретайте автомобиль напрямую от владельца без посредников на BuyCar.am, обеспечивая прозрачность и выгодные условия сделки.
        </div>
        <img src="images/porsche.webp" alt="porsche.webp">
    </div>
    <div class="block">
        <img src="images/truck.webp" alt="truck.webp">
        <div class="text">
            Используя платформу BuyCar.am, вы можете легко сдать свой автомобиль в аренду, воспользовавшись выгодными условиями и удобством процесса.
        </div>
    </div>
    <div class="block">
        <div class="text">
            Почувствуйте абсолютную свободу передвижения, взяв автомобиль в аренду на BuyCar.am. Насладитесь комфортом и безопасностью без лишних забот.
        </div>
        <img src="images/mercedes.webp" alt="mercedes.webp">
    </div>
</main>

<button id="filter-section-button">Показать фильтры</button>
<div id="filter-section" class="hidden">
<form method="post" id="filter" class="filter">
    <label for="filterBrand">Марка:</label>
    <input type="text" id="searchBrand" placeholder="Поиск марки автомобиля">
    <select id="filterBrand">
        <option value="Все марки">Все марки</option>
        <?php
        $sql = "SELECT * FROM brand";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['brandName'] . '">' . $row['brandName'] . '</option>';
            }
        }
        ?>
    </select>
<label for="filterModel">Модель:</label>
    <select id="filterModel">
        <option value="Все модели">Все модели</option>
    </select>
    <label for="filterYearMin">Год выпуска (от):</label>
    <select id="filterYearMin">
        <option value="Все">Все</option>
        <?php
        for ($year=2023; $year>=1900; $year--) { 
            echo "<option value='$year'>$year год</option>";
        }
        ?>
    </select>
    <label for="filterYearMax">Год выпуска (до):</label>
    <select id="filterYearMax">
        <option value="Все">Все</option>
        <?php
        for ($year=2023; $year>=1900; $year--) { 
            echo "<option value='$year'>$year год</option>";
        }
        ?>
    </select>
    <label for="filterMileageMin">Пробег (от):</label>
    <select id="filterMileageMin">
        <option value="Все">Все</option>
        <?php
        for ($value = 0; $value <= 500000; $value += 10000) {
            echo "<option value='$value'>$value км</option>";
        }
        ?>
    </select>
    <label for="filterMileageMax">Пробег (до):</label>
    <select id="filterMileageMax">
        <option value="Все">Все</option>
        <?php
        for ($value = 0; $value <= 500000; $value += 10000) {
            echo "<option value='$value'>$value км</option>";
        }
        ?>
    </select>
    <label for="filterPriceMin">Цена (от):</label>
    <select id="filterPriceMin">
        <option value="Все">Все</option>
        <?php
        for ($value = 0; $value <= 500000; $value += 10000) {
            echo "<option value='$value'>$value $</option>";
        }
        ?>
    </select>
    <label for="filterPriceMax">Цена (до):</label>
    <select id="filterPriceMax">
        <option value="Все">Все</option>
        <?php
        for ($value = 0; $value <= 500000; $value += 10000) {
            echo "<option value='$value'>$value $</option>";
        }
        ?>
    </select>
    <label for="filterTransmission">Коробка передач:</label>
    <select id="filterTransmission">
        <option value="Любой">Любой</option>
        <option value="Механическая">Механическая</option>
        <option value="Автоматическая">Автоматическая</option>
        <option value="Роботизированная">Роботизированная</option>
        <option value="Вариативная">Вариативная</option>
    </select>
    <label for="filterFuelType">Тип топлива:</label>
    <select id="filterFuelType">
        <option value="Любой">Любой</option>
        <option value="Бензиновый">Бензиновый</option>
        <option value="Дизельный">Дизельный</option>
        <option value="Гибридный">Гибридный</option>
        <option value="Электрический">Электрический</option>
    </select>
    <label for="filterColor">Цвет:</label>
    <select id="filterColor">
        <option value="Все">Все</option>
        <option value="Белый">Белый</option>
        <option value="Черный">Черный</option>
        <option value="Серый">Серый</option>
        <option value="Синий">Синий</option>
        <option value="Красный">Красный</option>
        <option value="Желтый">Желтый</option>
        <option value="Зеленый">Зеленый</option>
        <option value="Оранжевый">Оранжевый</option>
        <option value="Фиолетовый">Фиолетовый</option>
        <option value="Коричневый">Коричневый</option>
        <option value="Бежевый">Бежевый</option>
        <option value="Бордовый">Бордовый</option>
        <option value="Розовый">Розовый</option>
        <option value="Серебряный">Серебряный</option>
    </select>
    <label for="filterRegion">Регион:</label>
    <select id="filterRegion">
        <option value="Любой">Любой</option>
        <option value="Вне Армении">Вне Армении</option>
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
    </select>
    <button type="submit">Фильтровать</button>
</form>
</div>
<div class="car-list" id="adList">
<?php
$sql = "SELECT * FROM products ORDER BY productTime DESC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo '<div class="car-container">';
    while ($row = $result->fetch_assoc()) {
    $imageNames = explode(',', $row['productImage']);
    $firstImageName = trim($imageNames[0]);
    $defaultImage = 'images/default_image.webp';
    echo '<a href="post-page.php?product_id=' . $row['productId'] . '" class="car-link">';
    echo '<div class="car">';
    echo '<div class="car-image-container">';
    echo '<img class="car-image" src="' . (empty($firstImageName) ? $defaultImage : $firstImageName) . '" alt="' . $row['productTitle'] . '">';
    echo '</div>';
    echo '<div class="car-details">';
    echo '<p class="car-title">' . $row['productTitle'] . '</p>';
    echo '<p class="car-year">Год: ' . $row['productYear'] . '</p>';
    echo '<p class="car-price">Цена: <span class="price-number">' . $row['productPrice']. " " . $row['productCurrency'] . '</span></p>';
    echo '</div>';
    echo '</div>';
    echo '</a>';
}
    echo '</div>';
} else {
    echo '<p class="no-cars-message">Нет доступных объявлений.</p>';
}
$conn->close();
?>
</div>
<?php include 'site-footer.php'; ?>
<script src="js/jquery.js"></script>
<script src="js/buycar.min.js"></script>
<script src="js/apply-filter.min.js"></script>
<script src="js/filter-search.min.js"></script>
<script src="js/home.js"></script>
</body>
</html>

