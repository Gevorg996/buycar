<?php
include 'database-connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['author_name']) && isset($_POST['publication_text'])) {
    $author_name = substr($_POST['author_name'], 0, 50); 
    $publication_text = substr($_POST['publication_text'], 0, 2000);
    
    if (preg_match('/^[\p{L}0-9\s.,!?()-]+$/u', $publication_text)) {
        $stmt = $conn->prepare("INSERT INTO Publications (author_username, text) VALUES (?, ?)");
        $stmt->bind_param("ss", $author_name, $publication_text);
        $stmt->execute();
        $stmt->close();
    } else {
        echo "Недопустимые символы в тексте публикации.";
    }
}
?>
