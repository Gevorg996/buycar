<?php
session_start();
$title = "Моя страница";
$css = "styles/view-page.css";
$headerCss = "styles/site-header.css";
$footerCss = "styles/site-footer.css";
include "site-header.php";
include "database-connection.php";
include "user-auth.php";
function getUserData($conn, $userId) {
    $sql = "SELECT * FROM users WHERE userId = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $userResult = $stmt->get_result();
        $stmt->close();

        if ($userResult->num_rows > 0) {
            return $userResult->fetch_assoc();
        }
    }
    return null;
}
function getUserListings($conn, $userId) {
    $sql = "SELECT * FROM products WHERE userId = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    return [];
}
if (isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];
    $userData = getUserData($conn, $userId);
    if ($userData) {
        $userName = $userData['userName'];
        $userEmail = $userData['userEmail'];
        $userPhone = $userData['userPhone'];
    }
}
?>
<div class="profile-container">
<div class="left-section">
    <div class="personal-info">
        <h1><?= htmlspecialchars($userName); ?></h1>
        <p>Почта: <?= htmlspecialchars($userEmail); ?></p>
        <p>Телефон: <?= htmlspecialchars($userPhone); ?></p>
        <a class="favorite-link" href="my-favorite-ads.php"><h3>Избранные Объявления</h3></a>
    </div>
    <div class="my-listings">
        <h2>Мои объявления</h2>
        <?php
        if (isset($_SESSION['userId'])) {
            $userId = $_SESSION['userId'];
            $listings = getUserListings($conn, $userId);
            if (!empty($listings)) {
                echo '<div class="my-container">';
                foreach ($listings as $row) {
                    $imageNames = explode(',', $row['productImage']);
                    $firstImageName = trim($imageNames[0]);
                    $defaultImage = 'images/default_image.webp';
                    echo '<a href="post-page.php?product_id=' . $row['productId'] . '" class="my-link">';
                    echo '<div class="my">';
                    echo '<div class="my-image-container">';
                    echo '<img class="my-image" src="' . (empty($firstImageName) ? $defaultImage : $firstImageName) . '" alt="' . htmlspecialchars($row['productTitle']) . '">';
                    echo '</div>';
                    echo '<div class="my-details">';
                    echo '<h2 class="my-title">' . htmlspecialchars($row['productTitle']) . '</h2>';
                    echo '<p class="my-price">$' . htmlspecialchars($row['productPrice']) . '</p>';
                    echo '<p class="my-year">' . htmlspecialchars($row['productYear']) . '</p>';
                    echo '<a href="delete-ad.php?product_id=' . $row['productId'] . '" class="delete-button">Удалить</a>';
                    echo '<a href="update-data.php?product_id=' . $row['productId'] . '" class="update-button">Обновить</a>';
                    echo '<a href="update-info.php?product_id=' . $row['productId'] . '" class="update-button">Отредактировать</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</a>';
                }
                echo '</div>';
            } else {
                echo '<p class="no-my-message">Нет доступных объявлений.</p>';
            }
        } else {
            header("Location: user-login.php");
            exit;
        }
        ?>
    </div>
</div>
</div>
<?php include 'site-footer.php'; ?>
</body>
</html>