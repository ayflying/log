<?php
/**
 * 日志类
 * ay@7cuu.com
 * 2019-1-11
 *
 */
namespace Ayflying\Log;

// 日志类
class Log{
    /**
     * 数据库配置
     * @var array
     */
    protected  static $config = [
        //'path' => __DIR__ . '/../../public/log/',
        'path' => '/opt/data/wwwroot/heibang/public/log/',
    ];
    /**
     * 日志写入驱动
     * @var string
     */
    static $driver = 'File';
    static $dir;
    static $time;
    static $name;


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
    public static function record($data){


    }

    /**
     * 把保存在内存中的日志信息（用指定的记录方式）写入，并清空内存中的日志
     * @param string $name
     * @param string|array $data
     * @return bool
     */
    public static function save($name,$data){
        self::format($data);


        $destination = self::$config['path'] . date('Ym') . '/' . date('d') . '/' . $name  . '.log';

        $path = dirname($destination);
        //echo $path;

        //return $path;
        !is_dir($path) && mkdir($path, 0755, true);
        $message = self::format($data);
        return error_log($message,3,$destination);

    }

    /**
     * 实时写入一条日志信息，会触发save操作
     * @param string $name
     * @param string|array $data
     * @return bool
     */
    public static function write($name,$data){

        return self::save($name,$data);


    }

    /**
     * 转换格式
     * @param $arr
     * @return string
     */
    private static function format($arr){

        $str = implode("|",$arr);
        return $str;
    }




}

