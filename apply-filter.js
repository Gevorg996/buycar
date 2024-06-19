$(document).ready(function () {
$("#filter").submit(function (e) {
    e.preventDefault();
    let formData = {
        filterBrand: $("#filterBrand").val(),
        filterModel: $("#filterModel").val(),
        filterYearMin: $("#filterYearMin").val(),
        filterYearMax: $("#filterYearMax").val(),
        filterMileageMin: $("#filterMileageMin").val(),
        filterMileageMax: $("#filterMileageMax").val(),
        filterPriceMin: $("#filterPriceMin").val(),
        filterPriceMax: $("#filterPriceMax").val(),
        filterTransmission: $("#filterTransmission").val(),
        filterFuelType: $("#filterFuelType").val(),
        filterColor: $("#filterColor").val(),
        filterRegion: $("#filterRegion").val()
    };
    $.ajax({
        type: "POST",
        url: "apply-filter.php",
        data: formData,
        dataType: "html",
        success: function (response) {
            $("#adList").html(response);
        },
        error: function (xhr, status, error) {
        }
    });
});
});