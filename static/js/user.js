
$(function () {

    // 展开详细信息
    $('.entry').click(function () {
        $(this).siblings('.more-info').toggle();
    });

    // 修改订单按钮
    $('.edit-btn').click(function () {
        var that = $(this);
        var cusId = that.parents('.entry').data('id');
        $.get(
            '/user/' + cusId,
            {
                a: 'get_edit_div'
            },
            function (ret) {
                var appendDiv = $(ret);
                $('.append-parent').append(appendDiv).show();
                appendDiv.show();
                window.refreshAppendDiv();
            });
    });

    // 表单验证
    $('form.add').validate();
});
