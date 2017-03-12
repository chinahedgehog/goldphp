<?php
namespace goldphp\drivers;
class Mysql{
    static $links=[];  
    public $mPdo;
    public static function init($config,$link='0'){
        if(!isset(Mysql::$links[$link])){ 
            if(isset($config['read'])){
                $dsn="mysql:host={$config['read']['host']};dbname={$config['read']['dbname']}"; 
                Mysql::$links[$link]['read']=new \PDO(
                    $dsn,
                    $config['read']['username'],
                    $config['read']['password']
                    );
                if(!isset($config['write']))$config['write']=$config['read'];
                $dsn="mysql:host={$config['write']['host']};dbname={$config['write']['dbname']}";
                Mysql::$links[$link]['write']=new \PDO(
                    $dsn,
                    $config['write']['username'],
                    $config['write']['password']
                    );
            }
        }
        return static::$links[$link];
    }
    public function __construct($config,$link='0'){
        return $this->mPdo=Mysql::init($config,$link='0');
    }
    public function query($sql,$link='0'){
          return static::$links[$link]['read']->query($sql); 
    }
    public function one($obj){
        return $obj->fetch();
    }
    public function all($obj){
        return $obj->fetchall();
    }
}