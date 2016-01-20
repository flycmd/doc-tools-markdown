<?php
/* 导入头文件 */
require_once('header.php');
require_once('Library/GoogleAuthenticator/GoogleAuthenticator.php');

/**
 * 登陆处理
 */
$username = htmlspecialchars($_POST['username']);
$password = $_POST['password'];// 动态令牌码

// 参数不完整
if (!$username || !$password) {
    $result = array(
        'ret_code' => -1,
        'err_msg' => '参数错误'
        );
    ajaxReturn($result);
}

# 验证动态令牌
$ga = new PHPGangsta_GoogleAuthenticator();
$secret = $UserInfo[$username];
// 最后一个参数 为容差时间,这里是2 那么就是 2* 30 sec 一分钟.默认为1
$checkResult = $secret ? $ga->verifyCode($secret, $password, 1) : false;
if ($checkResult) {
    $_SESSION["username"] = $username;
    $result = array(
        'ret_code' => 1,
        'suc_msg' => '登陆成功'
        );
    ajaxReturn($result);

    /**
     * @todo  因为没有限制尝试次数，所以后期会发送进行登陆发送通知邮件给管理员和用户.
     */
} else {
    $result = array(
        'ret_code' => -1,
        'err_msg' => '用户名或密码错误,请检查后重试'
        );
    ajaxReturn($result);
}