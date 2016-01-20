function loginFun () {
    /**
     * 未登录
     * 弹出登录窗口
     */
    if (_config.is_login != 1) {
        showLogin();
    };

    /* 表单验证 */
    var form = $('#login-alert form');
    $().ready(function () {
        form.validate({
            rules:{
                username: {
                    required: true
                },
                password:{
                    required: true
                }
            },
            messages:{
                username: {
                    required: '请输入用户名'
                },
                password:{
                    required: '请输入密码'
                }
            },
            submitHandler:function(){
                /*获取值*/
                var data = {};
                data['username'] = form.find('input[name=username]').val();
                data['password'] = form.find('input[name=password]').val();
                var post_url = form.attr('action');

                /*处理提交内容*/
                form.find('input[name=password]').val('');
                /*显示提交中的状态*/
                $('.login-alert-form').hide(),
                $('.login-alert-load').show();

                $.post(post_url, data, function(data) {
                    if (data.ret_code > 0) {
                        window.location.reload();
                    }
                    else {
                        alert(data.err_msg + '('+data.ret_code+')');
                        $('.login-alert-form').show(),
                        $('.login-alert-load').hide();
                    }
                }, 'json');
            }
        });
    });

    /**
     * 显示登陆窗口
     */
    function showLogin() {
        $("#login-alert").show(),
        $(".login-mask").fadeIn(500),
        $("#login-alert").animate({
            top: 0
        }, 600)
    }
}