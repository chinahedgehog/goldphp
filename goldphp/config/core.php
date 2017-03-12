<?php
return [
    'load_config'=>[
        WEB_ROOT.'/app/config/config.php',
        WEB_ROOT.'/app/'.MODULE_NAME.'/config/config.php',
    ],
    'db'=>[
        'drivers'=>'Mysql',//驱动
        'prefix'=>'test_',//表前缀
        'read'=>[ 
            'host'=>'localhost', 
            'dbname'=>'test',
            'username'=>'test',
            'password'=>'test',
        ],/*
        'write'=>[
            'drivers'=>'Mysql',
            'host'=>'',
            'name'=>'',
            'username'=>'',
            'password'=>'',
        ],
        */
    ],
    
];