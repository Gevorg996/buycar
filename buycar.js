$(document).ready(function () {
const filterButton = document.getElementById('filter-section-button');
const filterSection = document.getElementById('filter-section');
function toggleButtonText() {
    if (filterSection.classList.contains('hidden')) {
        filterButton.textContent = 'Показать фильтры';
    } else {
        filterButton.textContent = 'Скрыть фильтры';
    }
}
filterButton.addEventListener('click', () => {
    if (filterSection.classList.contains('hidden')) {
        filterSection.style.display = 'block';
        setTimeout(() => {
            filterSection.style.opacity = '1';
            filterSection.style.transform = 'scale(1)';
        }, 100);
        filterSection.classList.remove('hidden');
    } else {
        filterSection.style.opacity = '0';
        filterSection.style.transform = 'scale(0.8)';
        setTimeout(() => {
            filterSection.style.display = 'none';
        }, 500);
        filterSection.classList.add('hidden');
    }
toggleButtonText();
});
toggleButtonText();
let carMakeSelect = $("#filterBrand");
let carModelSelect = $("#filterModel");
carMakeSelect.on("change", function () {
    let selectedBrand = carMakeSelect.val();
    carModelSelect.empty();
    let formData = { brand: selectedBrand };
    $.ajax({
        type: "POST",
        url: "home-controller.php",
        data: formData,
        dataType: "json",
        success: function (data) {
        carModelSelect.empty();
        carModelSelect.append($('<option>', {
            value: 'Все модели',
            text: 'Все модели'
        }));
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