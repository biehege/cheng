/* 
 * by xc
 */

 var d = function (arg) {
    console.log(arg);
 };

$(function () {

    // 附加层的关闭按钮
    var appendParent = $('.append-parent');
    var refreshAllAppendDivFunc = function () {
        
        // 表单验证
        var forms = $('.append-div form');
        if (forms.validate)
            forms.validate();

        appendParent.find('.close-btn').click(function () {
            $(this).parents('.append-div').hide().parents('.append-parent').hide();
        });
    };
    window.refreshAppendDiv = refreshAllAppendDivFunc;

    var xcjsLib = {
        appendDiv: {
            refreshAll: refreshAllAppendDivFunc,
            show: function (arg) {
                var argIsHtml = 1;
                if (argIsHtml) {
                    var html = arg;
                    var div = this.add(html);
                    div.show();
                    appendParent.show();
                }
            },
            add: function (html) {
                var div = $(html);
                appendParent.append(div);
                this.refreshAll();
                return div;
            }
        }
    };
    window.$$ = xcjsLib;

    $$.appendDiv.refreshAll();

});
