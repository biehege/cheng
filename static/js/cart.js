$(function () {
    $('.del.btn').click(function () {
        var that = $(this);
        var entry = that.parents('.product-entry');
        var id = entry.data('id');
        $.get(
            '/cart', 
            {
                a: 'del',
                id: id
            },
            function () {
                entry.hide();
            });
    });
});
