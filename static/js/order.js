
$(function () {

    // 不是我啰嗦，这些get_xxx_div的操作真的可以抽象出来

    $('.price-detail-btn').click(function () {
        var id = $(this).parents('.entry').data('id');
        $.get(
            '/order',
            {
                action: 'get_price_detail_div',
                target: id
            },
            function (ret) {
                $$.appendDiv.show(ret);
            });
    });

    // 修改订单信息
    $('.edit-info-btn').click(function () {
        var that = $(this);
        var id = that.parents('.entry').data('id');
        $.get(
            '/order/' + id,
            {
                a: 'get_info_div'
            },
            function (ret) {
                var appendDiv = $(ret);
                $('.append-parent').append(appendDiv).show();
                appendDiv.show();
                window.refreshAppendDiv();
            });
    });

    // 订单推进
    $('.next-btn').click(function () {
        var that = $(this);
        var id = that.parents('.entry').data('id');
        $.get(
            '/order',
            {
                action: 'get_action_div',
                target: id
            },
            function (ret) {
                $$.appendDiv.show(ret);
            }, 'html');
    });

    // 选择工厂 弹出框
    $('.choose-factory-btn').click(function () {
        var id = $(this).parents('.entry').data('id');
        $.get(
            '/order',
            {
                action: 'get_factory_div',
                target: id
            },
            function (ret) {
                $$.appendDiv.show(ret);
            });
    });

    // 价格计算
    $('.price-change-btn').click(function () {
        var that = $(this);
        var id = that.parents('.entry').data('id');
        $.get(
            '/order/' + id,
            {
                a: 'get_price_div',
                title: that.data('title'),
                type: that.data('type')
            },
            function (ret) {
                var appendDiv = $(ret);
                $('.append-parent').append(appendDiv).show();
                appendDiv.show();
                window.refreshAppendDiv();

            }, 'html');
    });

    // 客户已付
    $('.pay-btn').click(function () {
        var that = $(this);
        var id = that.parents('.entry').data('id');
        $.get(
            '/order/' + id,
            {
                a: 'get_pay_div'
            },
            function (ret) {
                var appendDiv = $(ret);
                $('.append-parent').append(appendDiv).show();
                appendDiv.show();
                window.refreshAppendDiv();
            });
    });

    // 填写主石
    $('.stone-btn').click(function () {
        var id = $(this).parents('.entry').data('id');
        $.get(
            '/order',
            {
                action: 'get_stone_div',
                target: id
            },
            function (ret) {
                $$.appendDiv.show(ret);
            }, 'html');
    });
});
