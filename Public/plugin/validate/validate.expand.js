jQuery.validator.addMethod("isUserName", function(value, element) {
    return /^[a-zA-Z0-9_]{3,16}$/.test(value);
}, "用户名必须在3-16个字符之间,用户名可以使用 [数字+大小写字母+下划线]");
jQuery.validator.addMethod('isCn', function(value, element) {
    var reg = /^[\u4E00-\u9FA5]+$/;
    return reg.test(value);
}, '只允许输入中文'),
jQuery.validator.addMethod('isPassword', function(value, element) {
    var reg = /^[\@A-Za-z0-9_\!\#\$\%\^\&\*\.\~]{6,22}$/;
    return this.optional(element) || reg.test(value);
}, '密码必须是 大小写字母数字 符号(~!@#$%^&*._) 6-22位');
jQuery.validator.addMethod('isPhone', function(value, element) {
    var reg = /^[1]([3][0-9]{1}|50|51|52|53|55|56|57|58|59|70|76|77|78|80|81|82|83|84|85|86|87|88|89)[0-9]{8}$/;
    return this.optional(element) || reg.test(value);
}, '请输入正确的手机号');