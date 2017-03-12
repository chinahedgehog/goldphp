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
class Error{
    static $mBbnormal=true;
    public static function register(){
        set_error_handler([__CLASS__,'error']);
        set_exception_handler([__CLASS__,'exception']);
        register_shutdown_function([__CLASS__,'shutdown']); 
    }
    public static function error($errno, $errstr, $errfile, $errline){
        echo "error:$errstr,errno:$errno,errfile:$errfile,errline:$errline"; 
        exit;
    }
    public static function exception($exception){
        var_dump($exception,'.....');
    }
    public static  function shutdown(){
        if(static::$mBbnormal){
            $errstr=error_get_last();
            if($errstr)var_dump($errstr);
        }
    }
    
}