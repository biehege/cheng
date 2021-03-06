
$(function () {

    // 多选框
    $('input[type=checkbox].group').widget('checkboxGroup')
        .not('.all').click(function() {
            var that = $(this);
            if (that.prop('checked'))
                that.parents('tr').data('selected', 1).css('color', 'red');
            else 
                that.parents('tr').data('selected', 0).css('color', 'black');
        });

    // 批量删除
    $('button.del').click(function () {
        var selectedRows = $('tr[data-id]').filter(function () {
            return $(this).data('selected');
        });
        var ids = JSON.stringify($.map(selectedRows, function (i) {
            return $(i).data('id');
        }));
        $.get(
            '/product',
            {
                a: 'del',
                ids: ids,
            },
            function () {
                selectedRows.remove();
            });
    });

    // 图片上传
    $('form.auto-load input[type=file]').change(function () {
        var form = $(this).parents('form.auto-load');
        form.validate().cancelSubmit = true;
        form.submit();
    });

    // 表单验证
    $('form.post').validate();
});
