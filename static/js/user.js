
$(function () {
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
});
