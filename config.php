<?php
header('Content-Type: text/html; charset=utf-8');

/* API文档所在目录 */
define('__API__', '../mapi');
/* web名称 */
define('__NAV_TITLE__', 'mapi');
/* 网站部署的网址 */
define('__DOMAIN__', 'http://' . $_SERVER['HTTP_HOST'] . '/doc');
/* 是否开启登陆验证 */
define('__AUTH__', false);

/**
 * 用户列表
 *
 * 用于控制用户登录
 * '用户名' => '密匙'
 */
$UserInfo = array(
    'test'  => 'key'
);