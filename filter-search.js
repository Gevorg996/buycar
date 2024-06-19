let delayTimer;
$(document).ready(function () {
    $('#searchBrand').on('input', function () {
        clearTimeout(delayTimer);
        delayTimer = setTimeout(function () {
            let input, filter, select, option, i, txtValue;
            input = $(this).val().toUpperCase();
            select = $('#filterBrand');
            option = select.find('option');
            if (/^[a-zA-Z]+$/.test(input)) {
                for (i = 0; i < option.length; i++) {
                    txtValue = option[i].text || option[i].innerText;
                    if (txtValue.toUpperCase().indexOf(input) > -1) {
                        option[i].style.display = "";
                    } else {
                        option[i].style.display = "none";
                    }
                }
            }
        }.bind(this), 500);
    });
});
