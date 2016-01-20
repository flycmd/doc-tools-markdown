<?php
/**
 * -------------------------------------------------------------------------------------------------
 * ---------------------------------------- 基础函数 -----------------------------------------------
 * -------------------------------------------------------------------------------------------------
 */
/**
 * 获取文件后缀名
 * @param  string $filename 文件名
 * @return string
 */
function getFileExt($filename) {
    if (!$filename) {
        return $filename;
    }
    $extend = explode(".", $filename);
    $va = count($extend) - 1;
    return $extend[$va];
}

/**
 * 判断是否是linux操作系统
 * @return boolean
 */
function isWindows() {
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        /* windows */
        return TRUE;
    } else {
        /* 不是windows */
        return FALSE;
    }
}

/**
 * 输出JSON数据
 * @param  array $data 要输出的数据
 * @return json
 */
function ajaxReturn($data)
{
    $json = json_encode($data);
    die($json);
}

/**
 * 编码转换
 * @param  string $code_1 转换前的编码
 * @param  string $code_2 要转换的编码
 * @param  string $string 要转换的字符串
 * @return string
 */
function codeConv($code_1, $code_2, $string)
{
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {// linux不需要转换编码
        return iconv($code_1, $code_2, $string);
    }
    return $string;
}

/**
 * -------------------------------------------------------------------------------------------------
 * ---------------------------------------- 文档操作 -----------------------------------------------
 * -------------------------------------------------------------------------------------------------
 */

/**
 * 获取文件目录列表,该方法返回数组
 * @param  [type] $dir [description]
 * @return [type]      [description]
 */
function getDir($dir) {
    $dir = codeConv("UTF-8","gb2312", $dir);
    $dirArray = array();
    if (is_dir($dir) && false != ($handle = opendir ( $dir ))) {
        $i=0;
        while ( false !== ($file = readdir ( $handle )) ) {
            // 去掉"“.”、“..”以及带“.xxx”后缀的文件
            // 使用strpos拼装字符串是防止 . 出现在首位
            if (!strpos('-_-!!' . $file,".")) {
                $file = codeConv("gb2312","UTF-8", $file);
                $dirArray[$i]=$file;
                $i++;
            }
        }
        //关闭句柄
        closedir ( $handle );
    }
    return $dirArray;
}

/**
 * 获取文件列表
 * @param  [type] $dir [description]
 * @return [type]      [description]
 */
function getFile($dir) {
    $dir = codeConv("UTF-8","gb2312", $dir);
    $fileArray = array();
    if (is_dir($dir) && false != ($handle = opendir ( $dir ))) {
        $i=0;
        while ( false !== ($file = readdir ( $handle )) ) {
            //去掉"“.”、“..”以及带“.xxx”后缀的文件
            // 使用strpos拼装字符串是防止 . 出现在首位
            // 只读取后缀名为.md的文件
            if (getFileExt('-_-!!' . $file) === 'md') {
                $file = codeConv("gb2312","UTF-8", $file);
                $fileArray[$i] = $file;
                if($i == 100){
                    break;
                }
                $i++;
            }
        }
        //关闭句柄
        closedir ( $handle );
    }
    return $fileArray;
}

/**
 * 读取文件
 * @param  [type] $file [description]
 * @return [type]      [description]
 */
function readFileText($file) {
    // 只读取文件名为.md的文件
    if (getFileExt('-_-!!' . $file) === 'md') {
        $file = codeConv("UTF-8","gb2312", $file);
        if (file_exists($file)) {
            return file_get_contents($file);
        }
    }
    return false;
}

/**
 * -------------------------------------------------------------------------------------------------
 * ---------------------------------------- 用户操作 -----------------------------------------------
 * -------------------------------------------------------------------------------------------------
 */

/**
 * 是否登陆
 * @return boolean
 */
function isLogin()
{
    if (!__AUTH__) {
        return TRUE;
    }
    if ($_SESSION["username"]) {
        return TRUE;
    }
    return FALSE;
}