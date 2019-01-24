<?php
/**
 * 日志类
 * ay@7cuu.com
 * 2019-1-11
 *
 */
namespace Ayflying;

use Exception;

// 日志类
class Log{
    /**
     * 数据库配置
     * @var array
     */
    public static $config = [
        'path' => __DIR__ . '/logs/',
        // 日志文件大小限制（超出会生成多个文件）
        'file_size' => 1024*1024*100,
    ];
    /**
     * 日志写入驱动
     * @var string
     */
    public static $driver = 'File';
    //分割符号，默认为array,可以为json，或者自定义分隔符
    public static $depr = 'json';
    public static $debug = true;
    private static $data;


    /**
     * 初始化
     * @param $info
     */
    function __construct($info)
    {

    }

    //public static function


    /**
     * 记录日志信息到内存
     * @param string|array $data
     */
    public static function record($name,$data){
        
        self::$data[] = [
            'name' => $name,
            'data' => $data,
        ];
        //self::save($name,$data);

    }

    /**
     * 把保存在内存中的日志信息（用指定的记录方式）写入，并清空内存中的日志
     * @param string $name
     * @param string|array $data
     * @return bool
     */
    public static function save($data = null){

		
        if(empty($data)){
            $data = self::$data;
        }else{
            $data[] = $data;
        }
		
		//日志为空不写入
		if(!is_array($data)){
			return false;
		}

        foreach($data as $val){
            //日志文件路径
            $destination = self::$config['path'] . date('Ym') . '/' . date('d') . '/' . $val['name']  . '.log';
            // 检测日志文件大小，超过配置大小则备份日志文件重新生成
            if (is_file($destination) && floor(self::$config['file_size']) <= filesize($destination)){
                try {
                    rename($destination, dirname($destination) . '/' . time() . '-' . basename($destination));
                } catch (\Exception $e) {
                }
            }

            $path = dirname($destination);
            //return $path;
            !is_dir($path) && mkdir($path, 0755, true);
            $message = self::format($val['data']);
            error_log($message,3,$destination);

        }

        return true;

    }

    /**
     * 实时写入一条日志信息，会触发save操作
     * @param string $name
     * @param string|array $data
     * @return bool
     */
    public static function write($name,$data){
        self::$data = [
            'name' => $name,
            'data' => $data,
        ];
        return self::save($data);


    }

    /**
     * 转换格式
     * @param $arr
     * @return string
     */
    private static function format($arr){

        switch (self::$depr){
            case 'json':
                $str = json_encode($arr);
                break;
            case 'array':
                return $arr;
                break;
            default:
                $str = implode(self::$depr,$arr);

        }

        return $str.PHP_EOL;
    }




}

