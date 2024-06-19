<?php
include 'database-connection.php';

$sql = "SELECT * FROM Publications ORDER BY publication_datetime DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='publication'>";
        echo "<p><span class='author-name'>" . ($row["author_username"] ? htmlspecialchars($row["author_username"]) : "Анонимный пользователь") . "</span>: " . htmlspecialchars($row["text"]) . "</p>";
        echo "<small class='publication-datetime'>" . $row["publication_datetime"] . "</small>";
        echo "</div>";
    }
} else {
    echo "Публикаций пока нет.";
}
$conn->close();
?>
