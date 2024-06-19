$(document).ready(function() {
    $("#likeButton").click(function() {
        let productId = $(this).data("product-id");
        let userId = $(this).data("user-id");
        $.ajax({
            type: "POST",
            url: "favorite-ads-controller.php",
            data: { productId: productId, userId: userId },
            success: function(response) {
                let responseMessage = $("#responseMessage");
                if (response === "added") {
                    responseMessage.text("Добавлено в избранное!");
                } else if (response === "removed") {
                    responseMessage.text("Удалено из избранного!");
                } else if (response === "unauthorized") {
                    window.location.href = "user-login.php";
                } else {
                    responseMessage.text("Произошла ошибка.");
                }
            },
            error: function() {
                var responseMessage = $("#responseMessage");
                responseMessage.text("Произошла ошибка.");
            }
        });
    });
});