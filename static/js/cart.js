$(function () {

    // 删除按钮 弹出面板
    $('.del.btn').click(function () {
        var that = $(this);
        that.siblings('.popup').show();
    });

    // 确认删除按钮
    $('.del .popup .ok-btn').click(function () {
        var entry = $(this).parents('.product-entry');
        var id = entry.data('id');
        $.get(
            '/cart', 
            {
                a: 'del',
                id: id
            },
            function (ret) {
                entry.remove();
                $('a.cart .count').text(ret);
            });
    });

    // 取消删除按钮
    $('.del .popup .cancel-btn').click(function () {
        $(this).parent().hide();
    });
});
