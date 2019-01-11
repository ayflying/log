<?php
/**
 * 日志类
 * ay@7cuu.com
 * 2019-1-11
 *
 */
namespace Ayflying\Log;

// 插件类
class Log{
    private $dir;


    /**
     * 初始化
     * @param $info
     */
    function __construct($info)
    {
        

    }


    /**
     * 记录日志信息到内存
     * @param string|array $data
     */
    public static  function record($data){

    }

    /**
     * 把保存在内存中的日志信息（用指定的记录方式）写入，并清空内存中的日志
     * @param string|array $data
     */
    public static  function save($data){

    }

    /**
     * 实时写入一条日志信息，会触发save操作
     * @param string|array $data
     */
    public static  function write($data){

    }




}

