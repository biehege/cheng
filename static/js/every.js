/* 
 * by xc
 */

 var d = function (arg) {
    console.log(arg);
 };

// 表单验证
$.validator.addClassRules({
    qq: {
        digits: true,
        minlength: 5,
        maxlength: 9
    },
    phone: {
        minlength: 6,
        maxlength: 15
    }
});

$(function () {

    
    // 附加层的关闭按钮
    window.refreshAppendDiv = function () {
        $('.append-div .close-btn').click(function () {
            $(this).parents('.append-div').hide().parents('.append-parent').hide();
        });
    };
    window.refreshAppendDiv();
    
});
