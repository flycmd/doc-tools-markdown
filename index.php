<?php
/* 导入头文件 */
require_once('header.php');
require_once('Library/Parsedown/Parsedown.php');

/* ------------------------------------- 以下 为正式代码 --------------------------------------- */

if (isLogin()) {// 已登陆
    // 接收参数
    $class = htmlspecialchars($_GET['class']);
    $file  = htmlspecialchars($_GET['file']);

    /* 获取目录数据 */
    if ($class) {
        $menus = getFile(__API__.'/'.$class);
        if ($menus) {
            asort($menus);
        }
        $menus = $menus ?  : $menus;
    }
    // 获取一级目录
    else {
        $directory = getDir(__API__);
        $menus = array();
        if ($directory) {
            asort($directory);
            foreach ($directory as $k => $v) {
                $file = getFile(__API__.'/'.$v);
                $menus[$k]['num'] = count($file);
                $menus[$k]['name'] = $v;
            }
        }
        else {
            $menus = $directory;
        }
    }

    /* 读取解析文档内容 */
    if ($file) {
        $file_name    = __API__.'/'.$class.'/'.$file;
        $content = readFileText($file_name);
        $content = $content ? Parsedown::instance()->parse($content) : $content;
    }
    else {
        $content = '';
    }
}
else {// 未登录
    $menus    = '';
    $content = '';
}
/* ------------------------------------- 以上 为正式代码 --------------------------------------- */
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>文档</title>

    <!-- reset css -->
    <link rel="stylesheet" href="Public/css/reset.css">

    <!-- base css -->
    <link rel="stylesheet" href="Public/css/base.css">

    <!-- font awesome -->
    <link rel="stylesheet" href="Public/plugin/font-awesome-4.4.0/css/font-awesome.min.css">

    <!-- load css -->
    <link rel="stylesheet" href="Public/css/loaders.css">

    <!-- 主样式表 -->
    <link rel="stylesheet" href="Public/css/main.css">

    <!-- markdown css -->
    <link rel="stylesheet" href="Public/css/markdown/black-markdown.css">

    <!-- login css -->
    <link rel="stylesheet" href="Public/css/login.css">

    <!-- docs-sidenav css -->
    <link rel="stylesheet" href="Public/css/docs-sidenav.css">

    <!-- highlight 代码高亮 -->
    <link rel="stylesheet" href="Public/plugin/highlight/styles/ir-black.css">

    <!-- 滚动条 -->
    <link rel="stylesheet" href="Public/plugin/custom-scrollbar/jquery.mCustomScrollbar.css">
</head>
<body>
    <div id="nav" class="mCS-autoHide">
        <!-- 面包屑 -->
        <?php
            if ($class) {
        ?>
        <div class="crumbs" title="<?php echo $class;?>">
            <a href="<?php echo __DOMAIN__?>"><i class="fa fa-angle-left"></i> <?php echo $class;?></a>
        </div>
        <?php
            }
            else {
        ?>
        <div class="crumbs">
            <a href="javascript:;"><?php echo __NAV_TITLE__;?></a>
        </div>
        <?php
            }
        ?>

        <!-- 导航 -->
        <ul>
            <?php
                if ($menus) {
                    // 文件
                    if ($class) {
                        foreach ($menus as $k => $v) {
                            if ($file == $v) {
                                echo '<li class="active"><a href="?class='.$class.'&file='.$v.'" title="'.$v.'"> <i class="fa fa-file-o"></i>&nbsp;&nbsp;'.$v.'</a></li>';
                            }
                            else {
                                echo '<li><a href="?class='.$class.'&file='.$v.'" title="'.$v.'"> <i class="fa fa-file-o"></i>&nbsp;&nbsp;'.$v.'</a></li>';
                            }
                        }
                    }
                    // 目录
                    else {
                        foreach ($menus as $k => $v) {
                            echo '<li><a href="?class='.$v['name'].'" title="'.$v['name'].'">'.'<i class="count">('.$v['num'].')</i>'.$v['name'].'</a></li>';
                        }
                    }
                }
            ?>
        </ul>
    </div>

    <div id="container" class="mCS-autoHide clearfix">
        <!-- 内容区域 -->
        <div class="article">
            <?php
                echo $content;
            ?>
        </div>
    </div>

    <!-- 登陆 -->
    <div class="login-mask" style="opacity: 0.8; display: none;"></div>
    <div id="login-alert" style="top: -248px;display: none;">
        <div class="login-alert-form">
            <div>是不是很丑，我就是不改，你咬我啊 - ^ -</div>
            <form action="login.php" method="POST">
                <input type="text" name="username" placeholder="用户名">
                <input type="password" name="password" placeholder="密码">
                <button type="submit" class="login-btn">登陆</button>
            </form>
        </div>
        <div class="login-alert-load hidden">
            <div class="loader-inner pacman" style="width: 100px;margin: 0px auto;">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>

    <!-- 文档导航 -->
    <div id="docs-sidenav">
        <ul>
            <!-- 通过js生成列表 -->
            <!-- <li><a href="#">a</a></li> -->
        </ul>
    </div><!-- /#docs-sidenav -->

    <!-- jquery -->
    <script src="Public/js/jquery-1.11.3.js"></script>

    <!-- jQuery Validation plugin javascript-->
    <script src="Public/plugin/validate/jquery.validate.min.js"></script>

    <!-- base.js -->
    <script src="Public/js/base.js"></script>

    <!-- login -->
    <script src="Public/js/login.js"></script>

    <!-- docs-sidenav -->
    <script src="Public/js/docs-sidenav.js"></script>

    <!-- highlight -->
    <script src="Public/plugin/highlight/highlight.pack.js"></script>
    <script>
        /* 代码高亮 */
        hljs.initHighlightingOnLoad();
    </script>

    <!-- 滚动条 -->
    <script src="Public/plugin/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="Public/plugin/custom-scrollbar/jquery.mCustomScrollbar.js"></script>
    <script type='text/javascript'>
        (function($){
            $(window).load(function(){
                $("#nav").mCustomScrollbar({
                    scrollButtons:{
                        enable:false,
                        scrollType:"continuous",
                        scrollSpeed:40,
                        scrollAmount:40
                    },
                    horizontalScroll:false,
                });
                $('#container').mCustomScrollbar({
                    scrollButtons:{
                        enable:false,
                        scrollType:"continuous",
                        scrollSpeed:40,
                        scrollAmount:60
                    },
                    horizontalScroll:false,
                });
            });
        })(jQuery);
    </script>

    <!-- config -->
    <script>
        var _config = {
            'domain': "<?php echo __DOMAIN__;?>",
            'is_login': "<?php echo isLogin() ? 1 : 0;?>"
        }
    </script>
</body>
</html>