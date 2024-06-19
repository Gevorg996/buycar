$(document).ready(function () {
    let carMakeSelect = $("#car_make");
    let carModelSelect = $("#car_model");
    carMakeSelect.on("change", function () {
        let selectedBrand = carMakeSelect.val();
        carModelSelect.empty();
        let formData = { brand: selectedBrand };
        $.ajax({
            type: "POST",
            url: "post-controller.php",
            data: formData,
            dataType: "json",
            success: function (data) {
                $.each(data, function (index, model) {
                    carModelSelect.append($('<option>', {
                        value: model.modelName,
                        text: model.modelName
                    }));
                });
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", error);
            }
        });
    });
});