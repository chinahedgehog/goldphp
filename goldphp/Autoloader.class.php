<?php
/**
 * GoldPHP[Easy PHP]
 * ---------------------------------------
 * Copyright (c) 2012~2017 http://goldphp.cn331.com All rights reserved.
 * ---------------------------------------
 * Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
 * ---------------------------------------
 * Author: GoldPHP <GoldPHP@cn331.com>
 * ---------------------------------------
 * 核心基类
 */
namespace goldphp;
class Autoloader{
    public static function register(){
        spl_autoload_register([__CLASS__,'class_autoload']);
    }
    public static function class_autoload($class_name){ 
        $file=WEB_ROOT.'/'.str_replace('\\', '/', $class_name).'.class.php';//文件 必须以.class.php结束
        if(is_file($file))include($file); 
        #var_dump(is_file($file));exit($file);
    } 
}