$(function () {
    $('form').validate();
    $('form input[type=file]').change(function () {
        var form = $(this).parents('form');
        form.validate().cancelSubmit = true;
        form.submit();
    });
});
