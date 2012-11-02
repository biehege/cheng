$(function () {
    $('.del.btn').click(function () {
        var that = $(this);
        var id = that.parents('.row').data('id');
        $.get(
            '/cart', 
            {
                a: 'del',
                id: id
            },
            function () {
                console.log('ok');
            });
    });
});
