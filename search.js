$(document).ready(function () {
    $('#search_make').on('input', function () {
        let input, filter, select, option, i, txtValue;
        input = $(this).val().toUpperCase();
        select = $('#car_make');
        option = select.find('option');

        for (i = 0; i < option.length; i++) {
            txtValue = option[i].text || option[i].innerText;
            if (txtValue.toUpperCase().indexOf(input) > -1) {
                option[i].style.display = "";
            } else {
                option[i].style.display = "none";
            }
        }
    });
});
