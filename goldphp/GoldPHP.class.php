<?php
/**
 * GoldPHP[Easy PHP]
 * ---------------------------------------
 * Copyright (c) 2012~2017 http://goldphp.cn331.com All rights reserved.
 * ---------------------------------------
 * Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
 * ---------------------------------------
 * Author: GoldPHP <Dreamphp@cn331.com>
 * ---------------------------------------
 * 核心基类
 */
namespace goldphp;
class GoldPHP{
    static $app;
    public static function checkPhpVersion(){
        version_compare(PHP_VERSION, '5.3.0','>=') or die('PHP Version:'.PHP_VERSION.'<5.3.0');
    }
    /**
     * 初始化
     */
    public static function init(){
        static::checkPhpVersion(); 
        //手动记录开始时间
        static::$app['_hook']['time']['run_time']=microtime(true);
    }
    public static function run(){
        static::init();//初始化
        Autoloader::register();//自动载入 
        Error::register();//注册ERROR
        Router::run();//路由器解析定位
        //开始执行控制器 
        Hook::setTimeHook('controller_time');
        $class_obj = REAL_CONTROLLER;//此行必须存在
        $class_obj = new $class_obj();  //只能使用变量实例化
        if(method_exists($class_obj, ACTION_NAME))call_user_func([$class_obj,ACTION_NAME]);//如果控制器方法存在
        else call_user_func([$class_obj,'show']); 
        Hook::getTimeHook('controller_time');//controller用时
        Error::$mBbnormal=false;//无错执行
        
    }
    public static function autoload($class_name){ 
        $file=WEB_ROOT.'/'.str_replace('\\', '/', $class_name).'.class.php';//文件 必须以.class.php结束
        if(is_file($file))include($file); 
        #var_dump(is_file($file));exit($file);
    } 
}