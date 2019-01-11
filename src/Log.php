<?php
/**
 * 插件钩子类
 * ay@7cuu.com
 * 2017-11-24
 *
 */
namespace Ayflying\Log;

// 插件类
class Log{
    private $dir;


    /**
     * Hook初始化
     */
    function __construct($info)
    {
        

    }

    /**
     *  注册添加插件
     * @param $name 钩子名称
     * @param $func 钩子使用的方法
     */
    public static function add($name,$func)
    {
        $GLOBALS['hookList'][$name][]=$func;
    }

}

