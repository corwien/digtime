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
