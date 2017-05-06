<?php


if(!function_exists('user')) {

    /**
     * @param null $driver
     *
     * @return mixed
     */
    function user($driver = null)
    {
        if($driver)
        {
            return app('auth')->guard($driver)->user();
        }

        return app('auth')->user();
    }
}

if(!function_exists('dump'))
{
    function dump($foo)
    {
        echo "<pre>";
        print_r($foo);
        echo "</pre>";
    }
}

if(!function_exists('strCut'))
{
    /**
     * 截取字符串
     * @param        $str
     * @param int    $length
     * @param string $suffix
     */
    function strCut($str, $length = 200, $suffix = '...')
    {
        if(empty($str)) return '';

        $str = trim($str);
        $str = str_replace(array('&nbsp;', '&#39;', '&quot;'), array(' ', "'", '"'), $str);
        $str = strip_tags($str);

        /*
        $mixed_arr = array(
            '/[\r\n]*?/' => '', //并为一行
            '/(<\/?br\s*?\\/?\s*?>){2,}/i' => '\1',
            '/(<br>\s*){2,}/' => '<br>',
            '/<[^>]*?$/ms' => '',
            '/\s+/' => '',
        );

        $pattern     = array_keys($mixed_arr);
        $replacement = array_values($mixed_arr);
        $str         = preg_replace($pattern, $replacement, $str);
        */

        // 截取字符串
        $strLength = strlen($str);
        if($strLength > $length)
        {
            $str = substr($str, 0, $length) . $suffix;
        }

        return $str;
    }
}
