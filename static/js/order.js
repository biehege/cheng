$(function () {
    $('.next-btn').click(function () {
        var that = $(this);
        var action = that.data('action');
        var id = that.parents('entry').data('id');
        $.get(
            '/order',
            {
                a: action,
                id: id
            },
            function () {
                console.log('pk');
            });
    });
});
