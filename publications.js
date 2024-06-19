$(document).ready(function() {
    $.get('get_publications.php', function(data) {
        $('#publications').html(data);
    });

    $('#publicationForm').submit(function(event) {
        event.preventDefault();
        const form = $(this);
        
        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: form.serialize(),
            success: function(response) {
                $('#publications').prepend(response);
                form.trigger('reset');
            },
            error: function(xhr, textStatus, errorThrown) {
                console.error('Ошибка:', errorThrown);
            }
        });
    });
});
