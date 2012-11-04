/* 
 * by xc
 */

 var d = function (arg) {
    console.log(arg);
 };

$(function () {
    
    // 附加层的关闭按钮
    $('.append-div .close-btn').click(function () {
        d('click');
        $(this).parents('.append-div').hide().parents('.append-parent').hide();
    });
});
