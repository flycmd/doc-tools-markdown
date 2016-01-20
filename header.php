<?php
//启动session的初始化
session_start();

// 设置字符编码
header('Content-Type: text/html; charset=utf-8');

// 设置错误级别
error_reporting(E_ALL ^ E_NOTICE);

// 导入类库/函数/设置
require_once('function.php');
require_once('config.php');
