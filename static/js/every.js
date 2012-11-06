/* 
 * by xc
 */

 var d = function (arg) {
    console.log(arg);
 };

$(function () {
    
    // 附加层的关闭按钮
    window.refreshAppendDiv = function () {
        $('.append-div .close-btn').click(function () {
            $(this).parents('.append-div').hide().parents('.append-parent').hide();
        });
    };
    window.refreshAppendDiv();
    
});
