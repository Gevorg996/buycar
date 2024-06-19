<?php 
$title = "Комментарии";
$css = "styles/publications.css";
$headerCss = "styles/site-header.css";
$footerCss = "styles/site-footer.css";
include "site-header.php";
?>

<div class="container">
    <h2>Напишите свою публикацию:</h2>
    <form id="publicationForm" action="publish.php" method="post">
        <input type="text" id="authorName" name="author_name" placeholder="Ваше имя (не более 50 символов)" maxlength="50">
        <textarea id="publicationText" name="publication_text" rows="5" cols="50" placeholder="Текст публикации (не более 2000 символов)"></textarea>
        <br>
        <button type="submit">Опубликовать</button>
    </form>
</div>

<div class="container">
    <h2>Публикации:</h2>
    <div id="publications"></div>
</div>


<script src="js/jquery.js"></script>
<script src="js/publications.js"></script>

<?php include "site-footer.php"; ?>