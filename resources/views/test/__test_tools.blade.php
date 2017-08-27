<?php

/**
 * ---------------------------------
 * 调试系统-在线编辑器
 * ---------------------------------
 * @desc 如需使用该在线编辑器，则需要设置常量：define('runcode', 1);
 * @author Achao
 * @version 2017-07
 * ---------------------------------
 */

// 加载配置文件
define('IN_EB', true);

$text = $_REQUEST['text'] ? $_REQUEST['text'] : '';
preg_match("/define\('runcode', 1\);/", $text) && eval($text);
// if($text == '') $text = "define('runcode', 1);";

$str = <<<EOF
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
<title></title>

<style type="text/css">
body, button, input, select, textarea {
    font: 14px/1.5 tahoma, arial, 'Hiragino Sans GB', \\5b8b\\4f53, sans-serif;
}
textarea {
    padding: 10px;
}
</style>
</head>

<body>

<form action="" method="POST">
<textarea style="width:100%; height:500px; font-size:16px;" name="text">$text</textarea>
<div>
<input type="submit" value="执行程序" style="height:30px; width:150px; margin-top:5px;" />
<label style="margin-left:10px;">调试：<input type="checkbox" name="_debug" value="1" /></label>
<label style="margin-left:10px;">清缓存：<input type="checkbox" name="_no_cache" value="1" /></label>
<label style="margin-left:10px;">E_ALL：<input type="checkbox" name="_e_all" value="1" /></label>
<label style="margin-left:10px;">实时：<input type="checkbox" name="realtime" value="1" checked /></label>
</div>
</form>

</body>
</html>
EOF;

echo $str;
