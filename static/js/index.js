$(function () {
    $('.post form').sentencePoster();

    // 材质选择按钮
    $('.type-selector li').click(function () {
        var that = $(this);
        that.addClass('on').parent().data('selected-id', that.data('id'));
    });

    // 刻字的确认按钮
    $('.carve').each(function () {
        var carve = $(this);
        carve.find('.ok-btn').click(function () {
            var that = $(this);
            var text = carve.find('input').val();
            console.log(text);
            if (text) {
                carve.find('.text').text(text);
            }
        });
    });
    
});
