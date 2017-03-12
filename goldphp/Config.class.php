<?php
namespace goldphp;
class Config{
    static $config;
    public static function init(){
        if(!Config::$config){//没有被初始化
            $cfile=WEB_ROOT.'/dreamphp/config/core.php';
            $config=include($cfile); 
            if(isset($config['load_file']) and is_array($config['load_file'])){
                foreach($config['load_file'] as $file){
                    $config=array_merge($config,include($file));
                }
            }
            
            Config::$config=$config;
        } 
        return   Config::$config;
    }
    public function __construct($key=''){ 
        return static::getConfig($key);
    }
    public static function getConfig($key=''){
        if(!Config::$config)Config::init(); 
        return isset(Config::$config[$key])?Config::$config[$key]:null;
       
    }
    public static function setConfig($key,$value){
        if(!Config::$config)Config::init();
        return Config::$config[$key]=$value;
    }
}