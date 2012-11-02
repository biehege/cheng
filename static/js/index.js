$(function () {
    $('.post form').sentencePoster();

    // 材质选择按钮
    var allMaterial = $('.type-selector li').click(function () {
        var that = $(this);
        allMaterial.removeClass('on');
        that.addClass('on').parent().data('selected', that.text());
    });

    // 刻字的确认按钮
    $('.carve').each(function () {
        var carve = $(this);
        carve.find('.ok-btn').click(function () {
            var that = $(this);
            var text = carve.find('input').val();
            console.log(text);
            if (text) {
                carve.find('.trigger').hide();
                carve.find('.text').text(text);
            }
        });
    });

    // 下订单
    $('.add.btn').click(function () {
        var that = $(this);
        var li = that.parents('li');
        var id = li.data('id');
        var material = li.find('.type-selector').data('selected');
        var size = li.find('input[name=size]').val();
        var carveText = li.find('.carve .text').text();
        if (!material) {
            alert('请选择材质');
            return;
        }
        if (!size) {
            alert('请填入手寸');
            return;
        }
        $.get(
            '/cart',
            {
                a: 'add',
                id: id,
                material: material,
                size: size,
                carveText: carveText
            },
            function (ret) {
                // 顶部的购物车+1
                $('.account .cart .count').text(ret);

                var already = li.find('.already');
                var numBox = already.find('.num');
                numBox.text(+numBox.text() + 1);
                already.show();
            });
        // clear for all???

    });
});
