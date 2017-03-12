<?php
namespace goldphp;
class Hook{
    
    public static function setTimeHook($hook){
        GoldPHP::$app['_hook']['time'][$hook]=microtime(true);
    }
    public static function getTimeHook($hook){
        return microtime(true)-GoldPHP::$app['_hook']['time'][$hook];
    } 
}