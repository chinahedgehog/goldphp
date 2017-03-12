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
 * 路由器
 */
namespace goldphp;
class Router{
    public static function run(){
        static::parseUrl();
    }
    public static function parseUrl(){ 
        $module=isset($_GET['m'])?$_GET['m']:DEFAULT_MODULE;
        $controller=isset($_GET['c'])?$_GET['c']:DEFAULT_CONTROLLER;
        $action=isset($_GET['a'])?$_GET['a']:DEFAULT_ACTION;
        //定义系统常用常量
        define('MODULE_NAME',$module);
        define('CONTROLLER_NAME',$controller);
        define('ACTION_NAME',$action);  
        
        define('REAL_CONTROLLER','\app\\'.MODULE_NAME.'\\controllers\\'.ucfirst(CONTROLLER_NAME).'Controller');
        
    } 
    
}